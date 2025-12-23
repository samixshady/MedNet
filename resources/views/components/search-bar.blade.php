<div class="w-full max-w-md mx-auto px-4 py-8">
    <!-- Search Bar Container -->
    <div class="relative" x-data="searchBar()" @click.outside="open = false">
        <!-- Input and Button Container -->
        <div class="flex gap-2">
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
                class="flex-1 px-5 py-3 bg-white border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all duration-200 text-gray-800 placeholder-gray-500"
            />

            <!-- Search Button -->
            <button
                type="button"
                @click="performSearch()"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-md hover:shadow-lg active:scale-95"
            >
                <span class="hidden sm:inline">Search</span>
                <span class="sm:hidden">🔍</span>
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
            class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50 max-h-96 overflow-y-auto"
        >
            <!-- Suggestions List -->
            <template x-for="(suggestion, index) in suggestions" :key="index">
                <div
                    @click="selectSuggestion(suggestion)"
                    @mouseenter="selectedIndex = index"
                    :class="selectedIndex === index ? 'bg-blue-50' : 'hover:bg-gray-50'"
                    class="px-4 py-3 cursor-pointer border-b border-gray-100 last:border-b-0 transition-colors duration-150"
                >
                    <div class="flex items-start gap-3">
                        <!-- Product Image (if available) -->
                        <template x-if="suggestion.image_path">
                            <img
                                :src="'/storage/' + suggestion.image_path"
                                :alt="suggestion.name"
                                class="w-12 h-12 object-cover rounded-md flex-shrink-0"
                                onerror="this.style.display='none'"
                            />
                        </template>

                        <!-- Product Info -->
                        <div class="flex-1 min-w-0">
                            <p class="text-gray-900 font-semibold truncate" x-text="suggestion.name"></p>
                            <p class="text-sm text-gray-600 truncate" x-text="suggestion.generic_name"></p>
                            <div class="flex items-center gap-2 mt-1 text-xs">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full" x-text="suggestion.type"></span>
                                <span class="text-gray-500" x-text="suggestion.dosage"></span>
                                <span class="font-semibold text-gray-900" x-text="'₱' + suggestion.price"></span>
                            </div>
                        </div>

                        <!-- Chevron Icon -->
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </template>

            <!-- Loading State -->
            <template x-if="loading">
                <div class="px-4 py-3 text-center text-gray-600">
                    <div class="inline-block">
                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-600"></div>
                    </div>
                </div>
            </template>
        </div>

        <!-- No Results Message -->
        <div
            x-show="open && query.length >= 2 && suggestions.length === 0 && !loading"
            class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg p-4 text-center text-gray-600 z-50"
        >
            No products found. Try a different search.
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
                    const response = await fetch(
                        `/search?q=${encodeURIComponent(this.query)}`
                    );
                    const data = await response.json();
                    this.suggestions = data;
                    this.open = data.length > 0;
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
