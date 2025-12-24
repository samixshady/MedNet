<!-- Mobile Sidebar (Collapsible) -->
<aside class="mobile-sidebar" id="mobile-sidebar">
    <!-- Close Button -->
    <button id="mobile-sidebar-close" class="mobile-sidebar-close">
        <i class='bx bx-x text-2xl'></i>
    </button>

    <!-- Header -->
    <div class="mobile-sidebar-header">
        <div class="mobile-sidebar-title">
            <i class='bx bx-grid'></i>
            <span>Categories</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mobile-sidebar-nav">
        <ul class="mobile-sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="mobile-sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class='bx bx-home'></i>
                    <span>Homepage</span>
                </a>
            </li>
            <li>
                <a href="{{ route('medicine') }}" class="mobile-sidebar-link {{ request()->routeIs('medicine') || request()->routeIs('medicine.show') ? 'active' : '' }}">
                    <i class='bx bx-capsule'></i>
                    <span>Medicine</span>
                </a>
            </li>
            <li>
                <a href="{{ route('supplements') }}" class="mobile-sidebar-link {{ request()->routeIs('supplements') || request()->routeIs('supplements.show') ? 'active' : '' }}">
                    <i class='bx bx-leaf'></i>
                    <span>Supplements</span>
                </a>
            </li>
            <li>
                <a href="{{ route('first-aid') }}" class="mobile-sidebar-link {{ request()->routeIs('first-aid') || request()->routeIs('first-aid.show') ? 'active' : '' }}">
                    <i class='bx bx-plus-medical'></i>
                    <span>First Aid</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Collapse Toggle Button -->
    <button id="mobile-sidebar-collapse" class="mobile-sidebar-collapse-btn">
        <i class='bx bx-chevron-left'></i>
    </button>

    <!-- Footer -->
    <div class="mobile-sidebar-footer">
        <p class="mobile-sidebar-footer-text">MedNet Online Pharmacy</p>
        <p class="mobile-sidebar-footer-subtext">Your trusted health partner</p>
    </div>
</aside>
