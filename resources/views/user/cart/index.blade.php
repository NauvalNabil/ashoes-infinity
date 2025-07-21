@extends('layouts.user')

@section('title', 'Shopping Cart - AShoes Infinity')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
            </h2>
        </div>
    </div>

    @if($carts->count() > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @foreach($carts as $cart)
                            <div class="row cart-item mb-3 pb-3 border-bottom" data-cart-id="{{ $cart->id }}">
                                <div class="col-md-2">
                                    @if($cart->product->image)
                                        <img src="{{ asset('storage/' . $cart->product->image) }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $cart->product->name }}"
                                             style="height: 80px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 80px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="col-md-4">
                                    <h6 class="mb-1">{{ $cart->product->name }}</h6>
                                    <small class="text-muted">Size: {{ $cart->size }}</small><br>
                                    <small class="text-muted">Price: Rp {{ number_format($cart->product->price, 0, ',', '.') }}</small>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="input-group input-group-sm">
                                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity({{ $cart->id }}, {{ $cart->quantity - 1 }})">-</button>
                                        <input type="text" class="form-control text-center quantity-input" 
                                               value="{{ $cart->quantity }}" 
                                               data-cart-id="{{ $cart->id }}"
                                               readonly>
                                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity({{ $cart->id }}, {{ $cart->quantity + 1 }})">+</button>
                                    </div>
                                    <small class="text-muted">Max: {{ $cart->product->stock }}</small>
                                </div>
                                
                                <div class="col-md-2">
                                    <strong class="subtotal">Rp {{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}</strong>
                                </div>
                                
                                <div class="col-md-1">
                                    <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart({{ $cart->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="text-end mt-3">
                            <button class="btn btn-outline-secondary" onclick="clearCart()">
                                <i class="fas fa-trash"></i> Clear Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total Items:</span>
                            <span id="total-items">{{ $carts->sum('quantity') }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong id="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </div>
                        
                        <div class="d-grid">
                            <a href="{{ route('orders.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-credit-card"></i> Proceed to Checkout
                            </a>
                        </div>
                        
                        <div class="d-grid mt-2">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Delivery Info -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h6><i class="fas fa-truck me-2"></i>Delivery Information</h6>
                        <small class="text-muted">
                            • Free delivery for orders above Rp 500,000<br>
                            • Delivery takes 2-5 business days<br>
                            • Cash on delivery available
                        </small>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
            <h4>Your cart is empty</h4>
            <p class="text-muted">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function updateQuantity(cartId, newQuantity) {
    if (newQuantity < 1) return;
    
    $.ajax({
        url: `/cart/${cartId}`,
        method: 'PATCH',
        data: {
            _token: '{{ csrf_token() }}',
            quantity: newQuantity
        },
        success: function(response) {
            // Update quantity input
            $(`.quantity-input[data-cart-id="${cartId}"]`).val(newQuantity);
            
            // Update subtotal for this item
            $(`.cart-item[data-cart-id="${cartId}"] .subtotal`).text(response.subtotal);
            
            // Update total
            $('#total-amount').text(response.total);
            
            // Update cart count
            updateCartCount();
            
            // Show success message
            showMessage(response.success, 'success');
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            showMessage(response.error || 'An error occurred', 'error');
        }
    });
}

function removeFromCart(cartId) {
    if (!confirm('Are you sure you want to remove this item?')) return;
    
    $.ajax({
        url: `/cart/${cartId}`,
        method: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            // Remove the cart item row
            $(`.cart-item[data-cart-id="${cartId}"]`).fadeOut(function() {
                $(this).remove();
                
                // Check if cart is empty
                if ($('.cart-item').length === 0) {
                    location.reload();
                }
            });
            
            // Update total
            $('#total-amount').text(response.total);
            
            // Update cart count
            updateCartCount();
            
            showMessage(response.success, 'success');
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            showMessage(response.error || 'An error occurred', 'error');
        }
    });
}

function clearCart() {
    if (!confirm('Are you sure you want to clear your cart?')) return;
    
    $.ajax({
        url: '{{ route('cart.clear') }}',
        method: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function() {
            location.reload();
        }
    });
}

function showMessage(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    
    $('body').prepend(`
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `);
    
    // Auto dismiss after 3 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 3000);
}
</script>
@endpush
