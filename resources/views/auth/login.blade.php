<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login - MedNet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(139, 92, 246, 0.2);
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3);
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700 flex items-center justify-center p-4">
    
    <!-- Home Button -->
    <a href="{{ url('/') }}" class="fixed top-6 left-6 z-50 w-14 h-14 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white rounded-full shadow-lg hover:shadow-xl flex items-center justify-center transition-all duration-300 hover:scale-110 group" title="Back to Home">
        <i class='bx bx-home text-2xl group-hover:scale-110 transition-transform'></i>
    </a>

    <div class="w-full max-w-6xl flex flex-col lg:flex-row gap-8 lg:gap-0 animate-fadeInUp">
        
        <!-- Left Side - Branding -->
        <div class="lg:w-1/2 flex flex-col justify-center items-center text-white p-8 lg:p-12">
            <div class="max-w-md">
                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-lg rounded-2xl mb-6">
                        <i class='bx bxs-capsule text-5xl'></i>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4">Welcome Back!</h1>
                    <p class="text-lg text-purple-100 mb-8">Sign in to access your health dashboard and order medicines online.</p>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-2xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold">Fast Delivery</h3>
                            <p class="text-sm text-purple-100">Get your medicines delivered quickly</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-2xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold">Verified Products</h3>
                            <p class="text-sm text-purple-100">100% authentic medications</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-2xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold">24/7 Support</h3>
                            <p class="text-sm text-purple-100">Expert assistance anytime</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="lg:w-1/2 flex items-center justify-center p-4">
            <div class="w-full max-w-md glass-effect rounded-3xl shadow-2xl p-8 lg:p-10">
                
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Customer Login</h2>
                    <p class="text-gray-600">Enter your credentials to continue</p>
                </div>

                <!-- Session Status -->
                @if(session('status'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg flex items-start">
                        <i class='bx bx-check-circle text-green-600 text-xl mr-3 mt-0.5'></i>
                        <p class="text-sm text-green-700">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                        <div class="flex items-start">
                            <i class='bx bx-error-circle text-red-600 text-xl mr-3 mt-0.5'></i>
                            <div class="flex-1">
                                @foreach($errors->all() as $error)
                                    <p class="text-sm text-red-700">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-envelope text-gray-400 text-xl'></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 input-focus"
                                placeholder="your@email.com"
                                required 
                                autofocus
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-lock-alt text-gray-400 text-xl'></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 input-focus"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500 cursor-pointer"
                            >
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-700 font-medium transition-colors">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3.5 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 btn-hover flex items-center justify-center space-x-2"
                    >
                        <span>Sign In</span>
                        <i class='bx bx-right-arrow-alt text-xl'></i>
                    </button>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Other Login Options</span>
                        </div>
                    </div>

                    <!-- Other Login Links -->
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('admin.login') }}" class="flex items-center justify-center px-4 py-3 border-2 border-indigo-200 rounded-xl hover:bg-indigo-50 hover:border-indigo-300 transition-all duration-300">
                            <i class='bx bx-shield text-indigo-600 text-xl mr-2'></i>
                            <span class="text-sm font-medium text-gray-700">Admin</span>
                        </a>
                        <a href="{{ route('shop.login') }}" class="flex items-center justify-center px-4 py-3 border-2 border-green-200 rounded-xl hover:bg-green-50 hover:border-green-300 transition-all duration-300">
                            <i class='bx bx-store text-green-600 text-xl mr-2'></i>
                            <span class="text-sm font-medium text-gray-700">Pharmacy</span>
                        </a>
                    </div>

                    <!-- Register Link -->
                    <p class="text-center text-sm text-gray-600 mt-6">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-700 font-semibold transition-colors">
                            Create one now
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
