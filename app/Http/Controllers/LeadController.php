<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Notification; // ADD YE IMPORT

class LeadController extends Controller
{
    public function index()
    {
        $managers = User::where('role', 'manager')->get();

        $leads = Lead::join('users', 'leads.assigned_to', '=', 'users.id')
            ->select('leads.*', 'users.name as assigned_user_name')
            ->latest('leads.created_at')
            ->get();

        return view('leads.index', compact('leads', 'managers'));
    }

    public function create()
    {
        $users = User::where('role', 'manager')->get();
        return view('leads.create', compact('users'));
    }

    // ✅ UPDATED store method - Added notification trigger
    public function store(Request $request)
    {
        $request->validate([
            'contact_person' => 'required|string|max:255',
            'company_name'   => 'required|string|max:255',
            'mobile_no'      => 'required|string|max:20',
            'email_id'       => 'nullable|email',
            'assigned_to'    => 'required|exists:users,id',
            'lead_source'    => 'required|string',
            'lead_for'       => 'required|string',
        ]);

        // Lead create karo aur variable mein store karo
        $lead = Lead::create([
            'lead_source'     => $request->lead_source,
            'lead_for'        => $request->lead_for,
            'lead_priority'   => $request->lead_priority ?? 'Medium',
            'contact_person'  => $request->contact_person,
            'lead_date'       => $request->lead_date ?? now(),
            'company_name'    => $request->company_name,
            'mobile_no'       => $request->mobile_no,
            'whatsapp_no'     => $request->whatsapp_no,
            'email_id'        => $request->email_id,
            'address'         => $request->address,
            'country'         => $request->country,
            'state'           => $request->state,
            'city'            => $request->city,
            'pincode'         => $request->pincode,
            'assigned_to'     => $request->assigned_to,
        ]);

        // 🔥 NOTIFICATION CREATE KARO - Manager ko notification bhejo
        Notification::createLeadAssignedNotification(
            $request->assigned_to, // Manager ID jo lead assign hui hai
            [
                'id' => $lead->id,
                'company_name' => $lead->company_name,
                'contact_person' => $lead->contact_person,
                'mobile_no' => $lead->mobile_no,
            ]
        );

        // Sabhi leads fetch karke store view bhej do
        $leads = Lead::latest()->get();

        return view('leads.store', compact('leads'))
               ->with('success', 'Lead added successfully!');
    }

    // ✅ ALTERNATIVE: If you want to keep using $request->all()
    public function storeAlternative(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'contact_person' => 'required|string|max:255',
            'company_name' => 'required|string|max:255', 
            'mobile_no' => 'required|string|max:20|unique:leads,mobile_no',
            'email_id' => 'nullable|email',
            'assigned_to' => 'required|exists:users,id',
        ]);

        // Create with all validated data
        $lead = Lead::create($request->all());

        // Manager ko notification bhejo
        Notification::createLeadAssignedNotification(
            $request->assigned_to,
            [
                'id' => $lead->id,
                'company_name' => $lead->company_name,
                'contact_person' => $lead->contact_person,
                'mobile_no' => $lead->mobile_no,
            ]
        );

        $leads = Lead::join('users', 'leads.assigned_to', '=', 'users.id')
            ->select('leads.*', 'users.name as assigned_user_name')
            ->where('leads.assigned_to', auth()->id())
            ->latest('leads.created_at')
            ->get();

        return view('leads.store', compact('leads'))
            ->with('success', 'Lead added successfully!');
    }

    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        $users = User::all();
        $salesmen = User::where('role', 'salesman')->get();
        
        return view('leads.edit', compact('lead', 'users', 'salesmen'));
    }

    // ✅ UPDATED update method - Added notification for lead updates
    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        
        // Validation for update (ignore current record)
        $request->validate([
            'contact_person' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:20|unique:leads,mobile_no,' . $id,
            'email_id' => 'nullable|email',
        ]);
        
        // Check if assignment changed
        $oldAssignedTo = $lead->assigned_to;
        $newAssignedTo = $request->assigned_to;
        
        $lead->update($request->all());
        
        // If assignment changed, notify the new manager
        if ($oldAssignedTo != $newAssignedTo && $newAssignedTo) {
            Notification::createLeadAssignedNotification(
                $newAssignedTo,
                [
                    'id' => $lead->id,
                    'company_name' => $lead->company_name,
                    'contact_person' => $lead->contact_person,
                    'mobile_no' => $lead->mobile_no,
                ]
            );
        }
        
        return redirect()->route('dashboard')->with('success', 'Lead updated successfully!');
    }
}