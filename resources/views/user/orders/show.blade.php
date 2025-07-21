@extends('layouts.user')

@section('title', 'Order #' . $order->order_number . ' - AShoes Infinity')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-receipt me-2"></i>Order Details
            </h2>
            
            <!-- Order Status Alert -->
            @if($order->payment_status === 'pending')
                <div class="alert alert-warning">
                    <i class="fas fa-clock me-2"></i>
                    <strong>Payment Required:</strong> Please upload your payment proof to complete your order.
                </div>
            @elseif($order->payment_status === 'paid')
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Payment Confirmed:</strong> Your order is being processed.
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <!-- Order Information -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Order Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Order Number:</strong> {{ $order->order_number }}<br>
                            <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}<br>
                            <strong>Status:</strong> 
                            <span class="badge 
                                @switch($order->status)
                                    @case('pending') bg-warning @break
                                    @case('processing') bg-info @break
                                    @case('shipped') bg-primary @break
                                    @case('delivered') bg-success @break
                                    @case('cancelled') bg-danger @break
                                    @default bg-secondary
                                @endswitch
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="col-md-6">
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
                            </span><br>
                            
                            @if($order->paid_at)
                                <strong>Payment Date:</strong> {{ $order->paid_at->format('M d, Y H:i') }}<br>
                            @endif
                            
                            <strong>Total Amount:</strong> 
                            <span class="text-primary fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @if($order->notes)
                        <hr>
                        <strong>Order Notes:</strong><br>
                        <p class="text-muted">{{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
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

            <!-- Order Items -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-box me-2"></i>Order Items
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($order->orderItems as $item)
                        <div class="row mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="col-md-2">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                         class="img-fluid rounded" 
                                         alt="{{ $item->product_name }}"
                                         style="height: 80px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                         style="height: 80px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                <h6 class="mb-1">{{ $item->product_name }}</h6>
                                <small class="text-muted">Size: {{ $item->size }}</small><br>
                                <small class="text-muted">Quantity: {{ $item->quantity }}</small><br>
                                <small class="text-muted">Unit Price: Rp {{ number_format($item->product_price, 0, ',', '.') }}</small>
                            </div>
                            
                            <div class="col-md-4 text-end">
                                <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    @endforeach
                    
                    <div class="text-end mt-3">
                        <h5 class="text-primary">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Section -->
        <div class="col-lg-4">
            @if($order->payment_status === 'pending')
                <!-- Upload Payment Proof -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-upload me-2"></i>Upload Payment Proof
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('orders.payment', $order) }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label">Payment Proof *</label>
                                <input type="file" class="form-control @error('payment_proof') is-invalid @enderror" 
                                       name="payment_proof" accept="image/*" required>
                                @error('payment_proof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Upload JPG, JPEG, or PNG file (Max: 2MB)</small>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-upload"></i> Upload Payment Proof
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @elseif($order->payment_proof)
                <!-- Payment Proof Display -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>Payment Proof
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                             class="img-fluid rounded" 
                             alt="Payment Proof"
                             style="max-height: 300px;">
                        <p class="text-muted mt-2 mb-0">
                            <small>Uploaded on {{ $order->paid_at ? $order->paid_at->format('M d, Y H:i') : 'N/A' }}</small>
                        </p>
                    </div>
                </div>
            @endif

            <!-- Bank Account Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-university me-2"></i>Bank Account Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Bank Mandiri</strong><br>
                        <small class="text-muted">Account: 1234567890</small><br>
                        <small class="text-muted">Name: AShoes Infinity</small>
                    </div>
                    
                    <div class="mb-3">
                        <strong>BCA</strong><br>
                        <small class="text-muted">Account: 0987654321</small><br>
                        <small class="text-muted">Name: AShoes Infinity</small>
                    </div>
                    
                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle me-1"></i>
                            Please transfer the exact amount and upload your payment proof.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
            
            @if($order->status === 'delivered')
                <button class="btn btn-success ms-2" disabled>
                    <i class="fas fa-check-circle"></i> Order Completed
                </button>
            @endif
        </div>
    </div>
</div>
@endsection
