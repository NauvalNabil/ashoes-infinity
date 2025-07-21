<nav x-data="{ open: false, cartCount: 0 }"
     x-init="
        @auth
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => cartCount = data.count);
        @endauth
     "
     class="bg-white shadow-lg border-b border-brown-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <i class="fas fa-shoe-prints text-2xl text-brown-600"></i>
                        <span class="text-xl font-bold text-brown-800">AShoes Infinity</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @guest
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-brown-700 hover:text-brown-900">
                            <i class="fas fa-home mr-1"></i> {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="text-brown-700 hover:text-brown-900">
                            <i class="fas fa-shoe-prints mr-1"></i> {{ __('Products') }}
                        </x-nav-link>
                    @endguest

                    @auth
                        @if(auth()->user()->isAdmin())
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-brown-700 hover:text-brown-900">
                                <i class="fas fa-tachometer-alt mr-1"></i> {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" class="text-brown-700 hover:text-brown-900">
                                <i class="fas fa-shoe-prints mr-1"></i> {{ __('Products') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')" class="text-brown-700 hover:text-brown-900">
                                <i class="fas fa-shopping-bag mr-1"></i> {{ __('Orders') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-brown-700 hover:text-brown-900">
                                <i class="fas fa-home mr-1"></i> {{ __('Home') }}
                            </x-nav-link>
                            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="text-brown-700 hover:text-brown-900">
                                <i class="fas fa-shoe-prints mr-1"></i> {{ __('Products') }}
                            </x-nav-link>
                            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')" class="text-brown-700 hover:text-brown-900">
                                <i class="fas fa-list-alt mr-1"></i> {{ __('My Orders') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown & Cart -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <!-- Cart Icon (only for regular users) -->
                    @if(!auth()->user()->isAdmin())
                        <a href="{{ route('cart.index') }}" class="relative text-brown-700 hover:text-brown-900 p-2">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span x-show="cartCount > 0" 
                                  x-text="cartCount" 
                                  class="absolute -top-1 -right-1 bg-brown-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            </span>
                        </a>
                    @endif

                    <!-- Settings Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-brown-700 hover:text-brown-900 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-brown-700 hover:text-brown-900">
                                <i class="fas fa-user mr-2"></i>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="text-brown-700 hover:text-brown-900">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Guest Links -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-brown-700 hover:text-brown-900 font-medium">
                            <i class="fas fa-sign-in-alt mr-1"></i>
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-brown-600 hover:bg-brown-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-user-plus mr-1"></i>
                            {{ __('Register') }}
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-brown-700 hover:text-brown-900 hover:bg-brown-100 focus:outline-none focus:bg-brown-100 focus:text-brown-900 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @guest
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    <i class="fas fa-home mr-2"></i>
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                    <i class="fas fa-shoe-prints mr-2"></i>
                    {{ __('Products') }}
                </x-responsive-nav-link>
            @endguest

            @auth
                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')">
                        <i class="fas fa-shoe-prints mr-2"></i>
                        {{ __('Products') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        {{ __('Orders') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        <i class="fas fa-home mr-2"></i>
                        {{ __('Home') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        <i class="fas fa-shoe-prints mr-2"></i>
                        {{ __('Products') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                        <i class="fas fa-list-alt mr-2"></i>
                        {{ __('My Orders') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        {{ __('Cart') }} <span x-show="cartCount > 0" x-text="'(' + cartCount + ')'" class="text-brown-600"></span>
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-brown-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-brown-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-brown-600">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <i class="fas fa-user mr-2"></i>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 space-y-2">
                    <a href="{{ route('login') }}" class="block text-brown-700 hover:text-brown-900 font-medium py-2">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        {{ __('Login') }}
                    </a>
                    <a href="{{ route('register') }}" class="block bg-brown-600 hover:bg-brown-700 text-white px-4 py-2 rounded-lg font-medium transition-colors text-center">
                        <i class="fas fa-user-plus mr-2"></i>
                        {{ __('Register') }}
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Update cart count function for global use
    function updateCartCount() {
        @auth
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => {
                    // Update Alpine.js data
                    const nav = document.querySelector('[x-data]');
                    if (nav) {
                        nav._x_dataStack[0].cartCount = data.count;
                    }
                })
                .catch(error => console.error('Error updating cart count:', error));
        @endauth
    }

    // Listen for cart updates
    document.addEventListener('cartUpdated', updateCartCount);
</script>
