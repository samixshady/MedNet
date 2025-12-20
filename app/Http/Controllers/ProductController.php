<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date|after_or_equal:today',
            'dosage' => 'required|string|max:255',
            'tag' => 'required|in:medicine,supplement,first_aid',
            'price' => 'required|numeric|min:0',
            'prescription_required' => 'required|boolean',
            'manufacturer' => 'required|string|max:255',
            'side_effects' => 'nullable|string',
            'low_stock_threshold' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Product name is required',
            'description.required' => 'Product description is required',
            'quantity.required' => 'Quantity is required',
            'expiry_date.required' => 'Expiry date is required',
            'expiry_date.after_or_equal' => 'Expiry date cannot be in the past',
            'dosage.required' => 'Dosage is required',
            'tag.required' => 'Product tag is required',
            'price.required' => 'Price is required',
            'manufacturer.required' => 'Manufacturer is required',
            'low_stock_threshold.required' => 'Low stock threshold is required',
            'image.required' => 'Product image is required',
            'image.image' => 'File must be an image',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products', 'public');
            $validated['image_path'] = $imagePath;
        }

        // Determine stock status
        if ($validated['quantity'] == 0) {
            $validated['stock_status'] = 'out_of_stock';
        } elseif ($validated['quantity'] <= $validated['low_stock_threshold']) {
            $validated['stock_status'] = 'low_stock';
        } else {
            $validated['stock_status'] = 'normal';
        }

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product added successfully!',
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
