<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-brown-800 to-brown-600 text-white">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">
                    Welcome to <span class="text-brown-300">AShoes Infinity</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-brown-100 animate-slide-up">
                    Discover the perfect shoes for every step of your journey
                </p>
                <a href="{{ route('products.index') }}" 
                   class="bg-brown-500 hover:bg-brown-400 text-white font-bold py-3 px-8 rounded-lg text-lg transition-all duration-300 transform hover:scale-105 animate-bounce-soft">
                    <i class="fas fa-shoe-prints mr-2"></i>
                    Shop Now
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-brown-800 mb-4">Featured Shoes</h2>
                <p class="text-lg text-gray-600">Discover our most popular and trending shoe collections</p>
            </div>

            @if($featuredProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($featuredProducts as $product)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                            <div class="relative overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-brown-100 flex items-center justify-center">
                                        <i class="fas fa-shoe-prints text-4xl text-brown-400"></i>
                                    </div>
                                @endif
                                @if($product->stock <= 10)
                                    <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-xs">
                                        Low Stock
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-brown-800 mb-2 group-hover:text-brown-600 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                                
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-2xl font-bold text-brown-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        Stock: {{ $product->stock }}
                                    </span>
                                </div>

                                <div class="flex space-x-2">
                                    <button onclick="showProductDetails({{ $product->id }})" 
                                            class="flex-1 bg-brown-100 hover:bg-brown-200 text-brown-800 py-2 px-4 rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-eye mr-1"></i> Details
                                    </button>
                                    @auth
                                        @if(!auth()->user()->isAdmin())
                                            <button onclick="addToCart({{ $product->id }})" 
                                                    class="flex-1 bg-brown-600 hover:bg-brown-700 text-white py-2 px-4 rounded-lg text-sm font-medium transition-colors">
                                                <i class="fas fa-cart-plus mr-1"></i> Add to Cart
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="flex-1 bg-brown-600 hover:bg-brown-700 text-white py-2 px-4 rounded-lg text-sm font-medium text-center transition-colors">
                                            <i class="fas fa-cart-plus mr-1"></i> Add to Cart
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('products.index') }}" 
                       class="bg-brown-600 hover:bg-brown-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition-all duration-300 transform hover:scale-105">
                        View All Products
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-shoe-prints text-6xl text-brown-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-brown-800 mb-2">No Products Available</h3>
                    <p class="text-gray-600">Check back later for new arrivals!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-brown-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-brown-800 mb-4">Shop by Category</h2>
                <p class="text-lg text-gray-600">Find the perfect shoes for every occasion</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group cursor-pointer">
                    <div class="relative h-48 bg-gradient-to-br from-brown-400 to-brown-600">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-running text-6xl text-white"></i>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-brown-800 mb-2">Sport Shoes</h3>
                        <p class="text-gray-600">Perfect for your active lifestyle</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group cursor-pointer">
                    <div class="relative h-48 bg-gradient-to-br from-brown-500 to-brown-700">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-user-tie text-6xl text-white"></i>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-brown-800 mb-2">Formal Shoes</h3>
                        <p class="text-gray-600">Elegant shoes for special occasions</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group cursor-pointer">
                    <div class="relative h-48 bg-gradient-to-br from-brown-600 to-brown-800">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-walking text-6xl text-white"></i>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-brown-800 mb-2">Casual Shoes</h3>
                        <p class="text-gray-600">Comfortable shoes for everyday wear</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-brown-800 mb-4">Why Choose AShoes Infinity?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-brown-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-medal text-2xl text-brown-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-brown-800 mb-2">Premium Quality</h3>
                    <p class="text-gray-600">All our shoes are made from the finest materials with attention to detail</p>
                </div>

                <div class="text-center">
                    <div class="bg-brown-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shipping-fast text-2xl text-brown-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-brown-800 mb-2">Fast Delivery</h3>
                    <p class="text-gray-600">Quick and secure delivery to your doorstep nationwide</p>
                </div>

                <div class="text-center">
                    <div class="bg-brown-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-2xl text-brown-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-brown-800 mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Our customer service team is always ready to help you</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Details Modal -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4" style="display: none;">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-bold text-brown-800">Product Details</h3>
                    <button onclick="closeProductModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="productModalContent">
                    <!-- Product details will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add to Cart Function
        async function addToCart(productId) {
            try {
                const response = await fetch('{{ route("cart.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1
                    })
                });

                const data = await response.json();
                
                if (data.success) {
                    // Show success message
                    showFlashMessage('success', 'Product added to cart successfully!');
                    // Update cart count in navigation
                    updateCartCount();
                } else {
                    showFlashMessage('error', data.message || 'Failed to add product to cart');
                }
            } catch (error) {
                console.error('Error:', error);
                showFlashMessage('error', 'An error occurred while adding to cart');
            }
        }

        // Show Product Details
        async function showProductDetails(productId) {
            try {
                const response = await fetch(`/products/${productId}/details`);
                const html = await response.text();
                
                document.getElementById('productModalContent').innerHTML = html;
                const modal = document.getElementById('productModal');
                modal.style.display = 'flex';
            } catch (error) {
                console.error('Error:', error);
                showFlashMessage('error', 'Failed to load product details');
            }
        }

        // Close Product Modal
        function closeProductModal() {
            document.getElementById('productModal').style.display = 'none';
        }

        // Update Cart Count
        async function updateCartCount() {
            try {
                const response = await fetch('{{ route("cart.count") }}');
                const data = await response.json();
                
                // Update cart count in navigation (Alpine.js)
                window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.count } }));
            } catch (error) {
                console.error('Error updating cart count:', error);
            }
        }

        // Show Flash Message
        function showFlashMessage(type, message) {
            const flashContainer = document.getElementById('flash-messages');
            const messageHtml = `
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-transition:enter="transform ease-out duration-300 transition"
                     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     x-init="setTimeout(() => show = false, 5000)"
                     class="bg-${type === 'success' ? 'green' : 'red'}-500 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm">
                    <div class="flex items-center">
                        <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle mr-3"></i>
                        <span>${message}</span>
                        <button @click="show = false" class="ml-auto text-white hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            flashContainer.insertAdjacentHTML('beforeend', messageHtml);
        }

        // Close modal when clicking outside
        document.getElementById('productModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProductModal();
            }
        });
    </script>
    @endpush
</x-app-layout>
