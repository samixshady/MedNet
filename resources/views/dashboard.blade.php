<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/search-bar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/quick-buy.css') }}">
        <link rel="stylesheet" href="{{ asset('css/promotional-slider.css') }}">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sonner@latest/dist/index.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sonner@latest/dist/styles.css" rel="stylesheet" />
    </x-slot>

    <!-- Sidebar Include -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- QuickBuy Section (Original Position) -->
                <div class="mb-12" style="position: relative; min-height: 380px;">
                    <x-quick-buy-box />
                    <!-- Promotional Slider to the Right -->
                    <x-promotional-slider :promotions="$promotions" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
