@extends('admin.layouts.app')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Analytics Dashboard</h1>
        <div class="flex space-x-2">
            <button onclick="exportReport('overview', 'json')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                Export JSON
            </button>
            <button onclick="exportReport('overview', 'csv')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                Export CSV
            </button>
        </div>
    </div>
</div>

<!-- Overview Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Users Stats -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1.392a3 3 0 100-4.243a3 3 0 000 4.243z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_users']) }}</p>
                <p class="text-xs text-green-600 dark:text-green-400">+{{ $stats['new_users_today'] }} today</p>
            </div>
        </div>
    </div>

    <!-- Products Stats -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Products</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_products']) }}</p>
                <p class="text-xs text-orange-600 dark:text-orange-400">{{ $stats['low_stock_products'] }} low stock</p>
            </div>
        </div>
    </div>

    <!-- Orders Stats -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Orders</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_orders']) }}</p>
                <p class="text-xs text-yellow-600 dark:text-yellow-400">{{ $stats['pending_orders'] }} pending</p>
            </div>
        </div>
    </div>

    <!-- Revenue Stats -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-pink-100 dark:bg-pink-900">
                <svg class="w-6 h-6 text-pink-600 dark:text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Revenue</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">${{ number_format($stats['total_revenue'], 2) }}</p>
                <p class="text-xs text-green-600 dark:text-green-400">${{ number_format($stats['revenue_this_month'], 2) }} this month</p>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- User Growth -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">User Growth</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">New today</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $stats['new_users_today'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">This week</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $stats['new_users_this_week'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">This month</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $stats['new_users_this_month'] }}</span>
            </div>
        </div>
    </div>

    <!-- Inventory Status -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Inventory Status</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Active Products</span>
                <span class="font-medium text-green-600 dark:text-green-400">{{ $stats['active_products'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Low Stock</span>
                <span class="font-medium text-orange-600 dark:text-orange-400">{{ $stats['low_stock_products'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Out of Stock</span>
                <span class="font-medium text-red-600 dark:text-red-400">{{ $stats['out_of_stock_products'] }}</span>
            </div>
        </div>
    </div>

    <!-- Order Status -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Status</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Completed</span>
                <span class="font-medium text-green-600 dark:text-green-400">{{ $stats['completed_orders'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Pending</span>
                <span class="font-medium text-yellow-600 dark:text-yellow-400">{{ $stats['pending_orders'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Cancelled</span>
                <span class="font-medium text-red-600 dark:text-red-400">{{ $stats['cancelled_orders'] }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- User Registrations Chart -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">User Registrations (Last 30 Days)</h3>
        <canvas id="userRegistrationsChart" height="200"></canvas>
    </div>

    <!-- Revenue Chart -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Revenue Trend (Last 12 Months)</h3>
        <canvas id="revenueChart" height="200"></canvas>
    </div>

    <!-- Product Categories -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Products by Category</h3>
        <canvas id="categoryChart" height="200"></canvas>
    </div>

    <!-- Order Status Distribution -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Status Distribution</h3>
        <canvas id="orderStatusChart" height="200"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Chart configurations
const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            labels: {
                color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#374151'
            }
        }
    },
    scales: {
        x: {
            ticks: {
                color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'
            },
            grid: {
                color: document.documentElement.classList.contains('dark') ? '#374151' : '#E5E7EB'
            }
        },
        y: {
            ticks: {
                color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'
            },
            grid: {
                color: document.documentElement.classList.contains('dark') ? '#374151' : '#E5E7EB'
            }
        }
    }
};

// User Registrations Chart
const userRegCtx = document.getElementById('userRegistrationsChart').getContext('2d');
new Chart(userRegCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartData['user_registrations']->pluck('date')) !!},
        datasets: [{
            label: 'New Users',
            data: {!! json_encode($chartData['user_registrations']->pluck('count')) !!},
            borderColor: '#3B82F6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: chartOptions
});

// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartData['revenue_chart']->pluck('month')) !!},
        datasets: [{
            label: 'Revenue ($)',
            data: {!! json_encode($chartData['revenue_chart']->pluck('revenue')) !!},
            backgroundColor: '#10B981',
            borderColor: '#059669',
            borderWidth: 1
        }]
    },
    options: chartOptions
});

// Category Chart
const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($chartData['product_categories']->pluck('name')) !!},
        datasets: [{
            data: {!! json_encode($chartData['product_categories']->pluck('count')) !!},
            backgroundColor: [
                '#EF4444', '#F59E0B', '#10B981', '#3B82F6',
                '#8B5CF6', '#F97316', '#06B6D4', '#84CC16'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#374151'
                }
            }
        }
    }
});

// Order Status Chart
const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
new Chart(orderStatusCtx, {
    type: 'pie',
    data: {
        labels: {!! json_encode($chartData['order_status_distribution']->pluck('status')) !!},
        datasets: [{
            data: {!! json_encode($chartData['order_status_distribution']->pluck('count')) !!},
            backgroundColor: ['#10B981', '#F59E0B', '#EF4444', '#6B7280', '#8B5CF6']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#374151'
                }
            }
        }
    }
});

// Export functions
function exportReport(type, format) {
    const url = `{{ route('admin.analytics.export') }}?type=${type}&format=${format}`;

    if (format === 'csv') {
        window.open(url, '_blank');
    } else {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = `${type}_report_${new Date().toISOString().split('T')[0]}.json`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                console.error('Export failed:', error);
                alert('Export failed. Please try again.');
            });
    }
}
</script>
@endsection
