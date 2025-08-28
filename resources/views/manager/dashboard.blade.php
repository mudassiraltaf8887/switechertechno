<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-soft': 'bounceSoft 2s infinite',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes bounceSoft {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Enhanced Sidebar -->
        <div class="w-72 gradient-bg shadow-2xl">
            <!-- Logo/Header Section -->
            <div class="p-8 border-b border-white/20">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-tie text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Manager Portal</h1>
                        <p class="text-white/80 text-sm">Team Management</p>
                    </div>
                </div>
            </div>

            <!-- Welcome Section -->
            <div class="p-6 border-b border-white/10">
                <div class="glass-effect rounded-xl p-4">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-crown text-white"></i>
                        </div>
                        <div>
                            <p class="text-gray-800 font-semibold">Manager Dashboard</p>
                            <p class="text-gray-600 text-sm">{{ auth()->user()->name }}</p>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Navigation Menu -->
            <nav class="mt-8 px-6">
                <div class="space-y-4">
                    <!-- Dashboard Link -->
                    <a href="#"
                        class="flex items-center space-x-3 text-white bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-home text-lg"></i>
                        </div>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Team Management -->
                    <a href="#"
                        class="flex items-center space-x-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-all">
                            <i class="fas fa-users text-lg"></i>
                        </div>
                        <span class="font-medium">Team Management</span>
                    </a>

                    <!-- Lead Assignment -->
                    <a href="#"
                        class="flex items-center space-x-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-all">
                            <i class="fas fa-share-alt text-lg"></i>
                        </div>
                        <span class="font-medium">Assign Leads</span>
                    </a>

                    <!-- Reports -->
                    <a href="#"
                        class="flex items-center space-x-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-all">
                            <i class="fas fa-chart-bar text-lg"></i>
                        </div>
                        <span class="font-medium">Team Reports</span>
                    </a>

                    <!-- Settings -->
                    <a href="#"
                        class="flex items-center space-x-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-all">
                            <i class="fas fa-cog text-lg"></i>
                        </div>
                        <span class="font-medium">Settings</span>
                    </a>
                </div>
            </nav>

            <!-- Bottom Section -->
           
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 overflow-hidden">
            <!-- Top Header -->
            <div class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Manager Dashboard</h2>
                        <p class="text-gray-600 mt-1">{{ now()->format('l, F d, Y') }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <!-- Replace your existing notification section with this code -->



                        <!-- Replace your existing notification section with this code -->

                      <!-- Replace your existing notification section with this code -->

<!-- Notifications Section - Updated -->
<div class="relative">
    <button id="notificationBtn" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition-colors relative">
        <i class="fas fa-bell text-gray-600"></i>
        @if($notificationCount > 0)
        <div id="notificationBadge" class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center">
            <span class="text-white text-xs font-bold">{{ $notificationCount }}</span>
        </div>
        @endif
    </button>
    
    <!-- Notification Dropdown -->
    <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-2xl z-50 border border-gray-200">
        <!-- Header -->
        <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-gray-900 text-lg">
                    <i class="fas fa-bell text-blue-500 mr-2"></i>Notifications
                </h3>
                @if($notificationCount > 0)
                <button onclick="markAllAsRead()" class="text-blue-500 text-sm hover:text-blue-700 font-medium px-3 py-1 rounded-md hover:bg-blue-100 transition-colors">
                    <i class="fas fa-check-double mr-1"></i>Mark all read
                </button>
                @endif
            </div>
            @if($notificationCount > 0)
            <p class="text-sm text-gray-600 mt-1">{{ $notificationCount }} unread notifications</p>
            @endif
        </div>
        
        <!-- Notifications List -->
        <div class="max-h-96 overflow-y-auto" id="notificationsList">
            @forelse($unreadNotifications as $notification)
            <div class="notification-item p-4 border-b border-gray-100 hover:bg-blue-50 cursor-pointer transition-colors duration-200" 
                 data-notification-id="{{ $notification->id }}" 
                 onclick="markAsRead({{ $notification->id }})">
                <div class="flex items-start space-x-3">
                    <!-- Icon -->
                    <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0
                        @if($notification->type == 'lead_assigned') bg-green-100 
                        @elseif($notification->type == 'lead_updated') bg-blue-100 
                        @elseif($notification->type == 'priority_changed') bg-red-100 
                        @else bg-gray-100 @endif">
                        <i class="{{ $notification->icon }} 
                           @if($notification->type == 'lead_assigned') text-green-600 
                           @elseif($notification->type == 'lead_updated') text-blue-600 
                           @elseif($notification->type == 'priority_changed') text-red-600 
                           @else text-gray-600 @endif text-lg"></i>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900 text-sm">{{ $notification->title }}</p>
                        <p class="text-gray-600 text-sm mt-1 leading-relaxed">{{ $notification->message }}</p>
                        
                        @if($notification->data)
                        <!-- Extra Details -->
                        <div class="mt-2 text-xs text-gray-500">
                            @if(isset($notification->data['contact_person']))
                            <span class="inline-flex items-center mr-3">
                                <i class="fas fa-user mr-1"></i>{{ $notification->data['contact_person'] }}
                            </span>
                            @endif
                            @if(isset($notification->data['mobile_no']))
                            <span class="inline-flex items-center">
                                <i class="fas fa-phone mr-1"></i>{{ $notification->data['mobile_no'] }}
                            </span>
                            @endif
                        </div>
                        @endif
                        
                        <!-- Time -->
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-xs text-gray-500">
                                <i class="fas fa-clock mr-1"></i>{{ $notification->time_ago }}
                            </p>
                            
                            <!-- Action buttons -->
                            @if(isset($notification->data['lead_id']))
                            <div class="flex space-x-2">
                                <button onclick="event.stopPropagation(); viewLead({{ $notification->data['lead_id'] }})" 
                                        class="text-blue-500 hover:text-blue-700 text-xs">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Unread indicator -->
                    <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-500">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-bell-slash text-gray-400 text-2xl"></i>
                </div>
                <p class="font-medium">No new notifications</p>
                <p class="text-sm text-gray-400 mt-1">You're all caught up!</p>
            </div>
            @endforelse
        </div>
        
        <!-- Footer -->
        @if($notificationCount > 0)
        <div class="p-3 border-t border-gray-200 bg-gray-50">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">{{ $notificationCount }} unread</span>
                <button onclick="viewAllNotifications()" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                    View all notifications <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
// Notification functionality
document.addEventListener('DOMContentLoaded', function() {
    const notificationBtn = document.getElementById('notificationBtn');
    const notificationDropdown = document.getElementById('notificationDropdown');
    
    // Toggle dropdown on button click
    notificationBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        notificationDropdown.classList.toggle('hidden');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
            notificationDropdown.classList.add('hidden');
        }
    });
    
    // Prevent dropdown from closing when clicking inside
    notificationDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

