{{-- File: resources/views/manager-dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .salesman-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-left: 4px solid #28a745;
            transition: all 0.3s ease;
        }
        .salesman-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
        }
        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row bg-primary text-white p-3">
            <div class="col-md-8">
                <h2><i class="fas fa-tachometer-alt"></i> Manager Dashboard</h2>
                <p class="mb-0">Welcome, {{ auth()->user()->name }}!</p>
            </div>
            <div class="col-md-4 text-end">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>Total Leads</h5>
                                <h2>{{ $totalLeads ?? 0 }}</h2>
                            </div>
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>Today's Leads</h5>
                                <h2>{{ $leads->where('created_at', '>=', today())->count() }}</h2>
                            </div>
                            <i class="fas fa-calendar-day fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>High Priority</h5>
                                <h2>{{ $leads->where('lead_priority', 'High')->count() }}</h2>
                            </div>
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card bg-secondary text-white pulse-animation" style="position: relative;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>Assigned Salesmen</h5>
                                
                            </div>
                            <i class="fas fa-user-tie fa-2x"></i>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>

        <!-- NEW: Assigned Salesmen Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5><i class="fas fa-users"></i> Recently Assigned Salesmen 
                           
                        </h5>
                    </div>
                    <div class="card-body" id="assignedSalesmenContainer">
                       
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5><i class="fas fa-bolt"></i> Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('leads.create') }}" class="btn btn-success me-2">
                            <i class="fas fa-plus"></i> Add New Lead
                        </a>
                        <a href="{{ route('leads.index') }}" class="btn btn-primary me-2">
                            <i class="fas fa-list"></i> View All Leads
                        </a>
                        <button class="btn btn-info me-2" onclick="exportAssignedSalesmen()">
                            <i class="fas fa-download"></i> Export Salesmen Report
                        </button>
                        <button class="btn btn-warning" onclick="refreshDashboard()">
                            <i class="fas fa-sync-alt"></i> Refresh Dashboard
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leads Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5><i class="fas fa-table"></i> My Assigned Leads ({{ $totalLeads ?? 0 }})</h5>
                    </div>
                    <div class="card-body">
                        @if($leads && $leads->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Contact Person</th>
                                            <th>Company</th>
                                            <th>Mobile</th>
                                            <th>Lead Source</th>
                                            <th>Lead For</th>
                                            <th>Priority</th>
                                            <th>Assigned Salesman</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($leads as $key => $lead)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <strong>{{ $lead->contact_person }}</strong>
                                                @if($lead->email_id)
                                                    <br><small class="text-muted">{{ $lead->email_id }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $lead->company_name ?? 'N/A' }}</td>
                                            <td>
                                                {{ $lead->mobile_no }}
                                                @if($lead->whatsapp_no)
                                                    <br><small class="text-success">WhatsApp: {{ $lead->whatsapp_no }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $lead->lead_source ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $lead->lead_for ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                @if($lead->lead_priority == 'High')
                                                    <span class="badge bg-danger">High</span>
                                                @elseif($lead->lead_priority == 'Medium')
                                                    <span class="badge bg-warning">Medium</span>
                                                @else
                                                    <span class="badge bg-success">Low</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($lead->assigned_salesman)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-user-check"></i> {{ $lead->assigned_salesman }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-user-times"></i> Not Assigned
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $lead->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-outline-primary btn-sm" title="View/Edit">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button class="btn btn-outline-success btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger btn-sm" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">No Leads Assigned</h4>
                                <p class="text-muted">You don't have any leads assigned yet.</p>
                                <a href="{{ route('leads.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create First Lead
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="text-center text-muted py-3">
                    <small>&copy; {{ date('Y') }} Lead Management System. All rights reserved.</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto refresh salesmen list every 30 seconds
        setInterval(function() {
            refreshSalesmenList();
        }, 30000);

        function refreshSalesmenList() {
            // Show loading
            document.getElementById('salesmenBadge').innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            // Simulate API call (replace with actual AJAX call)
            setTimeout(function() {
                fetch('/manager/assigned-salesmen')
                    .then(response => response.json())
                    .then(data => {
                        updateSalesmenDisplay(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('salesmenBadge').innerHTML = '0';
                    });
            }, 1000);
        }

        function updateSalesmenDisplay(data) {
            const container = document.getElementById('assignedSalesmenContainer');
            const badge = document.getElementById('salesmenBadge');
            const countElement = document.getElementById('assignedSalesmenCount');
            
            badge.textContent = data.count || 0;
            countElement.textContent = data.count || 0;
            
            if (data.count > 0) {
                // Update the cards with new data
                let cardsHTML = '<div class="row" id="salesmenCards">';
                data.salesmen.forEach(salesman => {
                    cardsHTML += createSalesmanCard(salesman);
                });
                cardsHTML += '</div>';
                
                container.innerHTML = cardsHTML;
                
                // Add notification animation
                const statsCard = document.querySelector('.pulse-animation');
                statsCard.style.animation = 'none';
                setTimeout(() => {
                    statsCard.style.animation = 'pulse 2s infinite';
                }, 100);
            }
        }

        function createSalesmanCard(salesman) {
            return `
                <div class="col-md-4 mb-3">
                    <div class="card salesman-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="card-title mb-2">
                                        <i class="fas fa-user-circle text-success"></i> 
                                        <strong>${salesman.name}</strong>
                                    </h6>
                                    <p class="card-text mb-2">
                                        <small class="text-muted">
                                            <i class="fas fa-briefcase"></i> Lead: ${salesman.leadName}<br>
                                            <i class="fas fa-calendar"></i> Assigned: ${salesman.assignedAt}<br>
                                            <i class="fas fa-flag"></i> Priority: 
                                            <span class="badge bg-${salesman.priorityClass}">${salesman.priority}</span>
                                        </small>
                                    </p>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary">${salesman.leadCount} Lead(s)</span>
                                </div>
                            </div>
                            ${salesman.remarks ? `
                                <div class="mt-2">
                                    <small class="text-info">
                                        <i class="fas fa-sticky-note"></i> ${salesman.remarks.substring(0, 50)}...
                                    </small>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                </div>
            `;
        }

        function viewAllSalesmen() {
            // Redirect to detailed salesmen page or show modal
            window.location.href = '/manager/salesmen/all';
        }

        function refreshDashboard() {
            window.location.reload();
        }

        function exportAssignedSalesmen() {
            // Export functionality
            window.open('/manager/export/salesmen', '_blank');
        }

        // Real-time notifications using WebSockets (optional)
        // if (window.Echo) {
        //     Echo.channel('manager-dashboard')
        //         .listen('SalesmanAssigned', (e) => {
        //             showNotification('New salesman assigned: ' + e.salesmanName);
        //             refreshSalesmenList();
        //         });
        // }

        function showNotification(message) {
            // Create toast notification
            const toastHTML = `
                <div class="toast align-items-center text-white bg-success border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-check-circle"></i> ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `;
            
            // Add to page and show
            const toastContainer = document.getElementById('toast-container') || createToastContainer();
            toastContainer.insertAdjacentHTML('beforeend', toastHTML);
            
            const toast = new bootstrap.Toast(toastContainer.lastElementChild);
            toast.show();
        }

        function createToastContainer() {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(container);
            return container;
        }
    </script>
</body>
</html>