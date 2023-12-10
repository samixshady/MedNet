<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('reviews.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'username' => 'required',
        'review' => 'required',
        'rating' => 'required|numeric|min:1|max:5', // Add validation for rating
    ]);

    Review::create([
        'username' => $request->username,
        'review' => $request->review,
        'rating' => $request->rating, // Save the rating
    ]);

    return redirect()->route('reviews.index')->with('success', 'Review submitted successfully.');
}
}
