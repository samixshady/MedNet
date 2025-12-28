<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration - MedNet</title>
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
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }
        .error-shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700 flex items-center justify-center p-4">
    
    <!-- Home Button -->
    <a href="{{ url('/') }}" class="fixed top-6 left-6 z-50 w-14 h-14 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white rounded-full shadow-lg hover:shadow-xl flex items-center justify-center transition-all duration-300 hover:scale-110 group" title="Back to Home">
        <i class='bx bx-home text-2xl group-hover:scale-110 transition-transform'></i>
    </a>

    <div class="w-full max-w-6xl flex flex-col lg:flex-row gap-8 lg:gap-0 animate-fadeInUp my-8">
        
        <!-- Left Side - Branding -->
        <div class="lg:w-1/2 flex flex-col justify-center items-center text-white p-8 lg:p-12">
            <div class="max-w-md">
                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-lg rounded-2xl mb-6">
                        <i class='bx bxs-user-plus text-5xl'></i>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4">Join MedNet</h1>
                    <p class="text-lg text-purple-100 mb-8">Create your account and start ordering medicines online with ease.</p>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-2xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold">Easy Registration</h3>
                            <p class="text-sm text-purple-100">Quick and simple signup process</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-2xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold">Secure Account</h3>
                            <p class="text-sm text-purple-100">Your data is safe with us</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-2xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold">Order Tracking</h3>
                            <p class="text-sm text-purple-100">Track your orders in real-time</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="lg:w-1/2 flex items-center justify-center p-4">
            <div class="w-full max-w-md glass-effect rounded-3xl shadow-2xl p-8 lg:p-10">
                
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h2>
                    <p class="text-gray-600">Fill in your details to register</p>
                </div>

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg error-shake">
                        <div class="flex items-start">
                            <i class='bx bx-error-circle text-red-600 text-xl mr-3 mt-0.5'></i>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-red-700 mb-1">Please correct the following errors:</p>
                                @foreach($errors->all() as $error)
                                    <p class="text-sm text-red-600">• {{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-user text-gray-400 text-xl'></i>
                            </div>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('name') ? 'border-red-500' : '' }}"
                                placeholder="John Doe"
                                required 
                                autofocus
                            >
                        </div>
                    </div>

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
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('email') ? 'border-red-500' : '' }}"
                                placeholder="your@email.com"
                                required
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
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('password') ? 'border-red-500' : '' }}"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                        <div class="mt-2 p-3 bg-gradient-to-r from-amber-400 to-yellow-500 rounded-lg">
                            <p class="text-xs font-medium text-white flex items-start">
                                <i class='bx bx-shield text-white text-sm mr-2 mt-0.5'></i>
                                <span>Must be 8+ characters with uppercase, lowercase, numbers & symbols</span>
                            </p>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-lock-open-alt text-gray-400 text-xl'></i>
                            </div>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-phone text-gray-400 text-xl'></i>
                            </div>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone') }}"
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('phone') ? 'border-red-500' : '' }}"
                                placeholder="+880 1234-567890"
                                required
                            >
                        </div>
                    </div>

                    <!-- Register Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3.5 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 btn-hover flex items-center justify-center space-x-2 mt-6"
                    >
                        <span>Create Account</span>
                        <i class='bx bx-user-plus text-xl'></i>
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-sm text-gray-600 mt-6">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-700 font-semibold transition-colors">
                            Sign in here
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
