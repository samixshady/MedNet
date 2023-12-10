@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Write a Review</h2>
        <form action="{{ route('reviews.store') }}" method="post">
            @csrf
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="review">Review:</label>
            <textarea name="review" rows="4" required></textarea>

            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" min="1" max="5" required>
            
            <button type="submit">Submit Review</button>
        </form>
    </div>
@endsection
