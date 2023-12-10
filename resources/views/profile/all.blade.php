<!-- resources/views/profile/all.blade.php -->

@extends('layouts.app')

@section('content')
    <div style="text-align: center; margin: 20px auto; max-width: 600px;">
        <h1>All User Profiles</h1>

        <form action="{{ route('profile.all') }}" method="get">
            <input type="text" name="search" placeholder="Search by name" value="{{ $search }}">
            <button type="submit">Search</button>
        </form>

        @forelse($profiles as $profile)
            <div style="border: 1px solid #ccc; padding: 20px; margin: 20px 0;">
                <h3>{{ $profile->full_name }}</h3>
                <p><strong>Email:</strong> {{ $profile->email }}</p>
                <p><strong>Age:</strong> {{ $profile->age }}</p>
                <p><strong>Gender:</strong> {{ $profile->gender }}</p>
                <!-- Add other fields as needed -->
            </div>
        @empty
            <p>No profiles found.</p>
        @endforelse
    </div>
@endsection
