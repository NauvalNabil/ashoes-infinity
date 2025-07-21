<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart
     */
    public function index()
    {
        $carts = Cart::with('product')
                    ->where('user_id', Auth::id())
                    ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });

        return view('user.cart.index', compact('carts', 'total'));
    }

    /**
     * Add product to cart
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if product is active and has stock
        if (!$product->is_active) {
            return response()->json(['error' => 'Product is not available'], 400);
        }

        if ($product->stock < $request->quantity) {
            return response()->json(['error' => 'Insufficient stock'], 400);
        }

        // Check if size is available
        if (!in_array($request->size, $product->sizes ?? [])) {
            return response()->json(['error' => 'Size not available'], 400);
        }

        // Check if item already exists in cart
        $existingCart = Cart::where([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'size' => $request->size
        ])->first();

        if ($existingCart) {
            $newQuantity = $existingCart->quantity + $request->quantity;
            
            if ($newQuantity > $product->stock) {
                return response()->json(['error' => 'Total quantity exceeds available stock'], 400);
            }

            $existingCart->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'size' => $request->size,
                'quantity' => $request->quantity
            ]);
        }

        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');

        return response()->json([
            'success' => 'Product added to cart successfully',
            'cart_count' => $cartCount
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, Cart $cart)
    {
        // Ensure user owns this cart item
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($request->quantity > $cart->product->stock) {
            return response()->json(['error' => 'Quantity exceeds available stock'], 400);
        }

        $cart->update(['quantity' => $request->quantity]);

        $subtotal = $cart->quantity * $cart->product->price;
        $total = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->get()
                    ->sum(function ($item) {
                        return $item->quantity * $item->product->price;
                    });

        return response()->json([
            'success' => 'Cart updated successfully',
            'subtotal' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
            'total' => 'Rp ' . number_format($total, 0, ',', '.')
        ]);
    }

    /**
     * Remove item from cart
     */
    public function destroy(Cart $cart)
    {
        // Ensure user owns this cart item
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        $total = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->get()
                    ->sum(function ($item) {
                        return $item->quantity * $item->product->price;
                    });

        return response()->json([
            'success' => 'Item removed from cart',
            'cart_count' => $cartCount,
            'total' => 'Rp ' . number_format($total, 0, ',', '.')
        ]);
    }

    /**
     * Get cart count for navbar
     */
    public function getCartCount()
    {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['count' => $count]);
    }

    /**
     * Clear all cart items
     */
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        
        return redirect()->route('user.cart.index')
                        ->with('success', 'Cart cleared successfully');
    }
}
