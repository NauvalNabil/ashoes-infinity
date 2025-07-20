<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        @yield('title', 'Admin Dashboard - A Shoes Marketplace')
    </title>
    <meta charset="utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="telephone=no" name="format-detection" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="TemplatesJungle" name="author" />
    <meta content="Admin Dashboard" name="keywords" />
    <meta content="A Shoes Marketplace - Admin Dashboard" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    @stack('styles')
</head>

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

            <div class="flex items-center gap-2 lg:gap-4">
                <div class="text-white font-medium text-sm lg:text-base">
                    <span class="hidden sm:inline">Welcome, </span>{{ auth()->user()->name ?? 'Admin' }}
                    <span class="hidden md:inline"> ({{ ucfirst(auth()->user()->role ?? 'Admin') }})</span>
                </div>
                <div class="relative">
                    <button class="bg-transparent border border-pink-500 text-pink-500 hover:bg-pink-500 hover:text-white px-3 py-2 rounded-lg transition-all duration-200 flex items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>
                    </button>
                    <ul class="dropdown-menu absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-lg shadow-lg z-50 hidden">
                        <li><a class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-t-lg" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><hr class="border-gray-600 my-1"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-b-lg">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-4 lg:p-8">
            @if (session('success'))
                <div class="bg-green-900/20 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center justify-between" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="text-green-400 hover:text-green-300" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-900/20 border border-red-500 text-red-400 px-4 py-3 rounded-lg mb-6 flex items-center justify-between" role="alert">
                    <span>{{ session('error') }}</span>
                    <button type="button" class="text-red-400 hover:text-red-300" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

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

    @stack('scripts')
</body>

</html>
