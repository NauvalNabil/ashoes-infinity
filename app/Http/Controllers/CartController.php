<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CartController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $cartItems = Cart::with('product.category')
            ->forUser(Auth::id())
            ->get();

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->getAttribute('quantity') * $item->product->getAttribute('price');
        });

        return view('cart.index', compact('cartItems', 'totalAmount'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $product = Product::findOrFail($request->input('product_id'));

        // Check if product is active
        if (!$product->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'This product is not available.'
            ], 400);
        }

        // Check stock availability
        if ($product->stock < $request->input('quantity')) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock available. Only ' . $product->stock . ' items left.'
            ], 400);
        }

        // Check if item already exists in cart
        $cartItem = Cart::forUser(Auth::id())
            ->where('product_id', $request->input('product_id'))
            ->first();

        if ($cartItem) {
            // Update quantity if item exists
            $newQuantity = $cartItem->quantity + $request->input('quantity');

            if ($product->stock < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more items. Only ' . $product->stock . ' items available.'
                ], 400);
            }

            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity')
            ]);
        }

        $cartCount = Cart::forUser(Auth::id())->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => $cartCount
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
            'size' => 'nullable|string',
            'color' => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->input('product_id'));

        // Check stock availability
        if ($product->getAttribute('stock') < $request->input('quantity')) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock available.'
            ], 400);
        }

        // Check if item already exists in cart
        $cartItem = Cart::forUser(Auth::id())
            ->where('product_id', $request->input('product_id'))
            ->where('size', $request->input('size'))
            ->where('color', $request->input('color'))
            ->first();

        if ($cartItem) {
            // Update quantity if item exists
            $newQuantity = $cartItem->getAttribute('quantity') + $request->input('quantity');

            if ($product->getAttribute('stock') < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more items. Insufficient stock.'
                ], 400);
            }

            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity'),
                'size' => $request->input('size'),
                'color' => $request->input('color')
            ]);
        }

        $cartCount = Cart::forUser(Auth::id())->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cart_count' => $cartCount
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        // Simple check instead of authorize for now
        if ($cart->getAttribute('user_id') !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        if ($cart->product->getAttribute('stock') < $request->input('quantity')) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock available.'
            ], 400);
        }

        $cart->update(['quantity' => $request->input('quantity')]);

        $cartItems = Cart::with('product')->forUser(Auth::id())->get();
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->getAttribute('quantity') * $item->product->getAttribute('price');
        });

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully.',
            'total_amount' => number_format($totalAmount, 2),
            'item_total' => number_format($cart->getAttribute('quantity') * $cart->product->getAttribute('price'), 2)
        ]);
    }

    public function destroy(Cart $cart)
    {
        // Simple check instead of authorize for now
        if ($cart->getAttribute('user_id') !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        $cartCount = Cart::forUser(Auth::id())->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart.',
            'cart_count' => $cartCount
        ]);
    }

    public function clear()
    {
        Cart::forUser(Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully.',
            'cart_count' => 0
        ]);
    }

    public function count()
    {
        $count = Cart::forUser(Auth::id())->sum('quantity');

        return response()->json([
            'count' => $count
        ]);
    }
}
