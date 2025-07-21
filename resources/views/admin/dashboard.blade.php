@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="bg-brown-50 min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-brown-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-brown-800">Admin Dashboard</h1>
                        <p class="text-brown-600 mt-1">Welcome back, {{ auth()->user()->name }}!</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">{{ date('l, F j, Y') }}</p>
                        <p class="text-sm text-gray-600 clock">{{ date('g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Products -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-brown-100">
                            <i class="fas fa-shoe-prints text-2xl text-brown-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Products</p>
                            <p class="text-2xl font-bold text-brown-800">{{ $totalProducts }}</p>
                            <p class="text-xs text-green-600">{{ $activeProducts }} active</p>
                        </div>
                    </div>
                </div>

                <!-- Total Orders -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <i class="fas fa-shopping-bag text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Orders</p>
                            <p class="text-2xl font-bold text-brown-800">{{ $totalOrders }}</p>
                            <p class="text-xs text-yellow-600">{{ $pendingOrders }} pending</p>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <i class="fas fa-money-bill-wave text-2xl text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                            <p class="text-2xl font-bold text-brown-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                            <p class="text-xs text-blue-600">Monthly: Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <i class="fas fa-users text-2xl text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Users</p>
                            <p class="text-2xl font-bold text-brown-800">{{ $totalUsers }}</p>
                            <p class="text-xs text-gray-600">Registered customers</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Status Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="lg:col-span-2">
                    <!-- Recent Orders -->
                    <div class="bg-white rounded-lg shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-bold text-brown-800">Recent Orders</h2>
                                <a href="{{ route('admin.orders.index') }}" class="text-brown-600 hover:text-brown-800 text-sm font-medium">
                                    View All <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            @if (isset($recentOrders) && $recentOrders->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($recentOrders as $order)
                                        <div class="flex items-center justify-between p-4 bg-brown-50 rounded-lg">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-10 h-10 bg-brown-200 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-receipt text-brown-600"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-brown-800">#{{ $order->order_number }}</p>
                                                    <p class="text-sm text-gray-600">{{ $order->user->name }}</p>
                                                    <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-brown-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                                    @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-600">No recent orders</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Order Status Summary -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-bold text-brown-800 mb-4">Order Status</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                                    <span class="text-sm text-gray-700">Pending</span>
                                </div>
                                <span class="text-sm font-semibold text-brown-800">{{ $pendingOrders ?? 0 }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                    <span class="text-sm text-gray-700">Processing</span>
                                </div>
                                <span class="text-sm font-semibold text-brown-800">{{ $processingOrders ?? 0 }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                                    <span class="text-sm text-gray-700">Shipped</span>
                                </div>
                                <span class="text-sm font-semibold text-brown-800">{{ $shippedOrders ?? 0 }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                    <span class="text-sm text-gray-700">Delivered</span>
                                </div>
                                <span class="text-sm font-semibold text-brown-800">{{ $deliveredOrders ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-bold text-brown-800 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.products.create') }}" class="block w-full bg-brown-600 hover:bg-brown-700 text-white py-2 px-4 rounded-lg text-center font-medium transition-colors">
                                <i class="fas fa-plus mr-2"></i>
                                Add New Product
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-center font-medium transition-colors">
                                <i class="fas fa-list mr-2"></i>
                                Manage Orders
                            </a>
                            <a href="{{ route('admin.products.index') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg text-center font-medium transition-colors">
                                <i class="fas fa-shoe-prints mr-2"></i>
                                Manage Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Low Stock Alert & Analytics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Low Stock Products -->
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-brown-800">Low Stock Alert</h2>
                        <p class="text-sm text-gray-600">Products with 10 or fewer items in stock</p>
                    </div>
                    <div class="p-6">
                        @if (isset($lowStockProducts) && $lowStockProducts->count() > 0)
                            <div class="space-y-4">
                                @foreach ($lowStockProducts as $product)
                                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-200">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-brown-100 rounded overflow-hidden">
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <i class="fas fa-shoe-prints text-brown-400 text-xs"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-medium text-brown-800 text-sm">{{ $product->name }}</p>
                                                <p class="text-xs text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                                {{ $product->stock }} left
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-check-circle text-4xl text-green-300 mb-4"></i>
                                <p class="text-gray-600">All products are well stocked!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Revenue Analytics -->
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-brown-800">Revenue Analytics</h2>
                        <p class="text-sm text-gray-600">Monthly performance overview</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <!-- This Month vs Last Month -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center p-4 bg-brown-50 rounded-lg">
                                    <p class="text-sm text-gray-600">This Month</p>
                                    <p class="text-xl font-bold text-brown-800">Rp {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-600">Total Revenue</p>
                                    <p class="text-xl font-bold text-brown-800">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Revenue Sources -->
                            <div>
                                <h4 class="font-semibold text-brown-800 mb-3">Payment Methods</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700">Bank Transfer</span>
                                        <span class="text-sm font-semibold text-brown-800">100%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-brown-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Top Selling Category -->
                            <div>
                                <h4 class="font-semibold text-brown-800 mb-3">Performance</h4>
                                <div class="grid grid-cols-2 gap-4 text-center">
                                    <div>
                                        <p class="text-2xl font-bold text-green-600">{{ $deliveredOrders ?? 0 }}</p>
                                        <p class="text-xs text-gray-600">Completed Orders</p>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-blue-600">{{ number_format((($deliveredOrders ?? 0) / max(($totalOrders ?? 1), 1)) * 100, 1) }}%</p>
                                        <p class="text-xs text-gray-600">Success Rate</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Real-time clock
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });

            const clockElements = document.querySelectorAll('.clock');
            clockElements.forEach(el => {
                if (el.textContent !== timeString) {
                    el.textContent = timeString;
                }
            });
        }

        // Update clock every second
        setInterval(updateClock, 1000);
        updateClock(); // Initial call
    </script>
@endpush
