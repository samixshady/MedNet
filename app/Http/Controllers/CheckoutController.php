<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show checkout summary page
     */
    public function index()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(fn($item) => $item->subtotal);
        
        // Get delivery address from localStorage or session
        $deliveryAddress = session('delivery_location', 'Not selected');
        $deliveryCoords = session('delivery_coords', ['lat' => null, 'lng' => null]);
        
        // Delivery pricing
        $deliveryPricing = [
            'inside_dhaka' => ['standard' => 40, 'express' => 80, 'overnight' => 100],
            'outside_dhaka' => ['standard' => 70, 'express' => 110, 'overnight' => 130]
        ];

        return view('checkout.summary', compact('cartItems', 'total', 'deliveryAddress', 'deliveryCoords', 'deliveryPricing'));
    }

    /**
     * Show payment method selection page
     */
    public function payment(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string',
            'delivery_location' => 'required|in:inside_dhaka,outside_dhaka',
            'delivery_method' => 'required|in:standard,express,overnight',
            'delivery_fee' => 'required|numeric|min:0',
        ]);

        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->subtotal);
        $deliveryFee = $request->delivery_fee;
        $total = $subtotal + $deliveryFee;
        $deliveryAddress = $request->delivery_address;
        $deliveryLocation = $request->delivery_location;
        $deliveryMethod = $request->delivery_method;
        $deliveryCoords = session('delivery_coords', ['lat' => null, 'lng' => null]);

        return view('checkout.payment', compact('cartItems', 'subtotal', 'deliveryFee', 'total', 'deliveryAddress', 'deliveryCoords', 'deliveryLocation', 'deliveryMethod'));
    }

    /**
     * Process payment and create order
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:visa,paypal',
            'delivery_address' => 'required|string',
            'delivery_fee' => 'required|numeric|min:0',
        ]);

        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty');
        }

        try {
            DB::beginTransaction();

            // Calculate total with delivery fee
            $subtotal = $cartItems->sum(fn($item) => $item->subtotal);
            $deliveryFee = $request->delivery_fee;
            $totalAmount = $subtotal + $deliveryFee;

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'delivery_address' => $request->delivery_address,
                'delivery_latitude' => session('delivery_coords.lat'),
                'delivery_longitude' => session('delivery_coords.lng'),
                'payment_method' => $request->payment_method,
                'payment_status' => 'completed',
                'order_status' => 'pending',
            ]);

            // Generate tracking number
            $trackingNumber = $order->generateTrackingNumber();
            $order->update(['tracking_number' => $trackingNumber]);

            // Create order items and update product quantities
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->updated_price ?? $item->product->price,
                    'subtotal' => $item->subtotal,
                ]);

                // Decrease product quantity
                $product = Product::find($item->product_id);
                $product->decrement('quantity', $item->quantity);
            }

            // Clear cart
            Cart::where('user_id', $user->id)->delete();

            // Clear delivery location session
            session()->forget(['delivery_location', 'delivery_coords']);

            DB::commit();

            return redirect()->route('checkout.confirmation', ['order' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment processing failed: ' . $e->getMessage());
        }
    }

    /**
     * Show order confirmation page
     */
    public function confirmation(Order $order)
    {
        // Ensure user can only see their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('checkout.confirmation', compact('order'));
    }

    /**
     * Show order details page
     */
    public function orderDetails(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product', 'user');

        return view('checkout.order-details', compact('order'));
    }
}
