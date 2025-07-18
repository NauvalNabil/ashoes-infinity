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
        
        /* Custom animations for active nav links */
        .nav-link-active {
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%) !important;
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.25);
            border-color: #ec4899 !important;
        }
        
        /* Collapsed sidebar icon styling */
        .sidebar-collapsed-icon {
            width: 48px !important;
            height: 48px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto !important;
            border-radius: 8px !important;
        }
        
        /* Gradient buttons */
        .btn-gradient-pink {
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
        }
        
        .btn-gradient-pink:hover {
            background: linear-gradient(135deg, #be185d 0%, #9d174d 100%);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #ec4899;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #be185d;
        }
        
        /* Alert transitions */
        [role="alert"] {
            transition: all 0.3s ease;
        }
        
        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .sidebar-mobile-hidden {
                transform: translateX(-100%);
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Admin Sidebar -->
    <nav class="fixed top-0 left-0 h-screen w-72 bg-gray-900 border-r border-slate-700 z-40 transition-all duration-300 ease-in-out overflow-y-auto lg:translate-x-0 -translate-x-full" id="adminSidebar">
        <div class="h-[5.5rem] border-b border-slate-700 flex items-center justify-center">
            <h3 class="text-white font-bold text-2xl text-center">Admin Panel</h3>
        </div>
        <ul class="py-6 space-y-2 px-4">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-5 py-3.5 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 border border-transparent hover:border-gray-600 font-medium text-sm {{ request()->routeIs('admin.dashboard') ? 'nav-link-active text-white border-pink-500' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 mr-3 text-center flex-shrink-0"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center px-5 py-3.5 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 border border-transparent hover:border-gray-600 font-medium text-sm {{ request()->routeIs('admin.products.*') ? 'nav-link-active text-white border-pink-500' : '' }}">
                    <i class="fas fa-box w-5 mr-3 text-center flex-shrink-0"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-5 py-3.5 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 border border-transparent hover:border-gray-600 font-medium text-sm">
                    <i class="fas fa-users w-5 mr-3 text-center flex-shrink-0"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-5 py-3.5 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 border border-transparent hover:border-gray-600 font-medium text-sm">
                    <i class="fas fa-shopping-cart w-5 mr-3 text-center flex-shrink-0"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-5 py-3.5 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 border border-transparent hover:border-gray-600 font-medium text-sm">
                    <i class="fas fa-tags w-5 mr-3 text-center flex-shrink-0"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-5 py-3.5 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 border border-transparent hover:border-gray-600 font-medium text-sm">
                    <i class="fas fa-chart-bar w-5 mr-3 text-center flex-shrink-0"></i>
                    <span>Analytics</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-5 py-3.5 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 border border-transparent hover:border-gray-600 font-medium text-sm">
                    <i class="fas fa-cog w-5 mr-3 text-center flex-shrink-0"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}" class="flex items-center px-5 py-3.5 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 border border-transparent hover:border-gray-600 font-medium text-sm">
                    <i class="fas fa-globe w-5 mr-3 text-center flex-shrink-0"></i>
                    <span>View Site</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="lg:ml-72 ml-0 min-h-screen bg-slate-900 transition-all duration-300 ease-in-out" id="adminMain">
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
        // Sidebar Toggle with proper mobile/desktop behavior
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('adminSidebar');
            const main = document.getElementById('adminMain');
            const isMobile = window.innerWidth <= 1024;

            if (isMobile) {
                // Mobile: toggle sidebar visibility
                sidebar.classList.toggle('-translate-x-full');
            } else {
                // Desktop: toggle sidebar width
                if (sidebar.classList.contains('w-72')) {
                    // Collapse sidebar
                    sidebar.classList.remove('w-72');
                    sidebar.classList.add('w-20');
                    main.classList.remove('lg:ml-72');
                    main.classList.add('lg:ml-20');
                    
                    // Hide text spans and title
                    const spans = sidebar.querySelectorAll('span');
                    spans.forEach(span => span.classList.add('hidden'));
                    
                    const title = sidebar.querySelector('h3');
                    title.classList.add('hidden');
                    
                    // Adjust links for collapsed state - make them square (1:1 ratio)
                    const links = sidebar.querySelectorAll('a');
                    links.forEach(link => {
                        link.classList.add('sidebar-collapsed-icon');
                        link.classList.remove('px-5', 'py-3.5');
                        
                        const icon = link.querySelector('i');
                        if (icon) {
                            icon.classList.remove('mr-3', 'w-5');
                            icon.classList.add('text-base');
                        }
                    });
                    
                    // Adjust list spacing for collapsed state
                    const list = sidebar.querySelector('ul');
                    list.classList.remove('space-y-2');
                    list.classList.add('space-y-3');
                    
                    // Hide header padding - keep same height for alignment
                    const header = sidebar.querySelector('.p-6');
                    if (header) {
                        header.classList.remove('p-6');
                        header.classList.add('py-8', 'px-2'); // Keep vertical padding same, reduce horizontal
                    }
                    
                } else {
                    // Expand sidebar
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-72');
                    main.classList.remove('lg:ml-20');
                    main.classList.add('lg:ml-72');
                    
                    // Show text spans and title
                    const spans = sidebar.querySelectorAll('span');
                    spans.forEach(span => span.classList.remove('hidden'));
                    
                    const title = sidebar.querySelector('h3');
                    title.classList.remove('hidden');
                    
                    // Reset links for expanded state
                    const links = sidebar.querySelectorAll('a');
                    links.forEach(link => {
                        link.classList.remove('sidebar-collapsed-icon');
                        link.classList.add('px-5', 'py-3.5');
                        
                        const icon = link.querySelector('i');
                        if (icon) {
                            icon.classList.remove('text-base');
                            icon.classList.add('mr-3', 'w-5');
                        }
                    });
                    
                    // Reset list spacing
                    const list = sidebar.querySelector('ul');
                    list.classList.remove('space-y-3');
                    list.classList.add('space-y-2');
                    
                    // Restore header padding
                    const header = sidebar.querySelector('.py-6');
                    if (header) {
                        header.classList.remove('py-6', 'px-2');
                        header.classList.add('p-6');
                    }
                }
            }
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
            const main = document.getElementById('adminMain');
            const isMobile = window.innerWidth <= 1024;
            
            if (isMobile) {
                // Reset to mobile state
                main.classList.remove('lg:ml-72', 'lg:ml-20');
                main.classList.add('ml-0');
                sidebar.classList.add('-translate-x-full');
                
                // Reset sidebar to full width for mobile
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-72');
                
                // Show all elements
                const spans = sidebar.querySelectorAll('span');
                spans.forEach(span => span.classList.remove('hidden'));
                
                const title = sidebar.querySelector('h3');
                title.classList.remove('hidden');
                
                // Reset links for mobile/desktop resize
                const links = sidebar.querySelectorAll('a');
                links.forEach(link => {
                    link.classList.remove('sidebar-collapsed-icon');
                    link.classList.add('px-5', 'py-3.5');
                    
                    const icon = link.querySelector('i');
                    if (icon) {
                        icon.classList.remove('text-base');
                        icon.classList.add('mr-3', 'w-5');
                    }
                });
                
                // Reset list spacing
                const list = sidebar.querySelector('ul');
                list.classList.remove('space-y-3');
                list.classList.add('space-y-2');
            } else {
                // Desktop state
                sidebar.classList.remove('-translate-x-full');
                main.classList.remove('ml-0');
                
                if (sidebar.classList.contains('w-20')) {
                    main.classList.add('lg:ml-20');
                } else {
                    main.classList.add('lg:ml-72');
                }
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
            const main = document.getElementById('adminMain');
            const isMobile = window.innerWidth <= 1024;
            
            if (isMobile) {
                sidebar.classList.add('-translate-x-full');
                main.classList.remove('lg:ml-72');
                main.classList.add('ml-0');
            }
        }

        // Run initialization when DOM is loaded
        document.addEventListener('DOMContentLoaded', initializeSidebar);
    </script>

    @stack('scripts')
</body>

</html>
