<x-app-layout>
    <div class="bg-brown-50 min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-brown-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center">
                    <a href="{{ route('products.index') }}" class="text-brown-600 hover:text-brown-800 mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-3xl font-bold text-brown-800">Shopping Cart</h1>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if($cartItems->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach($cartItems as $item)
                            <div class="bg-white rounded-lg shadow-sm p-6 flex flex-col sm:flex-row gap-4" id="cart-item-{{ $item->id }}">
                                <!-- Product Image -->
                                <div class="w-full sm:w-24 h-24 bg-brown-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-shoe-prints text-2xl text-brown-400"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 space-y-2">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-semibold text-brown-800">{{ $item->product->name }}</h3>
                                        <button onclick="removeFromCart({{ $item->id }})" 
                                                class="text-red-500 hover:text-red-700 ml-4">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <p class="text-gray-600 text-sm line-clamp-2">{{ $item->product->description }}</p>
                                    
                                    <!-- Price and Quantity -->
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                        <div class="text-lg font-bold text-brown-600">
                                            Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                        </div>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-3">
                                            <label class="text-sm text-brown-700">Qty:</label>
                                            <div class="flex items-center space-x-2">
                                                <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" 
                                                        class="w-8 h-8 bg-brown-100 hover:bg-brown-200 text-brown-700 rounded flex items-center justify-center"
                                                        {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-minus text-xs"></i>
                                                </button>
                                                <span class="w-12 text-center font-medium">{{ $item->quantity }}</span>
                                                <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" 
                                                        class="w-8 h-8 bg-brown-100 hover:bg-brown-200 text-brown-700 rounded flex items-center justify-center"
                                                        {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                                    <i class="fas fa-plus text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="text-right">
                                        <span class="text-lg font-bold text-brown-800">
                                            Subtotal: Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <!-- Stock Warning -->
                                    @if($item->quantity > $item->product->stock)
                                        <div class="bg-red-50 border border-red-200 rounded p-2">
                                            <p class="text-red-700 text-sm">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Only {{ $item->product->stock }} items available in stock.
                                            </p>
                                        </div>
                                    @elseif($item->product->stock <= 10)
                                        <div class="bg-yellow-50 border border-yellow-200 rounded p-2">
                                            <p class="text-yellow-700 text-sm">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Low stock: Only {{ $item->product->stock }} items left.
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('products.index') }}" 
                               class="flex-1 bg-brown-100 hover:bg-brown-200 text-brown-800 py-3 px-6 rounded-lg font-medium text-center transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Continue Shopping
                            </a>
                            <button onclick="clearCart()" 
                                    class="flex-1 bg-red-100 hover:bg-red-200 text-red-800 py-3 px-6 rounded-lg font-medium transition-colors">
                                <i class="fas fa-trash mr-2"></i>
                                Clear Cart
                            </button>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                            <h2 class="text-xl font-bold text-brown-800 mb-4">Order Summary</h2>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                                    <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium text-green-600">Free</span>
                                </div>
                                <div class="border-t border-gray-200 pt-3">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-bold text-brown-800">Total</span>
                                        <span class="text-lg font-bold text-brown-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <button onclick="proceedToCheckout()" 
                                    class="w-full bg-brown-600 hover:bg-brown-700 text-white py-3 px-6 rounded-lg font-bold text-lg transition-colors">
                                <i class="fas fa-credit-card mr-2"></i>
                                Proceed to Checkout
                            </button>

                            <!-- Payment Methods -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-sm font-medium text-brown-800 mb-3">We Accept</h3>
                                <div class="flex space-x-2">
                                    <div class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">
                                        Bank Transfer
                                    </div>
                                    <div class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">
                                        E-Wallet
                                    </div>
                                </div>
                            </div>

                            <!-- Security Notice -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                    <span>Secure checkout powered by SSL encryption</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-shopping-cart text-6xl text-brown-300 mb-6"></i>
                        <h2 class="text-2xl font-bold text-brown-800 mb-4">Your cart is empty</h2>
                        <p class="text-gray-600 mb-8">Looks like you haven't added any shoes to your cart yet.</p>
                        <a href="{{ route('products.index') }}" 
                           class="bg-brown-600 hover:bg-brown-700 text-white py-3 px-8 rounded-lg font-medium inline-flex items-center transition-colors">
                            <i class="fas fa-shoe-prints mr-2"></i>
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Update quantity function
        async function updateQuantity(cartId, newQuantity) {
            if (newQuantity < 1) return;

            try {
                const response = await fetch(`/cart/${cartId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                });

                const data = await response.json();
                
                if (data.success) {
                    location.reload(); // Reload to update totals
                } else {
                    showFlashMessage('error', data.message || 'Failed to update quantity');
                }
            } catch (error) {
                console.error('Error:', error);
                showFlashMessage('error', 'An error occurred while updating quantity');
            }
        }

        // Remove item from cart
        async function removeFromCart(cartId) {
            if (!confirm('Are you sure you want to remove this item from your cart?')) {
                return;
            }

            try {
                const response = await fetch(`/cart/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();
                
                if (data.success) {
                    document.getElementById(`cart-item-${cartId}`).remove();
                    showFlashMessage('success', 'Item removed from cart');
                    updateCartCount();
                    
                    // Reload if cart is empty
                    if (data.cartCount === 0) {
                        location.reload();
                    }
                } else {
                    showFlashMessage('error', data.message || 'Failed to remove item');
                }
            } catch (error) {
                console.error('Error:', error);
                showFlashMessage('error', 'An error occurred while removing item');
            }
        }

        // Clear entire cart
        async function clearCart() {
            if (!confirm('Are you sure you want to remove all items from your cart?')) {
                return;
            }

            try {
                const response = await fetch('/cart', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();
                
                if (data.success) {
                    location.reload();
                } else {
                    showFlashMessage('error', data.message || 'Failed to clear cart');
                }
            } catch (error) {
                console.error('Error:', error);
                showFlashMessage('error', 'An error occurred while clearing cart');
            }
        }

        // Proceed to checkout
        function proceedToCheckout() {
            window.location.href = '{{ route("user.checkout") }}';
        }

        // Update Cart Count
        async function updateCartCount() {
            try {
                const response = await fetch('{{ route("cart.count") }}');
                const data = await response.json();
                
                // Update cart count in navigation
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
    </script>
    @endpush
</x-app-layout>
