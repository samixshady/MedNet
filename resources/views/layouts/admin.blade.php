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
        /* Dropdown Menu Styles */
        .dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            opacity: 0;
            background: #0a0815;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        .dark .dropdown-menu {
            background: #1f2937;
        }

        .dropdown-menu.active {
            max-height: 200px;
            opacity: 1;
            padding: 5px 0;
        }

        .dropdown-menu li {
            margin: 0 !important;
            list-style: none !important;
        }

        .dropdown-menu a {
            padding: 10px 20px 10px 50px !important;
            font-size: 13px !important;
            border-radius: 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            color: #aaa !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
        }

        .dropdown-menu a:hover {
            background: #1d1b31 !important;
            color: #fff !important;
            padding-left: 60px !important;
        }
        
        .dark .dropdown-menu a:hover {
            background: #374151 !important;
            color: #a78bfa !important;
        }

        .dropdown-menu a i {
            font-size: 16px !important;
            height: auto !important;
            min-width: auto !important;
            line-height: 1 !important;
        }

        /* Products Toggle Button - Sidebar Link */
        .sidebar li.products-menu-item {
            position: relative;
            margin: 8px 0;
            padding: 0;
            list-style: none;
        }

        .products-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 50px;
            padding: 0 14px;
            background: #11101D;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-family: "Poppins", sans-serif;
            font-size: 15px;
            border-radius: 12px;
        }
        
        .dark .products-toggle {
            background: #1f2937;
        }

        .products-toggle:hover {
            background: #1d1b31;
            color: #fff;
        }
        
        .dark .products-toggle:hover {
            background: #374151;
            color: #a78bfa;
        }

        .products-toggle i:first-child {
            font-size: 20px;
            height: auto;
            line-height: 1;
            flex-shrink: 0;
        }

        .products-toggle .links_name {
            flex: 1;
            margin: 0 16px;
            whitespace: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: left;
        }

        .products-toggle .dropdown-arrow {
            font-size: 14px;
            transition: transform 0.3s ease;
            flex-shrink: 0;
            line-height: 1;
        }

        .products-toggle .dropdown-arrow.rotate {
            transform: rotate(180deg);
        }

        /* Marketing Toggle Button - Sidebar Link */
        .sidebar li.marketing-menu-item {
            position: relative;
            margin: 8px 0;
            padding: 0;
            list-style: none;
        }

        .marketing-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 50px;
            padding: 0 14px;
            background: #11101D;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-family: "Poppins", sans-serif;
            font-size: 15px;
            border-radius: 12px;
        }
        
        .dark .marketing-toggle {
            background: #1f2937;
        }

        .marketing-toggle:hover {
            background: #1d1b31;
            color: #fff;
        }
        
        .dark .marketing-toggle:hover {
            background: #374151;
            color: #a78bfa;
        }

        .marketing-toggle i:first-child {
            font-size: 20px;
            height: auto;
            line-height: 1;
            flex-shrink: 0;
        }

        .marketing-toggle .links_name {
            flex: 1;
            margin: 0 16px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: left;
        }

        .marketing-toggle .dropdown-arrow {
            font-size: 14px;
            transition: transform 0.3s ease;
            flex-shrink: 0;
            line-height: 1;
        }

        .marketing-toggle .dropdown-arrow.rotate {
            transform: rotate(180deg);
        }

        /* Sidebar link styling for consistency */
        .sidebar li a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 50px;
            width: 100%;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            background: #11101D;
            padding: 0 14px;
            color: #fff;
            gap: 16px;
        }

        .sidebar li a:hover {
            background: #fff;
            color: #11101D;
        }

        .sidebar li a i {
            font-size: 20px;
            height: auto;
            line-height: 1;
            flex-shrink: 0;
        }

        .sidebar li a .links_name {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: left;
        }

        /* Ensure tooltip text doesn't overflow */
        .sidebar .tooltip {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    @yield('extra-css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
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
            <li class="products-menu-item">
                <button class="products-toggle text-white dark:text-gray-200 hover:bg-slate-700 dark:hover:bg-gray-700" onclick="adminToggleProductsMenu(event)" type="button" id="productsToggleBtn">
                    <i class='bx bx-package'></i>
                    <span class="links_name">Products</span>
                    <i class='bx bx-chevron-down dropdown-arrow' id="productsArrow"></i>
                </button>
                <span class="tooltip bg-gray-900 dark:bg-gray-700 text-white">Products</span>
                <ul class="dropdown-menu bg-slate-900 dark:bg-gray-800" id="productsDropdown">
                    <li>
                        <a href="{{ route('admin.products.create') }}" class="text-gray-400 dark:text-gray-300 hover:text-white dark:hover:text-purple-300">
                            <i class='bx bx-plus'></i>
                            <span class="links_name">Add Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="text-gray-400 dark:text-gray-300 hover:text-white dark:hover:text-purple-300">
                            <i class='bx bx-list-ul'></i>
                            <span class="links_name">Modify Products</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Marketing Dropdown Menu -->
            <li class="marketing-menu-item">
                <button class="marketing-toggle text-white dark:text-gray-200 hover:bg-slate-700 dark:hover:bg-gray-700" onclick="adminToggleMarketingMenu(event)" type="button" id="marketingToggleBtn">
                    <i class='bx bx-trending-up'></i>
                    <span class="links_name">Marketing</span>
                    <i class='bx bx-chevron-down dropdown-arrow' id="marketingArrow"></i>
                </button>
                <span class="tooltip bg-gray-900 dark:bg-gray-700 text-white">Marketing</span>
                <ul class="dropdown-menu bg-slate-900 dark:bg-gray-800" id="marketingDropdown">
                    <li>
                        <a href="{{ route('admin.promotions.index') }}" class="text-gray-400 dark:text-gray-300 hover:text-white dark:hover:text-purple-300">
                            <i class='bx bx-images'></i>
                            <span class="links_name">Manage Promotions</span>
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
            <li class="profile bg-slate-800 dark:bg-gray-800 border-t border-slate-700 dark:border-gray-700">
                <div class="profile-details">
                    <img src="{{ asset('favicon.ico') }}" alt="profileImg" class="rounded-full">
                    <div class="name_job">
                        <div class="name text-white dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="job text-gray-400 dark:text-gray-400">Administrator</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-white dark:text-gray-200 hover:text-red-400 dark:hover:text-red-400">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
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
            const productsDropdownState = localStorage.getItem('productsDropdownOpen') === 'true';
            const marketingDropdownState = localStorage.getItem('marketingDropdownOpen') === 'true';
            
            const sidebar = document.getElementById('adminSidebar');
            const productsDropdown = document.getElementById('productsDropdown');
            const marketingDropdown = document.getElementById('marketingDropdown');
            
            // Restore sidebar state
            if (sidebarState) {
                sidebar.classList.add('open');
            }

            // Restore dropdown state on product pages
            const currentPath = window.location.pathname;
            if (currentPath.includes('/admin/products') && productsDropdownState) {
                productsDropdown.classList.add('active');
                document.getElementById('productsArrow').classList.add('rotate');
            } else if (currentPath.includes('/admin/products')) {
                // Always open dropdown on product pages
                productsDropdown.classList.add('active');
                document.getElementById('productsArrow').classList.add('rotate');
            }

            // Restore dropdown state on promotions pages
            if (currentPath.includes('/admin/promotions') && marketingDropdownState) {
                marketingDropdown.classList.add('active');
                document.getElementById('marketingArrow').classList.add('rotate');
            } else if (currentPath.includes('/admin/promotions')) {
                // Always open dropdown on promotions pages
                marketingDropdown.classList.add('active');
                document.getElementById('marketingArrow').classList.add('rotate');
            }

            // Sidebar toggle
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

            // Products dropdown toggle
            window.adminToggleProductsMenu = function(event) {
                event.preventDefault();
                event.stopPropagation();
                
                const dropdown = document.getElementById('productsDropdown');
                const arrow = document.getElementById('productsArrow');
                
                dropdown.classList.toggle('active');
                arrow.classList.toggle('rotate');
                
                // Save state
                localStorage.setItem('productsDropdownOpen', dropdown.classList.contains('active'));
            };

            // Marketing dropdown toggle
            window.adminToggleMarketingMenu = function(event) {
                event.preventDefault();
                event.stopPropagation();
                
                const dropdown = document.getElementById('marketingDropdown');
                const arrow = document.getElementById('marketingArrow');
                
                dropdown.classList.toggle('active');
                arrow.classList.toggle('rotate');
                
                // Save state
                localStorage.setItem('marketingDropdownOpen', dropdown.classList.contains('active'));
            };

            // Close dropdown when a link is clicked
            const dropdownLinks = document.querySelectorAll('#productsDropdown a');
            dropdownLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const dropdown = document.getElementById('productsDropdown');
                    const arrow = document.getElementById('productsArrow');
                    dropdown.classList.remove('active');
                    arrow.classList.remove('rotate');
                    localStorage.setItem('productsDropdownOpen', false);
                });
            });

            // Close marketing dropdown when a link is clicked
            const marketingDropdownLinks = document.querySelectorAll('#marketingDropdown a');
            marketingDropdownLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const dropdown = document.getElementById('marketingDropdown');
                    const arrow = document.getElementById('marketingArrow');
                    dropdown.classList.remove('active');
                    arrow.classList.remove('rotate');
                    localStorage.setItem('marketingDropdownOpen', false);
                });
            });
        });
    </script>

    @yield('extra-scripts')
</body>
</html>
