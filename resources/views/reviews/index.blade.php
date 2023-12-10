<!-- resources/views/reviews/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Reviews</h2>
        @foreach($reviews as $review)
    <div class="review-box">
        <strong>{{ $review->username }}</strong>
        <p>{{ $review->review }}</p>
        <p>Rating: {{ $review->rating }}/5</p> <!-- Display the rating -->
    </div>
@endforeach
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
@endsection
