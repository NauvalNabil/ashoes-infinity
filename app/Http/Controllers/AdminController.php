<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalUsers = User::count();
        $lowStockProducts = Product::where('stock', '<=', 10)->count();

        $recentProducts = Product::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts', 
            'totalUsers',
            'lowStockProducts',
            'recentProducts'
        ));
    }
}
