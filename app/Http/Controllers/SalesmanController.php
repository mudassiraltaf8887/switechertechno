<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\ManagerLead;
use App\Models\Notification;
use App\Models\SalesmanLead;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class SalesmanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Agar salesman nahi hai to manager dashboard pe bhej do
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role !== 'salesman') {
                return redirect('/manager/dashboard');
            }
            return $next($request);
        });
    }

  public function dashboard(Request $request)
{
    $salesmanId = Auth::id();
    $salesmanName = Auth::user()->name;

    // 🔥 NOTIFICATIONS ADD KIYE
    $unreadNotifications = Notification::where('user_id', $salesmanId)
        ->where('is_read', 0)
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();
        
    $notificationCount = Notification::where('user_id', $salesmanId)
        ->where('is_read', 0)
        ->count();

    // 🔥 FIX: Direct leads fetch karo jo salesman ko assign hain
    $assignedLeadIds = ManagerLead::where('assigned_to_salesman', $salesmanId)
        ->pluck('original_lead_id')
        ->toArray();

    // Base query for leads
    $query = Lead::whereIn('id', $assignedLeadIds);

    // Get all leads for total count
    $totalLeads = $query->count();

    // Apply filters
    if ($request->filled('date_from') || $request->filled('date_to')) {
        if ($request->filled('date_from')) {
            $query->where('lead_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('lead_date', '<=', $request->date_to);
        }
    }

    // Quick date filters
    if ($request->filled('quick_date')) {
        switch ($request->quick_date) {
            case 'today':
                $query->whereDate('lead_date', today());
                break;
            case 'yesterday':
                $query->whereDate('lead_date', yesterday());
                break;
            case 'this_week':
                $query->whereBetween('lead_date', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
                break;
            case 'last_week':
                $query->whereBetween('lead_date', [
                    now()->subWeek()->startOfWeek(),
                    now()->subWeek()->endOfWeek()
                ]);
                break;
            case 'this_month':
                $query->whereMonth('lead_date', now()->month)
                      ->whereYear('lead_date', now()->year);
                break;
            case 'last_month':
                $query->whereMonth('lead_date', now()->subMonth()->month)
                      ->whereYear('lead_date', now()->subMonth()->year);
                break;
        }
    }

    // Priority filter
    if ($request->filled('priority')) {
        $query->where('lead_priority', $request->priority);
    }

    // Lead source filter
    if ($request->filled('lead_source')) {
        $query->where('lead_source', $request->lead_source);
    }

    // Lead for filter
    if ($request->filled('lead_for')) {
        $query->where('lead_for', $request->lead_for);
    }

    // Search filter (contact person, company, mobile)
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($subQuery) use ($searchTerm) {
            $subQuery->where('contact_person', 'LIKE', "%{$searchTerm}%")
                     ->orWhere('company_name', 'LIKE', "%{$searchTerm}%")
                     ->orWhere('mobile_no', 'LIKE', "%{$searchTerm}%")
                     ->orWhere('email_id', 'LIKE', "%{$searchTerm}%");
        });
    }

    // Company filter
    if ($request->filled('company')) {
        $query->where('company_name', 'LIKE', "%{$request->company}%");
    }

    // Export functionality
    if ($request->get('export') === 'excel') {
        $exportLeads = $query->get();
        return $this->exportLeads($exportLeads);
    }

    // Get filtered results
    $myLeads = $query->orderBy('created_at', 'desc')->get();

    // Data for cards (based on filtered results)
    $todayLeads = $myLeads->filter(function($lead) {
        return $lead && \Carbon\Carbon::parse($lead->created_at)->isToday();
    })->count();
    
    $highPriorityLeads = $myLeads->filter(function($lead) {
        return $lead && in_array($lead->lead_priority, ['High', 'Urgent']);
    })->count();

    // Recently updated leads
    $recentLeads = $myLeads->sortByDesc('updated_at')->take(6);

    return view('salesman.dashboard', compact(
        'myLeads',
        'salesmanName',
        'todayLeads',
        'totalLeads',
        'highPriorityLeads',
        'recentLeads',
        'unreadNotifications',  // 🔥 YE ADD KIYA
        'notificationCount'     // 🔥 YE ADD KIYA
    ));
}

