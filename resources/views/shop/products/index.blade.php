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

        .sort-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
            background: white;
            color: #4b5563;
        }

        .dark .sort-btn {
            background: #374151;
            color: #e5e7eb;
            border-color: #4b5563;
        }

        .sort-btn:hover {
            background: #f3f4f6;
            border-color: #a78bfa;
        }

        .dark .sort-btn:hover {
            background: #4b5563;
            border-color: #a78bfa;
        }

        .sort-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .search-box {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 40px 10px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
        }

        .dark .search-box input {
            background: #374151;
            border-color: #4b5563;
            color: #e5e7eb;
        }

        .search-box i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
    </style>

    <div class="mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4 mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">My Products</h2>
                <p class="text-gray-600 dark:text-gray-400">Manage your pharmacy inventory</p>
            </div>
            <a href="{{ route('shop.products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                <i class='bx bx-plus-circle text-xl'></i>
                Add New Product
            </a>
        </div>

        <!-- Search and Sort Controls -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-6">
            <form method="GET" action="{{ route('shop.products.index') }}" class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="search-box">
                    <input type="text" 
                           name="search" 
                           value="{{ $search }}"
                           placeholder="Search by name, generic name, manufacturer, or batch..." 
                           class="text-gray-900 dark:text-white">
                    <i class='bx bx-search'></i>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Sort by:</span>
                    <a href="{{ route('shop.products.index', ['sort' => 'name', 'search' => $search]) }}" 
                       class="sort-btn {{ $sort === 'name' ? 'active' : '' }}">
                        <i class='bx bx-sort-alt-2'></i> Product Name
                    </a>
                    <a href="{{ route('shop.products.index', ['sort' => 'expiry', 'search' => $search]) }}" 
                       class="sort-btn {{ $sort === 'expiry' ? 'active' : '' }}">
                        <i class='bx bx-calendar'></i> Expiry Date
                    </a>
                    @if($search)
                        <a href="{{ route('shop.products.index') }}" 
                           class="text-sm text-purple-600 dark:text-purple-400 hover:underline">
                            Clear Search
                        </a>
                    @endif
                </div>
            </form>
        </div>
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
