<x-app-layout>
    <div class="bg-brown-50 min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-brown-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-3xl font-bold text-brown-800">My Orders</h1>
                <p class="text-brown-600 mt-1">Track and manage your shoe orders</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if($orders->count() > 0)
                <!-- Order Filters -->
                <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                    <div class="flex flex-wrap gap-4 items-center">
                        <div class="flex items-center space-x-2">
                            <label for="statusFilter" class="text-sm font-medium text-brown-700">Filter by Status:</label>
                            <select id="statusFilter" class="px-3 py-1 border border-brown-300 rounded focus:ring-2 focus:ring-brown-500 focus:border-brown-500 text-sm">
                                <option value="">All Orders</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <label for="paymentFilter" class="text-sm font-medium text-brown-700">Payment Status:</label>
                            <select id="paymentFilter" class="px-3 py-1 border border-brown-300 rounded focus:ring-2 focus:ring-brown-500 focus:border-brown-500 text-sm">
                                <option value="">All Payments</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Orders List -->
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden order-card"
                             data-status="{{ $order->status }}"
                             data-payment="{{ $order->payment_status }}">
                            
                            <!-- Order Header -->
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-brown-800">
                                                Order #{{ $order->order_number }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                                        <!-- Order Status -->
                                        <span class="px-3 py-1 rounded-full text-sm font-medium
                                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                            @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                            @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        
                                        <!-- Payment Status -->
                                        <span class="px-3 py-1 rounded-full text-sm font-medium
                                            @if($order->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->payment_status === 'paid') bg-green-100 text-green-800
                                            @elseif($order->payment_status === 'failed') bg-red-100 text-red-800
                                            @endif">
                                            Payment {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="p-6">
                                <div class="space-y-4">
                                    @foreach($order->orderItems as $item)
                                        <div class="flex gap-4">
                                            <!-- Product Image -->
                                            <div class="w-16 h-16 bg-brown-100 rounded-lg overflow-hidden flex-shrink-0">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <i class="fas fa-shoe-prints text-brown-400"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Product Details -->
                                            <div class="flex-1">
                                                <h4 class="font-medium text-brown-800">{{ $item->product->name }}</h4>
                                                <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                                <p class="text-sm font-semibold text-brown-600">
                                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Order Total -->
                                <div class="mt-6 pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                {{ $order->orderItems->sum('quantity') }} items
                                            </p>
                                            @if($order->notes)
                                                <p class="text-sm text-gray-600 mt-1">
                                                    <i class="fas fa-sticky-note mr-1"></i>
                                                    {{ $order->notes }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-bold text-brown-800">
                                                Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Actions -->
                            <div class="px-6 py-4 bg-brown-50 border-t border-brown-200">
                                <div class="flex flex-col sm:flex-row gap-3 justify-between items-start">
                                    <!-- Shipping Info -->
                                    <div class="text-sm text-gray-600">
                                        <p><i class="fas fa-truck mr-1"></i> 
                                            Shipping to: {{ $order->shipping_address }}
                                        </p>
                                        @if($order->tracking_number)
                                            <p class="mt-1">
                                                <i class="fas fa-barcode mr-1"></i>
                                                Tracking: {{ $order->tracking_number }}
                                            </p>
                                        @endif
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="flex flex-wrap gap-2">
                                        <button onclick="viewOrder('{{ $order->id }}')" 
                                                class="px-4 py-2 bg-brown-100 hover:bg-brown-200 text-brown-800 rounded-lg text-sm font-medium transition-colors">
                                            <i class="fas fa-eye mr-1"></i>
                                            View Details
                                        </button>
                                        
                                        @if($order->status === 'pending' && $order->payment_status === 'pending')
                                            <button onclick="payOrder('{{ $order->id }}')" 
                                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors">
                                                <i class="fas fa-credit-card mr-1"></i>
                                                Pay Now
                                            </button>
                                            
                                            <button onclick="cancelOrder('{{ $order->id }}')" 
                                                    class="px-4 py-2 bg-red-100 hover:bg-red-200 text-red-800 rounded-lg text-sm font-medium transition-colors">
                                                <i class="fas fa-times mr-1"></i>
                                                Cancel
                                            </button>
                                        @endif
                                        
                                        @if($order->status === 'delivered')
                                            <button onclick="reorderItems('{{ $order->id }}')" 
                                                    class="px-4 py-2 bg-brown-600 hover:bg-brown-700 text-white rounded-lg text-sm font-medium transition-colors">
                                                <i class="fas fa-redo mr-1"></i>
                                                Reorder
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-shopping-bag text-6xl text-brown-300 mb-6"></i>
                        <h2 class="text-2xl font-bold text-brown-800 mb-4">No Orders Yet</h2>
                        <p class="text-gray-600 mb-8">You haven't placed any orders yet. Start shopping to see your orders here.</p>
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

    <!-- Order Details Modal -->
    <div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4" style="display: none;">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-bold text-brown-800">Order Details</h3>
                    <button onclick="closeOrderModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="orderModalContent">
                    <!-- Order details will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('statusFilter');
            const paymentFilter = document.getElementById('paymentFilter');
            
            function filterOrders() {
                const statusValue = statusFilter.value;
                const paymentValue = paymentFilter.value;
                const orderCards = document.querySelectorAll('.order-card');
                
                orderCards.forEach(card => {
                    const cardStatus = card.dataset.status;
                    const cardPayment = card.dataset.payment;
                    
                    const statusMatch = !statusValue || cardStatus === statusValue;
                    const paymentMatch = !paymentValue || cardPayment === paymentValue;
                    
                    if (statusMatch && paymentMatch) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
            
            statusFilter.addEventListener('change', filterOrders);
            paymentFilter.addEventListener('change', filterOrders);
        });

        // View order details
        async function viewOrder(orderId) {
            try {
                const response = await fetch(`/user/orders/${orderId}`);
                const html = await response.text();
                
                document.getElementById('orderModalContent').innerHTML = html;
                const modal = document.getElementById('orderModal');
                modal.style.display = 'flex';
            } catch (error) {
                console.error('Error:', error);
                showFlashMessage('error', 'Failed to load order details');
            }
        }

        // Close order modal
        function closeOrderModal() {
            document.getElementById('orderModal').style.display = 'none';
        }

        // Pay for order
        function payOrder(orderId) {
            window.location.href = `/user/orders/${orderId}/payment`;
        }

        // Cancel order
        async function cancelOrder(orderId) {
            if (!confirm('Are you sure you want to cancel this order?')) {
                return;
            }

            try {
                const response = await fetch(`/user/orders/${orderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();
                
                if (data.success) {
                    showFlashMessage('success', 'Order cancelled successfully');
                    location.reload();
                } else {
                    showFlashMessage('error', data.message || 'Failed to cancel order');
                }
            } catch (error) {
                console.error('Error:', error);
                showFlashMessage('error', 'An error occurred while cancelling order');
            }
        }

        // Reorder items
        async function reorderItems(orderId) {
            try {
                const response = await fetch(`/user/orders/${orderId}/reorder`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();
                
                if (data.success) {
                    showFlashMessage('success', 'Items added to cart successfully');
                    updateCartCount();
                } else {
                    showFlashMessage('error', data.message || 'Failed to reorder items');
                }
            } catch (error) {
                console.error('Error:', error);
                showFlashMessage('error', 'An error occurred while reordering');
            }
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
        document.getElementById('orderModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderModal();
            }
        });
    </script>
    @endpush
</x-app-layout>
                                    ">
                                        Payment: {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <!-- Order Items Preview -->
                                <div class="col-md-8">
                                    <div class="row">
                                        @foreach($order->orderItems->take(3) as $item)
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        @if($item->product && $item->product->image)
                                                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                                 class="rounded" 
                                                                 alt="{{ $item->product_name }}"
                                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                                                 style="width: 60px; height: 60px;">
                                                                <i class="fas fa-image text-muted"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 small">{{ Str::limit($item->product_name, 20) }}</h6>
                                                        <small class="text-muted">
                                                            Size: {{ $item->size }}<br>
                                                            Qty: {{ $item->quantity }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($order->orderItems->count() > 3)
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex align-items-center justify-content-center bg-light rounded" 
                                                     style="height: 60px;">
                                                    <small class="text-muted">
                                                        +{{ $order->orderItems->count() - 3 }} more items
                                                    </small>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Order Summary & Actions -->
                                <div class="col-md-4">
                                    <div class="text-md-end">
                                        <h5 class="text-primary mb-3">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </h5>
                                        
                                        <div class="mb-2">
                                            <small class="text-muted">
                                                {{ $order->orderItems->count() }} item(s)
                                            </small>
                                        </div>
                                        
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            
                                            @if($order->payment_status === 'pending')
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-upload"></i> Upload Payment
                                                </a>
                                            @endif
                                            
                                            @if($order->status === 'delivered')
                                                <button class="btn btn-outline-success btn-sm" disabled>
                                                    <i class="fas fa-check-circle"></i> Completed
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Order Timeline -->
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="fas fa-clock me-1"></i>
                                            Last updated: {{ $order->updated_at->diffForHumans() }}
                                        </small>
                                        
                                        @if($order->payment_status === 'pending')
                                            <small class="text-warning">
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                Waiting for payment confirmation
                                            </small>
                                        @elseif($order->payment_status === 'paid' && $order->status === 'pending')
                                            <small class="text-info">
                                                <i class="fas fa-cog me-1"></i>
                                                Payment confirmed, preparing order
                                            </small>
                                        @elseif($order->status === 'processing')
                                            <small class="text-info">
                                                <i class="fas fa-box me-1"></i>
                                                Order is being processed
                                            </small>
                                        @elseif($order->status === 'shipped')
                                            <small class="text-primary">
                                                <i class="fas fa-shipping-fast me-1"></i>
                                                Order has been shipped
                                            </small>
                                        @elseif($order->status === 'delivered')
                                            <small class="text-success">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Order delivered successfully
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                    <h4>No orders yet</h4>
                    <p class="text-muted">You haven't placed any orders yet. Start shopping to see your orders here.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-bag"></i> Start Shopping
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Quick Filter (Optional Enhancement) -->
<div class="position-fixed bottom-0 end-0 m-4" style="z-index: 1050;">
    <div class="dropdown dropup">
        <button class="btn btn-primary rounded-circle" type="button" data-bs-toggle="dropdown" style="width: 60px; height: 60px;">
            <i class="fas fa-filter"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('orders.index') }}">All Orders</a></li>
            <li><a class="dropdown-item" href="{{ route('orders.index', ['status' => 'pending']) }}">Pending</a></li>
            <li><a class="dropdown-item" href="{{ route('orders.index', ['status' => 'processing']) }}">Processing</a></li>
            <li><a class="dropdown-item" href="{{ route('orders.index', ['status' => 'shipped']) }}">Shipped</a></li>
            <li><a class="dropdown-item" href="{{ route('orders.index', ['status' => 'delivered']) }}">Delivered</a></li>
        </ul>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.75rem;
}
</style>
@endpush
