<!-- resources/views/profile/index.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div style="text-align: center; border: 1px solid #ccc; padding: 20px; margin: 20px auto; max-width: 400px;">
        <h1>Your Profile</h1>
        <h1> {{ $user->full_name }}</h1>
        
        <!-- Display other profile details -->
        <div style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; margin: 0 auto;">
            <img src="{{ asset('storage/' . $user->picture) }}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
        </div>

        <!-- Add additional profile details here if needed -->

        <a href="{{ route('profile.view') }}" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 10px; cursor: pointer; border: none; border-radius: 5px;">View Profile</a>
        <a href="{{ route('profile.edit') }}" style="display: inline-block; padding: 10px 20px; background-color: #008CBA; color: white; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 10px; cursor: pointer; border: none; border-radius: 5px;">Edit Profile</a>
        <li><a href="{{ route('home') }}">Go back to Home</a></li>
    </div>
@endsection
