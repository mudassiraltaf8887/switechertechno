<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\ManagerLead;
use App\Models\User;
use App\Models\Notification; // ADD YE IMPORT
use Illuminate\Http\Request;
use App\Models\SalesmanLead; 

class ManagerLeadController extends Controller
{
    public function index()
    {
        $managerLeads = ManagerLead::with(['assignedManager', 'assignedSalesman'])->get();
        return view('manager.index', compact('managerLeads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'manager_lead_priority' => 'required',
            'physical_demo_date' => 'required',
            'assigned_to_salesman' => 'required',
            'original_lead_id' => 'required'
        ]);

        // Create managerlead with all data
        $managerLead = ManagerLead::create([
            // Original lead data
            'lead_source' => $request->lead_source,
            'lead_for' => $request->lead_for,
            'lead_priority' => $request->lead_priority,
            'contact_person' => $request->contact_person,
            'lead_date' => $request->lead_date,
            'company_name' => $request->company_name,
            'mobile_no' => $request->mobile_no,
            'whatsapp_no' => $request->whatsapp_no,
            'email_id' => $request->email_id,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'assigned_to' => $request->assigned_to,

            // Manager input
            'manager_lead_priority' => $request->manager_lead_priority,
            'physical_demo_date' => $request->physical_demo_date,
            'manager_remarks' => $request->manager_remarks,
            'assigned_to_salesman' => $request->assigned_to_salesman,
            'original_lead_id' => $request->original_lead_id,
        ]);

        // ManagerLeadController store method mein - notification wali line change kar
        Notification::create([
            'user_id' => $request->assigned_to_salesman,
            'title' => 'New Lead Assignment',
            'message' => 'New lead assigned to you by Manager',
            'type' => 'lead_assignment',
            'is_read' => 0,
            'data' => json_encode([
                'lead_id' => $request->original_lead_id,
                'manager_id' => auth()->id(),
                'url' => route('salesman.edit.lead', $request->original_lead_id) // 🔥 YE ADD KAR
            ])
        ]);

        return redirect()->route('manager.dashboard')
            ->with('success', 'Lead assigned to salesman successfully!');
    }

    // ✅ UPDATED dashboard method with notifications
    public function dashboard(Request $request)
    {
        $managerId = auth()->id();

        // Get filter parameters
        $dateFilter = $request->get('date_filter');
        $salesmanFilter = $request->get('salesman_filter');
        $priorityFilter = $request->get('priority_filter');
        $sourceFilter = $request->get('source_filter');
        $assignmentFilter = $request->get('assignment_filter');
        $searchTerm = $request->get('search');

        // Start with base query
        $leadsQuery = Lead::where('assigned_to', $managerId);

        // Apply date filter
        if ($dateFilter) {
            switch ($dateFilter) {
                case 'today':
                    $leadsQuery->whereDate('created_at', today());
                    break;
                case 'yesterday':
                    $leadsQuery->whereDate('created_at', yesterday());
                    break;
                case 'this_week':
                    $leadsQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'this_month':
                    $leadsQuery->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year);
                    break;
                case 'last_month':
                    $leadsQuery->whereMonth('created_at', now()->subMonth()->month)
                        ->whereYear('created_at', now()->subMonth()->year);
                    break;
            }
        }

        // Apply priority filter
        if ($priorityFilter && $priorityFilter !== 'all') {
            $leadsQuery->where('lead_priority', $priorityFilter);
        }

        // Apply source filter
        if ($sourceFilter && $sourceFilter !== 'all') {
            $leadsQuery->where('lead_source', $sourceFilter);
        }

