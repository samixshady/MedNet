<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
        
        $savedAddresses = auth()->user()->addresses()->get();

        return view('cart.index', compact('cartItems', 'savedAddresses'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:50',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Check if product already in cart
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $validated['quantity'];
            if ($newQuantity > 50) {
                return response()->json([
                    'success' => false,
                    'message' => "You can add only 50 items of {$product->name}",
                ], 422);
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        $cartCount = Cart::where('user_id', auth()->id())->count();

        return response()->json([
            'success' => true,
            'message' => "{$product->name} has been added to the cart",
            'cartCount' => $cartCount,
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function updateQuantity(Request $request, $cartItemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:50',
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
            ->findOrFail($cartItemId);

        $cartItem->update(['quantity' => $validated['quantity']]);

        // Calculate total subtotal of all items in cart
        $cartSubtotal = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get()
            ->sum(fn($item) => ($item->product->updated_price ?? $item->product->price) * $item->quantity);

        return response()->json([
            'success' => true,
            'subtotal' => $cartSubtotal,
            'total' => $this->getCartTotal(),
        ]);
    }

    /**
     * Upload prescription
     */
    public function uploadPrescription(Request $request, $cartItemId)
    {
        $validated = $request->validate([
            'prescription' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
            ->findOrFail($cartItemId);

        if ($request->hasFile('prescription')) {
            // Delete old prescription if exists
            if ($cartItem->prescription_file_path) {
                \Storage::disk('public')->delete($cartItem->prescription_file_path);
            }

            $file = $request->file('prescription');
            $filePath = $file->store('prescriptions', 'public');
            $cartItem->update(['prescription_file_path' => $filePath]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Prescription uploaded successfully',
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove($cartItemId)
    {
        $cartItem = Cart::where('user_id', auth()->id())
            ->findOrFail($cartItemId);

        $productName = $cartItem->product->name;
        $cartItem->delete();

        $cartCount = Cart::where('user_id', auth()->id())->count();

        return response()->json([
            'success' => true,
            'message' => "{$productName} has been removed from the cart",
            'cartCount' => $cartCount,
            'total' => $this->getCartTotal(),
        ]);
    }

    /**
     * Get cart count
     */
    public function count()
    {
        $count = Cart::where('user_id', auth()->id())->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Get cart total
     */
    private function getCartTotal()
    {
        $items = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = 0;

        foreach ($items as $item) {
            $price = $item->product->updated_price ?? $item->product->price;
            $total += $price * $item->quantity;
        }

        return $total;
    }

    /**
     * Checkout
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:500',
            'comments' => 'nullable|string|max:500',
            'delivery_option' => 'required|string|in:standard,express,overnight',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty',
            ], 422);
        }

        // Check if all prescription required items have prescriptions
        foreach ($cartItems as $item) {
            if ($item->product->prescription_required && !$item->prescription_file) {
                return response()->json([
                    'success' => false,
                    'message' => "{$item->product->name} requires a prescription. Please upload it.",
                ], 422);
            }
        }

        // TODO: Create order in database
        // For now, clear cart
        Cart::where('user_id', auth()->id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully! Redirecting...',
            'redirect' => route('dashboard'),
        ]);
    }
}
