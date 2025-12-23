<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/search-bar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/quick-buy.css') }}">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sonner@latest/dist/index.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sonner@latest/dist/styles.css" rel="stylesheet" />
    </x-slot>

    <!-- Sidebar Include -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900">Manage QuickBuy</h1>
                        <p class="text-gray-600 mt-2">Add or remove products from your QuickBuy list for faster purchases</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-lg transition-all duration-200">
                        ← Back to Dashboard
                    </a>
                </div>

                <!-- Search and List Container -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Search Section -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Search & Add Products</h2>
                            
                            <!-- Category Filter -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Filter by Category (Optional)</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <button
                                        onclick="filterCategory('all')"
                                        class="px-4 py-2 rounded-lg font-semibold transition-all duration-200 bg-blue-600 text-white hover:bg-blue-700"
                                        id="filter-all"
                                    >
                                        All Products
                                    </button>
                                    <button
                                        onclick="filterCategory('medicine')"
                                        class="px-4 py-2 rounded-lg font-semibold transition-all duration-200 bg-gray-200 text-gray-800 hover:bg-gray-300"
                                        id="filter-medicine"
                                    >
                                        💊 Medicine
                                    </button>
                                    <button
                                        onclick="filterCategory('supplement')"
                                        class="px-4 py-2 rounded-lg font-semibold transition-all duration-200 bg-gray-200 text-gray-800 hover:bg-gray-300"
                                        id="filter-supplement"
                                    >
                                        🥤 Supplement
                                    </button>
                                    <button
                                        onclick="filterCategory('first_aid')"
                                        class="px-4 py-2 rounded-lg font-semibold transition-all duration-200 bg-gray-200 text-gray-800 hover:bg-gray-300"
                                        id="filter-first_aid"
                                    >
                                        🩹 First Aid
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Search Bar from Dashboard -->
                            <div class="relative" x-data="quickBuySearch()" @click.outside="if (!$event.target.closest('button[type=button]')) open = false">
                                <div class="flex gap-3">
                                    <input
                                        type="text"
                                        x-model="query"
                                        @input="handleInput()"
                                        @keydown.down="selectNext()"
                                        @keydown.up="selectPrevious()"
                                        @keydown.enter="selectCurrent()"
                                        @keydown.escape="open = false"
                                        @focus="query.length >= 2 && (open = true)"
                                        placeholder="Search by product name or generic name"
                                        class="flex-1 px-4 py-3 bg-white border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-400 transition-all duration-200 text-gray-800 placeholder-gray-500 font-medium"
                                    />
                                    <button
                                        type="button"
                                        @click="performSearch()"
                                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl active:scale-95"
                                    >
                                        Search
                                    </button>
                                </div>

                                <!-- Suggestions Dropdown -->
                                <div
                                    x-show="open && suggestions.length > 0"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    class="absolute top-full left-0 right-0 mt-2 bg-white border-2 border-gray-200 rounded-lg shadow-2xl z-50 max-h-80 overflow-y-auto"
                                    @click.away="open = false"
                                >
                                    <template x-for="(suggestion, index) in suggestions" :key="index">
                                        <div
                                            @mouseenter="selectedIndex = index"
                                            :class="selectedIndex === index ? 'bg-blue-100 border-l-4 border-blue-600' : 'hover:bg-gray-50'"
                                            class="px-4 py-4 cursor-pointer border-b border-gray-150 last:border-b-0 transition-all duration-150"
                                        >
                                            <div class="flex items-start gap-3">
                                                <template x-if="suggestion.image_path">
                                                    <img
                                                        :src="'/storage/' + suggestion.image_path"
                                                        :alt="suggestion.name"
                                                        class="w-16 h-16 object-cover rounded-lg flex-shrink-0 shadow-md"
                                                        onerror="this.style.display='none'"
                                                    />
                                                </template>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-base font-bold text-gray-900 truncate" x-text="suggestion.name"></p>
                                                    <p class="text-sm text-gray-600 truncate mt-1" x-text="suggestion.generic_name"></p>
                                                    <div class="flex flex-wrap items-center gap-2 mt-2">
                                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold" x-text="suggestion.type"></span>
                                                        <span class="text-sm text-gray-600 font-medium" x-text="suggestion.dosage"></span>
                                                        <span class="font-bold text-green-600" x-text="'৳ ' + suggestion.price.toFixed(2)"></span>
                                                    </div>
                                                </div>
                                                <button
                                                    type="button"
                                                    @click="addToQuickBuy(suggestion); $event.stopPropagation();"
                                                    :disabled="isAdding"
                                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 disabled:bg-green-400 disabled:cursor-not-allowed text-white font-bold rounded-lg transition-all duration-200 flex-shrink-0 whitespace-nowrap"
                                                >
                                                    <span x-show="!isAdding">Add</span>
                                                    <span x-show="isAdding">Adding...</span>
                                                </button>
                                            </div>
                                        </div>
                                    </template>

                                    <!-- Loading State -->
                                    <template x-if="loading">
                                        <div class="px-6 py-8 text-center text-gray-600">
                                            <div class="inline-block">
                                                <div class="animate-spin rounded-full h-8 w-8 border-4 border-blue-200 border-t-blue-600"></div>
                                            </div>
                                            <p class="mt-3 text-base font-medium">Searching products...</p>
                                        </div>
                                    </template>
                                </div>

                                <!-- No Results Message -->
                                <div
                                    x-show="open && query.length >= 2 && suggestions.length === 0 && !loading"
                                    class="absolute top-full left-0 right-0 mt-3 bg-white border-2 border-gray-200 rounded-lg shadow-2xl p-6 text-center text-gray-600 z-50"
                                >
                                    <p class="text-lg font-semibold text-gray-800">No products found</p>
                                    <p class="mt-2 text-sm">Try searching with different keywords</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Buy List Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">QuickBuy List</h2>
                            <div class="text-sm text-gray-600 mb-4">
                                <p id="quickbuy-count">Total items: <span class="font-bold">0</span></p>
                            </div>
                            <button
                                @click="location.reload()"
                                class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all duration-200"
                            >
                                Refresh List
                            </button>
                        </div>
                    </div>
                </div>

                <!-- QuickBuy Items List -->
                <div class="mt-12 bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Current QuickBuy Items</h2>
                    <div id="quickbuy-items-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Items will be loaded here -->
                    </div>
                    <div id="empty-state" class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8-4m-8 4v10l8-4m-8-4l8 4"></path>
                        </svg>
                        <p class="mt-4 text-gray-600 text-lg">No items in QuickBuy list yet</p>
                        <p class="text-gray-500 text-sm">Search for products above to get started</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedCategory = 'all';

        function filterCategory(category) {
            selectedCategory = category;
            
            // Update button styles
            document.querySelectorAll('[id^="filter-"]').forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                btn.classList.add('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
            });
            
            const activeBtn = document.getElementById(`filter-${category}`);
            if (activeBtn) {
                activeBtn.classList.remove('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
                activeBtn.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            }
        }

        function quickBuySearch() {
            return {
                query: '',
                suggestions: [],
                selectedIndex: -1,
                open: false,
                loading: false,
                debounceTimer: null,
                isAdding: false,

                handleInput() {
                    clearTimeout(this.debounceTimer);
                    this.selectedIndex = -1;

                    if (this.query.length < 2) {
                        this.open = false;
                        this.suggestions = [];
                        return;
                    }

                    this.loading = true;
                    this.debounceTimer = setTimeout(() => {
                        this.fetchSuggestions();
                    }, 300);
                },

                async fetchSuggestions() {
                    try {
                        let url = `/search?q=${encodeURIComponent(this.query)}`;
                        if (selectedCategory !== 'all') {
                            url += `&category=${selectedCategory}`;
                        }
                        console.log('Fetching from URL:', url);
                        const response = await fetch(url);
                        const data = await response.json();
                        console.log('Search results:', data);
                        
                        // Filter by category if selected
                        if (selectedCategory !== 'all') {
                            this.suggestions = data.filter(item => item.type.toLowerCase().replace(' ', '_') === selectedCategory);
                        } else {
                            this.suggestions = data;
                        }
                        console.log('Filtered suggestions:', this.suggestions);
                        this.open = this.suggestions.length > 0;
                    } catch (error) {
                        console.error('Search error:', error);
                        this.suggestions = [];
                    } finally {
                        this.loading = false;
                    }
                },

                selectNext() {
                    if (this.suggestions.length === 0) return;
                    this.selectedIndex = (this.selectedIndex + 1) % this.suggestions.length;
                    this.open = true;
                },

                selectPrevious() {
                    if (this.suggestions.length === 0) return;
                    this.selectedIndex = this.selectedIndex <= 0 ? this.suggestions.length - 1 : this.selectedIndex - 1;
                    this.open = true;
                },

                selectCurrent() {
                    if (this.selectedIndex >= 0 && this.suggestions[this.selectedIndex]) {
                        this.addToQuickBuy(this.suggestions[this.selectedIndex]);
                    }
                },

                performSearch() {
                    if (this.selectedIndex >= 0 && this.suggestions[this.selectedIndex]) {
                        this.addToQuickBuy(this.suggestions[this.selectedIndex]);
                    }
                },

                async addToQuickBuy(product) {
                    if (this.isAdding) return; // Prevent duplicate submissions
                    
                    console.log('Adding to QuickBuy:', product);
                    
                    this.isAdding = true;
                    try {
                        const response = await fetch('/quick-buy/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({ product_id: product.id })
                        });

                        const data = await response.json();
                        console.log('QuickBuy add response:', data);

                        if (data.success) {
                            this.query = '';
                            this.suggestions = [];
                            this.open = false;
                            this.selectedIndex = -1;
                            
                            // Show success notification
                            if (typeof Sonner !== 'undefined') {
                                Sonner.toast.success(data.message);
                            } else {
                                alert(data.message);
                            }
                            
                            // Reload items after a short delay to ensure DB write completes
                            console.log('Reloading items in 800ms...');
                            setTimeout(() => {
                                console.log('Calling loadQuickBuyItems from add');
                                loadQuickBuyItems();
                            }, 800);
                        } else {
                            if (typeof Sonner !== 'undefined') {
                                Sonner.toast.error(data.message);
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }
                    } catch (error) {
                        console.error('Error adding to QuickBuy:', error);
                        if (typeof Sonner !== 'undefined') {
                            Sonner.toast.error('Failed to add to QuickBuy');
                        } else {
                            alert('Failed to add to QuickBuy');
                        }
                    } finally {
                        this.isAdding = false;
                    }
                }
            }
        }

        // Load QuickBuy items on page load
        function loadQuickBuyItems() {
            console.log('loadQuickBuyItems called');
            fetch('/quick-buy/items')
                .then(response => {
                    console.log('Items response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(items => {
                    console.log('Loaded items:', items);
                    console.log('Number of items:', items.length);
                    
                    const container = document.getElementById('quickbuy-items-container');
                    const emptyState = document.getElementById('empty-state');
                    const countEl = document.querySelector('#quickbuy-count span');

                    if (!container) {
                        console.error('Container not found');
                        return;
                    }

                    countEl.textContent = items.length;
                    console.log('Updated count to:', items.length);

                    if (items.length === 0) {
                        console.log('No items - showing empty state');
                        container.innerHTML = '';
                        emptyState.style.display = 'block';
                    } else {
                        console.log('Rendering', items.length, 'items');
                        emptyState.style.display = 'none';
                        container.innerHTML = items.map(item => `
                            <div class="bg-white rounded-xl border-2 border-gray-200 hover:border-blue-400 hover:shadow-lg transition-all duration-300 overflow-hidden">
                                ${item.image_path ? `<img src="/storage/${item.image_path}" alt="${item.name}" class="w-full h-40 object-cover">` : '<div class="w-full h-40 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center"><span class="text-4xl">📦</span></div>'}
                                <div class="p-5">
                                    <h3 class="font-bold text-gray-900 text-lg truncate">${item.name}</h3>
                                    <p class="text-sm text-gray-600 truncate mt-1">${item.generic_name || 'N/A'}</p>
                                    <div class="flex items-center gap-2 mt-3 text-xs flex-wrap">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold">${item.type || 'Product'}</span>
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full">${item.dosage || ''}</span>
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <p class="text-xl font-bold text-green-600">৳ ${item.price.toFixed(2)}</p>
                                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded font-semibold">In Stock</span>
                                    </div>
                                    <div class="mt-4 flex gap-2">
                                        <button type="button" onclick="removeFromQuickBuy(${item.id})" class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-all duration-200 text-sm active:scale-95">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                        console.log('Items rendered successfully');
                    }
                })
                .catch(error => {
                    console.error('Error loading QuickBuy items:', error);
                    if (typeof Sonner !== 'undefined') {
                        Sonner.toast.error('Failed to load QuickBuy items: ' + error.message);
                    } else {
                        alert('Failed to load QuickBuy items');
                    }
                });
        }

        function removeFromQuickBuy(quickBuyId) {
            console.log('Remove clicked - QuickBuy ID:', quickBuyId);
            
            if (!confirm('Remove this item from QuickBuy?')) {
                console.log('Remove cancelled');
                return;
            }
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            console.log('CSRF Token present:', !!csrfToken);
            console.log('Sending POST to /quick-buy/' + quickBuyId + '/remove');
            
            fetch(`/quick-buy/${quickBuyId}/remove`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                }
            })
            .then(response => {
                console.log('Remove response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Remove response data:', data);
                if (data.success) {
                    if (typeof Sonner !== 'undefined') {
                        Sonner.toast.success(data.message);
                    } else {
                        alert(data.message);
                    }
                    console.log('Reloading items after remove...');
                    setTimeout(() => {
                        console.log('Calling loadQuickBuyItems from remove');
                        loadQuickBuyItems();
                    }, 500);
                } else {
                    if (typeof Sonner !== 'undefined') {
                        Sonner.toast.error(data.message);
                    } else {
                        alert('Error: ' + data.message);
                    }
                }
            })
            .catch(error => {
                console.error('Remove error:', error);
                if (typeof Sonner !== 'undefined') {
                    Sonner.toast.error('Failed to remove item: ' + error.message);
                } else {
                    alert('Failed to remove item: ' + error.message);
                }
            });
        }

        // Load items on page load and refresh periodically
        window.addEventListener('load', function() {
            console.log('Page loaded, initializing QuickBuy');
            loadQuickBuyItems();
        });
        
        // Also call it immediately in case DOMContentLoaded already fired
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadQuickBuyItems);
        } else {
            loadQuickBuyItems();
        }
    </script>
</x-app-layout>