// Export method (optional)
private function exportLeads($leads)
{
    $filename = 'leads_export_' . date('Y-m-d_H-i-s') . '.csv';
    
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
        'Pragma' => 'no-cache',
        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        'Expires' => '0'
    ];

    $callback = function() use ($leads) {
        $file = fopen('php://output', 'w');
        
        // CSV headers
        fputcsv($file, [
            'Contact Person', 'Company', 'Mobile', 'Email', 
            'Lead Source', 'Lead For', 'Priority', 'Date', 'Address'
        ]);

        // CSV data
        foreach ($leads as $managerLead) {
            if ($managerLead->lead) {
                $lead = $managerLead->lead;
                fputcsv($file, [
                    $lead->contact_person,
                    $lead->company_name,
                    $lead->mobile_no,
                    $lead->email_id,
                    $lead->lead_source,
                    $lead->lead_for,
                    $lead->lead_priority,
                    $lead->lead_date,
                    $lead->address
                ]);
            }
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

    // Edit lead page show karo
    public function editLead($id)
    {
        $lead = Lead::with('managerLead')->findOrFail($id);
        $salesmen = User::where('role', 'salesman')->get();
        return view('salesman.edit-lead', compact('lead', 'salesmen'));
    }

    // Lead update karo
    public function updateLead(Request $request, $id)
    {
        $request->validate([
            'demo_type' => 'required|string',
            'status' => 'required|string',
            'next_followup_date' => 'nullable|date',
            'amount_quotated' => 'nullable|numeric',
            'remarks' => 'nullable|string'
        ]);

        $lead = Lead::findOrFail($id);

        // Check authorization
        if ($lead->assigned_to != Auth::user()->id) {
            return redirect()->route('salesman.dashboard')->with('error', 'Unauthorized access');
        }

        // Save to salesmanlead table
        SalesmanLead::updateOrCreate(
            [
                'lead_id' => $lead->id,
                'salesman_id' => Auth::user()->id
            ],
            [
                'demo_type' => $request->demo_type,
                'status' => $request->status,
                'next_followup_date' => $request->next_followup_date,
                'amount_quotated' => $request->amount_quotated,
                'remarks' => $request->remarks
            ]
        );

        return redirect()->route('salesman.dashboard')->with('success', 'Lead updated successfully!');
    }

    public function storeSalesmanLead(Request $request)
{
    // Validation
    $request->validate([
        'original_lead_id' => 'required|exists:leads,id',
        'contact_person' => 'required|string|max:255',
        'mobile_no' => 'required|string|max:255',
        'demo_type' => 'required|string',
        'status' => 'required|string',
        'manager_lead_priority' => 'required|string',
        'physical_demo_date' => 'required|date',
        'assigned_to_salesman' => 'required|exists:users,id',
    ]);

    try {
        // SalesmanLead table mein saara data save karo
        $salesmanLead = new SalesmanLead();
        
        // Original Lead Information
        $salesmanLead->original_lead_id = $request->original_lead_id;
        $salesmanLead->salesman_id = Auth::id();
        
        // Lead Information
        $salesmanLead->lead_source = $request->lead_source;
        $salesmanLead->lead_for = $request->lead_for;
        $salesmanLead->lead_priority = $request->lead_priority;
        $salesmanLead->lead_date = $request->lead_date;
        $salesmanLead->assigned_to = $request->assigned_to;
        
        // Personal Information
        $salesmanLead->contact_person = $request->contact_person;
        $salesmanLead->company_name = $request->company_name;
        $salesmanLead->mobile_no = $request->mobile_no;
        $salesmanLead->whatsapp_no = $request->whatsapp_no;
        $salesmanLead->email_id = $request->email_id;
        
        // Address Information
        $salesmanLead->address = $request->address;
        $salesmanLead->country = $request->country;
        $salesmanLead->state = $request->state;
        $salesmanLead->city = $request->city;
        $salesmanLead->pincode = $request->pincode;
        
        // Manager Input
        $salesmanLead->manager_lead_priority = $request->manager_lead_priority;
        $salesmanLead->physical_demo_date = $request->physical_demo_date;
        $salesmanLead->assigned_to_salesman = $request->assigned_to_salesman;
        $salesmanLead->manager_remarks = $request->manager_remarks;
        
        // Salesman Input
        $salesmanLead->demo_type = $request->demo_type;
        $salesmanLead->status = $request->status;
        $salesmanLead->next_followup_date = $request->next_followup_date;
        $salesmanLead->amount_quotated = $request->amount_quotated;
        $salesmanLead->salesman_remarks = $request->salesman_remarks;
        
        // Save record
        $salesmanLead->save();

        // 🔥 YE CODE ADD KARO - NOTIFICATIONS BHEJNE KE LIYE
        
        // 1. Manager ko notification bhejo
        $managers = User::where('role', 'manager')->get();
        foreach ($managers as $manager) {
            Notification::create([
                'user_id' => $manager->id,
                'title' => 'Lead Updated by Salesman',
                'message' => 'Lead #' . $request->original_lead_id . ' has been updated by ' . Auth::user()->name,
                'type' => 'lead_update',
                'related_id' => $salesmanLead->id,
                'is_read' => 0
            ]);
        }

        // 2. Assigned salesman ko notification bhejo (agar different hai)
        if ($request->assigned_to_salesman != Auth::id()) {
            Notification::create([
                'user_id' => $request->assigned_to_salesman,
                'title' => 'New Lead Assigned',
                'message' => 'Lead #' . $request->original_lead_id . ' has been assigned to you by ' . Auth::user()->name,
                'type' => 'lead_assignment',
                'related_id' => $salesmanLead->id,
                'is_read' => 0
            ]);
        }

        // 3. Current salesman ko confirmation notification
        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Lead Successfully Updated',
            'message' => 'Lead #' . $request->original_lead_id . ' has been successfully updated and sent to dashboard',
            'type' => 'lead_success',
            'related_id' => $salesmanLead->id,
            'is_read' => 0
        ]);

        // Success page pe redirect karo with lead data
        return redirect()->route('salesman.leadSuccess', ['id' => $salesmanLead->id])
            ->with('success', 'Lead updated successfully! Notifications sent to Manager and assigned Salesman.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error saving lead: ' . $e->getMessage())
            ->withInput();
    }
}
// SalesmanController mein ye method add karo

public function leadSuccess($id)
{
    $salesmanLead = SalesmanLead::with(['originalLead', 'salesman', 'assignedToSalesman'])
        ->findOrFail($id);

    // Check authorization - sirf usi salesman ko dikhe jo create kiya hai
    if ($salesmanLead->salesman_id !== Auth::id()) {
        return redirect()->route('salesman.dashboard')
            ->with('error', 'Unauthorized access');
    }

    return view('salesman.lead-success', compact('salesmanLead'));
}


// Notification methods - SalesmanController mein add kar
public function markNotificationAsRead($id)
{
    $notification = Notification::where('user_id', auth()->id())->findOrFail($id);
    $notification->update(['is_read' => 1]);
    
    return response()->json(['success' => true]);
}

public function markAllNotificationsAsRead()
{
    Notification::where('user_id', auth()->id())
               ->where('is_read', 0)
               ->update(['is_read' => 1]);
    
    return response()->json(['success' => true]);
}



  }

