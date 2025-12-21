<!-- Mobile Toggle Button -->
<button id="sidebar-toggle" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
    <i class='bx bx-menu text-2xl'></i>
</button>

<!-- Overlay for Mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 md:hidden hidden z-30 transition-opacity duration-300"></div>

<!-- Sidebar -->
<aside class="header sidebar-new" id="sidebar">
    <!-- Close Button for Mobile -->
    <button id="sidebar-close" class="md:hidden absolute top-4 right-4 p-2 rounded-lg hover:bg-gray-700 transition-colors duration-200 text-white">
        <i class='bx bx-x text-2xl'></i>
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
                <a href="#" class="sidebar-link">
                    <i class='bx bx-leaf'></i>
                    <span>Supplements</span>
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <i class='bx bx-plus-medical'></i>
                    <span>First Aid</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer -->
    <div class="sidebar-footer">
        <p class="sidebar-footer-text">MedNet Online Pharmacy</p>
        <p class="sidebar-footer-subtext">Your trusted health partner</p>
    </div>
</aside>

<style>
    /* Sidebar Styling */
    .sidebar-new {
        background-color: #37404f !important;
        border-right: 2px solid #1a252f;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3) !important;
        display: flex !important;
        flex-direction: column !important;
        position: fixed !important;
        top: 64px !important;
        left: 0 !important;
        height: calc(100vh - 64px) !important;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        overflow-y: auto !important;
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
        font-size: 22px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 8px;
    }

    .sidebar-title i {
        font-size: 24px;
        color: #3498db;
    }

    .sidebar-subtitle {
        font-size: 13px;
        color: #95a5a6;
        margin: 0;
        padding-left: 36px;
    }

    /* Sidebar Navigation */
    .sidebar-nav {
        flex: 1;
        padding: 16px 8px;
    }

    .sidebar-menu {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
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
        color: #bdc3c7;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .sidebar-link i {
        font-size: 20px;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .sidebar-link:hover {
        background-color: rgba(52, 152, 219, 0.1);
        color: #3498db;
        padding-left: 20px;
    }

    .sidebar-link:hover i {
        color: #3498db;
        transform: scale(1.1);
    }

    /* Active Link State */
    .sidebar-link.active {
        background: linear-gradient(90deg, #3498db 0%, rgba(52, 152, 219, 0.3) 100%);
        color: #ffffff;
        box-shadow: inset 0 0 10px rgba(52, 152, 219, 0.3);
        border-left: 3px solid #3498db;
        padding-left: 13px;
    }

    .sidebar-link.active i {
        color: #3498db;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: auto;
        background: rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        margin: 16px 8px 16px 8px;
        text-align: center;
    }

    .sidebar-footer-text {
        font-size: 13px;
        font-weight: 600;
        color: #ecf0f1;
        margin: 0;
    }

    .sidebar-footer-subtext {
        font-size: 12px;
        color: #95a5a6;
        margin: 6px 0 0 0;
    }

    /* Scrollbar Styling */
    .sidebar-new::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-new::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar-new::-webkit-scrollbar-thumb {
        background: rgba(52, 152, 219, 0.4);
        border-radius: 3px;
    }

    .sidebar-new::-webkit-scrollbar-thumb:hover {
        background: rgba(52, 152, 219, 0.6);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .sidebar-new {
            position: fixed !important;
            left: 0 !important;
            top: 70px !important;
            width: 250px !important;
            height: calc(100vh - 70px) !important;
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
            font-size: 20px;
        }
    }

    /* Desktop View */
    @media (min-width: 769px) {
        .sidebar-new {
            width: 220px !important;
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
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('show');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        toggle?.addEventListener('click', openSidebar);
        close?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);

        // Close on link click
        const links = sidebar.querySelectorAll('.sidebar-link');
        links.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 769) {
                    closeSidebar();
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
</script>
