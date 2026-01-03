<nav x-data="{ open: false }" class="bg-gradient-to-r from-slate-800 via-slate-700 to-slate-800 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 backdrop-blur-md shadow-2xl border-b border-slate-600/30 dark:border-gray-700/50 fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
        <div class="flex justify-between items-center h-16">

            <!-- Left: Hamburger Menu (Mobile) + MedNet Logo -->
            <div class="flex items-center gap-1.5 sm:gap-3 flex-shrink-0 overflow-hidden">
                <!-- Hamburger Menu Button (Mobile Only) -->
                <button id="sidebar-toggle" class="md:hidden p-2 bg-white/10 hover:bg-white/20 dark:bg-gray-700/50 dark:hover:bg-gray-600/50 backdrop-blur-sm rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-purple-500/20 group flex-shrink-0" aria-label="Toggle Menu">
                    <div class="hamburger-icon">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </div>
                </button>

                <!-- MedNet Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-1 sm:gap-2 group flex-shrink-0 overflow-hidden">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-purple-500 dark:to-purple-600 p-1 sm:p-2 rounded-lg sm:rounded-xl shadow-lg group-hover:shadow-blue-500/50 dark:group-hover:shadow-purple-500/50 transition-shadow duration-300 flex-shrink-0">
                        <a href="{{ route('prescription.index') }}" title="My Prescriptions">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white transition-transform duration-300 group-hover:rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </a>
                    </div>
                    <h2 class="hidden xs:block font-bold text-xs xs:text-sm sm:text-2xl bg-gradient-to-r from-blue-400 via-blue-300 to-blue-400 dark:from-purple-400 dark:via-purple-300 dark:to-purple-400 bg-clip-text text-transparent leading-none tracking-tight group-hover:opacity-90 transition-opacity duration-300 whitespace-nowrap mednet-mobile-mobile">
                        {{ __('MedNet') }}
                    </h2>
                </a>
            </div>

            <!-- Center: Search Bar (Desktop) -->
            <div class="hidden md:flex flex-1 max-w-2xl mx-6">
                <x-navbar-search />
            </div>

            <!-- Right Section: Dark Mode, Delivery, Cart, Profile -->
            <div class="flex items-center gap-1.5 sm:gap-2 lg:gap-4 flex-shrink-0">
                
                <!-- Dark Mode Toggle -->
                <x-dark-mode-toggle />
                
                <!-- Delivery Location (Desktop) -->
                <div class="hidden lg:block">
                    <div class="group relative">
                        <button onclick="toggleMap()" class="flex items-center gap-2 px-4 py-2.5 bg-white/10 hover:bg-white/20 dark:bg-gray-700/50 dark:hover:bg-gray-600/50 backdrop-blur-sm border border-white/20 dark:border-gray-600/30 rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-purple-500/20">
                            <svg class="w-5 h-5 text-blue-400 dark:text-purple-400 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"></path>
                            </svg>
                            <div class="text-left">
                                <div class="text-xs text-blue-300 dark:text-purple-300 font-medium">Deliver to</div>
                                <div id="current-location" class="text-sm font-bold text-white truncate max-w-[100px]">Dhaka</div>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Search Icon (Mobile) -->
                <div class="md:hidden flex-shrink-0">
                    <x-navbar-search />
                </div>

                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative group p-2 sm:p-2.5 bg-white/10 hover:bg-white/20 dark:bg-gray-700/50 dark:hover:bg-gray-600/50 backdrop-blur-sm rounded-lg sm:rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-purple-500/20 flex-shrink-0">
                    <svg class="w-5 h-5 text-white transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="absolute -top-1 -right-1 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-bold text-white bg-gradient-to-r from-red-500 to-red-600 dark:from-pink-500 dark:to-pink-600 rounded-full shadow-lg" id="cart-badge" style="display: none;">0</span>
                </a>

                <!-- User Profile Dropdown (Desktop) -->
                <div class="hidden sm:block flex-shrink-0">
                    <x-dropdown align="right" width="48" contentClasses="py-1 bg-white sm:w-48 w-11/12 max-w-xs">
                        <x-slot name="trigger">
                            <button class="group flex items-center gap-1.5 sm:gap-2 px-2 sm:px-3 lg:px-4 py-2 sm:py-2.5 bg-white/10 hover:bg-white/20 dark:bg-gray-700/50 dark:hover:bg-gray-600/50 backdrop-blur-sm border border-white/20 dark:border-gray-600/30 rounded-lg sm:rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-purple-500/20">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-purple-400 dark:to-purple-600 flex items-center justify-center text-white font-bold text-xs sm:text-sm shadow-lg flex-shrink-0">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden lg:block text-white font-medium text-sm truncate max-w-[100px]">{{ Str::limit(Auth::user()->name, 12) }}</span>
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white transition-transform duration-300 group-hover:rotate-180 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
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

                            <x-dropdown-link :href="route('prescription.index')">
                                {{ __('My Prescriptions') }}
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
                    <label class="hamburger">
                        <input type="checkbox" @change="open = $event.target.checked">
                        <svg viewBox="0 0 32 32">
                            <path class="line line-top-bottom" d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"></path>
                            <path class="line" d="M7 16 27 16"></path>
                        </svg>
                    </label>
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
        class="sm:hidden bg-gradient-to-b from-slate-800 to-slate-900 dark:from-gray-900 dark:to-black border-t border-slate-600/30 dark:border-gray-700/50 shadow-2xl"
        style="display: none;"
    >
        <!-- Mobile User Profile Section -->
        <div class="px-4 py-5 border-b border-slate-700/50 dark:border-gray-700/50">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-purple-400 dark:to-purple-600 flex items-center justify-center text-white font-bold text-lg sm:text-xl shadow-lg ring-4 ring-blue-500/30 dark:ring-purple-500/30">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-base sm:text-lg text-white truncate">{{ Auth::user()->name }}</div>
                    <div class="text-blue-300 dark:text-purple-300 text-xs sm:text-sm truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>

        <!-- Mobile Delivery Location -->
        <div class="px-4 py-4 border-b border-slate-700/50 dark:border-gray-700/50 hidden">
            <button onclick="toggleMap()" class="w-full flex items-center justify-between p-3 bg-white/5 hover:bg-white/10 dark:bg-gray-800/50 dark:hover:bg-gray-700/50 rounded-xl transition-all duration-300 group">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-500/20 dark:bg-purple-500/20 rounded-lg group-hover:bg-blue-500/30 dark:group-hover:bg-purple-500/30 transition-all duration-300">
                        <svg class="w-5 h-5 text-blue-400 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-xs text-blue-300 dark:text-purple-300 font-medium">Delivering to</div>
                        <div id="current-location-mobile" class="text-sm font-bold text-white">Dhaka</div>
                    </div>
                </div>
                <svg class="w-5 h-5 text-blue-400 dark:text-purple-400 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation Links -->
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 text-white hover:bg-white/10 dark:hover:bg-gray-700/50 rounded-xl transition-all duration-200 group">
                <svg class="w-5 h-5 text-blue-400 dark:text-purple-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="font-medium">{{ __('Profile') }}</span>
            </a>

            <a href="{{ route('profile.addresses') }}" class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 text-white hover:bg-white/10 dark:hover:bg-gray-700/50 rounded-xl transition-all duration-200 group">
                <svg class="w-5 h-5 text-blue-400 dark:text-purple-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-medium">{{ __('Addresses') }}</span>
            </a>

            <a href="{{ route('profile.orders') }}" class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 text-white hover:bg-white/10 dark:hover:bg-gray-700/50 rounded-xl transition-all duration-200 group">
                <svg class="w-5 h-5 text-blue-400 dark:text-purple-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="font-medium">{{ __('View Orders') }}</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 text-red-300 hover:bg-red-500/10 dark:hover:bg-pink-500/10 rounded-xl transition-all duration-200 group">
                    <svg class="w-5 h-5 text-red-400 dark:text-pink-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">{{ __('Log Out') }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Keep your same map + JS -->
    <div id="delivery-map-root" class="hidden lg:block"></div>

    <script>
        function toggleMap() {
            // Only work on desktop
            if (window.innerWidth < 1024) return;
            
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

    <style>
                /* SVG Hamburger Menu */
                .hamburger {
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 0.5rem;
                }

                .hamburger input {
                    display: none;
                }

                .hamburger svg {
                    /* The size of the SVG defines the overall size */
                    height: 2rem;
                    width: 2rem;
                    /* Define the transition for transforming the SVG */
                    transition: transform 600ms cubic-bezier(0.4, 0, 0.2, 1);
                }

                .line {
                    fill: none;
                    stroke: white;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                    stroke-width: 3;
                    /* Define the transition for transforming the Stroke */
                    transition: stroke-dasharray 600ms cubic-bezier(0.4, 0, 0.2, 1),
                                stroke-dashoffset 600ms cubic-bezier(0.4, 0, 0.2, 1);
                }

                .line-top-bottom {
                    stroke-dasharray: 12 63;
                }

                .hamburger input:checked + svg {
                    transform: rotate(-45deg);
                }

                .hamburger input:checked + svg .line-top-bottom {
                    stroke-dasharray: 20 300;
                    stroke-dashoffset: -32.42;
                }

                /* Responsive dropdown for mobile profile menu */
                @media (max-width: 639px) {
                    .dropdown-menu-mobile {
                        width: 96vw !important;
                        max-width: 360px !important;
                        left: 2vw !important;
                        right: 2vw !important;
                    }
                }
        /* Custom breakpoint for extra small devices */
        @media (min-width: 380px) {
            .hidden.xs\:block {
                display: block;
            }
        }

        /* Mobile MedNet text optimization */
        .mednet-mobile-mobile {
            display: block;
            font-size: 1.1rem;
            line-height: 1.1;
            letter-spacing: -0.01em;
        }
        @media (min-width: 380px) {
            .mednet-mobile-mobile {
                font-size: 1.25rem;
            }
        }
        @media (min-width: 640px) {
            .mednet-mobile-mobile {
                font-size: 1.5rem;
                letter-spacing: -0.025em;
            }
        }
    </style>
</nav>