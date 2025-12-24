<!-- Navbar Search Bar - Elegant & Modern Design -->
<div class="w-full" x-data="navbarSearch()" @click.outside="open = false">
    <!-- Desktop Search (md and above) -->
    <div class="hidden md:block w-full relative">
        <div class="relative group">
            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none transition-colors duration-200 group-hover:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                placeholder="Search medications, health products..."
                class="w-full pl-12 pr-4 py-3 bg-white/95 backdrop-blur-sm border-2 border-slate-300/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 focus:bg-white transition-all duration-300 text-sm text-slate-800 placeholder-slate-500 shadow-lg hover:shadow-xl hover:border-blue-300"
            />
            <!-- Clear button -->
            <button 
                x-show="query.length > 0"
                @click="query = ''; open = false"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 p-1 hover:bg-slate-100 rounded-full transition-all duration-200"
            >
                <svg class="w-4 h-4 text-slate-400 hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Desktop Suggestions Dropdown -->
            <div
                x-show="open && suggestions.length > 0"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                style="z-index: 9999; position: absolute;"
                class="top-full left-0 right-0 mt-3 bg-white rounded-xl shadow-2xl max-h-[28rem] overflow-y-auto border border-slate-200 ring-1 ring-slate-900/5"
            >
                <!-- Desktop Suggestions List -->
                <template x-for="(suggestion, index) in suggestions" :key="index">
                    <div
                        @click="selectSuggestion(suggestion)"
                        @mouseenter="selectedIndex = index"
                        :class="selectedIndex === index ? 'bg-gradient-to-r from-blue-50 to-blue-50/50 border-l-4 border-blue-500 scale-[1.02]' : 'hover:bg-slate-50'"
                        class="px-5 py-4 cursor-pointer border-b border-slate-100/70 last:border-b-0 transition-all duration-200 flex items-center gap-4"
                    >
                        <template x-if="suggestion.image_path">
                            <img
                                :src="'/storage/' + suggestion.image_path"
                                :alt="suggestion.name"
                                class="w-14 h-14 object-cover rounded-lg flex-shrink-0 shadow-md ring-2 ring-slate-100"
                                onerror="this.style.display='none'"
                            />
                        </template>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-900 truncate mb-1" x-text="suggestion.name"></p>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs px-2.5 py-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-full font-medium shadow-sm" x-text="suggestion.type"></span>
                                <span class="text-sm text-green-600 font-bold" x-text="'৳ ' + suggestion.price.toFixed(2)"></span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </template>

                <!-- Desktop Loading State -->
                <template x-if="loading">
                    <div class="px-4 py-8 text-center">
                        <div class="inline-block">
                            <div class="animate-spin rounded-full h-8 w-8 border-4 border-blue-200 border-t-blue-600"></div>
                        </div>
                        <p class="mt-3 text-sm text-slate-600 font-medium">Searching products...</p>
                    </div>
                </template>
            </div>

            <!-- Desktop No Results -->
            <div
                x-show="open && query.length >= 2 && suggestions.length === 0 && !loading"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                style="z-index: 9999; position: absolute;"
                class="top-full left-0 right-0 mt-3 bg-white rounded-xl shadow-2xl p-8 text-center border border-slate-200"
            >
                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-3">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-base font-semibold text-slate-700 mb-1">No products found</p>
                <p class="text-sm text-slate-500">Try searching with different keywords</p>
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
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="mobileSearchOpen = false"
        style="z-index: 9999;"
        class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm md:hidden"
    >
        <div 
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="-translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="-translate-y-full"
            class="bg-gradient-to-b from-white to-slate-50 rounded-b-3xl shadow-2xl"
        >
            <!-- Mobile Search Header -->
            <div class="px-4 py-4 flex items-center gap-3 border-b border-slate-200">
                <button @click="mobileSearchOpen = false" class="p-2.5 hover:bg-slate-100 rounded-xl transition-all duration-200 group">
                    <svg class="w-6 h-6 text-slate-600 group-hover:text-slate-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input
                        type="text"
                        x-model="mobileQuery"
                        @input="handleMobileInput()"
                        @keydown.enter="performMobileSearch()"
                        placeholder="Search medications..."
                        autofocus
                        class="w-full pl-12 pr-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-300 text-base text-slate-800 shadow-sm"
                    />
                    <!-- Clear button for mobile -->
                    <button 
                        x-show="mobileQuery.length > 0"
                        @click="mobileQuery = ''"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 p-1.5 hover:bg-slate-100 rounded-full transition-all duration-200"
                    >
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Suggestions List -->
            <div class="max-h-[70vh] overflow-y-auto">
                <template x-for="(suggestion, index) in mobileSuggestions" :key="index">
                    <div
                        @click="selectSuggestion(suggestion); mobileSearchOpen = false"
                        class="px-4 py-4 border-b border-slate-100 last:border-b-0 flex items-center gap-4 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-50/30 transition-all duration-200 cursor-pointer active:scale-[0.98]"
                    >
                        <template x-if="suggestion.image_path">
                            <img
                                :src="'/storage/' + suggestion.image_path"
                                :alt="suggestion.name"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 shadow-md ring-2 ring-slate-100"
                                onerror="this.style.display='none'"
                            />
                        </template>
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-bold text-slate-900 truncate" x-text="suggestion.name"></p>
                            <p class="text-sm text-slate-600 truncate mt-0.5" x-text="suggestion.generic_name"></p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs px-2.5 py-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-full font-medium shadow-sm" x-text="suggestion.type"></span>
                                <span class="text-sm text-green-600 font-bold" x-text="'৳ ' + suggestion.price.toFixed(2)"></span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </template>

                <!-- Mobile Loading State -->
                <template x-if="mobileLoading">
                    <div class="px-4 py-10 text-center">
                        <div class="inline-block">
                            <div class="animate-spin rounded-full h-10 w-10 border-4 border-blue-200 border-t-blue-600"></div>
                        </div>
                        <p class="mt-4 text-slate-600 font-medium">Searching products...</p>
                    </div>
                </template>

                <!-- Mobile No Results -->
                <template x-if="mobileQuery.length >= 2 && mobileSuggestions.length === 0 && !mobileLoading">
                    <div class="px-4 py-12 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="font-bold text-slate-800 text-lg">No products found</p>
                        <p class="text-sm text-slate-500 mt-2">Try searching with different keywords</p>
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
