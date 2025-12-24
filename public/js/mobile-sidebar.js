/**
 * Mobile Sidebar & Navbar Functionality
 * Only active on mobile devices (max-width: 768px)
 */

document.addEventListener('DOMContentLoaded', function() {
    const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
    const mobileNavOverlay = document.getElementById('mobile-nav-overlay');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const mobileSidebarClose = document.getElementById('mobile-sidebar-close');
    const mobileSidebarCollapse = document.getElementById('mobile-sidebar-collapse');
    const mobileSidebarLinks = document.querySelectorAll('.mobile-sidebar-link');

    // Mobile Navbar elements
    const mobileSearchToggle = document.getElementById('mobile-search-toggle');
    const mobileSearchContainer = document.getElementById('mobile-search-container');
    const mobileSearchInput = document.getElementById('mobile-search-input');
    const mobileSearchClear = document.getElementById('mobile-search-clear');
    const mobileSearchCloseBtn = document.getElementById('mobile-search-close-btn');

    // Restore collapse state from localStorage (mobile only)
    if (window.innerWidth <= 768) {
        const isCollapsed = localStorage.getItem('mobile-sidebar-collapsed') === 'true';
        if (isCollapsed) {
            mobileSidebar?.classList.add('collapsed');
        }
    }

    /**
     * Open Mobile Sidebar
     */
    function openMobileSidebar() {
        mobileSidebar?.classList.add('open');
        mobileNavOverlay?.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    /**
     * Close Mobile Sidebar
     */
    function closeMobileSidebar() {
        mobileSidebar?.classList.remove('open');
        mobileNavOverlay?.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    /**
     * Toggle Mobile Sidebar Collapse
     */
    function toggleMobileSidebarCollapse() {
        mobileSidebar?.classList.toggle('collapsed');
        localStorage.setItem('mobile-sidebar-collapsed', mobileSidebar?.classList.contains('collapsed'));
    }

    /**
     * Toggle Mobile Search Bar
     */
    function toggleMobileSearchBar() {
        mobileSearchBar?.classList.toggle('show');
        mobileSearchBar?.classList.toggle('hidden');
        if (mobileSearchBar?.classList.contains('show')) {
            setTimeout(() => {
                mobileSearchInput?.focus();
            }, 100);
        }
    }

    /**
     * Close Mobile Search Bar
     */
    function closeMobileSearchBar() {
        mobileSearchBar?.classList.add('hidden');
        mobileSearchBar?.classList.remove('show');
    }

    /**
     * Update Cart Badge
     */
    function updateMobileCartBadge() {
        const cartBadge = document.getElementById('mobile-cart-badge');
        if (cartBadge) {
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.count > 0) {
                        cartBadge.textContent = data.count;
                        cartBadge.style.display = 'inline-flex';
                    } else {
                        cartBadge.style.display = 'none';
                    }
                })
                .catch(err => console.log('Cart count fetch error:', err));
        }
    }

    /**
     * Event Listeners - Sidebar
     */
    mobileSidebarToggle?.addEventListener('click', openMobileSidebar);
    mobileSidebarClose?.addEventListener('click', closeMobileSidebar);
    mobileNavOverlay?.addEventListener('click', closeMobileSidebar);
    mobileSidebarCollapse?.addEventListener('click', toggleMobileSidebarCollapse);

    /**
     * Event Listeners - Search Bar
     */
    mobileSearchBtn?.addEventListener('click', toggleMobileSearchBar);
    mobileSearchClose?.addEventListener('click', closeMobileSearchBar);

    /**
     * Close sidebar on link click
     */
    mobileSidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
            closeMobileSidebar();
        });
    });

    /**
     * Close sidebar on resize to desktop
     */
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            closeMobileSidebar();
            closeMobileSearchBar();
        }
    });

    /**
     * Close search bar on Escape key
     */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileSearchBar();
        }
    });

    /**
     * Handle backdrop click
     */
    mobileNavOverlay?.addEventListener('touchmove', function(e) {
        e.preventDefault();
    }, { passive: false });

    /**
     * Update cart badge on page load
     */
    updateMobileCartBadge();
});

