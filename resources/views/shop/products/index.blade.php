@extends('layouts.shop')

@section('title', 'My Products')

@section('content')
    <style>
        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
    </style>

    <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">My Products</h2>
                <p class="text-gray-600 dark:text-gray-400">Manage your pharmacy inventory</p>
            </div>
            <a href="{{ route('shop.products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                <i class='bx bx-plus-circle text-xl'></i>
                Add New Product
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg flex items-start">
                <i class='bx bx-check-circle text-green-600 dark:text-green-400 text-xl mr-3 mt-0.5'></i>
                <p class="text-green-700 dark:text-green-300">{{ session('success') }}</p>
            </div>
        @endif

        @if($products->isEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class='bx bx-package text-5xl text-gray-400 dark:text-gray-500'></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-3">No Products Yet</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">Start adding products to your inventory to make them available on MedNet marketplace</p>
                <a href="{{ route('shop.products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                    <i class='bx bx-plus-circle'></i>
                    Add Your First Product
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="product-card bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                        <div class="relative h-48 bg-gray-200 dark:bg-gray-700">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class='bx bx-package text-6xl text-gray-400 dark:text-gray-500'></i>
                                </div>
                            @endif
                            
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3">
                                @php
                                    $categoryColors = [
                                        'medicine' => 'bg-red-500',
                                        'supplement' => 'bg-green-500',
                                        'first_aid' => 'bg-blue-500'
                                    ];
                                    $categoryIcons = [
                                        'medicine' => 'bx-plus-medical',
                                        'supplement' => 'bx-leaf',
                                        'first_aid' => 'bx-first-aid'
                                    ];
                                @endphp
                                <span class="inline-flex items-center gap-1 px-2 py-1 {{ $categoryColors[$product->category] ?? 'bg-gray-500' }} text-white text-xs font-medium rounded-full">
                                    <i class='bx {{ $categoryIcons[$product->category] ?? "bx-box" }}'></i>
                                    {{ ucfirst($product->category) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 truncate">{{ $product->name }}</h3>
                            
                            @if($product->generic_name)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $product->generic_name }}</p>
                            @endif

                            <div class="flex items-center justify-between mb-3">
                                <span class="text-2xl font-bold text-purple-600 dark:text-purple-400">৳{{ number_format($product->updated_price ?? $product->price, 2) }}</span>
                                @if($product->updated_price && $product->updated_price < $product->price)
                                    <span class="text-sm text-gray-500 dark:text-gray-400 line-through">৳{{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>

                            <div class="mb-3 space-y-1">
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <i class='bx bx-barcode'></i>
                                    <span class="font-mono">{{ $product->batch_number }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <i class='bx bx-package'></i>
                                    <span>Stock: {{ $product->stock }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('shop.products.edit', $product) }}" class="flex-1 flex items-center justify-center gap-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                    <i class='bx bx-edit'></i>
                                    Edit
                                </a>
                                <form action="{{ route('shop.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center justify-center gap-1 px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                                        <i class='bx bx-trash'></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
@endsection
