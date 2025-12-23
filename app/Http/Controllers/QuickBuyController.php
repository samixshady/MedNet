<?php

namespace App\Http\Controllers;

use App\Models\QuickBuy;
use App\Models\Product;
use Illuminate\Http\Request;

class QuickBuyController extends Controller
{
    /**
     * Show the QuickBuy management page
     */
    public function manage()
    {
        $quickBuys = QuickBuy::where('user_id', auth()->id())
            ->with('product')
            ->get();

        return view('quick-buy.manage', compact('quickBuys'));
    }

    /**
     * Add product to quick buy list
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:50',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $quantity = $validated['quantity'] ?? 1;
        $user = auth()->user();

        // Check if already in quick buy
        $exists = QuickBuy::where('user_id', auth()->id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($exists) {
            // Update quantity if already exists
            $newQuantity = $exists->quantity + $quantity;
            if ($newQuantity > 50) {
                return response()->json([
                    'success' => false,
                    'message' => "Maximum quantity for {$product->name} in QuickBuy is 50",
                ], 422);
            }
            $exists->update([
                'quantity' => $newQuantity,
                'user_name' => $user->name,
                'user_email' => $user->email,
            ]);
        } else {
            QuickBuy::create([
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
                'quantity' => $quantity,
                'user_name' => $user->name,
                'user_email' => $user->email,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "{$product->name} added to QuickBuy list",
        ]);
    }

    /**
     * Remove product from quick buy list
     */
    public function remove(Request $request, $quickBuyId)
    {
        $quickBuy = QuickBuy::where('user_id', auth()->id())
            ->findOrFail($quickBuyId);

        $productName = $quickBuy->product->name;
        $quickBuy->delete();

        return response()->json([
            'success' => true,
            'message' => "{$productName} removed from QuickBuy list",
        ]);
    }

    /**
     * Update quantity of quick buy item
     */
    public function updateQuantity(Request $request, $quickBuyId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:50',
        ]);

        $quickBuy = QuickBuy::where('user_id', auth()->id())
            ->findOrFail($quickBuyId);

        $quickBuy->update([
            'quantity' => $validated['quantity'],
            'user_name' => auth()->user()->name,
            'user_email' => auth()->user()->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated',
            'quantity' => $quickBuy->quantity,
        ]);
    }

    /**
     * Get quick buy items with product details
     */
    public function getItems()
    {
        $items = QuickBuy::where('user_id', auth()->id())
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product->id,
                    'name' => $item->product->name,
                    'generic_name' => $item->product->generic_name,
                    'dosage' => $item->product->dosage,
                    'type' => ucfirst(str_replace('_', ' ', $item->product->tag)),
                    'price' => (float) ($item->product->updated_price ?? $item->product->price ?? 0),
                    'image_path' => $item->product->image_path,
                    'tag' => $item->product->tag,
                    'quantity' => $item->quantity,
                    'user_name' => $item->user_name,
                    'user_email' => $item->user_email,
                ];
            });

        return response()->json($items);
    }
}
