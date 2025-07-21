<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<<<<<<< HEAD
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'AShoes Infinity') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
=======
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CSS & Custom Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet" />
    <link href="{{ asset('style.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;family=Playfair+Display:ital,wght@0,900;1,900&amp;family=Source+Sans+Pro:wght@400;600;700;900&amp;display=swap"
        rel="stylesheet" />

    <style>
        /* Custom styles for better integration */
        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a !important;
            color: #ffffff !important;
            margin: 0;
            overflow-x: hidden;
        }

        /* Improved sidebar styling */
        #adminSidebar {
            backdrop-filter: blur(10px);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #374151;
        }

        ::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        /* Alert transitions */
        [role="alert"] {
            transition: all 0.3s ease;
        }

        /* Mobile responsive adjustments */
        @media (max-width: 1024px) {
            .sidebar-mobile-hidden {
                transform: translateX(-100%);
            }
        }
    </style>
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-brown-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-brown-800 border-b border-brown-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-xl">
                                <i class="fas fa-shoe-prints mr-2"></i>
                                AShoes Admin
                            </a>
                        </div>

<<<<<<< HEAD
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium 
                                      {{ request()->routeIs('admin.dashboard') ? 'border-brown-300 text-white' : 'border-transparent text-brown-300 hover:text-white hover:border-brown-300' }}">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('admin.products.index') }}" 
                               class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium 
                                      {{ request()->routeIs('admin.products.*') ? 'border-brown-300 text-white' : 'border-transparent text-brown-300 hover:text-white hover:border-brown-300' }}">
                                <i class="fas fa-shoe-prints mr-2"></i>
                                Products
                            </a>
                            <a href="{{ route('admin.orders.index') }}" 
                               class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium 
                                      {{ request()->routeIs('admin.orders.*') ? 'border-brown-300 text-white' : 'border-transparent text-brown-300 hover:text-white hover:border-brown-300' }}">
                                <i class="fas fa-shopping-bag mr-2"></i>
                                Orders
                            </a>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <div class="flex items-center space-x-4">
                                <!-- Back to Site -->
                                <a href="{{ route('home') }}" 
                                   class="text-brown-300 hover:text-white text-sm font-medium">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    View Site
                                </a>
                                
                                <!-- User Dropdown -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" 
                                            class="flex items-center text-sm rounded-full text-brown-300 hover:text-white focus:outline-none focus:text-white">
                                        <span class="mr-2">{{ Auth::user()->name }}</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    
                                    <div x-show="open" 
                                         @click.away="open = false"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                        <a href="{{ route('profile.edit') }}" 
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-brown-50">
                                            <i class="fas fa-user mr-2"></i>
                                            Profile
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" 
                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-brown-50">
                                                <i class="fas fa-sign-out-alt mr-2"></i>
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
=======
<body>
    <!-- Admin Sidebar -->
    <nav class="fixed top-0 left-0 h-screen w-64 bg-gray-900 border-r border-gray-700 z-40 transition-all duration-300 ease-in-out overflow-y-auto lg:translate-x-0 -translate-x-full" id="adminSidebar">
        <!-- Header -->
        <div class="h-16 border-b border-gray-700 flex items-center justify-center px-4">
            <div class="flex items-center space-x-2">
                <div class="h-8 w-8 bg-gradient-to-r from-pink-500 to-orange-400 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shoe-prints text-white text-sm"></i>
                </div>
                <h3 class="text-white font-bold text-lg">Admin Panel</h3>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="py-4">
            <ul class="space-y-1 px-3">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-pink-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-tachometer-alt w-5 h-5 mr-3 flex-shrink-0"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}"
                        class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-pink-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-box w-5 h-5 mr-3 flex-shrink-0"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}"
                        class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-pink-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-tags w-5 h-5 mr-3 flex-shrink-0"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                        class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-pink-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-users w-5 h-5 mr-3 flex-shrink-0"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.analytics.index') }}"
                        class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.analytics.*') ? 'bg-pink-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="fas fa-chart-bar w-5 h-5 mr-3 flex-shrink-0"></i>
                        <span>Analytics</span>
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <div class="my-4 px-3">
                <div class="border-t border-gray-700"></div>
            </div>

            <!-- Secondary Menu -->
            <ul class="space-y-1 px-3">
                <li>
                    <a href="{{ url('/') }}"
                        class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 text-gray-300 hover:bg-gray-800 hover:text-white">
                        <i class="fas fa-external-link-alt w-5 h-5 mr-3 flex-shrink-0"></i>
                        <span>View Website</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Profile at Bottom -->
        <div class="absolute bottom-0 left-0 right-0 p-3 border-t border-gray-700 bg-gray-900">
            <div class="flex items-center space-x-3">
                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-pink-500 to-orange-400 flex items-center justify-center text-white font-semibold text-sm">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium text-white truncate">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </div>
                    <div class="text-xs text-gray-400 truncate">
                        {{ auth()->user()->email ?? 'admin@example.com' }}
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-colors duration-200"
                            title="Logout">
                        <i class="fas fa-sign-out-alt w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="lg:ml-64 ml-0 min-h-screen bg-slate-900 transition-all duration-300 ease-in-out" id="adminMain">
        <!-- Top Bar -->
        <div class="bg-slate-800 border-b border-slate-700 px-4 lg:px-8 py-4 flex justify-between items-center sticky top-0 z-30">
            <button class="bg-transparent border border-slate-600 text-slate-400 hover:text-white hover:bg-slate-700 hover:border-slate-500 p-2 rounded-md transition-all duration-200 w-10 h-10 flex items-center justify-center" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button class="inline-flex items-center justify-center p-2 rounded-md text-brown-300 hover:text-white hover:bg-brown-700 focus:outline-none focus:bg-brown-700 focus:text-white">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-1">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

<<<<<<< HEAD
            <!-- Main Content -->
            <div class="py-6">
                @yield('content')
            </div>
        </main>
    </div>
=======
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Simple sidebar toggle for mobile
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('adminSidebar');
            sidebar.classList.toggle('-translate-x-full');
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

        // Close mobile sidebar when clicking outside
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('adminSidebar');
            const toggleButton = document.getElementById('toggleSidebar');
            const isMobile = window.innerWidth <= 1024;

            if (isMobile && !sidebar.contains(e.target) && !toggleButton.contains(e.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('adminSidebar');
            const isMobile = window.innerWidth <= 1024;

            if (!isMobile) {
                // Desktop: show sidebar
                sidebar.classList.remove('-translate-x-full');
            } else {
                // Mobile: hide sidebar
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Dropdown toggle for user menu
        const dropdownButton = document.querySelector('[data-bs-toggle="dropdown"]');
        const dropdownMenu = dropdownButton ? dropdownButton.nextElementSibling : null;

        if (dropdownButton && dropdownMenu) {
            dropdownButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }

        // Initialize sidebar state
        function initializeSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const isMobile = window.innerWidth <= 1024;

            if (isMobile) {
                sidebar.classList.add('-translate-x-full');
            }
        }

        // Run initialization when DOM is loaded
        document.addEventListener('DOMContentLoaded', initializeSidebar);
    </script>
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007

    <!-- Scripts -->
    @stack('scripts')
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
