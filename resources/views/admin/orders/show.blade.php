@extends('admin.layouts.app')

@section('title', 'Order #' . $order->order_number . ' - AShoes Infinity')

@section('content')
<div class="order-details">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Order #{{ $order->order_number }}</h1>
            <p class="page-subtitle">
                Order placed on {{ $order->created_at->format('M d, Y \a\t H:i') }}
            </p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-cog"></i> Actions
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="printOrder()"><i class="fas fa-print"></i> Print Order</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> Email Customer</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-ban"></i> Cancel Order</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Information -->
        <div class="col-lg-8">
            <!-- Status Update -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-edit me-2"></i>Update Order Status
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Order Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Payment Status</label>
                                <select class="form-select" name="payment_status" required>
                                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">
                                    <i class="fas fa-save"></i> Update Status
                                </button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" name="notes" rows="2" placeholder="Add notes about this update...">{{ $order->notes }}</textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-box me-2"></i>Order Items ({{ $order->orderItems->count() }} items)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product && $item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                         class="me-3 rounded" 
                                                         alt="{{ $item->product_name }}"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="me-3 bg-light d-flex align-items-center justify-content-center rounded" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong>{{ $item->product_name }}</strong>
                                                    @if($item->product)
                                                        <br><small class="text-muted">SKU: {{ $item->product->id }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->size }}</td>
                                        <td>Rp {{ number_format($item->product_price, 0, ',', '.') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td><strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-active">
                                    <th colspan="4" class="text-end">Total:</th>
                                    <th>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Notes -->
            @if($order->notes)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-sticky-note me-2"></i>Order Notes
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $order->notes }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-user me-2"></i>Customer Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>{{ $order->user->name }}</strong><br>
                        <small class="text-muted">{{ $order->user->email }}</small><br>
                        <small class="text-muted">Customer since {{ $order->user->created_at->format('M Y') }}</small>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Total Orders:</strong> {{ $order->user->orders->count() }}<br>
                        <strong>Total Spent:</strong> Rp {{ number_format($order->user->orders->where('payment_status', 'paid')->sum('total_amount'), 0, ',', '.') }}
                    </div>
                    
                    <div class="d-grid">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-envelope"></i> Contact Customer
                        </button>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-shipping-fast me-2"></i>Shipping Address
                    </h5>
                </div>
                <div class="card-body">
                    <address class="mb-0">
                        <strong>{{ $order->shipping_address['name'] }}</strong><br>
                        {{ $order->shipping_address['address'] }}<br>
                        {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['postal_code'] }}<br>
                        <i class="fas fa-phone me-1"></i>{{ $order->shipping_address['phone'] }}
                    </address>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-credit-card me-2"></i>Payment Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Payment Status:</strong> 
                        <span class="badge 
                            @switch($order->payment_status)
                                @case('pending') bg-warning @break
                                @case('paid') bg-success @break
                                @case('failed') bg-danger @break
                                @default bg-secondary
                            @endswitch
                        ">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                    
                    @if($order->paid_at)
                        <div class="mb-3">
                            <strong>Payment Date:</strong><br>
                            {{ $order->paid_at->format('M d, Y H:i') }}
                        </div>
                    @endif
                    
                    <div class="mb-3">
                        <strong>Total Amount:</strong><br>
                        <span class="h5 text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    
                    @if($order->payment_proof)
                        <div class="mb-3">
                            <strong>Payment Proof:</strong><br>
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                                     class="img-fluid rounded cursor-pointer" 
                                     alt="Payment Proof"
                                     style="max-height: 200px;"
                                     onclick="showPaymentProof('{{ asset('storage/' . $order->payment_proof) }}')">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-clock me-2"></i>Order Timeline
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item active">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6>Order Placed</h6>
                                <small class="text-muted">{{ $order->created_at->format('M d, Y H:i') }}</small>
                            </div>
                        </div>
                        
                        @if($order->payment_status == 'paid')
                            <div class="timeline-item active">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6>Payment Confirmed</h6>
                                    <small class="text-muted">{{ $order->paid_at ? $order->paid_at->format('M d, Y H:i') : 'N/A' }}</small>
                                </div>
                            </div>
                        @endif
                        
                        @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                            <div class="timeline-item active">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6>Processing</h6>
                                    <small class="text-muted">Order is being prepared</small>
                                </div>
                            </div>
                        @endif
                        
                        @if(in_array($order->status, ['shipped', 'delivered']))
                            <div class="timeline-item active">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6>Shipped</h6>
                                    <small class="text-muted">Order has been shipped</small>
                                </div>
                            </div>
                        @endif
                        
                        @if($order->status == 'delivered')
                            <div class="timeline-item active">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6>Delivered</h6>
                                    <small class="text-muted">Order completed</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Proof Modal -->
<div class="modal fade" id="paymentProofModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Proof</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="paymentProofImage" src="" class="img-fluid" alt="Payment Proof">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function showPaymentProof(imageUrl) {
    $('#paymentProofImage').attr('src', imageUrl);
    $('#paymentProofModal').modal('show');
}

function printOrder() {
    window.print();
}
</script>
@endpush

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -2rem;
    top: 1.5rem;
    width: 2px;
    height: calc(100% + 1.5rem);
    background-color: #e9ecef;
}

.timeline-item:last-child::before {
    display: none;
}

.timeline-marker {
    position: absolute;
    left: -2.5rem;
    top: 0.25rem;
    width: 1rem;
    height: 1rem;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 0 0 2px #e9ecef;
}

.timeline-item.active .timeline-marker {
    box-shadow: 0 0 0 2px #007bff;
}

.cursor-pointer {
    cursor: pointer;
}

@media print {
    .page-header,
    .btn,
    .card-header {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endpush
