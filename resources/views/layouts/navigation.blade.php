<nav x-data="{ open: false }" class="shadow-lg border-b border-gray-200 fixed top-0 left-0 right-0 z-40" style="background-color: #37404f;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Left: MedNet (same font/style as your original) -->
            <div class="flex-shrink-0">
                <h2 class="font-semibold text-xl text-white leading-tight mednet-text">
                    {{ __('MedNet') }}
                </h2>
            </div>

            <!-- Center: Search Bar (Hidden on Mobile) -->
            <x-navbar-search />

            <!-- Center: Delivery -->
            <div class="hidden lg:flex flex-1 justify-center">
                <div class="bg-blue-50 px-5 py-2 rounded-xl flex flex-col items-center border border-blue-200 shadow-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-700 text-sm font-semibold uppercase tracking-wide">
                            Delivering To
                        </span>

                        <button onclick="toggleMap()" class="p-2 rounded-full bg-white hover:bg-blue-600 hover:text-white shadow transition">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"
                                      fill="currentColor"/>
                            </svg>
                        </button>
                    </div>

                    <span id="current-location"
                          class="text-xl font-bold text-blue-700 cursor-pointer"
                          onclick="toggleMap()">
                        Dhaka
                    </span>
                </div>
            </div>

            <!-- Right: Profile -->
            <div class="hidden sm:flex sm:items-center gap-4">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative p-2 bg-white hover:bg-gray-100 rounded-full shadow transition" title="Shopping Cart">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-blue-600 rounded-full" id="cart-badge" style="display: none;">0</span>
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl shadow transition text-gray-700 font-semibold">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586
                                      l3.293-3.293a1 1 0 111.414 1.414l-4 4a1
                                      1 0 01-1.414 0l-4-4a1 1 0
                                      010-1.414z"/>
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

            <!-- Mobile Hamburger -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open"
                        class="p-2 rounded-lg text-gray-600 hover:bg-gray-200 transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'block': ! open}"
                              class="block"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'block': open}"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Panel -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t shadow-md">

        <!-- Mobile Delivery -->
        <div class="px-6 py-4 flex items-center justify-between">
            <div>
                <p class="text-gray-700 font-bold text-lg">Delivering To</p>
                <p id="current-location-mobile"
                   onclick="toggleMap()"
                   class="text-blue-700 font-extrabold text-xl cursor-pointer">
                    Dhaka
                </p>
            </div>

            <button onclick="toggleMap()" class="p-2 bg-blue-100 hover:bg-blue-600 hover:text-white rounded-full transition shadow">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                          d="M12 2C8.13 2 5 5.13 5 9C5
                          14.25 12 22 12 22C12 22 19
                          14.25 19 9C19 5.13 15.87 2 12
                          2ZM12 11.5C10.62 11.5 9.5
                          10.38 9.5 9C9.5 7.62 10.62
                          6.5 12 6.5C13.38 6.5 14.5
                          7.62 14.5 9C14.5 10.38
                          13.38 11.5 12 11.5Z"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Profile -->
        <div class="border-t px-6 py-4">
            <div class="font-bold text-lg text-gray-800">{{ Auth::user()->name }}</div>
            <div class="text-gray-500 text-sm">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-2">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.addresses')">
                    {{ __('Addresses') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.orders')">
                    {{ __('View Orders') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                           this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
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