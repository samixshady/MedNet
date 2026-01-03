<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Login - MedNet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Vanta.js Libraries sssss-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.cells.min.js"></script>    
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
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.2);
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
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
<body class="min-h-screen flex items-center justify-center p-2 md:p-4">
    <div id="vanta-bg" class="fixed inset-0 -z-10"></div>

    <!-- Home Button -->
    <a href="{{ url('/') }}" class="fixed top-6 left-6 z-50 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white rounded-full shadow-lg hover:shadow-xl flex items-center justify-center transition-all duration-300 hover:scale-110 group" title="Back to Home">
        <i class='bx bx-home text-xl group-hover:scale-110 transition-transform'></i>
    </a>

    <div class="w-full max-w-6xl flex flex-col lg:flex-row gap-4 lg:gap-0 animate-fadeInUp">
        
        <!-- Left Side - Branding -->
        <div class="lg:w-1/2 flex flex-col justify-center items-center text-white p-4 lg:p-6">
            <div class="max-w-md">
                <div class="mb-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl mb-3">
                        <i class='bx bxs-store text-4xl'></i>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold mb-2">Pharmacy Portal</h1>
                    <p class="text-base text-green-100 mb-4">Access your pharmacy dashboard and manage your products, orders, and inventory.</p>
                </div>
                
                <div class="space-y-2">
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold text-sm">Manage Products</h3>
                            <p class="text-xs text-green-100">Add and update your inventory</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold text-sm">Process Orders</h3>
                            <p class="text-xs text-green-100">Handle customer orders efficiently</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold text-sm">Business Insights</h3>
                            <p class="text-xs text-green-100">Track sales and performance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="lg:w-1/2 flex items-center justify-center p-4">
            <div class="w-full max-w-md glass-effect rounded-3xl shadow-2xl p-4 lg:p-6">
                
                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-green-600 to-emerald-600 rounded-2xl mb-2">
                        <i class='bx bx-store text-white text-2xl'></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">Pharmacy Login</h2>
                    <p class="text-sm text-gray-600">Access your pharmacy dashboard</p>
                </div>

                <!-- Demo Credentials -->
                <div class="mb-3 p-3 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg">
                    <div class="flex items-center gap-2 mb-2">
                        <i class='bx bx-store text-green-600 text-lg'></i>
                        <h3 class="text-xs font-semibold text-green-900">Demo Pharmacy Account</h3>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between gap-3 p-2 bg-white rounded-lg hover:bg-green-50 transition-colors cursor-pointer group" 
                             onclick="fillShopCredentials('shop@shop.com', 'ShopShop123')"
                             title="Click to paste credentials">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500">Email</p>
                                <p class="text-sm font-mono text-gray-800 font-medium">shop@shop.com</p>
                            </div>
                            <i class='bx bx-copy text-green-600 opacity-0 group-hover:opacity-100 transition-opacity'></i>
                        </div>
                        <div class="flex items-center justify-between gap-3 p-2 bg-white rounded-lg hover:bg-green-50 transition-colors cursor-pointer group" 
                             onclick="fillShopCredentials('shop@shop.com', 'ShopShop123')"
                             title="Click to paste credentials">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500">Password</p>
                                <p class="text-sm font-mono text-gray-800 font-medium">ShopShop123</p>
                            </div>
                            <i class='bx bx-copy text-green-600 opacity-0 group-hover:opacity-100 transition-opacity'></i>
                        </div>
                    </div>
                    <p class="text-xs text-green-700 mt-1 text-center">Click on credentials to auto-fill</p>
                </div>

                <!-- Success Messages -->
                @if(session('success'))
                    <div class="mb-3 p-3 bg-green-50 border-l-4 border-green-500 rounded-lg flex items-start">
                        <i class='bx bx-check-circle text-green-600 text-lg mr-2 mt-0.5'></i>
                        <p class="text-xs text-green-700">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-3 p-3 bg-red-50 border-l-4 border-red-500 rounded-lg">
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

                <!-- Status-based Messages -->
                @if(session('error_type') === 'pending')
                    <div class="mb-3 p-3 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg">
                        <div class="flex items-start">
                            <i class='bx bx-time-five text-yellow-600 text-lg mr-2 mt-0.5'></i>
                            <div>
                                <p class="text-xs font-semibold text-yellow-800 mb-0.5">Application Pending</p>
                                <p class="text-xs text-yellow-700">Your pharmacy registration is under review. Please wait for admin approval.</p>
                            </div>
                        </div>
                    </div>
                @elseif(session('error_type') === 'rejected')
                    <div class="mb-3 p-3 bg-orange-50 border-l-4 border-orange-500 rounded-lg">
                        <div class="flex items-start">
                            <i class='bx bx-x-circle text-orange-600 text-lg mr-2 mt-0.5'></i>
                            <div>
                                <p class="text-xs font-semibold text-orange-800 mb-0.5">Application Rejected</p>
                                <p class="text-xs text-orange-700">Your registration was not approved. Please contact support for more information.</p>
                            </div>
                        </div>
                    </div>
                @elseif(session('error_type') === 'banned')
                    <div class="mb-3 p-3 bg-red-50 border-l-4 border-red-600 rounded-lg">
                        <div class="flex items-start">
                            <i class='bx bx-block text-red-600 text-lg mr-2 mt-0.5'></i>
                            <div>
                                <p class="text-xs font-semibold text-red-800 mb-0.5">Account Banned</p>
                                <p class="text-xs text-red-700">Your pharmacy account has been suspended. Contact admin for assistance.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('shop.login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-envelope text-gray-400 text-lg'></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus"
                                placeholder="pharmacy@example.com"
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
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-lock-alt text-gray-400 text-lg'></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus"
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

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="w-3.5 h-3.5 text-green-600 border-gray-300 rounded focus:ring-green-500 cursor-pointer"
                            >
                            <span class="ml-2 text-xs text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold py-2.5 rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 btn-hover flex items-center justify-center space-x-2"
                    >
                        <span class="text-sm">Sign In</span>
                        <i class='bx bx-right-arrow-alt text-lg'></i>
                    </button>

                    <!-- Links -->
                    <div class="space-y-2 mt-3">
                        <!-- Register Link -->
                        <p class="text-center text-xs text-gray-600">
                            Don't have an account? 
                            <a href="{{ route('shop.register') }}" class="text-green-600 hover:text-green-700 font-semibold transition-colors text-xs">
                                Register your pharmacy
                            </a>
                        </p>

                        <!-- Back to Customer Login -->
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="inline-flex items-center text-xs text-gray-500 hover:text-gray-700 transition-colors">
                                <i class='bx bx-left-arrow-alt text-base mr-1'></i>
                                Back to Customer Login
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    function fillShopCredentials(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
        
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        
        emailInput.classList.add('ring-2', 'ring-green-500');
        passwordInput.classList.add('ring-2', 'ring-green-500');
        
        setTimeout(() => {
            emailInput.classList.remove('ring-2', 'ring-green-500');
            passwordInput.classList.remove('ring-2', 'ring-green-500');
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
<script>
            VANTA.CELLS({
                el: "#vanta-bg",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200.00,
                minWidth: 200.00,
                scale: 1.00,
                color1: 0x95209,
                color2: 0xb8b570,
                size: 1.90,
                speed: 0.50
            });
        </script>
</body>
</html>
