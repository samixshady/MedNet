<nav x-data="{ open: false }" class="bg-gradient-to-r from-slate-800 via-slate-700 to-slate-800 backdrop-blur-md shadow-2xl border-b border-slate-600/30 fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6">
        <div class="flex justify-between items-center h-16 lg:h-18">

            <!-- Left: MedNet Logo with elegant styling -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 rounded-xl shadow-lg group-hover:shadow-blue-500/50 transition-shadow duration-300">
                        <svg class="w-6 h-6 text-white transition-transform duration-300 group-hover:rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h2 class="hidden sm:block font-bold text-2xl bg-gradient-to-r from-blue-400 via-blue-300 to-blue-400 bg-clip-text text-transparent leading-tight tracking-tight mednet-text group-hover:opacity-90 transition-opacity duration-300">
                        {{ __('MedNet') }}
                    </h2>
                </a>
            </div>

            <!-- Center: Search Bar (Desktop) -->
            <div class="hidden md:flex flex-1 max-w-2xl mx-6">
                <x-navbar-search />
            </div>

            <!-- Right Section: Delivery, Cart, Profile -->
            <div class="flex items-center gap-2 sm:gap-3 lg:gap-4">
                
                <!-- Delivery Location (Desktop) -->
                <div class="hidden lg:block">
                    <div class="group relative">
                        <button onclick="toggleMap()" class="flex items-center gap-2 px-4 py-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20">
                            <svg class="w-5 h-5 text-blue-400 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"></path>
                            </svg>
                            <div class="text-left">
                                <div class="text-xs text-blue-300 font-medium">Deliver to</div>
                                <div id="current-location" class="text-sm font-bold text-white truncate max-w-[100px]">Dhaka</div>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Search Icon (Mobile) -->
                <button @click="$dispatch('open-mobile-search')" class="md:hidden p-2.5 bg-white/10 hover:bg-white/20 rounded-lg transition-all duration-200 text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative group p-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="absolute -top-1 -right-1 inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-xs font-bold text-white bg-gradient-to-r from-red-500 to-red-600 rounded-full shadow-lg animate-pulse" id="cart-badge" style="display: none;">0</span>
                </a>

                <!-- User Profile Dropdown (Desktop) -->
                <div class="hidden sm:block">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="group flex items-center gap-2 px-3 lg:px-4 py-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden lg:block text-white font-medium text-sm">{{ Str::limit(Auth::user()->name, 15) }}</span>
                                <svg class="w-4 h-4 text-white transition-transform duration-300 group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.addresses')">
                                {{ __('Addresses') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.orders')">
                                {{ __('View Orders') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Mobile Hamburger Menu -->
                <div class="sm:hidden">
                    <button @click="open = ! open" class="p-2 bg-white/10 hover:bg-white/20 rounded-lg transition-all duration-200">
                        <svg class="w-6 h-6 text-white transition-all duration-300" :class="{'rotate-90': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'block': ! open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'block': open, 'hidden': ! open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Panel with smooth animations -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="sm:hidden bg-gradient-to-b from-slate-800 to-slate-900 border-t border-slate-600/30 shadow-2xl"
        style="display: none;"
    >
        <!-- Mobile User Profile Section -->
        <div class="px-4 py-5 border-b border-slate-700/50">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-xl shadow-lg ring-4 ring-blue-500/30">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <div class="font-bold text-lg text-white">{{ Auth::user()->name }}</div>
                    <div class="text-blue-300 text-sm">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>

        <!-- Mobile Delivery Location -->
        <div class="px-4 py-4 border-b border-slate-700/50">
            <button onclick="toggleMap()" class="w-full flex items-center justify-between p-3 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-300 group">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-500/20 rounded-lg group-hover:bg-blue-500/30 transition-all duration-300">
                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-xs text-blue-300 font-medium">Delivering to</div>
                        <div id="current-location-mobile" class="text-sm font-bold text-white">Dhaka</div>
                    </div>
                </div>
                <svg class="w-5 h-5 text-blue-400 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation Links -->
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200 group">
                <svg class="w-5 h-5 text-blue-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="font-medium">{{ __('Profile') }}</span>
            </a>

            <a href="{{ route('profile.addresses') }}" class="flex items-center gap-3 px-4 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200 group">
                <svg class="w-5 h-5 text-blue-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-medium">{{ __('Addresses') }}</span>
            </a>

            <a href="{{ route('profile.orders') }}" class="flex items-center gap-3 px-4 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200 group">
                <svg class="w-5 h-5 text-blue-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="font-medium">{{ __('View Orders') }}</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-300 hover:bg-red-500/10 rounded-xl transition-all duration-200 group">
                    <svg class="w-5 h-5 text-red-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">{{ __('Log Out') }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Keep your same map + JS -->
    <div id="delivery-map-root"></div>

    <script>
        function toggleMap() {
            const mapRoot = document.getElementById('delivery-map-root');
            const mapContainer = mapRoot.querySelector('.delivery-map-container');
            
            if (mapContainer) {
                const isShowing = mapContainer.classList.toggle('show');
                
                // Trigger map resize when becoming visible
                if (isShowing) {
                    setTimeout(function() {
                        const leafletMap = document.querySelector('.openstreetmap-embed');
                        if (leafletMap && leafletMap._leaflet_map) {
                            leafletMap._leaflet_map.invalidateSize();
                        }
                    }, 100);
                }
            }
        }
        
        // Ensure map starts hidden on page load
        document.addEventListener('DOMContentLoaded', function() {
            const mapRoot = document.getElementById('delivery-map-root');
            const mapContainer = mapRoot.querySelector('.delivery-map-container');
            
            if (mapContainer) {
                mapContainer.classList.remove('show');
            }
        });

        window.updateDeliveryLocation = function(location) {
            document.getElementById('current-location').textContent = location;
            document.getElementById('current-location-mobile').textContent = location;
        };

        document.addEventListener('DOMContentLoaded', function() {
            const savedLocation = localStorage.getItem('mednet_delivery_location');
            if (savedLocation) {
                document.getElementById('current-location').textContent = savedLocation;
                document.getElementById('current-location-mobile').textContent = savedLocation;
            }

            // Update cart badge on page load
            updateCartBadge();
        });

        function updateCartBadge() {
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('cart-badge');
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.style.display = 'inline-flex';
                    } else {
                        badge.style.display = 'none';
                    }
                });
        }

        window.updateCartBadge = updateCartBadge;
    </script>
</nav>