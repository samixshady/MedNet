<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopProductController extends Controller
{
    public function index()
    {
        $pharmacy = Auth::guard('pharmacy')->user();
        $products = Product::where('pharmacy_id', $pharmacy->id)->orderBy('created_at', 'desc')->get();
        return view('shop.products.index', compact('products'));
    }

    public function create()
    {
        return view('shop.products.create');
    }

    public function store(Request $request)
    {
        $pharmacy = Auth::guard('pharmacy')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'generic_name' => 'nullable|string|max:255',
            'batch_number' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:medicine,supplement,first_aid',            'manufacturer' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'expiry_date' => 'required|date|after:today',
            'requires_prescription' => 'required|boolean',            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $updatedPrice = $request->price;
        if ($request->discount) {
            $updatedPrice = $request->price - ($request->price * ($request->discount / 100));
        }

        // Determine stock status
        $quantity = $request->stock;
        $lowStockThreshold = $request->low_stock_threshold ?? 10;
        
        if ($quantity == 0) {
            $stockStatus = 'out_of_stock';
        } elseif ($quantity <= $lowStockThreshold) {
            $stockStatus = 'low_stock';
        } else {
            $stockStatus = 'normal';
        }

        Product::create([
            'pharmacy_id' => $pharmacy->id,
            'name' => $request->name,
            'generic_name' => $request->generic_name,
            'batch_number' => $request->batch_number,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'updated_price' => $updatedPrice,
            'quantity' => $quantity,
            'category' => $request->category,
            'tag' => $request->category,
            'manufacturer' => $request->manufacturer,
            'dosage' => $request->dosage,
            'expiry_date' => $request->expiry_date,
            'prescription_required' => $request->requires_prescription,
            'requires_prescription' => $request->requires_prescription,
            'side_effects' => $request->side_effects,
            'low_stock_threshold' => $lowStockThreshold,
            'stock_status' => $stockStatus,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('shop.products.index')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $pharmacy = Auth::guard('pharmacy')->user();
        $product = Product::where('pharmacy_id', $pharmacy->id)->findOrFail($id);
        return view('shop.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $pharmacy = Auth::guard('pharmacy')->user();
        $product = Product::where('pharmacy_id', $pharmacy->id)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'generic_name' => 'nullable|string|max:255',
            'batch_number' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:medicine,supplement,first_aid',
            'manufacturer' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'expiry_date' => 'required|date|after:today',
            'requires_prescription' => 'required|boolean',            'side_effects' => 'nullable|string',
            'low_stock_threshold' => 'nullable|integer|min:0',            'side_effects' => 'nullable|string',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }

        $updatedPrice = $request->price;
        if ($request->discount) {
            $updatedPrice = $request->price - ($request->price * ($request->discount / 100));
        }

        // Determine stock status
        $quantity = $request->stock;
        $lowStockThreshold = $request->low_stock_threshold ?? 10;
        
        if ($quantity == 0) {
            $stockStatus = 'out_of_stock';
        } elseif ($quantity <= $lowStockThreshold) {
            $stockStatus = 'low_stock';
        } else {
            $stockStatus = 'normal';
        }

        $updateData = [
            'name' => $request->name,
            'generic_name' => $request->generic_name,
            'batch_number' => $request->batch_number,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'updated_price' => $updatedPrice,
            'quantity' => $quantity,
            'category' => $request->category,
            'tag' => $request->category,
            'manufacturer' => $request->manufacturer,
            'dosage' => $request->dosage,
            'expiry_date' => $request->expiry_date,
            'prescription_required' => $request->requires_prescription,
            'requires_prescription' => $request->requires_prescription,
            'side_effects' => $request->side_effects,
            'low_stock_threshold' => $lowStockThreshold,
            'stock_status' => $stockStatus,
        ];

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $updateData['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($updateData);

        return redirect()->route('shop.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $pharmacy = Auth::guard('pharmacy')->user();
        $product = Product::where('pharmacy_id', $pharmacy->id)->findOrFail($id);
        
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        
        $product->delete();

        return back()->with('success', 'Product deleted successfully!');
    }
}
