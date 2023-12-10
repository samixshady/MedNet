<!-- resources/views/profile/all.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center mt-5 mb-4">
            <h1>All User Profiles</h1>

            <form action="{{ route('profile.all') }}" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ $search }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <div class="row">
            @forelse($profiles as $profile)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $profile->full_name }}</h3>
                            <ul class="list-unstyled">
                                <li><strong>Age:</strong> {{ $profile->age }}</li>
                                <li><strong>Gender:</strong> {{ $profile->gender }}</li>
                                <li><strong>Email:</strong> {{ $profile->email }}</li>
                                <li><strong>Address:</strong> {{ $profile->address }}</li>
                                <li><strong>City:</strong> {{ $profile->city }}</li>
                                <!-- Add other fields as needed -->
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No profiles found.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection