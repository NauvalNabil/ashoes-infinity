<x-app-layout>
    <div class="bg-brown-50 min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-brown-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center">
                    <a href="{{ route('cart.index') }}" class="text-brown-600 hover:text-brown-800 mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-3xl font-bold text-brown-800">Checkout</h1>
                </div>
                
                <!-- Progress Steps -->
                <div class="mt-6">
                    <div class="flex items-center">
                        <div class="flex items-center text-brown-600">
                            <div class="w-8 h-8 bg-brown-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                                1
                            </div>
                            <span class="ml-2 text-sm font-medium">Cart</span>
                        </div>
                        <div class="flex-1 h-0.5 bg-brown-600 mx-4"></div>
                        <div class="flex items-center text-brown-600">
                            <div class="w-8 h-8 bg-brown-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                                2
                            </div>
                            <span class="ml-2 text-sm font-medium">Checkout</span>
                        </div>
                        <div class="flex-1 h-0.5 bg-gray-300 mx-4"></div>
                        <div class="flex items-center text-gray-400">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-sm font-medium">
                                3
                            </div>
                            <span class="ml-2 text-sm font-medium">Payment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <form id="checkoutForm" method="POST" action="{{ route('user.orders.store') }}">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Checkout Form -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Shipping Information -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-bold text-brown-800 mb-4">Shipping Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-brown-700 mb-1">First Name *</label>
                                    <input type="text" 
                                           id="first_name" 
                                           name="first_name" 
                                           value="{{ old('first_name', auth()->user()->name) }}" 
                                           required
                                           class="w-full px-3 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                                    @error('first_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-brown-700 mb-1">Last Name</label>
                                    <input type="text" 
                                           id="last_name" 
                                           name="last_name" 
                                           value="{{ old('last_name') }}"
                                           class="w-full px-3 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                                    @error('last_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-brown-700 mb-1">Email Address *</label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', auth()->user()->email) }}" 
                                           required
                                           class="w-full px-3 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-brown-700 mb-1">Phone Number *</label>
                                    <input type="tel" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone') }}" 
                                           required
                                           placeholder="+62 812 3456 7890"
                                           class="w-full px-3 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-brown-700 mb-1">Full Address *</label>
                                    <textarea id="address" 
                                              name="address" 
                                              rows="3" 
                                              required
                                              placeholder="Street address, apartment, suite, etc."
                                              class="w-full px-3 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500">{{ old('address') }}</textarea>
                                    @error('address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="city" class="block text-sm font-medium text-brown-700 mb-1">City *</label>
                                    <input type="text" 
                                           id="city" 
                                           name="city" 
                                           value="{{ old('city') }}" 
                                           required
                                           class="w-full px-3 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                                    @error('city')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="postal_code" class="block text-sm font-medium text-brown-700 mb-1">Postal Code *</label>
                                    <input type="text" 
                                           id="postal_code" 
                                           name="postal_code" 
                                           value="{{ old('postal_code') }}" 
                                           required
                                           placeholder="12345"
                                           class="w-full px-3 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500">
                                    @error('postal_code')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-bold text-brown-800 mb-4">Payment Method</h2>
                            
                            <div class="space-y-4">
                                <div class="border border-brown-200 rounded-lg p-4">
                                    <label class="flex items-center">
                                        <input type="radio" 
                                               name="payment_method" 
                                               value="bank_transfer" 
                                               checked
                                               class="text-brown-600 focus:ring-brown-500">
                                        <div class="ml-3">
                                            <div class="font-medium text-brown-800">Bank Transfer</div>
                                            <div class="text-sm text-gray-600">Transfer ke rekening bank kami</div>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4 opacity-50">
                                    <label class="flex items-center">
                                        <input type="radio" 
                                               name="payment_method" 
                                               value="e_wallet" 
                                               disabled
                                               class="text-brown-600 focus:ring-brown-500">
                                        <div class="ml-3">
                                            <div class="font-medium text-gray-600">E-Wallet</div>
                                            <div class="text-sm text-gray-500">Coming soon</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-bold text-brown-800 mb-4">Order Notes (Optional)</h2>
                            <textarea name="notes" 
                                      rows="3" 
                                      placeholder="Any special instructions for your order..."
                                      class="w-full px-3 py-2 border border-brown-300 rounded-lg focus:ring-2 focus:ring-brown-500 focus:border-brown-500">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                            <h2 class="text-xl font-bold text-brown-800 mb-4">Order Summary</h2>
                            
                            <!-- Cart Items -->
                            <div class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                                @foreach($cartItems as $item)
                                    <div class="flex gap-3">
                                        <div class="w-12 h-12 bg-brown-100 rounded overflow-hidden flex-shrink-0">
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
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-brown-800 truncate">{{ $item->product->name }}</p>
                                            <p class="text-xs text-gray-600">Qty: {{ $item->quantity }}</p>
                                            <p class="text-sm font-semibold text-brown-600">
                                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Totals -->
                            <div class="space-y-2 mb-6 border-t border-gray-200 pt-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                                    <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium text-green-600">Free</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Tax</span>
                                    <span class="font-medium">Rp 0</span>
                                </div>
                                <div class="border-t border-gray-200 pt-2">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-bold text-brown-800">Total</span>
                                        <span class="text-lg font-bold text-brown-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Place Order Button -->
                            <button type="submit" 
                                    class="w-full bg-brown-600 hover:bg-brown-700 text-white py-3 px-6 rounded-lg font-bold text-lg transition-colors">
                                <i class="fas fa-credit-card mr-2"></i>
                                Place Order
                            </button>

                            <!-- Security Notice -->
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="flex items-center text-xs text-gray-600">
                                    <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                    <span>Your personal information is protected by SSL encryption</span>
                                </div>
                            </div>

                            <!-- Terms -->
                            <div class="mt-4">
                                <label class="flex items-start text-xs text-gray-600">
                                    <input type="checkbox" 
                                           name="terms_agreed" 
                                           required
                                           class="mt-0.5 mr-2 text-brown-600 focus:ring-brown-500">
                                    <span>I agree to the <a href="#" class="text-brown-600 hover:text-brown-800 underline">Terms & Conditions</a> and <a href="#" class="text-brown-600 hover:text-brown-800 underline">Privacy Policy</a></span>
                                </label>
                                @error('terms_agreed')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Form validation and submission
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            const requiredFields = ['first_name', 'email', 'phone', 'address', 'city', 'postal_code'];
            let isValid = true;
            
            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });
            
            // Check terms agreement
            const termsCheckbox = document.querySelector('input[name="terms_agreed"]');
            if (!termsCheckbox.checked) {
                isValid = false;
                showFlashMessage('error', 'Please agree to the terms and conditions');
                return;
            }
            
            if (!isValid) {
                showFlashMessage('error', 'Please fill in all required fields');
                return;
            }
            
            // Show loading state
            const submitButton = document.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
            submitButton.disabled = true;
            
            // Submit form
            this.submit();
        });
        
        // Phone number formatting
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('0')) {
                value = '62' + value.substring(1);
            }
            if (!value.startsWith('62')) {
                value = '62' + value;
            }
            
            // Format: +62 812 3456 7890
            if (value.length > 2) {
                value = '+' + value.substring(0, 2) + ' ' + value.substring(2);
            }
            if (value.length > 7) {
                value = value.substring(0, 7) + ' ' + value.substring(7);
            }
            if (value.length > 12) {
                value = value.substring(0, 12) + ' ' + value.substring(12);
            }
            
            e.target.value = value;
        });

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
