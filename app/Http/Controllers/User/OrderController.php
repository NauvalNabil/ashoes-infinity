<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display user's orders
     */
    public function index()
    {
        $orders = Order::with('orderItems.product')
                      ->where('user_id', Auth::id())
                      ->latest()
                      ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    /**
     * Show checkout form
     */
    public function create()
    {
        $carts = Cart::with('product')
                    ->where('user_id', Auth::id())
                    ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                           ->with('error', 'Your cart is empty');
        }

        $total = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });

        return view('user.orders.create', compact('carts', 'total'));
    }

    /**
     * Store order
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'notes' => 'nullable|string'
        ]);

        $carts = Cart::with('product')
                    ->where('user_id', Auth::id())
                    ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                           ->with('error', 'Your cart is empty');
        }

        $total = 0;
        $orderItems = [];

        // Validate stock and calculate total
        foreach ($carts as $cart) {
            if ($cart->product->stock < $cart->quantity) {
                return redirect()->back()
                               ->with('error', "Insufficient stock for {$cart->product->name}");
            }

            $subtotal = $cart->quantity * $cart->product->price;
            $total += $subtotal;

            $orderItems[] = [
                'product_id' => $cart->product_id,
                'product_name' => $cart->product->name,
                'product_price' => $cart->product->price,
                'size' => $cart->size,
                'quantity' => $cart->quantity,
                'subtotal' => $subtotal
            ];
        }

        DB::beginTransaction();
        try {
            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'shipping_address' => [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code
                ],
                'notes' => $request->notes
            ]);

            // Create order items and update stock
            foreach ($orderItems as $item) {
                $orderItem = new OrderItem($item);
                $orderItem->order_id = $order->id;
                $orderItem->save();

                // Update product stock
                $product = Product::find($item['product_id']);
                $product->decrement('stock', $item['quantity']);
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                           ->with('success', 'Order placed successfully! Please proceed with payment.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                           ->with('error', 'Failed to place order. Please try again.');
        }
    }

    /**
     * Show order details
     */
    public function show(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('user.orders.show', compact('order'));
    }

    /**
     * Upload payment proof
     */
    public function uploadPayment(Request $request, Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->payment_status !== 'pending') {
            return redirect()->back()
                           ->with('error', 'Payment has already been processed for this order.');
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            
            $order->update([
                'payment_proof' => $path,
                'payment_status' => 'paid',
                'paid_at' => now()
            ]);

            return redirect()->back()
                           ->with('success', 'Payment proof uploaded successfully. Your order will be processed soon.');
        }

        return redirect()->back()
                       ->with('error', 'Failed to upload payment proof. Please try again.');
    }
}
