<x-app-layout>
    <div class="bg-brown-50 min-h-screen">
        <!-- Header Section -->
        <div class="bg-white shadow-sm border-b border-brown-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-brown-800">Our Shoe Collection</h1>
                        <p class="text-brown-600 mt-1">Discover the perfect shoes for your style</p>
                    </div>
                    
                    <!-- Search and Filter -->
                    <div class="mt-4 md:mt-0 flex flex-col sm:flex-row gap-4">
                        <div class="relative">
                            <input type="text" 
                                   id="searchInput"
                                   placeholder="Search shoes..." 
                                   class="w-full sm:w-64 pl-10 pr-4 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                            <i class="fas fa-search absolute left-3 top-3 text-brown-400"></i>
                        </div>
                        
                        <select id="sortSelect" class="px-4 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500 bg-white">
                            <option value="name_asc">Name (A-Z)</option>
                            <option value="name_desc">Name (Z-A)</option>
                            <option value="price_asc">Price (Low to High)</option>
                            <option value="price_desc">Price (High to Low)</option>
                            <option value="newest">Newest First</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Sidebar and Products -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Filter Sidebar -->
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                        <h3 class="text-lg font-semibold text-brown-800 mb-4">Filters</h3>
                        
                        <!-- Price Range -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-brown-700 mb-2">Price Range</label>
                            <div class="flex items-center space-x-2">
                                <input type="number" 
                                       id="minPrice" 
                                       placeholder="Min" 
                                       class="w-full px-3 py-2 border border-brown-300 rounded text-sm focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                                <span class="text-brown-500">-</span>
                                <input type="number" 
                                       id="maxPrice" 
                                       placeholder="Max" 
                                       class="w-full px-3 py-2 border border-brown-300 rounded text-sm focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                            </div>
                        </div>

                        <!-- Stock Status -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-brown-700 mb-2">Availability</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" id="inStock" checked class="rounded border-brown-300 text-brown-600 focus:ring-brown-500">
                                    <span class="ml-2 text-sm text-brown-700">In Stock</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" id="lowStock" class="rounded border-brown-300 text-brown-600 focus:ring-brown-500">
                                    <span class="ml-2 text-sm text-brown-700">Low Stock (≤10)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Apply Filters Button -->
                        <button onclick="applyFilters()" 
                                class="w-full bg-brown-600 hover:bg-brown-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Apply Filters
                        </button>
                        
                        <button onclick="clearFilters()" 
                                class="w-full mt-2 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg font-medium transition-colors">
                            Clear Filters
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="lg:w-3/4">
                    <div id="productsContainer">
                        @if($products->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="productsGrid">
                                @foreach($products as $product)
                                    <div class="product-card bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300 group"
                                         data-name="{{ strtolower($product->name) }}"
                                         data-price="{{ $product->price }}"
                                         data-stock="{{ $product->stock }}"
                                         data-created="{{ $product->created_at->timestamp }}">
                                        
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
                                            
                                            <!-- Stock Badge -->
                                            @if($product->stock <= 0)
                                                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-xs font-medium">
                                                    Out of Stock
                                                </div>
                                            @elseif($product->stock <= 10)
                                                <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded text-xs font-medium">
                                                    Low Stock
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-brown-800 mb-2 group-hover:text-brown-600 transition-colors line-clamp-1">
                                                {{ $product->name }}
                                            </h3>
                                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                                            
                                            <div class="flex items-center justify-between mb-4">
                                                <span class="text-xl font-bold text-brown-600">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </span>
                                                <span class="text-sm text-gray-500">
                                                    Stock: {{ $product->stock }}
                                                </span>
                                            </div>

                                            <div class="flex gap-2">
                                                <button onclick="showProductDetails({{ $product->id }})" 
                                                        class="flex-1 bg-brown-100 hover:bg-brown-200 text-brown-800 py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                                                    <i class="fas fa-eye mr-1"></i> Details
                                                </button>
                                                
                                                @auth
                                                    @if(!auth()->user()->isAdmin())
                                                        @if($product->stock > 0)
                                                            <button onclick="addToCart({{ $product->id }})" 
                                                                    class="flex-1 bg-brown-600 hover:bg-brown-700 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                                                                <i class="fas fa-cart-plus mr-1"></i> Add to Cart
                                                            </button>
                                                        @else
                                                            <button class="flex-1 bg-gray-400 text-white py-2 px-3 rounded-lg text-sm font-medium cursor-not-allowed" disabled>
                                                                <i class="fas fa-times mr-1"></i> Out of Stock
                                                            </button>
                                                        @endif
                                                    @endif
                                                @else
                                                    <a href="{{ route('login') }}" 
                                                       class="flex-1 bg-brown-600 hover:bg-brown-700 text-white py-2 px-3 rounded-lg text-sm font-medium text-center transition-colors">
                                                        <i class="fas fa-cart-plus mr-1"></i> Login to Buy
                                                    </a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="mt-8">
                                {{ $products->links() }}
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="fas fa-shoe-prints text-6xl text-brown-300 mb-4"></i>
                                <h3 class="text-xl font-semibold text-brown-800 mb-2">No Products Found</h3>
                                <p class="text-gray-600">Try adjusting your search criteria or check back later for new arrivals!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        // Search and Filter Functions
        let allProducts = [];
        
        document.addEventListener('DOMContentLoaded', function() {
            // Store initial products
            allProducts = Array.from(document.querySelectorAll('.product-card'));
            
            // Setup search
            document.getElementById('searchInput').addEventListener('input', debounce(filterProducts, 300));
            document.getElementById('sortSelect').addEventListener('change', filterProducts);
        });

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function filterProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const sortBy = document.getElementById('sortSelect').value;
            const minPrice = parseFloat(document.getElementById('minPrice').value) || 0;
            const maxPrice = parseFloat(document.getElementById('maxPrice').value) || Infinity;
            const inStock = document.getElementById('inStock').checked;
            const lowStock = document.getElementById('lowStock').checked;

            let filteredProducts = allProducts.filter(product => {
                const name = product.dataset.name;
                const price = parseFloat(product.dataset.price);
                const stock = parseInt(product.dataset.stock);

                // Search filter
                if (searchTerm && !name.includes(searchTerm)) {
                    return false;
                }

                // Price filter
                if (price < minPrice || price > maxPrice) {
                    return false;
                }

                // Stock filter
                if (inStock && lowStock) {
                    return stock > 0; // Show all in stock
                } else if (inStock && !lowStock) {
                    return stock > 10; // Show only good stock
                } else if (!inStock && lowStock) {
                    return stock <= 10 && stock > 0; // Show only low stock
                } else if (!inStock && !lowStock) {
                    return stock === 0; // Show only out of stock
                }

                return true;
            });

            // Sort products
            filteredProducts.sort((a, b) => {
                switch (sortBy) {
                    case 'name_asc':
                        return a.dataset.name.localeCompare(b.dataset.name);
                    case 'name_desc':
                        return b.dataset.name.localeCompare(a.dataset.name);
                    case 'price_asc':
                        return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    case 'price_desc':
                        return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                    case 'newest':
                        return parseInt(b.dataset.created) - parseInt(a.dataset.created);
                    default:
                        return 0;
                }
            });

            // Update display
            const grid = document.getElementById('productsGrid');
            if (grid) {
                grid.innerHTML = '';
                filteredProducts.forEach(product => {
                    grid.appendChild(product.cloneNode(true));
                });

                if (filteredProducts.length === 0) {
                    grid.innerHTML = `
                        <div class="col-span-full text-center py-12">
                            <i class="fas fa-search text-6xl text-brown-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-brown-800 mb-2">No Products Found</h3>
                            <p class="text-gray-600">Try adjusting your search criteria!</p>
                        </div>
                    `;
                }
            }
        }

        function applyFilters() {
            filterProducts();
        }

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('minPrice').value = '';
            document.getElementById('maxPrice').value = '';
            document.getElementById('inStock').checked = true;
            document.getElementById('lowStock').checked = false;
            document.getElementById('sortSelect').value = 'name_asc';
            filterProducts();
        }

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
                    showFlashMessage('success', 'Product added to cart successfully!');
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

        // Close modal when clicking outside
        document.getElementById('productModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProductModal();
            }
        });
    </script>
    @endpush
</x-app-layout>
