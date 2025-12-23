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
        
        // Get delivery address from request or use default
        // The address is passed from cart or stored in session
        $deliveryAddress = request('address', session('delivery_location', 'Not selected'));
        
        // Get user's saved addresses
        $savedAddresses = $user->addresses()->get();

        return view('checkout.summary', compact('cartItems', 'total', 'deliveryAddress', 'savedAddresses'));
    }

    /**
     * Process payment and create order
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method_field' => 'required|in:card,paypal',
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

            // Generate random tracking number
            $trackingNumber = 'MN' . strtoupper(bin2hex(random_bytes(4))) . '-' . strtoupper(substr($user->name, 0, 3));

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'tracking_number' => $trackingNumber,
                'total_amount' => $totalAmount,
                'delivery_address' => $request->delivery_address,
                'delivery_latitude' => session('delivery_coords.lat'),
                'delivery_longitude' => session('delivery_coords.lng'),
                'payment_method' => $request->payment_method_field,
                'payment_status' => 'completed',
                'order_status' => 'pending',
            ]);

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

    /**
     * Reduce order item quantity (for test site)
     */
    public function reduceQuantity(OrderItem $orderItem)
    {
        // Check authorization
        if ($orderItem->order->user_id !== auth()->id()) {
            abort(403);
        }

        // Get the product
        $product = Product::find($orderItem->product_id);
        
        // Add back the quantity to product (restore stock)
        $product->increment('quantity', $orderItem->quantity);
        
        // Delete the order item
        $orderItem->delete();
        
        // Recalculate order total
        $order = $orderItem->order;
        $newSubtotal = $order->items->sum('subtotal');
        $order->update(['total_amount' => $newSubtotal]);

        return redirect()->route('profile.orders')->with('success', 'Order item removed and quantity restored');
    }}