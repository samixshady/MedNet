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
            'generic_name' => 'required|string|max:255',
            'batch_number' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|in:medicine,supplement,first_aid',
            'requires_prescription' => 'required|boolean',
            'expiry_date' => 'required|date|after:today',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $updatedPrice = $request->price;
        if ($request->discount) {
            $updatedPrice = $request->price - ($request->price * ($request->discount / 100));
        }

        Product::create([
            'pharmacy_id' => $pharmacy->id,
            'name' => $request->name,
            'generic_name' => $request->generic_name,
            'batch_number' => $request->batch_number,
            'manufacturer' => $request->manufacturer,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'updated_price' => $updatedPrice,
            'quantity' => $request->quantity,
            'category' => $request->category,
            'requires_prescription' => $request->requires_prescription,
            'expiry_date' => $request->expiry_date,
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
            'generic_name' => 'required|string|max:255',
            'batch_number' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|in:medicine,supplement,first_aid',
            'requires_prescription' => 'required|boolean',
            'expiry_date' => 'required|date|after:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        $product->update([
            'name' => $request->name,
            'generic_name' => $request->generic_name,
            'batch_number' => $request->batch_number,
            'manufacturer' => $request->manufacturer,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'updated_price' => $updatedPrice,
            'quantity' => $request->quantity,
            'category' => $request->category,
            'requires_prescription' => $request->requires_prescription,
            'expiry_date' => $request->expiry_date,
        ]);

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
