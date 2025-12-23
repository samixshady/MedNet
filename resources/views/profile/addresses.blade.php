<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/search-bar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/quick-buy.css') }}">
        <link rel="stylesheet" href="{{ asset('css/promotional-slider.css') }}">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sonner@latest/dist/index.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sonner@latest/dist/styles.css" rel="stylesheet" />
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Saved Addresses') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('profile.edit') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                    ← Back
                </a>
                <a href="{{ route('profile.orders') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                    My Orders
                </a>
            </div>
        </div>
    </x-slot>

    @include('layouts.sidebar')

    <div class="main-content">
        <div class="py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900">Delivery Addresses</h1>
                            <p class="text-gray-600 mt-1">Manage your saved addresses (up to 5)</p>
                        </div>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-blue-600 to-blue-300 rounded-full"></div>
                </div>

                @include('profile.partials.addresses-form')
            </div>
        </div>
    </div>

    <script>
        // Show success/error messages as toast notifications
        @if(session('success'))
            Sonner.toast.success('{{ session('success') }}', {
                duration: 4000,
                position: 'top-right'
            });
        @endif

        @if(session('error'))
            Sonner.toast.error('{{ session('error') }}', {
                duration: 4000,
                position: 'top-right'
            });
        @endif
    </script>
</x-app-layout>
