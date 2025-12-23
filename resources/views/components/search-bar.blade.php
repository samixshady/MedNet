<div class="w-full max-w-5xl mx-auto px-4 py-8" style="transform: translateX(-190px) translateY(-100px);">
    <!-- Search Bar Container -->
    <div class="relative" x-data="searchBar()" @click.outside="open = false">
        <!-- Category Filter (Optional) -->
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Filter by Category (Optional)</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                <button
                    @click="category = 'all'; query = ''; suggestions = []"
                    :class="category === 'all' ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'"
                    class="px-3 py-2 rounded-lg font-semibold transition-all duration-200 text-sm"
                >
                    All
                </button>
                <button
                    @click="category = 'medicine'; query = ''; suggestions = []"
                    :class="category === 'medicine' ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'"
                    class="px-3 py-2 rounded-lg font-semibold transition-all duration-200 text-sm"
                >
                    💊 Medicine
                </button>
                <button
                    @click="category = 'supplement'; query = ''; suggestions = []"
                    :class="category === 'supplement' ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'"
                    class="px-3 py-2 rounded-lg font-semibold transition-all duration-200 text-sm"
                >
                    🥤 Supplement
                </button>
                <button
                    @click="category = 'first_aid'; query = ''; suggestions = []"
                    :class="category === 'first_aid' ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'"
                    class="px-3 py-2 rounded-lg font-semibold transition-all duration-200 text-sm"
                >
                    🩹 First Aid
                </button>
            </div>
        </div>

        <!-- Input and Button Container -->
        <div class="flex gap-3">
            <!-- Search Input -->
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
                class="flex-1 px-8 py-4 bg-white border-2 border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-400 transition-all duration-200 text-lg text-gray-800 placeholder-gray-500 font-medium"
            />

            <!-- Search Button -->
            <button
                type="button"
                @click="performSearch()"
                class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl active:scale-95 text-lg"
            >
                <span class="hidden sm:inline">Search</span>
                <span class="sm:hidden text-2xl">🔍</span>
            </button>
        </div>

        <!-- Suggestions Dropdown -->
        <div
            x-show="open && suggestions.length > 0"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="absolute top-full left-0 right-0 mt-3 bg-white border-2 border-gray-200 rounded-xl shadow-2xl z-50 max-h-screen overflow-y-auto"
        >
            <!-- Suggestions List -->
            <template x-for="(suggestion, index) in suggestions" :key="index">
                <div
                    @click="selectSuggestion(suggestion)"
                    @mouseenter="selectedIndex = index"
                    :class="selectedIndex === index ? 'bg-blue-100 border-l-4 border-blue-600' : 'hover:bg-gray-50'"
                    class="px-6 py-5 cursor-pointer border-b border-gray-150 last:border-b-0 transition-all duration-150"
                >
                    <div class="flex items-start gap-4">
                        <!-- Product Image (if available) -->
                        <template x-if="suggestion.image_path">
                            <img
                                :src="'/storage/' + suggestion.image_path"
                                :alt="suggestion.name"
                                class="w-20 h-20 object-cover rounded-lg flex-shrink-0 shadow-md"
                                onerror="this.style.display='none'"
                            />
                        </template>

                        <!-- Product Info -->
                        <div class="flex-1 min-w-0">
                            <p class="text-lg font-bold text-gray-900 truncate" x-text="suggestion.name"></p>
                            <p class="text-base text-gray-600 truncate mt-1" x-text="suggestion.generic_name"></p>
                            <div class="flex flex-wrap items-center gap-3 mt-2">
                                <span class="px-3 py-1.5 bg-blue-100 text-blue-800 rounded-full font-semibold text-sm" x-text="suggestion.type"></span>
                                <span class="text-base text-gray-600 font-medium" x-text="suggestion.dosage"></span>
                                <span class="font-bold text-lg text-green-600" x-text="'৳ ' + suggestion.price.toFixed(2)"></span>
                            </div>
                        </div>

                        <!-- Chevron Icon -->
                        <svg class="w-6 h-6 text-gray-400 flex-shrink-0 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </template>

            <!-- Loading State -->
            <template x-if="loading">
                <div class="px-6 py-8 text-center text-gray-600">
                    <div class="inline-block">
                        <div class="animate-spin rounded-full h-8 w-8 border-4 border-blue-200 border-t-blue-600"></div>
                    </div>
                    <p class="mt-3 text-lg font-medium">Searching products...</p>
                </div>
            </template>
        </div>

        <!-- No Results Message -->
        <div
            x-show="open && query.length >= 2 && suggestions.length === 0 && !loading"
            class="absolute top-full left-0 right-0 mt-3 bg-white border-2 border-gray-200 rounded-xl shadow-2xl p-8 text-center text-gray-600 z-50"
        >
            <p class="text-xl font-semibold text-gray-800">No products found</p>
            <p class="mt-2 text-base">Try searching with different keywords</p>
        </div>
    </div>
</div>

<script>
    function searchBar() {
        return {
            query: '',
            suggestions: [],
            selectedIndex: -1,
            open: false,
            loading: false,
            debounceTimer: null,
            category: 'all',

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
                    if (this.category !== 'all') {
                        url += `&category=${this.category}`;
                    }
                    const response = await fetch(url);
                    const data = await response.json();
                    
                    // Filter by category if selected
                    if (this.category !== 'all') {
                        this.suggestions = data.filter(item => {
                            const itemTag = item.type.toLowerCase().replace(' ', '_');
                            return itemTag === this.category;
                        });
                    } else {
                        this.suggestions = data;
                    }
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
                    this.selectSuggestion(this.suggestions[this.selectedIndex]);
                }
            },

            selectSuggestion(suggestion) {
                window.location.href = suggestion.url;
            },

            performSearch() {
                if (this.selectedIndex >= 0 && this.suggestions[this.selectedIndex]) {
                    this.selectSuggestion(this.suggestions[this.selectedIndex]);
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
        background: #ccc;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #888;
    }
</style>