        // Apply search filter
        if ($searchTerm) {
            $leadsQuery->where(function ($query) use ($searchTerm) {
                $query->where('contact_person', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('company_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('mobile_no', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Get filtered leads
        $leads = $leadsQuery->orderBy('created_at', 'desc')->get();

        // Add salesman info to each lead
        $assignedLeads = $leads->map(function ($lead) {
            // Check if this lead has manager assignment
            $managerLead = ManagerLead::where('original_lead_id', $lead->id)->first();

            if ($managerLead && $managerLead->assigned_to_salesman) {
                // Get salesman info
                $salesman = User::find($managerLead->assigned_to_salesman);
                $lead->assigned_salesman_name = $salesman ? $salesman->name : 'Unknown';
                $lead->assigned_salesman_id = $managerLead->assigned_to_salesman;
                $lead->is_assigned = true;
            } else {
                $lead->assigned_salesman_name = null;
                $lead->assigned_salesman_id = null;
                $lead->is_assigned = false;
            }

            return $lead;
        });

        // Apply assignment filter after mapping
        if ($assignmentFilter && $assignmentFilter !== 'all') {
            if ($assignmentFilter === 'assigned') {
                $assignedLeads = $assignedLeads->filter(function ($lead) {
                    return $lead->is_assigned;
                });
            } elseif ($assignmentFilter === 'not_assigned') {
                $assignedLeads = $assignedLeads->filter(function ($lead) {
                    return !$lead->is_assigned;
                });
            } elseif (is_numeric($assignmentFilter)) {
                // Filter by specific salesman
                $assignedLeads = $assignedLeads->filter(function ($lead) use ($assignmentFilter) {
                    return $lead->assigned_salesman_id == $assignmentFilter;
                });
            }
        }

        // Apply salesman filter if specified
        if ($salesmanFilter && $salesmanFilter !== 'all' && is_numeric($salesmanFilter)) {
            $assignedLeads = $assignedLeads->filter(function ($lead) use ($salesmanFilter) {
                return $lead->assigned_salesman_id == $salesmanFilter;
            });
        }

        // Calculate stats from original leads (before assignment filter)
        $totalLeads = $leads->count();
        $todaysLeads = $leads->filter(function ($lead) {
            return $lead->created_at->isToday();
        })->count();
        $highPriorityLeads = $leads->where('lead_priority', 'High')->count();
        $assignedSalesmen = ManagerLead::whereIn('original_lead_id', $leads->pluck('id'))
            ->whereNotNull('assigned_to_salesman')
            ->distinct('assigned_to_salesman')
            ->count();

        // 🔥 NEW - Notifications data add kiya
        $unreadNotifications = Notification::forUser($managerId)
            ->unread()
            ->recent()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $notificationCount = Notification::forUser($managerId)
            ->unread()
            ->count();

        // Get all salesmen for dropdown
        $allSalesmen = User::where('role', 'salesman')->get();

        // Get all lead sources for dropdown
        $allSources = Lead::where('assigned_to', $managerId)
            ->distinct()
            ->pluck('lead_source')
            ->filter()
            ->values();

        // Current filter values for form
        $currentFilters = [
            'date_filter' => $dateFilter,
            'salesman_filter' => $salesmanFilter,
            'priority_filter' => $priorityFilter,
            'source_filter' => $sourceFilter,
            'assignment_filter' => $assignmentFilter,
            'search' => $searchTerm
        ];

        return view('manager.dashboard', compact(
            'assignedLeads',
            'totalLeads',
            'todaysLeads',
            'highPriorityLeads',
            'assignedSalesmen',
            'allSalesmen',
            'allSources',
            'currentFilters',
            'unreadNotifications',  // NEW
            'notificationCount'     // NEW
        ));
    }

    // ✅ Fixed edit method - Lead table se data lao
    public function edit($id)
    {
        $lead = Lead::findOrFail($id);

        // Sirf salesmen users lao
        $salesmen = User::where('role', 'salesman')->get();

        return view('manager.lead-edit', compact('lead', 'salesmen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'manager_lead_priority' => 'required',
            'physical_demo_date' => 'required',
            'assigned_to_salesman' => 'required'
        ]);

        $lead = ManagerLead::findOrFail($id);
        $lead->update([
            'manager_lead_priority' => $request->manager_lead_priority,
            'physical_demo_date' => $request->physical_demo_date,
            'manager_remarks' => $request->manager_remarks,
            'assigned_to_salesman' => $request->assigned_to_salesman,
        ]);

        return redirect()->route('manager.dashboard')->with('success', 'Lead updated successfully!');
    }

    // 🔥 NEW - Notification methods add kiye
    public function markNotificationAsRead($id)
    {
        $notification = Notification::forUser(auth()->id())->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllNotificationsAsRead()
    {
        Notification::forUser(auth()->id())->unread()->update([
            'is_read' => true,
            'read_at' => now()
        ]);

        return response()->json(['success' => true]);
    }

    public function getNotifications()
    {
        $notifications = Notification::forUser(auth()->id())
            ->unread()
            ->recent()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return response()->json($notifications);
    }
    // Lead view/detail method
    public function show($id)
    {
        $lead = Lead::findOrFail($id);

        // Check if this manager owns this lead
        if ($lead->assigned_to != auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Get manager lead details if exists
        $managerLead = ManagerLead::where('original_lead_id', $id)->first();

        // Get all salesmen for assignment dropdown (if needed)
        $salesmen = User::where('role', 'salesman')->get();

        return view('manager.lead-view', compact('lead', 'managerLead', 'salesmen'));
    }
}