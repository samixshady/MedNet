<!-- Mobile Navigation Bar -->
<nav class="mobile-navbar">
    <div class="mobile-navbar-container">
        <!-- Left: Toggle Button -->
        <button id="mobile-sidebar-toggle" class="mobile-navbar-toggle">
            <i class='bx bx-menu text-2xl'></i>
        </button>

        <!-- Center: MedNet Logo -->
        <div class="mobile-navbar-logo">
            <h2 class="mobile-navbar-text">MedNet</h2>
        </div>

        <!-- Right: Search & Icons -->
        <div class="mobile-navbar-icons">
            <!-- Search Button -->
            <button class="mobile-navbar-search-btn" id="mobile-search-toggle">
                <i class='bx bx-search text-xl'></i>
            </button>

            <!-- Cart Icon -->
            <a href="{{ route('cart.index') }}" class="mobile-navbar-cart">
                <i class='bx bx-shopping-bag text-xl'></i>
                <span class="mobile-cart-badge" id="mobile-cart-badge" style="display: none;">0</span>
            </a>
        </div>
    </div>

    <!-- Mobile Search Bar (Compact Expandable) -->
    <div class="mobile-search-container hidden" id="mobile-search-container">
        <div class="mobile-search-wrapper">
            <i class='bx bx-search mobile-search-icon'></i>
            <input 
                type="text" 
                id="mobile-search-input" 
                placeholder="Search medicines..." 
                class="mobile-search-input" 
                autocomplete="off"
            />
            <button class="mobile-search-clear" id="mobile-search-clear" style="display: none;">
                <i class='bx bx-x text-lg'></i>
            </button>
            <button class="mobile-search-close" id="mobile-search-close-btn">
                <i class='bx bx-x text-lg'></i>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Navigation Overlay -->
<div id="mobile-nav-overlay" class="md:hidden fixed inset-0 bg-black bg-opacity-50 hidden z-30 transition-opacity duration-300"></div>

