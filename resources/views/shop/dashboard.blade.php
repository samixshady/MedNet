@extends('layouts.shop')

@section('title', 'Shop Dashboard')

@section('content')
    <style>
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
    </style>

    <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Welcome Back!</h2>
            <p class="text-gray-600 dark:text-gray-400">Manage your pharmacy products and track your sales</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg flex items-start">
                <i class='bx bx-check-circle text-green-600 dark:text-green-400 text-xl mr-3 mt-0.5'></i>
                <p class="text-green-700 dark:text-green-300">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Products -->
            <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Total Products</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalProducts }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <i class='bx bx-package text-blue-600 dark:text-blue-400 text-2xl'></i>
                    </div>
                </div>
            </div>

            <!-- Medicine -->
            <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Medicine</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $medicineCount }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                        <i class='bx bx-plus-medical text-red-600 dark:text-red-400 text-2xl'></i>
                    </div>
                </div>
            </div>

            <!-- Supplements -->
            <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">Supplements</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $supplementCount }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                        <i class='bx bx-leaf text-green-600 dark:text-green-400 text-2xl'></i>
                    </div>
                </div>
            </div>

            <!-- First Aid -->
            <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-1">First Aid</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $firstAidCount }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                        <i class='bx bx-first-aid text-purple-600 dark:text-purple-400 text-2xl'></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coming Soon Banner -->
        <div class="mb-8 p-6 bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-purple-700 dark:to-indigo-700 rounded-xl shadow-lg text-white">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class='bx bx-barcode text-2xl'></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold mb-2">Barcode Scanner Coming Soon!</h3>
                    <p class="text-purple-100 mb-4">We're working on an advanced barcode scanning feature to make adding products faster and easier. Stay tuned!</p>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur rounded-lg text-sm font-medium">
                        <i class='bx bx-time-five'></i>
                        <span>Expected: Q1 2026</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Add Product Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                        <i class='bx bx-plus-circle text-purple-600 dark:text-purple-400 text-2xl'></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Add New Product</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-4">List a new medicine, supplement, or first aid product to your inventory</p>
                <a href="{{ route('shop.products.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-lg font-medium transition-all transform hover:-translate-y-0.5">
                    <i class='bx bx-plus'></i>
                    Add Product
                </a>
            </div>

            <!-- Manage Products Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <i class='bx bx-edit text-blue-600 dark:text-blue-400 text-2xl'></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Manage Products</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-4">View, edit, or remove products from your pharmacy inventory</p>
                <a href="{{ route('shop.products.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 dark:bg-gray-600 hover:bg-gray-800 dark:hover:bg-gray-700 text-white rounded-lg font-medium transition-all transform hover:-translate-y-0.5">
                    <i class='bx bx-list-ul'></i>
                    View Products
                </a>
            </div>
        </div>
@endsection
