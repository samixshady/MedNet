<?php

namespace App\Http\Controllers;

use App\Models\SupportFeedback;
use Illuminate\Http\Request;

class SupportFeedbackController extends Controller
{
    /**
     * Store support feedback in database
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Name is required.',
            'name.max' => 'Name cannot exceed 255 characters.',
            'phone.required' => 'Phone number is required.',
            'phone.max' => 'Phone number cannot exceed 20 characters.',
            'message.required' => 'Message is required.',
            'message.max' => 'Message cannot exceed 5000 characters.',
        ]);

        try {
            // Save to database
            SupportFeedback::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your feedback! We will get back to you soon.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.',
            ], 500);
        }
    }

    /**
     * Admin: Get all feedback with filters
     */
    public function index(Request $request)
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $query = SupportFeedback::query();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by urgent
        if ($request->has('urgent') && $request->urgent == '1') {
            $query->where('is_urgent', true);
        }

        // Filter by pinned
        if ($request->has('pinned') && $request->pinned == '1') {
            $query->where('is_pinned', true);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Always show pinned first, then sort by selected criteria
        $query->orderBy('is_pinned', 'desc')
              ->orderBy($sortBy, $sortOrder);

        $feedbacks = $query->paginate(20)->withQueryString();

        return view('admin.support-feedback', compact('feedbacks'));
    }

    /**
     * Toggle feedback status
     */
    public function toggleStatus(SupportFeedback $feedback)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $feedback->status = $feedback->status === 'pending' ? 'resolved' : 'pending';
        $feedback->resolved_at = $feedback->status === 'resolved' ? now() : null;
        $feedback->save();

        return response()->json([
            'success' => true,
            'status' => $feedback->status,
            'message' => 'Status updated successfully.'
        ]);
    }

    /**
     * Toggle pinned status
     */
    public function togglePin(SupportFeedback $feedback)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $feedback->is_pinned = !$feedback->is_pinned;
        $feedback->save();

        return response()->json([
            'success' => true,
            'is_pinned' => $feedback->is_pinned,
            'message' => 'Pin status updated successfully.'
        ]);
    }

    /**
     * Toggle urgent status
     */
    public function toggleUrgent(SupportFeedback $feedback)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $feedback->is_urgent = !$feedback->is_urgent;
        $feedback->save();

        return response()->json([
            'success' => true,
            'is_urgent' => $feedback->is_urgent,
            'message' => 'Urgent status updated successfully.'
        ]);
    }

    /**
     * Delete feedback
     */
    public function destroy(SupportFeedback $feedback)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $feedback->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feedback deleted successfully.'
        ]);
    }
}
