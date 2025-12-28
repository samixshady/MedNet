<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products - MedNet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .shop-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 280px;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        @media (max-width: 768px) {
            .shop-sidebar {
                transform: translateX(-100%);
            }
            .shop-sidebar.mobile-open {
                transform: translateX(0);
            }
            .shop-content {
                margin-left: 0 !important;
            }
        }

        .shop-content {
            margin-left: 280px;
            padding: 24px;
            min-height: 100vh;
        }

        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">

    <!-- Mobile Menu Toggle -->
    <button id="mobileMenuBtn" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-purple-600 text-white rounded-lg shadow-lg">
        <i class='bx bx-menu text-2xl'></i>
    </button>

    <!-- Shop Sidebar -->
    <div class="shop-sidebar" id="shopSidebar">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-white">{{ Auth::guard('pharmacy')->user()->shop_name }}</h1>
            <p class="text-purple-200 text-sm">Pharmacy Dashboard</p>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('shop.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-white rounded-lg hover:bg-white/20 transition-colors">
                <i class='bx bx-grid-alt text-xl'></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('shop.products.index') }}" class="flex items-center gap-3 px-4 py-3 text-white bg-white/20 rounded-lg hover:bg-white/30 transition-colors">
                <i class='bx bx-package text-xl'></i>
                <span class="font-medium">My Products</span>
            </a>
            <a href="{{ route('shop.products.create') }}" class="flex items-center gap-3 px-4 py-3 text-white rounded-lg hover:bg-white/20 transition-colors">
                <i class='bx bx-plus-circle text-xl'></i>
                <span class="font-medium">Add Product</span>
            </a>
        </nav>

        <div class="absolute bottom-6 left-6 right-6">
            <div class="p-4 bg-white/10 backdrop-blur rounded-lg">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-purple-300 rounded-full flex items-center justify-center">
                        <i class='bx bx-user text-purple-700 text-xl'></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-white font-medium text-sm">{{ Auth::guard('pharmacy')->user()->owner_name }}</p>
                        <p class="text-purple-200 text-xs truncate">{{ Auth::guard('pharmacy')->user()->email }}</p>
                    </div>
                </div>
                <form action="{{ route('shop.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors text-sm font-medium">
                        <i class='bx bx-log-out'></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="shop-content">
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
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
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
    </div>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }

        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const shopSidebar = document.getElementById('shopSidebar');
        
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                shopSidebar.classList.toggle('mobile-open');
            });
        }

        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768) {
                if (!shopSidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    shopSidebar.classList.remove('mobile-open');
                }
            }
        });
    </script>
</body>
</html>
