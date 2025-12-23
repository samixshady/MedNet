<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search products by name or generic name only
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $query = trim($query);
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        // Get products that START with the search query - name and generic_name ONLY
        $products = Product::where('stock_status', '!=', 'out_of_stock')
            ->where(function ($q) use ($query) {
                // Only search in name and generic_name fields, only START matches
                $q->whereRaw('LOWER(name) LIKE LOWER(?)', ["{$query}%"])
                  ->orWhereRaw('LOWER(generic_name) LIKE LOWER(?)', ["{$query}%"]);
            })
            ->select('id', 'name', 'generic_name', 'dosage', 'tag', 'updated_price', 'image_path')
            ->orderByRaw("
                CASE 
                    WHEN LOWER(name) LIKE LOWER(?) THEN 1
                    WHEN LOWER(generic_name) LIKE LOWER(?) THEN 2
                    ELSE 3
                END
            ", ["{$query}%", "{$query}%"])
            ->limit(8)
            ->get()
            ->map(function ($product) {
                // Map tag to route name
                $tagRouteMap = [
                    'medicine' => 'medicine.show',
                    'supplement' => 'supplements.show',
                    'first_aid' => 'first-aid.show',
                ];
                
                $routeName = $tagRouteMap[$product->tag] ?? 'medicine.show';
                
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'generic_name' => $product->generic_name,
                    'dosage' => $product->dosage,
                    'type' => ucfirst(str_replace('_', ' ', $product->tag)),
                    'price' => number_format($product->updated_price, 2),
                    'image_path' => $product->image_path,
                    'url' => route($routeName, $product->id),
                ];
            });

        return response()->json($products);
    }
}