// Mark single notification as read
function markAsRead(notificationId) {
    fetch(`/manager/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the notification from UI
            const notificationElement = document.querySelector(`[data-notification-id="${notificationId}"]`);
            if (notificationElement) {
                notificationElement.style.opacity = '0.5';
                setTimeout(() => {
                    notificationElement.remove();
                    updateNotificationCount();
                }, 300);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Mark all notifications as read
function markAllAsRead() {
    fetch('/manager/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear all notifications from UI
            const notificationsList = document.getElementById('notificationsList');
            notificationsList.innerHTML = `
                <div class="p-8 text-center text-gray-500">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-bell-slash text-gray-400 text-2xl"></i>
                    </div>
                    <p class="font-medium">No new notifications</p>
                    <p class="text-sm text-gray-400 mt-1">You're all caught up!</p>
                </div>
            `;
            
            // Hide notification badge
            const badge = document.getElementById('notificationBadge');
            if (badge) {
                badge.remove();
            }
            
            // Close dropdown
            document.getElementById('notificationDropdown').classList.add('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Update notification count
function updateNotificationCount() {
    const remainingNotifications = document.querySelectorAll('.notification-item').length;
    const badge = document.getElementById('notificationBadge');
    
    if (remainingNotifications === 0) {
        if (badge) {
            badge.remove();
        }
        // Update the list to show empty state
        const notificationsList = document.getElementById('notificationsList');
        notificationsList.innerHTML = `
            <div class="p-8 text-center text-gray-500">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-bell-slash text-gray-400 text-2xl"></i>
                </div>
                <p class="font-medium">No new notifications</p>
                <p class="text-sm text-gray-400 mt-1">You're all caught up!</p>
            </div>
        `;
    } else if (badge) {
        badge.querySelector('span').textContent = remainingNotifications;
    }
}

// View specific lead
function viewLead(leadId) {
    window.location.href = `/manager/leads/${leadId}`;
}

// View all notifications (future feature)
function viewAllNotifications() {
    // This could redirect to a dedicated notifications page
    alert('View all notifications feature - coming soon!');
}

// Auto-refresh notifications every 30 seconds
setInterval(function() {
    if (!document.getElementById('notificationDropdown').classList.contains('hidden')) {
        // Only refresh if dropdown is open
        refreshNotifications();
    }
}, 30000);

// Refresh notifications
function refreshNotifications() {
    fetch('/manager/notifications/get', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(notifications => {
        // Update UI with new notifications
        // This is a more advanced feature - implement if needed
        console.log('New notifications:', notifications);
    })
    .catch(error => {
        console.error('Error refreshing notifications:', error);
    });
}
</script>

<!-- Add this to your <head> section if not already present -->
<meta name="csrf-token" content="{{ csrf_token() }}">

                        <!-- Add this to your <head> section if not already present -->
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="flex items-center space-x-2 px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 animate-fade-in">
                <!-- Welcome Card -->
                <div
                    class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl shadow-xl p-8 mb-8 text-white animate-slide-up">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h3>
                            <p class="text-blue-100 text-lg">Manage your team and track performance</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-chart-line text-4xl animate-bounce-soft"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Leads -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-6 hover-scale hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Leads</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalLeads }}</p>
                                <p class="text-green-500 text-sm mt-1">
                                    <i class="fas fa-arrow-up"></i> All time
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Today's Leads -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-6 hover-scale hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Today's Leads</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $todaysLeads }}</p>
                                <p class="text-blue-500 text-sm mt-1">
                                    <i class="fas fa-calendar-day"></i> Today
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar-check text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- High Priority -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-6 hover-scale hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">High Priority</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $highPriorityLeads }}</p>
                                <p class="text-red-500 text-sm mt-1">
                                    <i class="fas fa-exclamation-triangle"></i> Urgent
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-fire text-red-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Active Salesmen -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-6 hover-scale hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Active Salesmen</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $assignedSalesmen }}</p>
                                <p class="text-purple-500 text-sm mt-1">
                                    <i class="fas fa-user-tie"></i> Team
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-users-cog text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate-slide-up">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-filter text-blue-500"></i> Filter Leads
                    </h3>

                    <form method="GET" action="{{ url()->current() }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                            <!-- Search -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                <input type="text" name="search" value="{{ $currentFilters['search'] }}"
                                    placeholder="Name, company, mobile..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Date Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                                <select name="date_filter"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">All Dates</option>
                                    <option value="today" {{ $currentFilters['date_filter'] == 'today' ? 'selected' : '' }}>Today</option>
                                    <option value="yesterday" {{ $currentFilters['date_filter'] == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                                    <option value="this_week" {{ $currentFilters['date_filter'] == 'this_week' ? 'selected' : '' }}>This Week</option>
                                    <option value="this_month" {{ $currentFilters['date_filter'] == 'this_month' ? 'selected' : '' }}>This Month</option>
                                    <option value="last_month" {{ $currentFilters['date_filter'] == 'last_month' ? 'selected' : '' }}>Last Month</option>
                                </select>
                            </div>

                            <!-- Priority Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                                <select name="priority_filter"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="all">All Priorities</option>
                                    <option value="High" {{ $currentFilters['priority_filter'] == 'High' ? 'selected' : '' }}>High</option>
                                    <option value="Medium" {{ $currentFilters['priority_filter'] == 'Medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="Low" {{ $currentFilters['priority_filter'] == 'Low' ? 'selected' : '' }}>Low</option>
                                </select>
                            </div>

                            <!-- Source Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lead Source</label>
                                <select name="source_filter"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="all">All Sources</option>
                                    @foreach($allSources as $source)
                                        <option value="{{ $source }}" {{ $currentFilters['source_filter'] == $source ? 'selected' : '' }}>{{ $source }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Assignment Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Assignment</label>
                                <select name="assignment_filter"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="all">All Leads</option>
                                    <option value="assigned" {{ $currentFilters['assignment_filter'] == 'assigned' ? 'selected' : '' }}>Assigned</option>
                                    <option value="not_assigned" {{ $currentFilters['assignment_filter'] == 'not_assigned' ? 'selected' : '' }}>Not Assigned</option>
                                </select>
                            </div>

                            <!-- Salesman Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Salesman</label>
                                <select name="salesman_filter"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="all">All Salesmen</option>
                                    @foreach($allSalesmen as $salesman)
                                        <option value="{{ $salesman->id }}" {{ $currentFilters['salesman_filter'] == $salesman->id ? 'selected' : '' }}>
                                            {{ $salesman->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="flex space-x-4 pt-4">
                            <button type="submit"
                                class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-search mr-2"></i> Apply Filters
                            </button>
                            <a href="{{ url()->current() }}"
                                class="flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                <i class="fas fa-times mr-2"></i> Clear All
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Leads Table -->
                @if($assignedLeads->count() > 0)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-up">
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b">
                            <h3 class="text-xl font-bold text-gray-900">
                                <i class="fas fa-table text-blue-600"></i> My Assigned Leads
                            </h3>
                            <p class="text-gray-600 text-sm mt-1">{{ $assignedLeads->count() }} leads found</p>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">#</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">
                                            Contact</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">
                                            Company</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">Source
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">
                                            Priority</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">
                                            Salesman</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">Date
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($assignedLeads as $index => $lead)
                                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                                            <td class="px-6 py-4 text-gray-900 font-medium">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4">
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $lead->contact_person }}</div>
                                                    <div class="text-gray-500 text-sm">{{ $lead->mobile_no }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-gray-900">
                                                {{ $lead->company_name ?: 'Individual' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $lead->lead_source ?: 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($lead->lead_priority == 'High')
                                                    <span
                                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-fire mr-1"></i> High
                                                    </span>
                                                @elseif($lead->lead_priority == 'Medium')
                                                    <span
                                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-clock mr-1"></i> Medium
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check mr-1"></i> Low
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($lead->is_assigned)
                                                    <span
                                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-user mr-1"></i> {{ $lead->assigned_salesman_name }}
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        <i class="fas fa-user-times mr-1"></i> Not Assigned
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-gray-500 text-sm">
                                                {{ $lead->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('manager.lead.edit', $lead->id) }}"
                                                        class="w-8 h-8 bg-blue-100 hover:bg-blue-200 rounded-full flex items-center justify-center transition-colors">
                                                        <i class="fas fa-eye text-blue-600 text-sm"></i>
                                                    </a>
                                                    <a href="tel:{{ $lead->mobile_no }}"
                                                        class="w-8 h-8 bg-green-100 hover:bg-green-200 rounded-full flex items-center justify-center transition-colors">
                                                        <i class="fas fa-phone text-green-600 text-sm"></i>
                                                    </a>
                                                    @if($lead->whatsapp_no)
                                                        <a href="https://wa.me/{{ $lead->whatsapp_no }}" target="_blank"
                                                            class="w-8 h-8 bg-green-100 hover:bg-green-200 rounded-full flex items-center justify-center transition-colors">
                                                            <i class="fab fa-whatsapp text-green-600 text-sm"></i>
                                                        </a>
                                                    @endif
                                                    @if(!$lead->is_assigned)
                                                        <button
                                                            class="w-8 h-8 bg-purple-100 hover:bg-purple-200 rounded-full flex items-center justify-center transition-colors"
                                                            onclick="assignLead({{ $lead->id }})">
                                                            <i class="fas fa-user-plus text-purple-600 text-sm"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Export Button -->
                        <div class="bg-gray-50 px-6 py-4 border-t">
                            <div class="flex justify-between items-center">
                                <p class="text-gray-600 text-sm">Showing {{ $assignedLeads->count() }} of {{ $totalLeads }}
                                    leads</p>
                                <div class="flex space-x-3">
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                        <i class="fas fa-download mr-2"></i> Export CSV
                                    </button>
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-share-alt mr-2"></i> Bulk Assign
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- No Leads State -->
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center animate-slide-up">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-gray-400 text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">No Leads Found</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                            No leads match your current filters. Try adjusting your search criteria or clearing filters.
                        </p>
                        <a href="{{ url()->current() }}"
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-xl transition-all duration-300">
                            <i class="fas fa-times mr-3"></i> Clear All Filters
                        </a>
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6 mt-8 animate-slide-up">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-bolt text-yellow-500"></i> Manager Actions
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <button
                            class="bg-gradient-to-r from-green-400 to-green-600 text-white rounded-xl p-6 hover-scale hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-all">
                                    <i class="fas fa-user-plus text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Assign Leads</h4>
                                    <p class="text-green-100 text-sm">Distribute to salesmen</p>
                                </div>
                            </div>
                        </button>

                        <button
                            class="bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-xl p-6 hover-scale hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-all">
                                    <i class="fas fa-chart-line text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Team Reports</h4>
                                    <p class="text-blue-100 text-sm">View performance</p>
                                </div>
                            </div>
                        </button>

                        <button
                            class="bg-gradient-to-r from-purple-400 to-purple-600 text-white rounded-xl p-6 hover-scale hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-all">
                                    <i class="fas fa-download text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Export Data</h4>
                                    <p class="text-purple-100 text-sm">Download reports</p>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add interactive effects
        document.addEventListener('DOMContentLoaded', function () {
            // Add click effects to cards
            const cards = document.querySelectorAll('.hover-scale');
            cards.forEach(card => {
                card.addEventListener('click', function () {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1.05)';
                    }, 100);
                });
            });
        });

        // Assign lead function
        function assignLead(leadId) {
            // This would open a modal or redirect to assignment page
            alert('Assignment functionality would be implemented here for lead ID: ' + leadId);
        }

        // Auto submit form on filter change (optional)
        document.querySelectorAll('select[name$="_filter"]').forEach(select => {
            select.addEventListener('change', function () {
                // Uncomment to auto-submit on change
                // this.form.submit();
            });
        });
        // Auto-submit form functionality
document.addEventListener('DOMContentLoaded', function() {
    const autoApplyCheckbox = document.getElementById('autoApply');
    const filterForm = document.getElementById('filterForm');
    const selectFields = filterForm.querySelectorAll('select, input[type="text"]');
    
    // Auto-apply on change if checkbox is checked
    selectFields.forEach(field => {
        field.addEventListener('change', function() {
            if (autoApplyCheckbox && autoApplyCheckbox.checked) {
                filterForm.submit();
            }
        });
    });
});
    </script>
</body>

</html>