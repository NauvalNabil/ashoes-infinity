<x-app-layout>
<<<<<<< HEAD
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
=======
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Shopping Cart
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($cartItems->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cart Items ({{ $cartItems->count() }})</h3>
                            </div>
                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($cartItems as $item)
                                <div class="p-6" id="cart-item-{{ $item->id }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            @if($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                     alt="{{ $item->product->name }}"
                                                     class="w-20 h-20 object-cover rounded-lg">
                                            @else
                                                <div class="w-20 h-20 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </div>
                                            @endif

                                            <div class="flex-1">
                                                <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</h4>
                                                @if($item->product->category)
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->product->category->name }}</p>
                                                @endif
                                                @if($item->product->brand)
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->product->brand }}</p>
                                                @endif
                                                <div class="flex items-center space-x-4 mt-2">
                                                    @if($item->size)
                                                        <span class="text-sm text-gray-600 dark:text-gray-400">Size: {{ $item->size }}</span>
                                                    @endif
                                                    @if($item->color)
                                                        <span class="text-sm text-gray-600 dark:text-gray-400">Color: {{ $item->color }}</span>
                                                    @endif
                                                </div>
                                                <p class="text-lg font-bold text-gray-900 dark:text-white mt-2">
                                                    ${{ number_format($item->product->price, 2) }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-4">
                                            <!-- Quantity Controls -->
                                            <div class="flex items-center space-x-2">
                                                <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                                        class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-500 flex items-center justify-center"
                                                        {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                </button>
                                                <span class="w-12 text-center font-medium text-gray-900 dark:text-white" id="quantity-{{ $item->id }}">{{ $item->quantity }}</span>
                                                <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                                        class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-500 flex items-center justify-center"
                                                        {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Item Total -->
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-gray-900 dark:text-white" id="item-total-{{ $item->id }}">
                                                    ${{ number_format($item->quantity * $item->product->price, 2) }}
                                                </p>
                                                <button onclick="removeItem({{ $item->id }})"
                                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm mt-1">
                                                    Remove
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007
                                                </button>
                                            </div>
                                        </div>
                                    </div>
<<<<<<< HEAD

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
=======
                                </div>
                                @endforeach
                            </div>
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
<<<<<<< HEAD
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
=======
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg sticky top-8">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Summary</h3>

                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                                        <span class="text-gray-900 dark:text-white" id="cart-total">${{ number_format($totalAmount, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                                        <span class="text-gray-900 dark:text-white">Free</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Tax</span>
                                        <span class="text-gray-900 dark:text-white">$0.00</span>
                                    </div>
                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                                        <div class="flex justify-between">
                                            <span class="text-lg font-semibold text-gray-900 dark:text-white">Total</span>
                                            <span class="text-lg font-semibold text-gray-900 dark:text-white" id="final-total">${{ number_format($totalAmount, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 space-y-3">
                                    <a href="{{ route('checkout.index') }}"
                                       class="w-full bg-gradient-to-r from-pink-500 to-orange-400 text-white py-3 px-4 rounded-lg font-medium hover:from-pink-600 hover:to-orange-500 transition-colors text-center block">
                                        Proceed to Checkout
                                    </a>
                                    <a href="{{ route('dashboard') }}"
                                       class="w-full bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 py-3 px-4 rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors text-center block">
                                        Continue Shopping
                                    </a>
                                    <button onclick="clearCart()"
                                            class="w-full text-red-600 dark:text-red-400 py-2 text-sm hover:text-red-800 dark:hover:text-red-300">
                                        Clear Cart
                                    </button>
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
<<<<<<< HEAD
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
=======
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-12 text-center">
                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13v8a2 2 0 002 2h6a2 2 0 002-2v-8m-9 0V9a2 2 0 012-2h4a2 2 0 012 2v4"></path>
                    </svg>
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Your cart is empty</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{ route('dashboard') }}"
                       class="bg-gradient-to-r from-pink-500 to-orange-400 text-white py-3 px-8 rounded-lg font-medium hover:from-pink-600 hover:to-orange-500 transition-colors">
                        Start Shopping
                    </a>
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007
                </div>
            @endif
        </div>
    </div>

<<<<<<< HEAD
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
=======
    <script>
        function updateQuantity(itemId, newQuantity) {
            if (newQuantity < 1) return;

            fetch(`/cart/${itemId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`quantity-${itemId}`).textContent = newQuantity;
                    document.getElementById(`item-total-${itemId}`).textContent = '$' + data.item_total;
                    document.getElementById('cart-total').textContent = '$' + data.total_amount;
                    document.getElementById('final-total').textContent = '$' + data.total_amount;

                    // Update cart counter in navigation if it exists
                    updateCartCounter();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the cart.');
            });
        }

        function removeItem(itemId) {
            if (!confirm('Are you sure you want to remove this item from your cart?')) return;

            fetch(`/cart/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`cart-item-${itemId}`).remove();
                    updateCartCounter();

                    // Reload page if cart is empty
                    if (data.cart_count === 0) {
                        location.reload();
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while removing the item.');
            });
        }

        function clearCart() {
            if (!confirm('Are you sure you want to clear your entire cart?')) return;

            fetch('/cart/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('An error occurred while clearing the cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while clearing the cart.');
            });
        }

        function updateCartCounter() {
            fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                const cartCounter = document.getElementById('cart-counter');
                if (cartCounter) {
                    cartCounter.textContent = data.count;
                }
            })
            .catch(error => console.error('Error updating cart counter:', error));
        }
    </script>
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007
</x-app-layout>
