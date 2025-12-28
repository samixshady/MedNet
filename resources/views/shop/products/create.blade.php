<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - MedNet</title>
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

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .shake {
            animation: shake 0.5s;
        }

        .gradient-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-button:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
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
            <a href="{{ route('shop.products.index') }}" class="flex items-center gap-3 px-4 py-3 text-white rounded-lg hover:bg-white/20 transition-colors">
                <i class='bx bx-package text-xl'></i>
                <span class="font-medium">My Products</span>
            </a>
            <a href="{{ route('shop.products.create') }}" class="flex items-center gap-3 px-4 py-3 text-white bg-white/20 rounded-lg hover:bg-white/30 transition-colors">
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
        <!-- Coming Soon Banner -->
        <div class="gradient-banner rounded-lg shadow-lg p-4 mb-6 flex items-center gap-3 text-white">
            <i class='bx bx-barcode text-3xl'></i>
            <div>
                <p class="font-bold text-lg">🚀 Coming Soon: Barcode Scanner Feature!</p>
                <p class="text-purple-100 text-sm">Quickly add products by scanning barcodes</p>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-3">
            <i class='bx bx-check-circle text-2xl'></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Page Header -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Add New Product</h2>
            <p class="text-gray-600 dark:text-gray-400">Fill in the details below to add a new product to your inventory</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <form action="{{ route('shop.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-package'></i> Product Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('name') border-red-500 shake @enderror"
                               required>
                        @error('name')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Generic Name -->
                    <div>
                        <label for="generic_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-dna'></i> Generic Name
                        </label>
                        <input type="text" 
                               name="generic_name" 
                               id="generic_name" 
                               value="{{ old('generic_name') }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('generic_name') border-red-500 shake @enderror">
                        @error('generic_name')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-money'></i> Price (₱) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               name="price" 
                               id="price" 
                               value="{{ old('price') }}"
                               step="0.01"
                               min="0"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('price') border-red-500 shake @enderror"
                               required>
                        @error('price')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Discount -->
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-purchase-tag'></i> Discount (%)
                        </label>
                        <input type="number" 
                               name="discount" 
                               id="discount" 
                               value="{{ old('discount', 0) }}"
                               min="0"
                               max="100"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('discount') border-red-500 shake @enderror">
                        @error('discount')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-box'></i> Stock Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               name="stock" 
                               id="stock" 
                               value="{{ old('stock') }}"
                               min="0"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('stock') border-red-500 shake @enderror"
                               required>
                        @error('stock')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-category'></i> Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category" 
                                id="category" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('category') border-red-500 shake @enderror"
                                required>
                            <option value="">Select Category</option>
                            <option value="medicine" {{ old('category') == 'medicine' ? 'selected' : '' }}>Medicine</option>
                            <option value="supplement" {{ old('category') == 'supplement' ? 'selected' : '' }}>Supplement</option>
                            <option value="first_aid" {{ old('category') == 'first_aid' ? 'selected' : '' }}>First Aid</option>
                        </select>
                        @error('category')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Batch Number -->
                    <div>
                        <label for="batch_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-barcode'></i> Batch Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="batch_number" 
                               id="batch_number" 
                               value="{{ old('batch_number') }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('batch_number') border-red-500 shake @enderror"
                               required>
                        @error('batch_number')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-image'></i> Product Image
                        </label>
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('image') border-red-500 shake @enderror">
                        @error('image')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Accepted formats: JPG, PNG, GIF (Max: 2MB)</p>
                    </div>
                </div>

                <!-- Description (Full Width) -->
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class='bx bx-detail'></i> Description <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="4"
                              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('description') border-red-500 shake @enderror"
                              required>{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <button type="submit" 
                            class="gradient-button text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <i class='bx bx-plus-circle text-xl'></i>
                        Add Product
                    </button>
                    <a href="{{ route('shop.products.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <i class='bx bx-x-circle text-xl'></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const shopSidebar = document.getElementById('shopSidebar');

        mobileMenuBtn.addEventListener('click', () => {
            shopSidebar.classList.toggle('mobile-open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!shopSidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    shopSidebar.classList.remove('mobile-open');
                }
            }
        });

        // Remove shake animation after it completes
        document.querySelectorAll('.shake').forEach(element => {
            element.addEventListener('animationend', () => {
                element.classList.remove('shake');
            });
        });
    </script>
</body>
</html>
