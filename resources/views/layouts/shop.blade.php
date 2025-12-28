<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shop Dashboard') - MedNet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- Dark Mode Initialization -->
    <script>
        (function() {
            const theme = localStorage.getItem('shopTheme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        /* Shop Sidebar - Admin Style */
        .shop-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 78px;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            padding: 6px 14px;
            z-index: 1000;
            transition: all 0.5s ease;
        }

        .dark .shop-sidebar {
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
        }

        .shop-sidebar.open {
            width: 280px;
        }

        .shop-sidebar .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .shop-sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            opacity: 0;
            transition: all 0.5s ease;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .shop-sidebar.open .logo-details .logo_name {
            opacity: 1;
        }

        .shop-sidebar .logo-details #btn {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            font-size: 22px;
            text-align: center;
            cursor: pointer;
            transition: all 0.5s ease;
            color: #fff;
        }

        .dark .shop-sidebar .logo-details #btn {
            color: #a78bfa;
        }

        .shop-sidebar .nav-list {
            margin-top: 20px;
            height: calc(100% - 140px);
            overflow-y: auto;
        }

        .shop-sidebar .nav-list::-webkit-scrollbar {
            width: 6px;
        }

        .shop-sidebar .nav-list::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .shop-sidebar li {
            position: relative;
            margin: 8px 0;
            list-style: none;
        }

        .shop-sidebar li a {
            display: flex;
            height: 50px;
            width: 100%;
            border-radius: 12px;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
            background: rgba(255, 255, 255, 0.1);
            padding: 0 14px;
        }

        .shop-sidebar li a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(2px);
        }

        .dark .shop-sidebar li a:hover {
            background: rgba(167, 139, 250, 0.2);
        }

        .shop-sidebar li a.active {
            background: rgba(255, 255, 255, 0.25);
        }

        .dark .shop-sidebar li a.active {
            background: rgba(167, 139, 250, 0.3);
        }

        .shop-sidebar li a i {
            height: 50px;
            min-width: 50px;
            font-size: 20px;
            text-align: center;
            line-height: 50px;
            color: #fff;
        }

        .dark .shop-sidebar li a i {
            color: #d1d5db;
        }

        .shop-sidebar li a .links_name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: 0.4s;
        }

        .dark .shop-sidebar li a .links_name {
            color: #e5e7eb;
        }

        .shop-sidebar.open li a .links_name {
            opacity: 1;
            pointer-events: auto;
        }

        .shop-sidebar li .tooltip {
            position: absolute;
            top: 50%;
            left: calc(100% + 15px);
            transform: translateY(-50%);
            background: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 400;
            opacity: 0;
            white-space: nowrap;
            pointer-events: none;
            transition: 0s;
            color: #11101D;
        }

        .dark .shop-sidebar li .tooltip {
            background: #374151;
            color: #e5e7eb;
        }

        .shop-sidebar li:hover .tooltip {
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
        }

        .shop-sidebar.open li .tooltip {
            display: none;
        }

        /* Dark Mode Toggle Button */
        .shop-sidebar .dark-mode-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 100%;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 8px;
        }

        .shop-sidebar .dark-mode-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .dark .shop-sidebar .dark-mode-toggle:hover {
            background: rgba(167, 139, 250, 0.2);
        }

        .shop-sidebar .dark-mode-toggle svg {
            width: 20px;
            height: 20px;
            color: #fbbf24;
            transition: all 0.3s ease;
        }

        .shop-sidebar .dark-mode-toggle:hover svg {
            transform: rotate(45deg) scale(1.1);
        }

        .dark .shop-sidebar .dark-mode-toggle svg {
            color: #60a5fa;
        }

        /* Profile Section */
        .shop-sidebar li.profile {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 78px;
            height: 80px;
            padding: 12px 14px;
            background: rgba(0, 0, 0, 0.2);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
        }

        .shop-sidebar.open li.profile {
            width: 280px;
        }

        .shop-sidebar li.profile .profile-details {
            display: flex;
            align-items: center;
            gap: 12px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }

        .shop-sidebar.open li.profile .profile-details {
            opacity: 1;
            pointer-events: auto;
        }

        .shop-sidebar li.profile img,
        .shop-sidebar li.profile .avatar-placeholder {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .shop-sidebar li.profile .avatar-placeholder {
            background: rgba(167, 139, 250, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .shop-sidebar li.profile .name_job {
            flex: 1;
            overflow: hidden;
        }

        .shop-sidebar li.profile .name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dark .shop-sidebar li.profile .name {
            color: #e5e7eb;
        }

        .shop-sidebar li.profile .job {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dark .shop-sidebar li.profile .job {
            color: #9ca3af;
        }

        .shop-sidebar li.profile .logout-form {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 78px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .shop-sidebar.open li.profile .logout-form {
            width: 50px;
            position: relative;
            background: transparent;
        }

        .shop-sidebar li.profile .logout-btn {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
            color: #fff;
            font-size: 22px;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .shop-sidebar li.profile .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            transform: scale(1.1);
        }

        /* Main Content */
        .shop-content {
            position: relative;
            background: #f3f4f6;
            min-height: 100vh;
            left: 78px;
            width: calc(100% - 78px);
            transition: all 0.5s ease;
            padding: 24px;
        }

        .dark .shop-content {
            background: #111827;
        }

        .shop-sidebar.open ~ .shop-content {
            left: 280px;
            width: calc(100% - 280px);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .shop-sidebar {
                left: -78px;
            }
            .shop-sidebar.open {
                left: 0;
            }
            .shop-content {
                left: 0;
                width: 100%;
            }
            .shop-sidebar.open ~ .shop-content {
                left: 0;
                width: 100%;
            }
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .dark .mobile-menu-btn {
            background: #1f2937;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">

    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class='bx bx-menu'></i>
    </button>

    <!-- Shop Sidebar -->
    <div class="shop-sidebar" id="shopSidebar">
        <div class="logo-details">
            <span class="logo_name">{{ Auth::guard('pharmacy')->user()->shop_name }}</span>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <!-- Dark Mode Toggle -->
            <li>
                <button class="dark-mode-toggle" id="shopDarkModeToggle" title="Toggle Dark Mode">
                    <!-- Sun Icon (Visible in Dark Mode) -->
                    <svg class="hidden dark:block" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
                    </svg>
                    <!-- Moon Icon (Visible in Light Mode) -->
                    <svg class="block dark:hidden" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd" />
                    </svg>
                </button>
                <span class="tooltip">Toggle Dark Mode</span>
            </li>

            <li>
                <a href="{{ route('shop.dashboard') }}" class="{{ Request::routeIs('shop.dashboard') ? 'active' : '' }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="{{ route('shop.products.index') }}" class="{{ Request::routeIs('shop.products.index') ? 'active' : '' }}">
                    <i class='bx bx-package'></i>
                    <span class="links_name">My Products</span>
                </a>
                <span class="tooltip">My Products</span>
            </li>
            <li>
                <a href="{{ route('shop.products.create') }}" class="{{ Request::routeIs('shop.products.create') ? 'active' : '' }}">
                    <i class='bx bx-plus-circle'></i>
                    <span class="links_name">Add Product</span>
                </a>
                <span class="tooltip">Add Product</span>
            </li>

            <li class="profile">
                <div class="profile-details">
                    <div class="avatar-placeholder">
                        <i class='bx bx-user'></i>
                    </div>
                    <div class="name_job">
                        <div class="name">{{ Auth::guard('pharmacy')->user()->owner_name }}</div>
                        <div class="job">Pharmacy Owner</div>
                    </div>
                </div>
                <form action="{{ route('shop.logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class='bx bx-log-out'></i>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <section class="shop-content">
        @yield('content')
    </section>

    <script>
        // Dark Mode Toggle
        (function() {
            const darkModeToggle = document.getElementById('shopDarkModeToggle');
            const html = document.documentElement;
            
            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', () => {
                    html.classList.toggle('dark');
                    const newTheme = html.classList.contains('dark') ? 'dark' : 'light';
                    localStorage.setItem('shopTheme', newTheme);
                    
                    darkModeToggle.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        darkModeToggle.style.transform = 'scale(1)';
                    }, 150);
                });
            }
        })();

        // Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('shopSidebar');
            const sidebarState = localStorage.getItem('shopSidebarOpen') === 'true';
            
            if (sidebarState) {
                sidebar.classList.add('open');
            }

            const closeBtn = document.querySelector("#btn");
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');

            function toggleSidebar() {
                sidebar.classList.toggle("open");
                localStorage.setItem('shopSidebarOpen', sidebar.classList.contains('open'));
                
                if (closeBtn) {
                    if (sidebar.classList.contains("open")) {
                        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
                    } else {
                        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
                    }
                }
            }

            if (closeBtn) {
                closeBtn.addEventListener("click", toggleSidebar);
            }

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener("click", toggleSidebar);
            }

            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                        sidebar.classList.remove('open');
                    }
                }
            });
        });
    </script>
    @yield('extra-scripts')
</body>
</html>
