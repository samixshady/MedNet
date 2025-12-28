<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Login - MedNet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center justify-center transition-colors duration-300">
    
    <div class="w-full max-w-md px-4">
        <!-- Logo and Header -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 bg-white dark:bg-gray-800 rounded-full shadow-lg mb-4">
                <i class='bx bx-store text-5xl text-purple-600 dark:text-purple-400'></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Shop Login</h1>
            <p class="text-gray-600 dark:text-gray-400">Access your pharmacy dashboard</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 transition-colors duration-300">
            
            <!-- Status Messages -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg">
                    <div class="flex items-start">
                        <i class='bx bx-error-circle text-red-600 dark:text-red-400 text-xl mr-3 mt-0.5'></i>
                        <div class="flex-1">
                            @foreach($errors->all() as $error)
                                <p class="text-red-700 dark:text-red-300 text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg">
                    <div class="flex items-start">
                        <i class='bx bx-check-circle text-green-600 dark:text-green-400 text-xl mr-3 mt-0.5'></i>
                        <p class="text-green-700 dark:text-green-300 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('shop.login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-envelope text-gray-400 dark:text-gray-500'></i>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            placeholder="shop@example.com"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-lock-alt text-gray-400 dark:text-gray-500'></i>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            placeholder="••••••••"
                            required
                        >
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            class="w-4 h-4 text-purple-600 border-gray-300 dark:border-gray-600 rounded focus:ring-purple-500 dark:focus:ring-purple-400 dark:bg-gray-700"
                        >
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center"
                >
                    <i class='bx bx-log-in-circle mr-2 text-lg'></i>
                    Login to Dashboard
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                        Don't have a shop account?
                    </span>
                </div>
            </div>

            <!-- Register Link -->
            <a 
                href="{{ route('shop.register') }}" 
                class="block w-full py-3 px-4 border-2 border-purple-600 dark:border-purple-400 text-purple-600 dark:text-purple-400 font-medium rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors duration-200 text-center"
            >
                <i class='bx bx-user-plus mr-2'></i>
                Register Your Pharmacy
            </a>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a 
                    href="{{ url('/') }}" 
                    class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition-colors duration-200"
                >
                    <i class='bx bx-arrow-back mr-1'></i>
                    Back to Home
                </a>
            </div>
        </div>

        <!-- Additional Links -->
        <div class="mt-6 text-center space-y-2">
            <a 
                href="{{ route('login') }}" 
                class="block text-sm text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition-colors duration-200"
            >
                User Login
            </a>
            <a 
                href="{{ route('admin.login') }}" 
                class="block text-sm text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition-colors duration-200"
            >
                Admin Login
            </a>
        </div>
    </div>

    <!-- Dark Mode Toggle (Optional) -->
    <script>
        // Auto dark mode based on system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
