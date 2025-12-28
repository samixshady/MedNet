<!-- Overlay for Mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm md:hidden hidden z-30 transition-all duration-300"></div>

<!-- Sidebar -->
<aside class="header sidebar-new" id="sidebar">
    <!-- Close Button for Mobile -->
    <button id="sidebar-close" class="md:hidden absolute top-5 right-5 p-1.5 rounded-lg bg-red-500/10 hover:bg-red-500 border border-red-500/30 hover:border-red-500 transition-all duration-300 text-red-500 hover:text-white group">
        <svg class="w-6 h-6 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Header -->
    <div class="sidebar-header">
        <div class="sidebar-title">
            <i class='bx bx-grid'></i>
            <span>Categories</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class='bx bx-home'></i>
                    <span>Homepage</span>
                </a>
            </li>
            <li>
                <a href="{{ route('medicine') }}" class="sidebar-link {{ request()->routeIs('medicine') || request()->routeIs('medicine.show') ? 'active' : '' }}">
                    <i class='bx bx-capsule'></i>
                    <span>Medicine</span>
                </a>
            </li>
            <li>
                <a href="{{ route('supplements') }}" class="sidebar-link {{ request()->routeIs('supplements') || request()->routeIs('supplements.show') ? 'active' : '' }}">
                    <i class='bx bx-leaf'></i>
                    <span>Supplements</span>
                </a>
            </li>
            <li>
                <a href="{{ route('first-aid') }}" class="sidebar-link {{ request()->routeIs('first-aid') || request()->routeIs('first-aid.show') ? 'active' : '' }}">
                    <i class='bx bx-plus-medical'></i>
                    <span>First Aid</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer -->
    <div class="sidebar-footer">
        <p class="sidebar-footer-text">MedNet</p>
        <p class="sidebar-footer-subtext">Made by <a href="https://github.com/samixshady" target="_blank" rel="noopener noreferrer" class="underline text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 transition">samixshady</a></p>
    </div>
</aside>

<style>
    /* Hamburger Menu Animation */
    .hamburger-icon {
        width: 24px;
        height: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        cursor: pointer;
    }

    .hamburger-line {
        width: 100%;
        height: 3px;
        background-color: white;
        border-radius: 2px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    #sidebar-toggle:hover .hamburger-line:nth-child(1) {
        transform: translateY(-2px);
    }

    #sidebar-toggle:hover .hamburger-line:nth-child(3) {
        transform: translateY(2px);
    }

    #sidebar-toggle.active .hamburger-line:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    #sidebar-toggle.active .hamburger-line:nth-child(2) {
        opacity: 0;
        transform: scaleX(0);
    }

    #sidebar-toggle.active .hamburger-line:nth-child(3) {
        transform: translateY(-10px) rotate(-45deg);
    }

    /* Sidebar Styling */
    .sidebar-new {
        background: linear-gradient(180deg, #37404f 0%, #2c3542 100%) !important;
        border-right: 2px solid #1e2530;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3) !important;
        display: flex !important;
        flex-direction: column !important;
        position: fixed !important;
        top: 64px !important;
        left: 0 !important;
        height: calc(100vh - 64px) !important;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        z-index: 40 !important;
    }

    @media (max-width: 768px) {
        .sidebar-new {
            top: 64px !important;
            height: calc(100vh - 64px) !important;
        }
    }

    .sidebar-new.show {
        transform: translateX(0) !important;
    }

    /* Sidebar Header */
    .sidebar-header {
        padding: 24px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 8px;
    }

    .sidebar-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 20px;
        font-weight: 700;
        color: #ffffff;
    }

    .sidebar-title i {
        font-size: 24px;
        color: #60a5fa;
    }

    /* Sidebar Navigation */
    .sidebar-nav {
        flex: 1;
        padding: 16px 12px;
    }

    .sidebar-menu {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .sidebar-menu li {
        margin: 0;
        padding: 0;
    }

    /* Sidebar Links */
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        color: #cbd5e1;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .sidebar-link i {
        font-size: 20px;
        flex-shrink: 0;
        transition: all 0.3s ease;
        color: #94a3b8;
    }

    .sidebar-link:hover {
        background: rgba(96, 165, 250, 0.1);
        color: #ffffff;
        transform: translateX(4px);
    }

    .sidebar-link:hover i {
        color: #60a5fa;
        transform: scale(1.1);
    }

    /* Active Link State */
    .sidebar-link.active {
        background: linear-gradient(90deg, rgba(96, 165, 250, 0.2) 0%, rgba(59, 130, 246, 0.1) 100%);
        color: #ffffff;
        border-left: 3px solid #60a5fa;
        padding-left: 13px;
    }

    .sidebar-link.active i {
        color: #60a5fa;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: auto;
        background: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        margin: 16px 12px;
        text-align: center;
    }

    .sidebar-footer-text {
        font-size: 14px;
        font-weight: 700;
        color: #ffffff;
        margin: 0 0 4px 0;
    }

    .sidebar-footer-subtext {
        font-size: 12px;
        color: #94a3b8;
        margin: 0;
    }

    /* Scrollbar Styling */
    .sidebar-new::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-new::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar-new::-webkit-scrollbar-thumb {
        background: rgba(96, 165, 250, 0.3);
        border-radius: 3px;
    }

    .sidebar-new::-webkit-scrollbar-thumb:hover {
        background: rgba(96, 165, 250, 0.5);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .sidebar-new {
            position: fixed !important;
            left: 0 !important;
            top: 64px !important;
            width: 260px !important;
            height: calc(100vh - 64px) !important;
            transform: translateX(-100%) !important;
            z-index: 1001 !important;
            padding-top: 16px !important;
        }

        #sidebar-overlay {
            z-index: 1000 !important;
        }

        .sidebar-new.show {
            transform: translateX(0) !important;
        }

        .sidebar-header {
            padding: 20px 16px;
            margin-top: 8px;
        }

        .sidebar-title {
            font-size: 19px;
        }
    }

    /* Desktop View */
    @media (min-width: 769px) {
        .sidebar-new {
            width: 240px !important;
        }

        #sidebar-toggle,
        #sidebar-close,
        #sidebar-overlay {
            display: none !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('sidebar-toggle');
        const close = document.getElementById('sidebar-close');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.add('show');
            overlay.classList.remove('hidden');
            toggle.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Add ripple effect
            const ripple = document.createElement('div');
            ripple.style.cssText = 'position: absolute; border-radius: 50%; background: rgba(59, 130, 246, 0.6); width: 100px; height: 100px; margin-top: -50px; margin-left: -50px; animation: ripple 0.6s; pointer-events: none;';
            toggle.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        }

        function closeSidebar() {
            sidebar.classList.remove('show');
            overlay.classList.add('hidden');
            toggle.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        toggle?.addEventListener('click', function(e) {
            if (sidebar.classList.contains('show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        close?.addEventListener('click', function() {
            closeSidebar();
            // Add close animation feedback
            close.style.transform = 'scale(0.8) rotate(90deg)';
            setTimeout(() => {
                close.style.transform = '';
            }, 200);
        });

        overlay?.addEventListener('click', closeSidebar);

        // Close on link click with feedback
        const links = sidebar.querySelectorAll('.sidebar-link');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                if (window.innerWidth < 769) {
                    // Add click feedback
                    link.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        link.style.transform = '';
                        closeSidebar();
                    }, 150);
                }
            });
        });

        // Close on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 769) {
                closeSidebar();
            }
        });
    });

    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            0% {
                transform: scale(0);
                opacity: 1;
            }
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
