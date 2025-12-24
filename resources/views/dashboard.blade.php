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
        <div class="py-6 sm:py-12">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
                <!-- QuickBuy and Promotional Slider Section -->
                <div class="mb-8 sm:mb-12 flex flex-col lg:flex-row gap-6 lg:gap-0 lg:relative lg:min-h-[380px]">
                    <!-- QuickBuy Box -->
                    <div class="w-full lg:w-auto">
                        <x-quick-buy-box />
                    </div>
                    <!-- Promotional Slider -->
                    <div class="w-full lg:w-auto">
                        <x-promotional-slider :promotions="$promotions" />
                    </div>
                </div>

                <!-- Discount Carousel Section -->
                <x-discount-carousel :discountedProducts="$discountedProducts" />
            </div>
        </div>
    </div>
</x-app-layout>
