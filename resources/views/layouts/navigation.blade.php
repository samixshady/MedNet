<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left Section - MedNet Logo -->
            <div class="flex-shrink-0">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mednet-text">
                    {{ __('MedNet') }}
                </h2>
            </div>

            <!-- Center Section - Delivery Location -->
            <div class="flex-1 flex items-center" style="margin-left: 40px;">
                <div class="delivery-info">
                    <div class="delivery-text">
                        <div class="delivery-row">
                            <span class="delivery-label">Delivering To</span>
                            <button class="map-toggle-btn" onclick="toggleMap()" title="Toggle Map">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" fill="currentColor"/>
                                </svg>
                            </button>
                        </div>
                        <span class="delivery-location" id="current-location" onclick="toggleMap()" style="cursor: pointer;">Dhaka</span>
                    </div>
                </div>
            </div>

            <!-- Right Section - Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center flex-shrink-0">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Mobile Delivery Location -->
            <div class="px-4 py-2">
                <div class="delivery-info">
                    <span class="delivery-label">Delivering To</span>
                    <span class="delivery-location" id="current-location-mobile" onclick="toggleMap()" style="cursor: pointer;">Dhaka</span>
                    <button class="map-toggle-btn" onclick="toggleMap()" title="Toggle Map">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
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

    <!-- Delivery Location Styles -->
    <style>
        .delivery-info {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .delivery-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        
        .delivery-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .delivery-label {
            font-size: 20px;
            font-weight: 600;
            color: #191818;
        }
        
        .delivery-location {
            font-size: 20px;
            font-weight: 900;
            color: #BF4408;
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 800px;
        }
        
        .map-toggle-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #BF4408;
            padding: 4px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .map-toggle-btn:hover {
            background-color: #BF4408;
            color: white;
        }
        
        /* Profile name styling */
        .text-gray-500 {
            font-size: 20px !important;
            font-weight: 600;
        }
        
        #delivery-map-root {
            position: fixed;
            top: 80px;
            right: 24px;
            z-index: 100;
        }
    </style>

    <!-- React root for map -->
    <div id="delivery-map-root"></div>
    
    <script>
        function toggleMap() {
            const mapRoot = document.getElementById('delivery-map-root');
            if (mapRoot.style.display === 'none') {
                mapRoot.style.display = 'block';
            } else {
                mapRoot.style.display = 'none';
            }
        }
        
        // Update location from React component
        window.updateDeliveryLocation = function(location) {
            document.getElementById('current-location').textContent = location;
            document.getElementById('current-location-mobile').textContent = location;
        };
        
        // Load saved location
        document.addEventListener('DOMContentLoaded', function() {
            const savedLocation = localStorage.getItem('mednet_delivery_location');
            if (savedLocation) {
                document.getElementById('current-location').textContent = savedLocation;
                document.getElementById('current-location-mobile').textContent = savedLocation;
            }
        });
    </script>
</nav>