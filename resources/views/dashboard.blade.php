<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/search-bar.css') }}">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </x-slot>

    <!-- Sidebar Include -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Search Bar Section -->
                <div class="mb-12">
                    <x-search-bar />
                </div>
</x-app-layout>
