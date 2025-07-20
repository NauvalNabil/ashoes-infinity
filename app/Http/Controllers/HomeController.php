<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\HeroContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil hero content yang aktif untuk landing page
        $heroContents = HeroContent::active()->ordered()->get();

        // Ambil produk terbaru yang aktif dengan kategori untuk Latest Products section
        $latestProducts = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(10) // Tampilkan 10 produk terbaru
            ->get();

        // Ambil semua kategori aktif
        $categories = Category::active()->ordered()->get();

        // Produk featured (contoh: produk dengan stock tinggi atau rating tinggi)
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('stock', '>', 20) // Produk dengan stock banyak sebagai featured
            ->take(8)
            ->get();

        // Statistik untuk homepage
        $totalProducts = Product::where('is_active', true)->count();
        $totalCategories = Category::where('is_active', true)->count();

        return view('pages.dashboard.app', compact(
            'heroContents',
            'latestProducts',
            'featuredProducts',
            'categories',
            'totalProducts',
            'totalCategories'
        ));
    }
}
