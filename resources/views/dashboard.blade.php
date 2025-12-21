<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    </x-slot>

    <!-- Sidebar Include -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Your content here -->
            </div>
        </div>
    </div>
</x-app-layout>
