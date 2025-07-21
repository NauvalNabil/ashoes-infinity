@extends('layouts.user')

@section('title', 'Checkout - AShoes Infinity')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-credit-card me-2"></i>Checkout
            </h2>
        </div>
    </div>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <div class="row">
            <!-- Shipping Information -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-shipping-fast me-2"></i>Shipping Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address *</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">City *</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       name="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Postal Code *</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                       name="postal_code" value="{{ old('postal_code') }}" required>
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Order Notes (Optional)</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      name="notes" rows="2" placeholder="Any special instructions?">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-credit-card me-2"></i>Payment Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Bank Transfer Payment:</strong><br>
                            After placing your order, you will be redirected to upload your payment proof. 
                            Please transfer to our bank account and upload the payment receipt.
                        </div>
                        
                        <div class="border rounded p-3">
                            <h6>Bank Account Details:</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Bank Name:</strong> Bank Mandiri<br>
                                    <strong>Account Number:</strong> 1234567890<br>
                                    <strong>Account Name:</strong> AShoes Infinity
                                </div>
                                <div class="col-md-6">
                                    <strong>Bank Name:</strong> BCA<br>
                                    <strong>Account Number:</strong> 0987654321<br>
                                    <strong>Account Name:</strong> AShoes Infinity
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        @foreach($carts as $cart)
                            <div class="d-flex mb-3 pb-3 border-bottom">
                                <div class="me-3">
                                    @if($cart->product->image)
                                        <img src="{{ asset('storage/' . $cart->product->image) }}" 
                                             class="rounded" 
                                             alt="{{ $cart->product->name }}"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $cart->product->name }}</h6>
                                    <small class="text-muted">Size: {{ $cart->size }}</small><br>
                                    <small class="text-muted">Qty: {{ $cart->quantity }}</small>
                                    <div class="text-end">
                                        <strong>Rp {{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal:</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping:</span>
                            <span class="text-success">Free</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total:</strong>
                            <strong class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle"></i> Place Order
                            </button>
                        </div>

                        <div class="d-grid mt-2">
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Format phone number input
    $('input[name="phone"]').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(value);
    });

    // Format postal code input
    $('input[name="postal_code"]').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(value);
    });
});
</script>
@endpush
