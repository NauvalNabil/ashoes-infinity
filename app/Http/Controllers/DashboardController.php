<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\HeroContent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil hero content yang aktif
        $heroContents = HeroContent::active()->ordered()->get();

        // Ambil produk terbaru yang aktif dengan kategori
        $latestProducts = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        // Ambil produk dengan stok terbatas (urgent)
        $limitedStockProducts = Product::with('category')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->where('stock', '<=', 10)
            ->take(4)
            ->get();

        // Statistik untuk dashboard
        $totalProducts = Product::where('is_active', true)->count();
        $totalCategories = Category::where('is_active', true)->count();

        // Kategori aktif
        $categories = Category::active()->ordered()->pluck('name');

        return view('dashboard', compact(
            'heroContents',
            'latestProducts',
            'limitedStockProducts',
            'totalProducts',
            'totalCategories',
            'categories'
        ));
    }
}
