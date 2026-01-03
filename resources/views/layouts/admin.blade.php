<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MedNet') - MedNet</title>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="{{ asset('css/adminsidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- Dark Mode Initialization (Prevent Flash) -->
    <script>
        // Apply dark mode before page renders to prevent flash
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    
    <style>
        /* ========================================
           UNIFIED DROPDOWN MENU SYSTEM
           ======================================== */
        
        /* Dropdown Container */
        .dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), 
                        opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        padding 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            background: rgba(29, 27, 49, 0.6);
            margin: 4px 0 0 0;
            padding: 0;
            list-style: none;
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }
        
        .dark .dropdown-menu {
            background: rgba(31, 41, 55, 0.6);
        }

        .dropdown-menu.active {
            max-height: 300px;
            opacity: 1;
            padding: 8px 0;
            margin-top: 8px;
        }

        .dropdown-menu li {
            margin: 2px 0 !important;
            padding: 0 !important;
            list-style: none !important;
        }

        /* Dropdown Links */
        .dropdown-menu a {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            padding: 12px 16px 12px 50px !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            border-radius: 8px !important;
            color: #cbd5e1 !important;
            text-decoration: none !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
            margin: 0 8px !important;
            position: relative !important;
        }

        .dropdown-menu a::before {
            content: '';
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 6px;
            background: #64748b;
            border-radius: 50%;
            transition: all 0.25s ease;
        }

        .dropdown-menu a:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            padding-left: 55px !important;
            transform: translateX(3px);
        }

        .dropdown-menu a:hover::before {
            background: #a78bfa;
            transform: translateY(-50%) scale(1.3);
        }
        
        .dark .dropdown-menu a {
            color: #d1d5db !important;
        }

        .dark .dropdown-menu a:hover {
            background: rgba(167, 139, 250, 0.15) !important;
            color: #e0d4ff !important;
        }

        .dark .dropdown-menu a:hover::before {
            background: #c4b5fd;
        }

        .dropdown-menu a i {
            font-size: 18px !important;
            height: auto !important;
            min-width: 20px !important;
            line-height: 1 !important;
            opacity: 0.9;
        }

        /* ========================================
           UNIFIED DROPDOWN TOGGLE BUTTONS
           ======================================== */
        
        .sidebar li.menu-item-dropdown {
            position: relative;
            margin: 6px 0;
            padding: 0;
            list-style: none;
        }

        .menu-toggle {
            display: flex;
            align-items: center;
            width: 100%;
            height: 50px;
            padding: 0 14px;
            background: #11101D;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            font-family: "Poppins", sans-serif;
            font-size: 15px;
            font-weight: 400;
            border-radius: 12px;
            position: relative;
        }
        
        .dark .menu-toggle {
            background: #1f2937;
            color: #e5e7eb;
        }

        .menu-toggle:hover {
            background: rgba(255, 255, 255, 0.95);
            color: #11101D;
            transform: translateX(2px);
        }
        
        .dark .menu-toggle:hover {
            background: #374151;
            color: #e0d4ff;
        }

        /* Toggle Icon */
        .menu-toggle i:first-child {
            font-size: 20px;
            height: 50px;
            min-width: 50px;
            line-height: 50px;
            text-align: center;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover i:first-child {
            transform: scale(1.1);
        }

        /* Toggle Text */
        .menu-toggle .links_name {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: left;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }

        .sidebar.open .menu-toggle .links_name {
            opacity: 1;
            pointer-events: auto;
        }

        /* Dropdown Arrow */
        .menu-toggle .dropdown-arrow {
            font-size: 16px;
            height: 50px;
            min-width: 30px;
            line-height: 50px;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
            opacity: 0;
            pointer-events: none;
        }

        .sidebar.open .menu-toggle .dropdown-arrow {
            opacity: 1;
            pointer-events: auto;
        }

        .menu-toggle .dropdown-arrow.rotate {
            transform: rotate(180deg);
        }

        /* Hide dropdowns when sidebar is collapsed */
        .sidebar:not(.open) .dropdown-menu {
            display: none;
        }

        /* ========================================
           REGULAR SIDEBAR LINKS
           ======================================== */
        
        .sidebar li a:not(.menu-toggle):not(.dropdown-menu a) {
            display: flex;
            align-items: center;
            height: 50px;
            width: 100%;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #11101D;
            padding: 0 14px;
            color: #fff;
        }

        .dark .sidebar li a:not(.menu-toggle):not(.dropdown-menu a) {
            background: #1f2937;
            color: #e5e7eb;
        }

        .sidebar li a:not(.menu-toggle):not(.dropdown-menu a):hover {
            background: rgba(255, 255, 255, 0.95);
            color: #11101D;
            transform: translateX(2px);
        }

        .dark .sidebar li a:not(.menu-toggle):not(.dropdown-menu a):hover {
            background: #4c1d95;
            color: #e0d4ff;
        }

        .sidebar li a:not(.menu-toggle):not(.dropdown-menu a) i {
            font-size: 20px;
            height: 50px;
            min-width: 50px;
            line-height: 50px;
            text-align: center;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .sidebar li a:not(.menu-toggle):not(.dropdown-menu a):hover i {
            transform: scale(1.1);
        }

        .sidebar li a:not(.menu-toggle):not(.dropdown-menu a) .links_name {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: left;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }

        .sidebar.open li a:not(.menu-toggle):not(.dropdown-menu a) .links_name {
            opacity: 1;
            pointer-events: auto;
        }

        /* Tooltip positioning */
        .sidebar .tooltip {
            position: absolute;
            left: calc(100% + 15px);
            top: 50%;
            transform: translateY(-50%);
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            padding: 8px 14px;
            background: #1f2937;
            color: white;
            border-radius: 8px;
            font-size: 14px;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .dark .sidebar .tooltip {
            background: #111827;
            color: #e5e7eb;
        }

        .sidebar li:hover .tooltip {
            opacity: 1;
        }

        .sidebar.open .tooltip {
            display: none;
        }

        /* Profile and Logout Section Fixes */
        .sidebar li.profile {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 78px;
            height: 80px;
            padding: 12px 14px;
            background: #1d1b31;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            z-index: 10;
        }

        .dark .sidebar li.profile {
            background: #1f2937;
            border-top-color: rgba(255, 255, 255, 0.05);
        }

        .sidebar.open li.profile {
            width: 280px;
        }

        .sidebar li.profile .profile-details {
            display: flex;
            align-items: center;
            gap: 12px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
            white-space: nowrap;
        }

        .sidebar.open li.profile .profile-details {
            opacity: 1;
            pointer-events: auto;
        }

        .sidebar li.profile img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .sidebar li.profile .name_job {
            flex: 1;
            overflow: hidden;
        }

        .sidebar li.profile .name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dark .sidebar li.profile .name {
            color: #e5e7eb;
        }

        .sidebar li.profile .job {
            font-size: 12px;
            color: #9ca3af;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar li.profile .logout-form {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 78px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1d1b31;
            transition: all 0.3s ease;
        }

        .dark .sidebar li.profile .logout-form {
            background: #1f2937;
        }

        .sidebar.open li.profile .logout-form {
            width: 50px;
            position: relative;
            background: transparent;
        }

        .sidebar li.profile .logout-btn {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-center;
            background: transparent;
            border: none;
            color: #fff;
            font-size: 22px;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .dark .sidebar li.profile .logout-btn {
            color: #e5e7eb;
        }

        .sidebar li.profile .logout-btn:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            transform: scale(1.1);
        }

        .dark .sidebar li.profile .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .sidebar li.profile .logout-btn i {
            font-size: 22px;
            line-height: 1;
        }
    </style>
    @yield('extra-css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    <!-- Home Button -->
    {{-- <a href="{{ url('/') }}" class="fixed top-6 right-6 z-[9999] w-14 h-14 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-full shadow-lg hover:shadow-xl flex items-center justify-center transition-all duration-300 hover:scale-110 group" title="Back to Home">
        <i class='bx bx-home text-2xl group-hover:scale-110 transition-transform'></i>
    </a> --}}

    <div class="sidebar bg-gradient-to-b from-slate-900 to-slate-800 dark:from-gray-950 dark:to-gray-900 transition-colors duration-300" id="adminSidebar">
        <div class="logo-details">
            <div class="logo_name text-white dark:text-purple-300">MedNet</div>
            <i class='bx bx-menu text-white dark:text-purple-300' id="btn"></i>
        </div>
        <ul class="nav-list">
            <!-- Dark Mode Toggle for Admin -->
            <li style="margin: 8px 0;">
                <button 
                    id="adminDarkModeToggle" 
                    class="flex items-center justify-center w-full h-[50px] rounded-xl bg-white/10 hover:bg-white/20 dark:bg-gray-700/50 dark:hover:bg-gray-600/50 transition-all duration-300 border-none cursor-pointer group"
                    style="padding: 0 14px;"
                    aria-label="Toggle Dark Mode"
                >
                    <!-- Sun Icon (Visible in Dark Mode) -->
                    <svg 
                        id="adminSunIcon" 
                        class="w-5 h-5 text-yellow-400 transition-all duration-300 group-hover:rotate-45 group-hover:scale-110 hidden dark:block" 
                        fill="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
                    </svg>
                    
                    <!-- Moon Icon (Visible in Light Mode) -->
                    <svg 
                        id="adminMoonIcon" 
                        class="w-5 h-5 text-blue-300 dark:text-purple-300 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110 block dark:hidden" 
                        fill="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd" />
                    </svg>
                    <span class="links_name text-white dark:text-purple-200 ml-4">Dark Mode</span>
                </button>
                <span class="tooltip bg-gray-900 dark:bg-gray-700 text-white">Toggle Dark Mode</span>
            </li>
            
            <li>
                <i class='bx bx-search text-white dark:text-purple-300'></i>
                <input type="text" placeholder="Search..." class="bg-slate-800 dark:bg-gray-800 text-white dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500">
                <span class="tooltip bg-gray-900 dark:bg-gray-700 text-white">Search</span>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="text-white dark:text-gray-200 hover:bg-white dark:hover:bg-purple-600 hover:text-slate-900 dark:hover:text-white">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip bg-gray-900 dark:bg-gray-700 text-white">Dashboard</span>
            </li>

            <!-- Products Dropdown Menu -->
            <li class="menu-item-dropdown">
                <button class="menu-toggle" onclick="adminToggleDropdown(event, 'products')" type="button" id="productsToggleBtn">
                    <i class='bx bx-package'></i>
                    <span class="links_name">Products</span>
                    <i class='bx bx-chevron-down dropdown-arrow' id="productsArrow"></i>
                </button>
                <span class="tooltip">Products</span>
                <ul class="dropdown-menu" id="productsDropdown">
                    <li>
                        <a href="{{ route('admin.products.create') }}">
                            <i class='bx bx-plus'></i>
                            <span class="links_name">Add Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}">
                            <i class='bx bx-list-ul'></i>
                            <span class="links_name">Modify Products</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Marketing Dropdown Menu -->
            <li class="menu-item-dropdown">
                <button class="menu-toggle" onclick="adminToggleDropdown(event, 'marketing')" type="button" id="marketingToggleBtn">
                    <i class='bx bx-trending-up'></i>
                    <span class="links_name">Marketing</span>
                    <i class='bx bx-chevron-down dropdown-arrow' id="marketingArrow"></i>
                </button>
                <span class="tooltip">Marketing</span>
                <ul class="dropdown-menu" id="marketingDropdown">
                    <li>
                        <a href="{{ route('admin.promotions.index') }}">
                            <i class='bx bx-images'></i>
                            <span class="links_name">Manage Promotions</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Pharmacy Management Dropdown Menu -->
            <li class="menu-item-dropdown">
                <button class="menu-toggle" onclick="adminToggleDropdown(event, 'pharmacy')" type="button" id="pharmacyToggleBtn">
                    <i class='bx bx-store'></i>
                    <span class="links_name">Manage Pharmacy</span>
                    <i class='bx bx-chevron-down dropdown-arrow' id="pharmacyArrow"></i>
                </button>
                <span class="tooltip">Manage Pharmacy</span>
                <ul class="dropdown-menu" id="pharmacyDropdown">
                    <li>
                        <a href="{{ route('admin.pharmacy.index') }}">
                            <i class='bx bx-list-ul'></i>
                            <span class="links_name">List Pharmacy</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pharmacy.create') }}">
                            <i class='bx bx-plus'></i>
                            <span class="links_name">Add Pharmacy</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('admin.users.index') }}" class="text-white dark:text-gray-200 hover:bg-white dark:hover:bg-purple-600 hover:text-slate-900 dark:hover:text-white">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip bg-gray-900 dark:bg-gray-700 text-white">Users</span>
            </li>
            <li>
                <a href="{{ route('admin.support-feedback.index') }}" class="text-white dark:text-gray-200 hover:bg-white dark:hover:bg-purple-600 hover:text-slate-900 dark:hover:text-white">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Messages</span>
                </a>
                <span class="tooltip bg-gray-900 dark:bg-gray-700 text-white">Messages</span>
            </li>
            <li>
                <a href="{{ route('admin.analytics') }}" class="text-white dark:text-gray-200 hover:bg-white dark:hover:bg-purple-600 hover:text-slate-900 dark:hover:text-white">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip bg-gray-900 dark:bg-gray-700 text-white">Analytics</span>
            </li>
            <li>
                <a href="{{ route('admin.prescriptions.index') }}" style="position: relative;" class="text-white dark:text-gray-200 hover:bg-white dark:hover:bg-purple-600 hover:text-slate-900 dark:hover:text-white">
                    <i class='bx bx-file-blank'></i>
                    <span class="links_name">Prescriptions</span>
                    @php
                        $pendingPrescriptions = \App\Models\Order::where('prescription_required', true)
                            ->where('prescription_status', 'pending')
                            ->count();
                    @endphp
                    @if($pendingPrescriptions > 0)
                    <span style="position: absolute; top: 8px; right: 8px; background: #ef4444; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700;">
                        {{ $pendingPrescriptions }}
                    </span>
                    @endif
                </a>
                <span class="tooltip">Prescriptions</span>
            </li>
            <li>
                <a href="" class="text-white dark:text-gray-200 hover:bg-white dark:hover:bg-purple-600 hover:text-slate-900 dark:hover:text-white">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Settings</span>
                </a>
                <span class="tooltip bg-gray-900 dark:bg-gray-700 text-white">Settings</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img src="{{ asset('favicon.ico') }}" alt="profileImg">
                    <div class="name_job">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="job">Administrator</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class='bx bx-log-out'></i>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <section class="home-section bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        @yield('content')
    </section>

    <script>
        // Admin Dark Mode Toggle Functionality
        (function() {
            const adminDarkModeToggle = document.getElementById('adminDarkModeToggle');
            const html = document.documentElement;
            
            if (adminDarkModeToggle) {
                adminDarkModeToggle.addEventListener('click', () => {
                    html.classList.toggle('dark');
                    
                    // Save preference
                    const newTheme = html.classList.contains('dark') ? 'dark' : 'light';
                    localStorage.setItem('theme', newTheme);
                    
                    // Add animation effect
                    adminDarkModeToggle.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        adminDarkModeToggle.style.transform = 'scale(1)';
                    }, 150);
                });
            }
        })();
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize sidebar state from localStorage
            const sidebarState = localStorage.getItem('adminSidebarOpen') === 'true';
            const sidebar = document.getElementById('adminSidebar');
            
            // Restore sidebar state
            if (sidebarState) {
                sidebar.classList.add('open');
            }

            // Restore and auto-open dropdowns based on current page
            const currentPath = window.location.pathname;
            const dropdowns = {
                products: {
                    id: 'productsDropdown',
                    arrow: 'productsArrow',
                    paths: ['/admin/products']
                },
                marketing: {
                    id: 'marketingDropdown',
                    arrow: 'marketingArrow',
                    paths: ['/admin/promotions']
                },
                pharmacy: {
                    id: 'pharmacyDropdown',
                    arrow: 'pharmacyArrow',
                    paths: ['/admin/pharmacy']
                }
            };

            // Check each dropdown
            Object.keys(dropdowns).forEach(key => {
                const dropdown = dropdowns[key];
                const dropdownElement = document.getElementById(dropdown.id);
                const arrowElement = document.getElementById(dropdown.arrow);
                const storageKey = `${key}DropdownOpen`;
                const isStoredOpen = localStorage.getItem(storageKey) === 'true';
                
                // Check if current path matches any of the dropdown paths
                const isCurrentPath = dropdown.paths.some(path => currentPath.includes(path));
                
                if (isCurrentPath || isStoredOpen) {
                    dropdownElement.classList.add('active');
                    arrowElement.classList.add('rotate');
                }
            });

            // Sidebar toggle functionality
            const closeBtn = document.querySelector("#btn");
            const searchBtn = document.querySelector(".bx-search");

            if (closeBtn) {
                closeBtn.addEventListener("click", () => {
                    sidebar.classList.toggle("open");
                    menuBtnChange();
                    localStorage.setItem('adminSidebarOpen', sidebar.classList.contains('open'));
                });
            }

            if (searchBtn) {
                searchBtn.addEventListener("click", () => {
                    sidebar.classList.toggle("open");
                    menuBtnChange();
                    localStorage.setItem('adminSidebarOpen', sidebar.classList.contains('open'));
                });
            }

            function menuBtnChange() {
                if (sidebar.classList.contains("open")) {
                    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
                } else {
                    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
                }
            }
        });

        // Unified dropdown toggle function
        window.adminToggleDropdown = function(event, dropdownName) {
            event.preventDefault();
            event.stopPropagation();
            
            const dropdown = document.getElementById(`${dropdownName}Dropdown`);
            const arrow = document.getElementById(`${dropdownName}Arrow`);
            
            if (!dropdown || !arrow) return;
            
            const isActive = dropdown.classList.contains('active');
            
            dropdown.classList.toggle('active');
            arrow.classList.toggle('rotate');
            
            // Save state
            localStorage.setItem(`${dropdownName}DropdownOpen`, !isActive);
        };
    </script>

    @yield('extra-scripts')
</body>
</html>
