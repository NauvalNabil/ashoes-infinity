<x-app-layout>
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
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
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
                </div>
            @endif
        </div>
    </div>

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
</x-app-layout>
