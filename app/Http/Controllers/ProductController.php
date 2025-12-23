<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'name'); // default sort by name
        $search = $request->get('search', ''); // get search query
        
        $query = Product::query();
        
        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('generic_name', 'like', '%' . $search . '%')
                  ->orWhere('manufacturer', 'like', '%' . $search . '%')
                  ->orWhere('dosage', 'like', '%' . $search . '%');
            });
        }
        
        // Apply sorting
        if ($sort === 'expiry') {
            $products = $query->orderBy('expiry_date', 'asc')->get();
        } else {
            $products = $query->orderBy('name', 'asc')->get();
        }
        
        return view('admin.products.index', compact('products', 'sort', 'search'));
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
            'generic_name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date|after_or_equal:today',
            'dosage' => 'required|string|max:255',
            'tag' => 'required|in:medicine,supplement,first_aid',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|between:0,100',
            'prescription_required' => 'required|boolean',
            'manufacturer' => 'required|string|max:255',
            'side_effects' => 'nullable|string',
            'low_stock_threshold' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Product name is required',
            'generic_name.required' => 'Generic name is required',
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

        // Calculate updated_price based on discount
        $price = (float) $validated['price'];
        $discount = isset($validated['discount']) && $validated['discount'] ? (float) $validated['discount'] : 0;
        
        if ($discount > 0) {
            $validated['updated_price'] = $price - ($price * $discount / 100);
        } else {
            $validated['discount'] = null;
            $validated['updated_price'] = $price;
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
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'generic_name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date|after_or_equal:today',
            'dosage' => 'required|string|max:255',
            'tag' => 'required|in:medicine,supplement,first_aid',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|between:0,100',
            'prescription_required' => 'required|boolean',
            'manufacturer' => 'required|string|max:255',
            'side_effects' => 'nullable|string',
            'low_stock_threshold' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Product name is required',
            'generic_name.required' => 'Generic name is required',
            'description.required' => 'Product description is required',
            'quantity.required' => 'Quantity is required',
            'expiry_date.required' => 'Expiry date is required',
            'expiry_date.after_or_equal' => 'Expiry date cannot be in the past',
            'dosage.required' => 'Dosage is required',
            'tag.required' => 'Product tag is required',
            'price.required' => 'Price is required',
            'manufacturer.required' => 'Manufacturer is required',
            'low_stock_threshold.required' => 'Low stock threshold is required',
            'image.image' => 'File must be an image',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products', 'public');
            $validated['image_path'] = $imagePath;

            // Delete old image if it exists
            if ($product->image_path) {
                \Storage::disk('public')->delete($product->image_path);
            }
        }

        // Calculate updated_price based on discount
        $price = (float) $validated['price'];
        $discount = isset($validated['discount']) && $validated['discount'] ? (float) $validated['discount'] : 0;
        
        if ($discount > 0) {
            $validated['updated_price'] = $price - ($price * $discount / 100);
        } else {
            $validated['discount'] = null;
            $validated['updated_price'] = $price;
        }

        // Determine stock status
        if ($validated['quantity'] == 0) {
            $validated['stock_status'] = 'out_of_stock';
        } elseif ($validated['quantity'] <= $validated['low_stock_threshold']) {
            $validated['stock_status'] = 'low_stock';
        } else {
            $validated['stock_status'] = 'normal';
        }

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully!',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete image if it exists
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    /**
     * Display medicine products with pagination
     */
    public function medicine()
    {
        $products = Product::where('tag', 'medicine')
            ->where('expiry_date', '>=', now()->toDateString())
            ->paginate(30);
        return view('products.medicine', compact('products'));
    }

    /**
     * Display supplement products with pagination
     */
    public function supplements()
    {
        $products = Product::where('tag', 'supplement')
            ->where('expiry_date', '>=', now()->toDateString())
            ->paginate(30);
        return view('products.supplements', compact('products'));
    }

    /**
     * Display first aid products with pagination
     */
    public function firstAid()
    {
        $products = Product::where('tag', 'first_aid')
            ->where('expiry_date', '>=', now()->toDateString())
            ->paginate(30);
        return view('products.first_aid', compact('products'));
    }

    /**
     * Display expired products
     */
    public function expiredProducts(Request $request)
    {
        $sort = $request->get('sort', 'name');
        
        if ($sort === 'expiry') {
            $products = Product::where('expiry_date', '<', now()->toDateString())
                ->orderBy('expiry_date', 'asc')
                ->get();
        } else {
            $products = Product::where('expiry_date', '<', now()->toDateString())
                ->orderBy('name', 'asc')
                ->get();
        }
        
        return view('admin.products.expired', compact('products', 'sort'));
    }
}

