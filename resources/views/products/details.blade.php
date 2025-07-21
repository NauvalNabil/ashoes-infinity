<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Product Image -->
    <div class="space-y-4">
        @if($product->image)
            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover">
            </div>
        @else
            <div class="aspect-square bg-brown-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-shoe-prints text-6xl text-brown-400"></i>
            </div>
        @endif
    </div>

    <!-- Product Information -->
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-brown-800 mb-2">{{ $product->name }}</h2>
            <p class="text-3xl font-bold text-brown-600">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>
        </div>

        <!-- Stock Status -->
        <div class="flex items-center space-x-2">
            @if($product->stock > 10)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1"></i>
                    In Stock ({{ $product->stock }} available)
                </span>
            @elseif($product->stock > 0)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    Low Stock ({{ $product->stock }} left)
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    <i class="fas fa-times-circle mr-1"></i>
                    Out of Stock
                </span>
            @endif
        </div>

        <!-- Description -->
        <div>
            <h3 class="text-lg font-semibold text-brown-800 mb-2">Description</h3>
            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
        </div>

        <!-- Product Details -->
        <div class="bg-brown-50 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-brown-800 mb-3">Product Details</h3>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <span class="font-medium text-brown-700">SKU:</span>
                    <span class="text-gray-600">{{ $product->sku ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="font-medium text-brown-700">Stock:</span>
                    <span class="text-gray-600">{{ $product->stock }} units</span>
                </div>
                <div>
                    <span class="font-medium text-brown-700">Category:</span>
                    <span class="text-gray-600">{{ $product->category ?? 'Shoes' }}</span>
                </div>
                <div>
                    <span class="font-medium text-brown-700">Brand:</span>
                    <span class="text-gray-600">{{ $product->brand ?? 'AShoes Infinity' }}</span>
                </div>
            </div>
        </div>

        @auth
            @if(!auth()->user()->isAdmin())
                <!-- Quantity and Add to Cart -->
                <div class="space-y-4">
                    @if($product->stock > 0)
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-brown-700 mb-2">Quantity</label>
                            <div class="flex items-center space-x-3">
                                <button onclick="decreaseQuantity()" 
                                        class="w-10 h-10 bg-brown-100 hover:bg-brown-200 text-brown-700 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" 
                                       id="quantity" 
                                       value="1" 
                                       min="1" 
                                       max="{{ $product->stock }}" 
                                       class="w-20 px-3 py-2 border border-brown-300 rounded-lg text-center focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                                <button onclick="increaseQuantity()" 
                                        class="w-10 h-10 bg-brown-100 hover:bg-brown-200 text-brown-700 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex space-x-3">
                            <button onclick="addToCartFromModal({{ $product->id }})" 
                                    class="flex-1 bg-brown-600 hover:bg-brown-700 text-white py-3 px-6 rounded-lg font-semibold transition-colors">
                                <i class="fas fa-cart-plus mr-2"></i>
                                Add to Cart
                            </button>
                            <button onclick="buyNow({{ $product->id }})" 
                                    class="flex-1 bg-brown-800 hover:bg-brown-900 text-white py-3 px-6 rounded-lg font-semibold transition-colors">
                                <i class="fas fa-bolt mr-2"></i>
                                Buy Now
                            </button>
                        </div>
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                <span class="text-red-700 font-medium">This product is currently out of stock</span>
                            </div>
                            <p class="text-red-600 text-sm mt-1">Please check back later or contact us for availability.</p>
                        </div>
                    @endif
                </div>
            @endif
        @else
            <div class="bg-brown-50 border border-brown-200 rounded-lg p-4">
                <div class="text-center">
                    <i class="fas fa-user-lock text-brown-500 text-2xl mb-2"></i>
                    <p class="text-brown-700 font-medium mb-3">Please login to purchase this product</p>
                    <div class="flex space-x-3">
                        <a href="{{ route('login') }}" 
                           class="flex-1 bg-brown-600 hover:bg-brown-700 text-white py-2 px-4 rounded-lg font-medium text-center transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="flex-1 bg-brown-200 hover:bg-brown-300 text-brown-800 py-2 px-4 rounded-lg font-medium text-center transition-colors">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        @endauth

        <!-- Features -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div class="flex items-center text-brown-700">
                <i class="fas fa-shipping-fast mr-2 text-brown-500"></i>
                Free shipping nationwide
            </div>
            <div class="flex items-center text-brown-700">
                <i class="fas fa-undo mr-2 text-brown-500"></i>
                30-day return policy
            </div>
            <div class="flex items-center text-brown-700">
                <i class="fas fa-medal mr-2 text-brown-500"></i>
                Premium quality guarantee
            </div>
            <div class="flex items-center text-brown-700">
                <i class="fas fa-headset mr-2 text-brown-500"></i>
                24/7 customer support
            </div>
        </div>
    </div>
</div>

<script>
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    const maxValue = parseInt(quantityInput.max);
    
    if (currentValue < maxValue) {
        quantityInput.value = currentValue + 1;
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

async function addToCartFromModal(productId) {
    const quantity = parseInt(document.getElementById('quantity').value);
    
    try {
        const response = await fetch('{{ route("cart.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        });

        const data = await response.json();
        
        if (data.success) {
            closeProductModal();
            showFlashMessage('success', `${quantity} item(s) added to cart successfully!`);
            updateCartCount();
        } else {
            showFlashMessage('error', data.message || 'Failed to add product to cart');
        }
    } catch (error) {
        console.error('Error:', error);
        showFlashMessage('error', 'An error occurred while adding to cart');
    }
}

async function buyNow(productId) {
    const quantity = parseInt(document.getElementById('quantity').value);
    
    try {
        // Add to cart first
        const response = await fetch('{{ route("cart.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        });

        const data = await response.json();
        
        if (data.success) {
            // Redirect to cart/checkout
            window.location.href = '{{ route("cart.index") }}';
        } else {
            showFlashMessage('error', data.message || 'Failed to add product to cart');
        }
    } catch (error) {
        console.error('Error:', error);
        showFlashMessage('error', 'An error occurred while processing your request');
    }
}
</script>
