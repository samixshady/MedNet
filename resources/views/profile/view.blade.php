<!-- resources/views/profile/view.blade.php -->

@extends('layouts.app')

@section('content')
    <div style="text-align: center; border: 1px solid #ccc; padding: 20px; margin: 20px auto; max-width: 400px;">
        <h1>View Profile</h1>

        <div style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; margin: 0 auto; float: left; margin-right: 20px;">
            <img src="{{ asset('storage/' . $user->picture) }}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
        </div>

        <div style="text-align: left;">
            <p><strong>Full Name:</strong> {{ $user->full_name }}</p>
            <p><strong>Age:</strong> {{ $user->age }}</p>
            <p><strong>Gender:</strong> {{ $user->gender }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Address:</strong> {{ $user->address }}</p>
            <p><strong>City:</strong> {{ $user->city }}</p>
        </div>
        <div>
        <li><a href="{{ route('home') }}">Go back to Home</a></li>
</div>
    </div>
@endsection
