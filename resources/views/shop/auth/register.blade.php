<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Your Pharmacy - MedNet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 min-h-screen py-8 transition-colors duration-300">
    
    <div class="w-full max-w-2xl mx-auto px-4">
        <!-- Logo and Header -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 bg-white dark:bg-gray-800 rounded-full shadow-lg mb-4">
                <i class='bx bx-store-alt text-5xl text-purple-600 dark:text-purple-400'></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Register Your Pharmacy</h1>
            <p class="text-gray-600 dark:text-gray-400">Join MedNet marketplace and reach more customers</p>
        </div>

        <!-- Registration Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 transition-colors duration-300">
            
            <!-- Information Banner -->
            <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg">
                <div class="flex items-start">
                    <i class='bx bx-info-circle text-blue-600 dark:text-blue-400 text-xl mr-3 mt-0.5'></i>
                    <div class="flex-1">
                        <p class="text-blue-800 dark:text-blue-300 text-sm font-medium mb-1">Registration Review Process</p>
                        <p class="text-blue-700 dark:text-blue-400 text-xs">Your registration will be reviewed by our admin team. You'll be notified via email once approved.</p>
                    </div>
                </div>
            </div>

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg">
                    <div class="flex items-start">
                        <i class='bx bx-error-circle text-red-600 dark:text-red-400 text-xl mr-3 mt-0.5'></i>
                        <div class="flex-1">
                            <p class="text-red-700 dark:text-red-300 text-sm font-medium mb-2">Please correct the following errors:</p>
                            <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Registration Form -->
            <form action="{{ route('shop.register') }}" method="POST">
                @csrf

                <!-- Shop Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                        <i class='bx bx-store mr-2 text-purple-600 dark:text-purple-400'></i>
                        Shop Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Shop Name -->
                        <div class="md:col-span-2">
                            <label for="shop_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Shop Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="shop_name" 
                                name="shop_name" 
                                value="{{ old('shop_name') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                                placeholder="e.g., ABC Pharmacy"
                                required
                            >
                        </div>

                        <!-- Owner Name -->
                        <div>
                            <label for="owner_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Owner Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="owner_name" 
                                name="owner_name" 
                                value="{{ old('owner_name') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                                placeholder="Full name"
                                required
                            >
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                                placeholder="+880 1234-567890"
                                required
                            >
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Shop Address <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="address" 
                                name="address" 
                                rows="2"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300 resize-none"
                                placeholder="Full address with city and postal code"
                                required
                            >{{ old('address') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Trade License Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                        <i class='bx bx-id-card mr-2 text-purple-600 dark:text-purple-400'></i>
                        Trade License Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <!-- Trade License Number -->
                        <div class="md:col-span-3">
                            <label for="trade_license_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Trade License Number <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="trade_license_number" 
                                name="trade_license_number" 
                                value="{{ old('trade_license_number') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                                placeholder="e.g., TL-2025-123456"
                                required
                            >
                        </div>

                        <!-- Trade License Issue Date -->
                        <div>
                            <label for="trade_license_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Issue Date <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                id="trade_license_date" 
                                name="trade_license_date" 
                                value="{{ old('trade_license_date') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                                required
                            >
                        </div>

                        <!-- License Expiry Date -->
                        <div class="md:col-span-2">
                            <label for="license_expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Expiry Date <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                id="license_expiry_date" 
                                name="license_expiry_date" 
                                value="{{ old('license_expiry_date') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                                required
                            >
                        </div>
                    </div>
                </div>

                <!-- Account Credentials Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                        <i class='bx bx-lock-alt mr-2 text-purple-600 dark:text-purple-400'></i>
                        Account Credentials
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email Address <span class="text-red-500">*</span>
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
                                >
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-lock text-gray-400 dark:text-gray-500'></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                                    placeholder="Minimum 8 characters"
                                    required
                                    minlength="8"
                                >
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-lock text-gray-400 dark:text-gray-500'></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                                    placeholder="Re-enter password"
                                    required
                                    minlength="8"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="mb-6">
                    <label class="flex items-start">
                        <input 
                            type="checkbox" 
                            name="terms" 
                            class="w-5 h-5 text-purple-600 border-gray-300 dark:border-gray-600 rounded focus:ring-purple-500 dark:focus:ring-purple-400 dark:bg-gray-700 mt-1"
                            required
                        >
                        <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                            I agree to the <a href="#" class="text-purple-600 dark:text-purple-400 hover:underline">Terms and Conditions</a> and confirm that all information provided is accurate.
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-4 px-6 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center text-lg"
                >
                    <i class='bx bx-check-circle mr-2 text-xl'></i>
                    Submit Registration
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                        Already registered?
                    </span>
                </div>
            </div>

            <!-- Login Link -->
            <a 
                href="{{ route('shop.login') }}" 
                class="block w-full py-3 px-4 border-2 border-purple-600 dark:border-purple-400 text-purple-600 dark:text-purple-400 font-medium rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors duration-200 text-center"
            >
                <i class='bx bx-log-in mr-2'></i>
                Login to Existing Account
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
    </div>

    <!-- Dark Mode Toggle Script -->
    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
