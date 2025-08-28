<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Salesman Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .dashboard-card { border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: none; color: white; }
        .card-green { background: linear-gradient(135deg, #28a745, #20c997); }
        .card-blue { background: linear-gradient(135deg, #007bff, #17a2b8); }
        .card-orange { background: linear-gradient(135deg, #fd7e14, #ffc107); }
        .filter-container, .table-container { background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px; }
        .priority-low { background-color: #28a745; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px; }
        .priority-medium { background-color: #ffc107; color: black; padding: 4px 8px; border-radius: 15px; font-size: 12px; }
        .priority-high { background-color: #dc3545; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px; }
        .priority-urgent { background-color: #6f42c1; color: white; padding: 4px 8px; border-radius: 15px; font-size: 12px; }
        .lead-source, .lead-for { font-size: 11px; padding: 4px 8px; border-radius: 10px; }
        .phone-link { color: #28a745; text-decoration: none; }
        .phone-link:hover { color: #20c997; }
        .filter-btn { border-radius: 20px; padding: 8px 15px; }
        .clear-filters { background: linear-gradient(135deg, #dc3545, #e74c3c); border: none; color: white; border-radius: 20px; padding: 8px 15px; }

        /* Notification Styles */
        .notification-container { position: relative; display: inline-block; }
        .notification-bell { position: relative; background: none; border: none; font-size: 24px; color: #6c757d; cursor: pointer; margin-right: 15px; transition: all 0.3s ease; }
        .notification-bell:hover { color: #007bff; transform: scale(1.1); }
        .notification-badge { position: absolute; top: -8px; right: -8px; background: #dc3545; color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 10px; display: flex; align-items: center; justify-content: center; font-weight: bold; animation: pulse 2s infinite; }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }
        .notification-dropdown { position: absolute; top: 100%; right: 0; background: white; border: 1px solid #dee2e6; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.15); width: 350px; max-height: 400px; overflow-y: auto; z-index: 1000; display: none; }
        .notification-header { padding: 15px 20px; border-bottom: 1px solid #dee2e6; background: #f8f9fa; border-radius: 10px 10px 0 0; }
        .notification-header h6 { margin: 0; color: #495057; font-weight: 600; }
        .notification-item { padding: 12px 20px; border-bottom: 1px solid #f1f1f1; cursor: pointer; transition: background-color 0.3s ease; position: relative; }
        .notification-item:hover { background-color: #f8f9fa; }
        .notification-item.unread { background-color: #e3f2fd; border-left: 4px solid #007bff; }
        .notification-item.unread::before { content: ''; position: absolute; top: 15px; right: 15px; width: 8px; height: 8px; background: #007bff; border-radius: 50%; }
        .notification-title { font-weight: 600; color: #495057; margin-bottom: 5px; font-size: 14px; }
        .notification-message { color: #6c757d; font-size: 13px; margin-bottom: 5px; }
        .notification-time { color: #adb5bd; font-size: 11px; }
        .no-notifications { padding: 40px 20px; text-align: center; color: #6c757d; }
        .mark-all-read { padding: 10px 20px; text-align: center; border-top: 1px solid #dee2e6; }
        .mark-all-read button { background: none; border: none; color: #007bff; font-size: 12px; text-decoration: underline; cursor: pointer; }
    </style>
</head>

<body>
    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Salesman Dashboard</h2>
                <p class="text-muted mb-0">Welcome, {{ Auth::user()->name }}!</p>
            </div>
            <div class="d-flex align-items-center">
                <!-- Notification Bell -->
                <div class="notification-container">
                    <button class="notification-bell" onclick="toggleNotifications()">
                        <i class="fas fa-bell"></i>
                        @if($notificationCount > 0)
                            <span class="notification-badge">{{ $notificationCount }}</span>
                        @endif
                    </button>
                    
                    <div class="notification-dropdown" id="notificationDropdown">
                        <div class="notification-header">
                            <h6>Notifications ({{ $notificationCount }})</h6>
                        </div>
                        
                        @if($unreadNotifications->count() > 0)
                            @foreach($unreadNotifications as $notification)
                                @php
                                    $data = json_decode($notification->data ?? '{}', true);
                                    $leadUrl = $data['url'] ?? route('salesman.edit.lead', $data['lead_id'] ?? 0);
                                @endphp
                                <div class="notification-item unread" onclick="markAsReadAndRedirect({{ $notification->id }}, '{{ $leadUrl }}')">
                                    <div class="notification-message">{{ $notification->message }}</div>
                                    <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-notifications">No new notifications</div>
                        @endif
                        
                        @if($notificationCount > 0)
                            <div class="mark-all-read">
                                <button onclick="markAllAsRead()">Mark all as read</button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card dashboard-card card-blue">
                    <div class="card-body text-center">
                        <i class="fas fa-list fa-3x mb-3"></i>
                        <h4>{{ $totalLeads }}</h4>
                        <p class="mb-0">Total Leads</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card dashboard-card card-green">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-day fa-3x mb-3"></i>
                        <h4>{{ $todayLeads }}</h4>
                        <p class="mb-0">Today's Leads</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card dashboard-card card-orange">
                    <div class="card-body text-center">
                        <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                        <h4>{{ $highPriorityLeads }}</h4>
                        <p class="mb-0">High Priority</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-container">
            <form method="GET" action="{{ route('salesman.dashboard') }}" id="filterForm">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">From Date</label>
                        <input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">To Date</label>
                        <input type="date" class="form-control" name="date_to" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Priority</label>
                        <select class="form-control" name="priority">
                            <option value="">All Priorities</option>
                            <option value="Low" {{ request('priority')=='Low'?'selected':'' }}>Low</option>
                            <option value="Medium" {{ request('priority')=='Medium'?'selected':'' }}>Medium</option>
                            <option value="High" {{ request('priority')=='High'?'selected':'' }}>High</option>
                            <option value="Urgent" {{ request('priority')=='Urgent'?'selected':'' }}>Urgent</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Lead Source</label>
                        <select class="form-control" name="lead_source">
                            <option value="">All Sources</option>
                            <option value="Facebook" {{ request('lead_source')=='Facebook'?'selected':'' }}>Facebook</option>
                            <option value="Google Ads" {{ request('lead_source')=='Google Ads'?'selected':'' }}>Google Ads</option>
                            <option value="Olx" {{ request('lead_source')=='Olx'?'selected':'' }}>Olx</option>
                        </select>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary filter-btn me-2"><i class="fas fa-search"></i> Apply Filters</button>
                    <button type="button" onclick="exportResults()" class="btn btn-success filter-btn"><i class="fas fa-download"></i> Export</button>
                </div>
            </form>
        </div>

        <!-- Leads Table -->
        <div class="table-container">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th><th>Contact</th><th>Company</th><th>Mobile</th><th>Lead Source</th><th>Priority</th><th>Date</th><th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myLeads as $index=>$lead)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $lead->contact_person }}</td>
                        <td>{{ $lead->company_name ?? 'N/A' }}</td>
                        <td><a href="tel:{{ $lead->mobile_no }}" class="phone-link">{{ $lead->mobile_no }}</a></td>
                        <td><span class="lead-source badge bg-primary">{{ $lead->lead_source ?? 'N/A' }}</span></td>
                        <td><span class="priority-{{ strtolower($lead->lead_priority??'medium') }}">{{ $lead->lead_priority ?? 'Medium' }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($lead->lead_date)->format('d-M-Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('salesman.edit.lead',$lead->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <a href="tel:{{ $lead->mobile_no }}" class="btn btn-success"><i class="fas fa-phone"></i></a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted">No leads found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleNotifications() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }

        // NEW FUNCTION - Notification click pe lead page pe le jaye
        function markAsReadAndRedirect(notificationId, url) {
            fetch(`/salesman/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && url && url !== '#') {
                    window.location.href = url; // Lead edit page pe redirect
                } else {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function markAllAsRead() {
            fetch('/salesman/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('notificationDropdown');
            const container = document.querySelector('.notification-container');
            
            if (!container.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        function exportResults() {
            const url = new URL(window.location.href);
            url.searchParams.set('export', 'excel');
            window.location.href = url.toString();
        }
    </script>
</body>
</html>