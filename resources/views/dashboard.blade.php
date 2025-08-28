<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes bounceSoft {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
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
                        <i class="fas fa-tachometer-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">My Dashboard</h1>
                        <p class="text-white/80 text-sm">Lead Management</p>
                    </div>
                </div>
            </div>

            <!-- Welcome Section -->
            <div class="p-6 border-b border-white/10">
                <div class="glass-effect rounded-xl p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div>
                            <p class="text-gray-800 font-semibold">Welcome back!</p>
                            <p class="text-gray-600 text-sm">{{ auth()->user()->name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="mt-8 px-6">
                <div class="space-y-4">
                    <!-- Dashboard Link -->
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center space-x-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-all">
                            <i class="fas fa-home text-lg"></i>
                        </div>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Lead Management -->
                    <a href="{{ route('leads.index') }}" 
                       class="flex items-center space-x-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-all">
                            <i class="fas fa-users text-lg"></i>
                        </div>
                        <span class="font-medium">Lead Management</span>
                    </a>

                    <!-- Add New Lead -->
                    <a href="{{ route('leads.create') }}" 
                       class="flex items-center space-x-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-all">
                            <i class="fas fa-plus text-lg"></i>
                        </div>
                        <span class="font-medium">Add New Lead</span>
                    </a>

                    <!-- Reports -->
                    <a href="#" 
                       class="flex items-center space-x-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-all">
                            <i class="fas fa-chart-bar text-lg"></i>
                        </div>
                        <span class="font-medium">Reports</span>
                    </a>

                    <!-- Settings -->
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center space-x-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl p-3 transition-all duration-300 group">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-all">
                            <i class="fas fa-cog text-lg"></i>
                        </div>
                        <span class="font-medium">Settings</span>
                    </a>
                </div>
            </nav>

            <!-- Bottom Section -->
            <div class="absolute bottom-6 left-6 right-6">
                <div class="glass-effect rounded-xl p-4">
                    <div class="text-center">
                        <div class="w-8 h-8 bg-green-400 rounded-full mx-auto mb-2 animate-bounce-soft"></div>
                        <p class="text-gray-800 text-sm font-medium">System Online</p>
                        <p class="text-gray-600 text-xs">All services running</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 overflow-hidden">
            <!-- Top Header -->
            <div class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Dashboard Overview</h2>
                        <p class="text-gray-600 mt-1">{{ now()->format('l, F d, Y') }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition-colors">
                                <i class="fas fa-bell text-gray-600"></i>
                            </button>
                            <div class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-xs font-bold">3</span>
                            </div>
                        </div>
                        
                        <!-- User Profile -->
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 animate-fade-in">
                <!-- Welcome Card -->
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl shadow-xl p-8 mb-8 text-white animate-slide-up">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h3>
                            <p class="text-blue-100 text-lg">Ready to manage your leads today?</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-rocket text-4xl animate-bounce-soft"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Leads -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover-scale hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Leads</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalLeads ?? 0 }}</p>
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
                    <div class="bg-white rounded-xl shadow-lg p-6 hover-scale hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Today's Leads</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ isset($leads) ? $leads->where('created_at', '>=', today())->count() : 0 }}</p>
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
                    <div class="bg-white rounded-xl shadow-lg p-6 hover-scale hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">High Priority</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ isset($leads) ? $leads->where('lead_priority', 'High')->count() : 0 }}</p>
                                <p class="text-red-500 text-sm mt-1">
                                    <i class="fas fa-exclamation-triangle"></i> Urgent
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-fire text-red-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- This Month -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover-scale hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">This Month</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ isset($leads) ? $leads->where('created_at', '>=', now()->startOfMonth())->count() : 0 }}</p>
                                <p class="text-purple-500 text-sm mt-1">
                                    <i class="fas fa-chart-line"></i> Monthly
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-chart-bar text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate-slide-up">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-bolt text-yellow-500"></i> Quick Actions
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('leads.create') }}" 
                           class="bg-gradient-to-r from-green-400 to-green-600 text-white rounded-xl p-6 hover-scale hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-all">
                                    <i class="fas fa-plus text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Add New Lead</h4>
                                    <p class="text-green-100 text-sm">Create fresh opportunities</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('leads.index') }}" 
                           class="bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-xl p-6 hover-scale hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-all">
                                    <i class="fas fa-list text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">View All Leads</h4>
                                    <p class="text-blue-100 text-sm">Manage your pipeline</p>
                                </div>
                            </div>
                        </a>

                        <a href="#" 
                           class="bg-gradient-to-r from-purple-400 to-purple-600 text-white rounded-xl p-6 hover-scale hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-all">
                                    <i class="fas fa-download text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Export Reports</h4>
                                    <p class="text-purple-100 text-sm">Download analytics</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Activity / Leads Table -->
                @if(isset($leads) && $leads->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-up">
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b">
                        <h3 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-table text-blue-600"></i> My Recent Leads
                        </h3>
                        <p class="text-gray-600 text-sm mt-1">Latest {{ $leads->take(5)->count() }} assigned leads</p>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">Contact</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">Company</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">Source</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">Priority</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">Date</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wide">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($leads->take(5) as $lead)
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
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
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $lead->lead_source ?: 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($lead->lead_priority == 'High')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-fire mr-1"></i> High
                                            </span>
                                        @elseif($lead->lead_priority == 'Medium')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i> Medium
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check mr-1"></i> Low
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 text-sm">
                                        {{ $lead->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('lead.edit', $lead->id) }}" 
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
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- View All Button -->
                    <div class="bg-gray-50 px-6 py-4 border-t">
                        <div class="text-center">
                            <a href="{{ route('leads.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors">
                                <i class="fas fa-list mr-2"></i> View All Leads
                            </a>
                        </div>
                    </div>
                </div>
                @else
                <!-- No Leads State -->
                <div class="bg-white rounded-xl shadow-lg p-12 text-center animate-slide-up">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-inbox text-gray-400 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Leads Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        You don't have any leads assigned yet. Start by creating your first lead or wait for assignments.
                    </p>
                    <a href="{{ route('leads.create') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-plus mr-3"></i> Create Your First Lead
                    </a>
                </div>
                @endif

                <!-- Quick Tips -->
                <div class="bg-white rounded-xl shadow-lg p-6 mt-8 animate-slide-up">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-lightbulb text-yellow-500"></i> Quick Tips
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center p-4 bg-blue-50 rounded-xl">
                            <i class="fas fa-phone text-blue-600 text-2xl mb-3"></i>
                            <h4 class="font-semibold text-gray-900 mb-2">Follow Up Quickly</h4>
                            <p class="text-gray-600 text-sm">Contact leads within 24 hours for best results</p>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-xl">
                            <i class="fas fa-star text-green-600 text-2xl mb-3"></i>
                            <h4 class="font-semibold text-gray-900 mb-2">Prioritize High Value</h4>
                            <p class="text-gray-600 text-sm">Focus on high priority leads first</p>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-xl">
                            <i class="fas fa-chart-line text-purple-600 text-2xl mb-3"></i>
                            <h4 class="font-semibold text-gray-900 mb-2">Track Progress</h4>
                            <p class="text-gray-600 text-sm">Monitor your conversion rates</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effects to cards
            const cards = document.querySelectorAll('.hover-scale');
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1.05)';
                    }, 100);
                });
            });
        });
    </script>
</body>
</x-app-layout>