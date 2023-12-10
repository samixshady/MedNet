<!-- resources/views/auth.blade.php -->

<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Include your head section here -->
    @include('partials.head')
</head>
<body>
    <!-- Include your navigation and header sections here -->

    <!-- Your content for login and registration -->
    <div class="auth-container">
        <div class="login-box">
            <!-- Your login form goes here -->
            <form method="post" action="{{ route('login') }}">
                @csrf
                <!-- Your login form fields go here -->
                <button type="submit">Login</button>
            </form>
        </div>

        <div class="register-box">
            <!-- Your registration form goes here -->
            <form method="post" action="{{ route('register') }}">
                @csrf
                <!-- Your registration form fields go here -->
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <!-- Include your footer and scripts sections here -->
    @include('partials.footer')
</body>
</html>
