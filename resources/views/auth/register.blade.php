<x-guest-layout>
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }
        @keyframes slideDown {
            from { 
                opacity: 0;
                transform: translateY(-8px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        .error-field {
            animation: shake 0.5s ease-in-out;
        }
        .error-message {
            animation: slideDown 0.3s ease-out;
        }
        .error-input {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }
    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="{{ $errors->has('name') ? 'error-field' : '' }}">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full {{ $errors->has('name') ? 'error-input' : '' }}" 
                          type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            @error('name')
                <div class="error-message flex items-start mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm text-red-700 font-medium">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4 {{ $errors->has('email') ? 'error-field' : '' }}">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full {{ $errors->has('email') ? 'error-input' : '' }}" 
                          type="email" name="email" :value="old('email')" required autocomplete="username" />
            @error('email')
                <div class="error-message flex items-start mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm text-red-700 font-medium">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4 {{ $errors->has('password') ? 'error-field' : '' }}">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full {{ $errors->has('password') ? 'error-input' : '' }}"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <div class="mt-2 p-3 bg-gradient-to-r from-amber-400 to-yellow-500 border-l-4 border-amber-600 rounded-r-lg shadow-md">
                <p class="text-xs font-semibold text-white flex items-start">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0 mt-0.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span class="leading-relaxed">Must be 8+ characters with uppercase, lowercase, numbers & symbols</span>
                </p>
            </div>
            @error('password')
                <div class="error-message flex items-start mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm text-red-700 font-medium">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 {{ $errors->has('password_confirmation') ? 'error-field' : '' }}">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full {{ $errors->has('password_confirmation') ? 'error-input' : '' }}"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <div class="error-message flex items-start mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm text-red-700 font-medium">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between mt-6 gap-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="w-full sm:w-auto justify-center">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- Shop Registration Banner -->
        <div class="mt-6 p-4 bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 border border-purple-200 dark:border-purple-800 rounded-lg">
            <div class="flex items-start gap-3">
                <i class='bx bx-store-alt text-3xl text-purple-600 dark:text-purple-400'></i>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Own a Pharmacy?</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Register your pharmacy and start selling on MedNet marketplace</p>
                    <a href="{{ route('shop.register') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class='bx bx-user-plus mr-2'></i>
                        Register Your Pharmacy
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>
