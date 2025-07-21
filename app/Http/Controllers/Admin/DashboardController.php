<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        // Basic statistics
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalOrders = Order::count();
        $totalUsers = User::where('role', 'user')->count();
        
        // Revenue statistics
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $monthlyRevenue = Order::where('payment_status', 'paid')
                              ->whereMonth('created_at', Carbon::now()->month)
                              ->whereYear('created_at', Carbon::now()->year)
                              ->sum('total_amount');
        
        // Recent orders
        $recentOrders = Order::with(['user', 'orderItems'])
                            ->latest()
                            ->limit(10)
                            ->get();
        
        // Low stock products
        $lowStockProducts = Product::where('stock', '<=', 10)
                                  ->where('is_active', true)
                                  ->orderBy('stock', 'asc')
                                  ->limit(10)
                                  ->get();
        
        // Order status counts
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        
        // Monthly sales data for chart (last 6 months)
        $monthlySales = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $sales = Order::where('payment_status', 'paid')
                         ->whereMonth('created_at', $date->month)
                         ->whereYear('created_at', $date->year)
                         ->sum('total_amount');
            
            $monthlySales[] = [
                'month' => $date->format('M Y'),
                'sales' => $sales
            ];
        }
        
        // Top selling products
        $topProducts = Product::withCount(['orderItems as total_sold' => function ($query) {
                                $query->join('orders', 'orders.id', '=', 'order_items.order_id')
                                      ->where('orders.payment_status', 'paid');
                              }])
                             ->orderBy('total_sold', 'desc')
                             ->limit(5)
                             ->get();

        // Recent products for admin dashboard
        $recentProducts = Product::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'monthlyRevenue',
            'recentOrders',
            'recentProducts',
            'lowStockProducts',
            'pendingOrders',
            'processingOrders',
            'shippedOrders',
            'deliveredOrders',
            'monthlySales',
            'topProducts'
        ));
    }
}
