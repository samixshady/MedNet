<!-- Navbar Search Bar - Mobile Friendly & Sleek Design -->
<div class="flex items-center flex-1" x-data="navbarSearch()" @click.outside="open = false">
    <!-- Desktop Search (md and above) -->
    <div class="hidden md:flex items-center flex-1 max-w-2xl mx-4 relative">
        <div class="w-full relative">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input
                type="text"
                x-model="query"
                @input="handleInput()"
                @keydown.down="selectNext()"
                @keydown.up="selectPrevious()"
                @keydown.enter="selectCurrent()"
                @keydown.escape="open = false"
                @focus="query.length >= 2 && (open = true)"
                placeholder="Search products..."
                class="w-full pl-10 pr-4 py-2.5 bg-white bg-opacity-95 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 focus:bg-white transition-all duration-200 text-base text-gray-800 placeholder-gray-500 shadow-sm hover:shadow-md"
            />

            <!-- Desktop Suggestions Dropdown -->
            <div
                x-show="open && suggestions.length > 0"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                style="z-index: 9999; position: absolute;"
                class="top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-2xl max-h-96 overflow-y-auto border border-gray-200"
            >
                <!-- Desktop Suggestions List -->
                <template x-for="(suggestion, index) in suggestions" :key="index">
                    <div
                        @click="selectSuggestion(suggestion)"
                        @mouseenter="selectedIndex = index"
                        :class="selectedIndex === index ? 'bg-blue-50 border-l-4 border-blue-600' : 'hover:bg-gray-50'"
                        class="px-4 py-4 cursor-pointer border-b border-gray-100 last:border-b-0 transition-all duration-150 flex items-center gap-3"
                    >
                        <template x-if="suggestion.image_path">
                            <img
                                :src="'/storage/' + suggestion.image_path"
                                :alt="suggestion.name"
                                class="w-12 h-12 object-cover rounded-md flex-shrink-0"
                                onerror="this.style.display='none'"
                            />
                        </template>
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-semibold text-gray-900 truncate" x-text="suggestion.name"></p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm px-2 py-1 bg-blue-100 text-blue-700 rounded-full font-medium" x-text="suggestion.type"></span>
                                <span class="text-sm text-green-600 font-bold" x-text="'৳ ' + suggestion.price.toFixed(2)"></span>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Desktop Loading State -->
                <template x-if="loading">
                    <div class="px-4 py-6 text-center">
                        <div class="inline-block">
                            <div class="animate-spin rounded-full h-7 w-7 border-3 border-blue-200 border-t-blue-600"></div>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">Searching...</p>
                    </div>
                </template>
            </div>

            <!-- Desktop No Results -->
            <div
                x-show="open && query.length >= 2 && suggestions.length === 0 && !loading"
                style="z-index: 9999; position: absolute;"
                class="top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-2xl p-6 text-center text-gray-600 border border-gray-200"
            >
                <p class="text-base font-medium text-gray-700">No products found</p>
            </div>
        </div>
    </div>

    <!-- Mobile Search Icon Button (md and below) -->
    <button
        @click="toggleMobileSearch()"
        class="md:hidden p-2.5 hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-200 text-white ml-2"
        title="Search"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </button>

    <!-- Mobile Search Modal -->
    <div
        x-show="mobileSearchOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="mobileSearchOpen = false"
        style="z-index: 9999;"
        class="fixed inset-0 bg-black bg-opacity-50 md:hidden"
    >
        <div class="bg-white rounded-b-2xl shadow-2xl">
            <div class="px-4 py-4 flex items-center gap-3 border-b border-gray-200">
                <button @click="mobileSearchOpen = false" class="p-2 hover:bg-gray-100 rounded-lg transition">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input
                        type="text"
                        x-model="mobileQuery"
                        @input="handleMobileInput()"
                        @keydown.enter="performMobileSearch()"
                        placeholder="Search products..."
                        autofocus
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200 text-base text-gray-800"
                    />
                </div>
            </div>

            <!-- Mobile Suggestions List -->
            <div class="max-h-96 overflow-y-auto">
                <template x-for="(suggestion, index) in mobileSuggestions" :key="index">
                    <div
                        @click="selectSuggestion(suggestion); mobileSearchOpen = false"
                        class="px-4 py-4 border-b border-gray-100 last:border-b-0 flex items-center gap-3 hover:bg-blue-50 transition-colors cursor-pointer"
                    >
                        <template x-if="suggestion.image_path">
                            <img
                                :src="'/storage/' + suggestion.image_path"
                                :alt="suggestion.name"
                                class="w-14 h-14 object-cover rounded-lg flex-shrink-0"
                                onerror="this.style.display='none'"
                            />
                        </template>
                        <div class="flex-1 min-w-0">
                            <p class="text-lg font-semibold text-gray-900 truncate" x-text="suggestion.name"></p>
                            <p class="text-base text-gray-600 truncate mt-1" x-text="suggestion.generic_name"></p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-sm px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-medium" x-text="suggestion.type"></span>
                                <span class="text-base text-green-600 font-bold" x-text="'৳ ' + suggestion.price.toFixed(2)"></span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </template>

                <!-- Mobile Loading State -->
                <template x-if="mobileLoading">
                    <div class="px-4 py-8 text-center">
                        <div class="inline-block">
                            <div class="animate-spin rounded-full h-8 w-8 border-4 border-blue-200 border-t-blue-600"></div>
                        </div>
                        <p class="mt-3 text-gray-600 text-sm">Searching...</p>
                    </div>
                </template>

                <!-- Mobile No Results -->
                <template x-if="mobileQuery.length >= 2 && mobileSuggestions.length === 0 && !mobileLoading">
                    <div class="px-4 py-8 text-center text-gray-600">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="font-medium text-gray-800">No products found</p>
                        <p class="text-sm text-gray-500 mt-1">Try searching with different keywords</p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
    function navbarSearch() {
        return {
            // Desktop search
            query: '',
            suggestions: [],
            selectedIndex: -1,
            open: false,
            loading: false,
            debounceTimer: null,

            // Mobile search
            mobileSearchOpen: false,
            mobileQuery: '',
            mobileSuggestions: [],
            mobileLoading: false,
            mobileDebounceTimer: null,

            toggleMobileSearch() {
                this.mobileSearchOpen = !this.mobileSearchOpen;
                this.mobileQuery = '';
                this.mobileSuggestions = [];
                if (this.mobileSearchOpen) {
                    setTimeout(() => {
                        const input = document.querySelector('[autofocus]');
                        if (input) input.focus();
                    }, 100);
                }
            },

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

            handleMobileInput() {
                clearTimeout(this.mobileDebounceTimer);

                if (this.mobileQuery.length < 2) {
                    this.mobileSuggestions = [];
                    return;
                }

                this.mobileLoading = true;
                this.mobileDebounceTimer = setTimeout(() => {
                    this.fetchMobileSuggestions();
                }, 300);
            },

            async fetchSuggestions() {
                try {
                    const response = await fetch(`/search?q=${encodeURIComponent(this.query)}`);
                    const data = await response.json();
                    this.suggestions = data;
                    this.open = this.suggestions.length > 0;
                } catch (error) {
                    console.error('Search error:', error);
                    this.suggestions = [];
                } finally {
                    this.loading = false;
                }
            },

            async fetchMobileSuggestions() {
                try {
                    const response = await fetch(`/search?q=${encodeURIComponent(this.mobileQuery)}`);
                    const data = await response.json();
                    this.mobileSuggestions = data;
                } catch (error) {
                    console.error('Search error:', error);
                    this.mobileSuggestions = [];
                } finally {
                    this.mobileLoading = false;
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
                    this.selectSuggestion(this.suggestions[this.selectedIndex]);
                }
            },

            selectSuggestion(suggestion) {
                window.location.href = suggestion.url;
            },

            performMobileSearch() {
                if (this.mobileSuggestions.length > 0) {
                    this.selectSuggestion(this.mobileSuggestions[0]);
                }
            }
        }
    }
</script>

<style>
    /* Custom scrollbar for suggestions */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }
</style>
