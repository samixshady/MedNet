<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')

<div style="max-width: 800px; margin: 0 auto;">

    <h1>Edit Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" name="age" value="{{ old('age', $user->age) }}">
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <input type="text" class="form-control" name="gender" value="{{ old('gender', $user->gender) }}">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}">
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" value="{{ old('city', $user->city) }}">
        </div>

        <div class="form-group">
            <label for="picture">Profile Picture:</label>
            <input type="file" class="form-control-file" name="picture">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>

    <br>
    <br>

    <div>
        <a href="{{ route('home') }}" class="btn btn-secondary">Go back to Home</a>
    </div>

</div>

@endsection
