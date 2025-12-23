<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    /**
     * Display promotional images management page
     */
    public function index()
    {
        $promotions = Promotion::orderBy('display_order')->get();
        // Pad to ensure we always have 6 slots
        while ($promotions->count() < 6) {
            $promotions->push(null);
        }
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Store a newly created promotional image
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'title' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
        ]);

        try {
            $path = $request->file('image')->store('promotions', 'public');

            Promotion::create([
                'image_path' => $path,
                'title' => $request->input('title'),
                'alt_text' => $request->input('alt_text') ?? 'Promotional Image',
                'is_active' => true,
                'display_order' => Promotion::max('display_order') + 1,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Promotional image uploaded successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a promotional image
     */
    public function destroy($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);

            // Delete file from storage
            if (Storage::disk('public')->exists($promotion->image_path)) {
                Storage::disk('public')->delete($promotion->image_path);
            }

            $promotion->delete();

            return response()->json([
                'success' => true,
                'message' => 'Promotional image deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update display order
     */
    public function updateOrder(Request $request)
    {
        try {
            $request->validate([
                'promotions' => 'required|array',
                'promotions.*' => 'integer',
            ]);

            foreach ($request->promotions as $order => $promotionId) {
                Promotion::where('id', $promotionId)->update(['display_order' => $order]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Display order updated successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order: ' . $e->getMessage(),
            ], 500);
        }
    }
}
