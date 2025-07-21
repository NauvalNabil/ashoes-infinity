<footer class="bg-brown-800 text-white mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-shoe-prints text-2xl text-brown-300"></i>
                    <span class="text-xl font-bold">AShoes Infinity</span>
                </div>
                <p class="text-brown-300 mb-4">
                    Toko sepatu online terbaik dengan koleksi sepatu berkualitas tinggi untuk semua kebutuhan Anda.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-brown-300 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-brown-300 hover:text-white transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-brown-300 hover:text-white transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-brown-300 hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-brown-300 hover:text-white transition-colors">Products</a></li>
                    @auth
                        @if(!auth()->user()->isAdmin())
                            <li><a href="{{ route('cart.index') }}" class="text-brown-300 hover:text-white transition-colors">Cart</a></li>
                            <li><a href="{{ route('orders.index') }}" class="text-brown-300 hover:text-white transition-colors">My Orders</a></li>
                        @endif
                    @endauth
                    @guest
                        <li><a href="{{ route('login') }}" class="text-brown-300 hover:text-white transition-colors">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-brown-300 hover:text-white transition-colors">Register</a></li>
                    @endguest
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact</h3>
                <ul class="space-y-2 text-brown-300">
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-2"></i>
                        +62 123 456 789
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        info@ashoesinfinity.com
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        Jakarta, Indonesia
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-brown-700 mt-8 pt-8 text-center text-brown-300">
            <p>&copy; {{ date('Y') }} AShoes Infinity. All rights reserved.</p>
        </div>
    </div>
</footer>
