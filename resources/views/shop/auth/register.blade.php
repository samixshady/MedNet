<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Registration - MedNet</title>
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
<body class="min-h-screen bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 py-8 px-4">
    
    <!-- Home Button -->
    <a href="{{ url('/') }}" class="fixed top-6 left-6 z-50 w-14 h-14 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white rounded-full shadow-lg hover:shadow-xl flex items-center justify-center transition-all duration-300 hover:scale-110 group" title="Back to Home">
        <i class='bx bx-home text-2xl group-hover:scale-110 transition-transform'></i>
    </a>

    <div class="w-full max-w-5xl mx-auto animate-fadeInUp">
        
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-lg rounded-2xl mb-4">
                <i class='bx bxs-store-alt text-5xl text-white'></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Register Your Pharmacy</h1>
            <p class="text-lg text-green-100">Join MedNet marketplace and reach more customers</p>
        </div>

        <!-- Registration Card -->
        <div class="glass-effect rounded-3xl shadow-2xl p-8 lg:p-10">
            
            <!-- Information Banner -->
            <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                <div class="flex items-start">
                    <i class='bx bx-info-circle text-blue-600 text-xl mr-3 mt-0.5'></i>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-blue-800 mb-1">Registration Review Process</p>
                        <p class="text-xs text-blue-700">Your registration will be reviewed by our admin team. You'll be notified via email once approved.</p>
                    </div>
                </div>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg error-shake">
                    <div class="flex items-start">
                        <i class='bx bx-error-circle text-red-600 text-xl mr-3 mt-0.5'></i>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-red-700 mb-2">Please correct the following errors:</p>
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('shop.register') }}" class="space-y-8">
                @csrf

                <!-- Shop Information Section -->
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center pb-2 border-b-2 border-green-500">
                        <i class='bx bx-store text-green-600 text-2xl mr-2'></i>
                        Shop Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
                        <!-- Shop Name -->
                        <div class="md:col-span-2">
                            <label for="shop_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Shop Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class='bx bx-building text-gray-400 text-xl'></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="shop_name" 
                                    name="shop_name" 
                                    value="{{ old('shop_name') }}"
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('shop_name') ? 'border-red-500' : '' }}"
                                    placeholder="ABC Pharmacy"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Owner Name -->
                        <div>
                            <label for="owner_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Owner Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class='bx bx-user text-gray-400 text-xl'></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="owner_name" 
                                    name="owner_name" 
                                    value="{{ old('owner_name') }}"
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('owner_name') ? 'border-red-500' : '' }}"
                                    placeholder="Full name"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                Phone Number <span class="text-red-500">*</span>
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
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('phone') ? 'border-red-500' : '' }}"
                                    placeholder="+880 1234-567890"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                Shop Address <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3.5 left-4">
                                    <i class='bx bx-map text-gray-400 text-xl'></i>
                                </div>
                                <textarea 
                                    id="address" 
                                    name="address" 
                                    rows="2"
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 resize-none {{ $errors->has('address') ? 'border-red-500' : '' }}"
                                    placeholder="Full address with city and postal code"
                                    required
                                >{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trade License Section -->
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center pb-2 border-b-2 border-green-500">
                        <i class='bx bx-id-card text-green-600 text-2xl mr-2'></i>
                        Trade License Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-4">
                        <!-- Trade License Number -->
                        <div class="md:col-span-3">
                            <label for="trade_license_number" class="block text-sm font-semibold text-gray-700 mb-2">
                                Trade License Number <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class='bx bx-file text-gray-400 text-xl'></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="trade_license_number" 
                                    name="trade_license_number" 
                                    value="{{ old('trade_license_number') }}"
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('trade_license_number') ? 'border-red-500' : '' }}"
                                    placeholder="TL-2025-123456"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Issue Date -->
                        <div>
                            <label for="trade_license_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Issue Date <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class='bx bx-calendar text-gray-400 text-xl'></i>
                                </div>
                                <input 
                                    type="date" 
                                    id="trade_license_date" 
                                    name="trade_license_date" 
                                    value="{{ old('trade_license_date') }}"
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('trade_license_date') ? 'border-red-500' : '' }}"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Expiry Date -->
                        <div class="md:col-span-2">
                            <label for="license_expiry_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Expiry Date <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class='bx bx-calendar-x text-gray-400 text-xl'></i>
                                </div>
                                <input 
                                    type="date" 
                                    id="license_expiry_date" 
                                    name="license_expiry_date" 
                                    value="{{ old('license_expiry_date') }}"
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('license_expiry_date') ? 'border-red-500' : '' }}"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Credentials Section -->
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center pb-2 border-b-2 border-green-500">
                        <i class='bx bx-lock-alt text-green-600 text-2xl mr-2'></i>
                        Account Credentials
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
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
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('email') ? 'border-red-500' : '' }}"
                                    placeholder="pharmacy@example.com"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class='bx bx-lock text-gray-400 text-xl'></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('password') ? 'border-red-500' : '' }}"
                                    placeholder="Minimum 8 characters"
                                    required
                                    minlength="8"
                                >
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class='bx bx-lock-open-alt text-gray-400 text-xl'></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}"
                                    placeholder="Re-enter password"
                                    required
                                    minlength="8"
                                >
                            </div>
                        </div>

                        <!-- Password Hint -->
                        <div class="md:col-span-2">
                            <div class="p-3 bg-gradient-to-r from-amber-400 to-yellow-500 rounded-lg">
                                <p class="text-xs font-medium text-white flex items-start">
                                    <i class='bx bx-shield text-white text-sm mr-2 mt-0.5'></i>
                                    <span>Password must be at least 8 characters long</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start p-4 bg-gray-50 rounded-xl">
                    <input 
                        type="checkbox" 
                        name="terms" 
                        id="terms"
                        class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500 cursor-pointer mt-1"
                        required
                    >
                    <label for="terms" class="ml-3 text-sm text-gray-700 cursor-pointer">
                        I agree to the <a href="#" class="text-green-600 hover:text-green-700 font-semibold">Terms and Conditions</a> and confirm that all information provided is accurate and up to date.
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold py-4 rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 btn-hover flex items-center justify-center space-x-2 text-lg"
                >
                    <i class='bx bx-check-circle text-2xl'></i>
                    <span>Submit Registration</span>
                </button>

                <!-- Links Section -->
                <div class="space-y-3 pt-4">
                    <!-- Login Link -->
                    <p class="text-center text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('shop.login') }}" class="text-green-600 hover:text-green-700 font-semibold transition-colors">
                            Login here
                        </a>
                    </p>

                    <!-- Back to Home -->
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors">
                            <i class='bx bx-left-arrow-alt text-lg mr-1'></i>
                            Back to Home
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
