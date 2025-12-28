@extends('layouts.shop')

@section('title', 'Edit Product')

@section('content')
    <style>
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

        .current-image-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
        }
    </style>

    <!-- Coming Soon Banner -->
        <div class="gradient-banner rounded-lg shadow-lg p-4 mb-6 flex items-center gap-3 text-white">
            <i class='bx bx-barcode text-3xl'></i>
            <div>
                <p class="font-bold text-lg">🚀 Coming Soon: Barcode Scanner Feature!</p>
                <p class="text-purple-100 text-sm">Quickly update products by scanning barcodes</p>
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
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Edit Product</h2>
            <p class="text-gray-600 dark:text-gray-400">Update the details below to modify your product</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <form action="{{ route('shop.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-package'></i> Product Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $product->name) }}"
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
                               value="{{ old('generic_name', $product->generic_name) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('generic_name') border-red-500 shake @enderror">
                        @error('generic_name')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-money'></i> Price (৳) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               name="price" 
                               id="price" 
                               value="{{ old('price', $product->price) }}"
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
                               value="{{ old('discount', $product->discount ?? 0) }}"
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
                               value="{{ old('stock', $product->stock) }}"
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
                            <option value="medicine" {{ old('category', $product->category) == 'medicine' ? 'selected' : '' }}>Medicine</option>
                            <option value="supplement" {{ old('category', $product->category) == 'supplement' ? 'selected' : '' }}>Supplement</option>
                            <option value="first_aid" {{ old('category', $product->category) == 'first_aid' ? 'selected' : '' }}>First Aid</option>
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
                               value="{{ old('batch_number', $product->batch_number) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('batch_number') border-red-500 shake @enderror"
                               required>
                        @error('batch_number')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Manufacturer -->
                    <div>
                        <label for="manufacturer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-building'></i> Manufacturer <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="manufacturer" 
                               id="manufacturer" 
                               value="{{ old('manufacturer', $product->manufacturer) }}"
                               placeholder="e.g., Bayer, Pfizer"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('manufacturer') border-red-500 shake @enderror"
                               required>
                        @error('manufacturer')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dosage -->
                    <div>
                        <label for="dosage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-capsule'></i> Dosage <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="dosage" 
                               id="dosage" 
                               value="{{ old('dosage', $product->dosage) }}"
                               placeholder="e.g., 500mg tablet"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('dosage') border-red-500 shake @enderror"
                               required>
                        @error('dosage')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Expiry Date -->
                    <div>
                        <label for="expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-calendar'></i> Expiry Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="expiry_date" 
                               id="expiry_date" 
                               value="{{ old('expiry_date', $product->expiry_date ? date('Y-m-d', strtotime($product->expiry_date)) : '') }}"
                               min="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('expiry_date') border-red-500 shake @enderror"
                               required>
                        @error('expiry_date')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prescription Required -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-note'></i> Prescription Required <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-4 mt-3">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" 
                                       name="requires_prescription" 
                                       value="1" 
                                       {{ old('requires_prescription', $product->requires_prescription) == '1' ? 'checked' : '' }}
                                       class="w-4 h-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Yes</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" 
                                       name="requires_prescription" 
                                       value="0" 
                                       {{ old('requires_prescription', $product->requires_prescription) == '0' ? 'checked' : '' }}
                                       class="w-4 h-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">No</span>
                            </label>
                        </div>
                        @error('requires_prescription')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class='bx bx-image'></i> Product Image
                        </label>
                        
                        @if($product->image_path)
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Current Image:</p>
                            <img src="{{ asset('storage/' . $product->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="current-image-preview rounded-lg border border-gray-300 dark:border-gray-600">
                        </div>
                        @endif

                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('image') border-red-500 shake @enderror">
                        @error('image')
                        <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to keep current image. Accepted formats: JPG, PNG, GIF (Max: 2MB)</p>
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
                              required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Side Effects (Optional) -->
                <div class="mt-6">
                    <label for="side_effects" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class='bx bx-error-alt'></i> Side Effects (Optional)
                    </label>
                    <textarea name="side_effects" 
                              id="side_effects" 
                              rows="3"
                              placeholder="List any known side effects..."
                              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('side_effects') border-red-500 shake @enderror">{{ old('side_effects', $product->side_effects) }}</textarea>
                    @error('side_effects')
                    <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Low Stock Threshold -->
                <div class="mt-6">
                    <label for="low_stock_threshold" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class='bx bx-error-circle'></i> Low Stock Threshold (Optional)
                    </label>
                    <input type="number" 
                           name="low_stock_threshold" 
                           id="low_stock_threshold" 
                           value="{{ old('low_stock_threshold', $product->low_stock_threshold ?? 10) }}"
                           min="0"
                           placeholder="10"
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('low_stock_threshold') border-red-500 shake @enderror">
                    @error('low_stock_threshold')
                    <p class="mt-1 text-sm text-red-500"><i class='bx bx-error-circle'></i> {{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Get notified when stock falls below this amount (default: 10)</p>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <button type="submit" 
                            class="gradient-button text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <i class='bx bx-save text-xl'></i>
                        Update Product
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

    <script>
        // Remove shake animation after it completes
        document.querySelectorAll('.shake').forEach(element => {
            element.addEventListener('animationend', () => {
                element.classList.remove('shake');
            });
        });
    </script>
@endsection