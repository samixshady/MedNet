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
     * Admin: Get all feedback
     */
    public function index()
    {
        // Check if user is admin (you can customize this based on your auth system)
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $feedbacks = SupportFeedback::latest()->paginate(15);
        return view('admin.support-feedback', compact('feedbacks'));
    }
}
