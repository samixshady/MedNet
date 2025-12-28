<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Dashboard - MedNet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Shop Sidebar Styles */
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

        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">

    <!-- Mobile Menu Toggle -->
    <button id="mobilemenuBtn" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-purple-600 text-white rounded-lg shadow-lg">
        <i class='bx bx-menu text-2xl'></i>
    </button>

    <!-- Shop Sidebar -->
    <div class="shop-sidebar" id="shopSidebar">
        <!-- Logo -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-white">{{ Auth::guard('pharmacy')->user()->shop_name }}</h1>
            <p class="text-purple-200 text-sm">Pharmacy Dashboard</p>
        </div>

        <!-- Navigation -->
        <nav class="space-y-2">
            <a href="{{ route('shop.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-white bg-white/20 rounded-lg hover:bg-white/30 transition-colors">
                <i class='bx bx-grid-alt text-xl'></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('shop.products.index') }}" class="flex items-center gap-3 px-4 py-3 text-white rounded-lg hover:bg-white/20 transition-colors">
                <i class='bx bx-package text-xl'></i>
                <span class="font-medium">My Products</span>
            </a>
            <a href="{{ route('shop.products.create') }}" class="flex items-center gap-3 px-4 py-3 text-white rounded-lg hover:bg-white/20 transition-colors">
                <i class='bx bx-plus-circle text-xl'></i>
                <span class="font-medium">Add Product</span>
            </a>
        </nav>

        <!-- User Info & Logout -->
        <div class="absolute bottom-6 left-6 right-6">
            <div class="p-4 bg-white/10 backdrop-blur rounded-lg">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-purple-300 rounded-full flex items-center justify-center">
                        <i class='bx bx-user text-purple-700 text-xl'></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-white font-medium text-sm">{{ Auth::guard('pharmacy')->user()->owner_name }}</p>
                        <p class="text-purple-200 text-xs">{{ Auth::guard('pharmacy')->user()->email }}</p>
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
    </div>

    <script>
        // Dark mode toggle
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobilemenuBtn');
        const shopSidebar = document.getElementById('shopSidebar');
        
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                shopSidebar.classList.toggle('mobile-open');
            });
        }

        // Close sidebar when clicking outside on mobile
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
