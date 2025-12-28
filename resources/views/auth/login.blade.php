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
<body class="min-h-screen bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700 flex items-center justify-center p-2 md:p-4">
    
    <!-- Home Button -->
    <a href="{{ url('/') }}" class="fixed top-4 left-4 z-50 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white rounded-full shadow-lg hover:shadow-xl flex items-center justify-center transition-all duration-300 hover:scale-110 group" title="Back to Home">
        <i class='bx bx-home text-xl group-hover:scale-110 transition-transform'></i>
    </a>

    <div class="w-full max-w-6xl flex flex-col lg:flex-row gap-4 lg:gap-0 animate-fadeInUp">
        
        <!-- Left Side - Branding -->
        <div class="lg:w-1/2 flex flex-col justify-center items-center text-white p-4 lg:p-6">
            <div class="max-w-md">
                <div class="mb-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl mb-3">
                        <i class='bx bxs-capsule text-4xl'></i>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold mb-2">Welcome Back!</h1>
                    <p class="text-base text-purple-100 mb-4">Sign in to access your health dashboard and order medicines online.</p>
                </div>
                
                <div class="space-y-2">
                    <div class="flex items-start space-x-2">
                        <i class='bx bx-check-circle text-xl text-green-300'></i>
                        <div>
                            <h3 class="text-sm font-semibold">Fast Delivery</h3>
                            <p class="text-xs text-purple-100">Get your medicines delivered quickly</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class='bx bx-check-circle text-xl text-green-300'></i>
                        <div>
                            <h3 class="text-sm font-semibold">Verified Products</h3>
                            <p class="text-xs text-purple-100">100% authentic medications</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class='bx bx-check-circle text-xl text-green-300'></i>
                        <div>
                            <h3 class="text-sm font-semibold">24/7 Support</h3>
                            <p class="text-xs text-purple-100">Expert assistance anytime</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="lg:w-1/2 flex items-center justify-center p-2 md:p-4">
            <div class="w-full max-w-md glass-effect rounded-2xl shadow-2xl p-6 lg:p-8">
                
                <!-- Header -->
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">Customer Login</h2>
                    <p class="text-sm text-gray-600">Enter your credentials to continue</p>
                </div>

                <!-- Demo Credentials -->
                <div class="mb-4 p-3 bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-200 rounded-lg">
                    <div class="flex items-center gap-2 mb-2">
                        <i class='bx bx-info-circle text-purple-600 text-lg'></i>
                        <h3 class="text-xs font-semibold text-purple-900">Demo Account</h3>
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between gap-3 p-2 bg-white rounded-lg hover:bg-purple-50 transition-colors cursor-pointer group" 
                             onclick="fillDemoCredentials('duck@duck.com', 'duckduck')"
                             title="Click to paste credentials">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500">Email</p>
                                <p class="text-sm font-mono text-gray-800 font-medium">duck@duck.com</p>
                            </div>
                            <i class='bx bx-copy text-purple-600 opacity-0 group-hover:opacity-100 transition-opacity'></i>
                        </div>
                        <div class="flex items-center justify-between gap-3 p-2 bg-white rounded-lg hover:bg-purple-50 transition-colors cursor-pointer group" 
                             onclick="fillDemoCredentials('duck@duck.com', 'duckduck')"
                             title="Click to paste credentials">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500">Password</p>
                                <p class="text-sm font-mono text-gray-800 font-medium">duckduck</p>
                            </div>
                            <i class='bx bx-copy text-purple-600 opacity-0 group-hover:opacity-100 transition-opacity'></i>
                        </div>
                    </div>
                    <p class="text-xs text-purple-700 mt-1.5 text-center">Click on credentials to auto-fill</p>
                </div>

                <!-- Session Status -->
                @if(session('status'))
                    <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 rounded-lg flex items-start">
                        <i class='bx bx-check-circle text-green-600 text-lg mr-2 mt-0.5'></i>
                        <p class="text-xs text-green-700">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded-lg">
                        <div class="flex items-start">
                            <i class='bx bx-error-circle text-red-600 text-lg mr-2 mt-0.5'></i>
                            <div class="flex-1">
                                @foreach($errors->all() as $error)
                                    <p class="text-xs text-red-700">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-envelope text-gray-400 text-lg'></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="w-full pl-10 pr-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 input-focus"
                                placeholder="your@email.com"
                                required 
                                autofocus
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-semibold text-gray-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-lock-alt text-gray-400 text-lg'></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full pl-10 pr-10 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 input-focus"
                                placeholder="••••••••"
                                required
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword()" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                                title="Toggle password visibility"
                            >
                                <i class='bx bx-show text-lg' id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="w-3.5 h-3.5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 cursor-pointer"
                            >
                            <span class="ml-1.5 text-xs text-gray-600">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-purple-600 hover:text-purple-700 font-medium transition-colors">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-2.5 text-sm rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 btn-hover flex items-center justify-center space-x-2"
                    >
                        <span>Sign In</span>
                        <i class='bx bx-right-arrow-alt text-lg'></i>
                    </button>

                    <!-- Divider -->
                    <div class="relative my-3">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="px-3 bg-white text-gray-500">Other Login Options</span>
                        </div>
                    </div>

                    <!-- Other Login Links -->
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('admin.login') }}" class="flex items-center justify-center px-3 py-2 border-2 border-indigo-200 rounded-xl hover:bg-indigo-50 hover:border-indigo-300 transition-all duration-300">
                            <i class='bx bx-shield text-indigo-600 text-lg mr-1.5'></i>
                            <span class="text-xs font-medium text-gray-700">Admin</span>
                        </a>
                        <a href="{{ route('shop.login') }}" class="flex items-center justify-center px-3 py-2 border-2 border-green-200 rounded-xl hover:bg-green-50 hover:border-green-300 transition-all duration-300">
                            <i class='bx bx-store text-green-600 text-lg mr-1.5'></i>
                            <span class="text-xs font-medium text-gray-700">Pharmacy</span>
                        </a>
                    </div>

                    <!-- Register Link -->
                    <p class="text-center text-xs text-gray-600 mt-3">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-700 font-semibold transition-colors">
                            Create one now
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

<script>
    function fillDemoCredentials(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
        
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        
        emailInput.classList.add('ring-2', 'ring-purple-500');
        passwordInput.classList.add('ring-2', 'ring-purple-500');
        
        setTimeout(() => {
            emailInput.classList.remove('ring-2', 'ring-purple-500');
            passwordInput.classList.remove('ring-2', 'ring-purple-500');
        }, 1000);
    }

    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bx-show');
            toggleIcon.classList.add('bx-hide');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bx-hide');
            toggleIcon.classList.add('bx-show');
        }
    }
</script>
</body>
</html>
