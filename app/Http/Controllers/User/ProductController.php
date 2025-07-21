<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products for users
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Filter by brand
        if ($request->has('brand') && $request->brand) {
            $query->where('brand', $request->brand);
        }

        // Price range filter
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

                $products = $query->paginate(12);

        // Get unique categories and brands for filter options
        $categories = Product::where('is_active', true)
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        $brands = Product::where('is_active', true)
            ->distinct()
            ->pluck('brand')
            ->filter()
            ->sort()
            ->values();

        return view('products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Display the specified product
     */
    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

                // Get related products from the same category
        $relatedProducts = Product::where('is_active', true)
                                ->where('category', $product->category)
                                ->where('id', '!=', $product->id)
                                ->limit(4)
                                ->get();

        return view('products.details', compact('product', 'relatedProducts'));
    }

    /**
     * Get product details for AJAX (for popup)
     */
    public function getDetails(Product $product)
    {
        if (!$product->is_active) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'formatted_price' => 'Rp ' . number_format($product->price, 0, ',', '.'),
            'stock' => $product->stock,
            'category' => $product->category,
            'brand' => $product->brand,
            'color' => $product->color,
            'sizes' => $product->sizes,
            'image' => $product->image ? asset('storage/' . $product->image) : null,
            'gallery' => $product->gallery ? array_map(function($img) {
                return asset('storage/' . $img);
            }, $product->gallery) : []
        ]);
    }
}
