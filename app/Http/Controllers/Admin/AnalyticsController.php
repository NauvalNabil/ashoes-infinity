<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\HeroContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        $stats = $this->getOverviewStats();
        $chartData = $this->getChartData();

        return view('admin.analytics.index', compact('stats', 'chartData'));
    }

    public function getOverviewStats()
    {
        $today = Carbon::today();
        $lastMonth = Carbon::now()->subMonth();
        $lastWeek = Carbon::now()->subWeek();

        return [
            'total_users' => User::count(),
            'new_users_today' => User::whereDate('created_at', $today)->count(),
            'new_users_this_week' => User::where('created_at', '>=', $lastWeek)->count(),
            'new_users_this_month' => User::where('created_at', '>=', $lastMonth)->count(),

            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'low_stock_products' => Product::where('stock', '<=', 10)->where('stock', '>', 0)->count(),
            'out_of_stock_products' => Product::where('stock', 0)->count(),

            'total_categories' => Category::count(),
            'active_categories' => Category::where('is_active', true)->count(),

            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'delivered')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),

            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'revenue_this_month' => Order::where('payment_status', 'paid')
                ->where('created_at', '>=', $lastMonth)
                ->sum('total_amount'),

            'active_hero_contents' => HeroContent::where('is_active', true)->count(),
        ];
    }

    public function getChartData()
    {
        return [
            'user_registrations' => $this->getUserRegistrationData(),
            'order_trends' => $this->getOrderTrendsData(),
            'revenue_chart' => $this->getRevenueData(),
            'product_categories' => $this->getProductCategoryData(),
            'order_status_distribution' => $this->getOrderStatusData(),
        ];
    }

    private function getUserRegistrationData()
    {
        $last30Days = collect();
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            $last30Days->push([
                'date' => $date->format('M d'),
                'count' => $count
            ]);
        }
        return $last30Days;
    }

    private function getOrderTrendsData()
    {
        $last30Days = collect();
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Order::whereDate('created_at', $date)->count();
            $last30Days->push([
                'date' => $date->format('M d'),
                'count' => $count
            ]);
        }
        return $last30Days;
    }

    private function getRevenueData()
    {
        $last12Months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $revenue = Order::where('payment_status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_amount');
            $last12Months->push([
                'month' => $date->format('M Y'),
                'revenue' => $revenue
            ]);
        }
        return $last12Months;
    }

    private function getProductCategoryData()
    {
        return Category::withCount('products')
            ->where('is_active', true)
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->getAttribute('name'),
                    'count' => $category->getAttribute('products_count')
                ];
            });
    }

    private function getOrderStatusData()
    {
        return Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->map(function ($item) {
                return [
                    'status' => ucfirst($item->status),
                    'count' => $item->count
                ];
            });
    }

    public function exportReport(Request $request)
    {
        $type = $request->input('type', 'overview');
        $format = $request->input('format', 'json');

        $data = match($type) {
            'users' => $this->getUsersReport(),
            'products' => $this->getProductsReport(),
            'orders' => $this->getOrdersReport(),
            'revenue' => $this->getRevenueReport(),
            default => $this->getOverviewStats()
        };

        if ($format === 'csv') {
            return $this->exportToCsv($data, $type);
        }

        return response()->json($data);
    }

    private function getUsersReport()
    {
        return User::select([
            'id', 'name', 'email', 'role', 'is_active',
            'email_verified_at', 'created_at'
        ])
        ->withCount('orders')
        ->get();
    }

    private function getProductsReport()
    {
        return Product::with('category')
            ->select([
                'id', 'name', 'category_id', 'price', 'stock',
                'is_active', 'created_at'
            ])
            ->get();
    }

    private function getOrdersReport()
    {
        return Order::with(['user:id,name,email', 'orderItems.product:id,name'])
            ->select([
                'id', 'user_id', 'order_number', 'status', 'payment_status',
                'total_amount', 'created_at'
            ])
            ->get();
    }

    private function getRevenueReport()
    {
        return Order::where('payment_status', 'paid')
            ->select([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('SUM(total_amount) as total_revenue'),
                DB::raw('AVG(total_amount) as average_order_value')
            ])
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(90)
            ->get();
    }

    private function exportToCsv($data, $type)
    {
        $filename = "{$type}_report_" . now()->format('Y-m-d') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');

            if (is_array($data) && count($data) > 0) {
                // Write headers
                fputcsv($file, array_keys((array) $data[0]));

                // Write data
                foreach ($data as $row) {
                    fputcsv($file, (array) $row);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
