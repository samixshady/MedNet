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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

        .products-toggle:hover {
            background: #1d1b31;
            color: #fff;
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
            white-space: nowrap;
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

        .marketing-toggle:hover {
            background: #1d1b31;
            color: #fff;
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
<body>
    <div class="sidebar" id="adminSidebar">
        <div class="logo-details">
            <div class="logo_name">MedNet</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>

            <!-- Products Dropdown Menu -->
            <li class="products-menu-item">
                <button class="products-toggle" onclick="adminToggleProductsMenu(event)" type="button" id="productsToggleBtn">
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
            <li class="marketing-menu-item">
                <button class="marketing-toggle" onclick="adminToggleMarketingMenu(event)" type="button" id="marketingToggleBtn">
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

            <li>
                <a href="{{ route('admin.users.index') }}">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>
            <li>
                <a href="{{ route('admin.support-feedback.index') }}">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Messages</span>
                </a>
                <span class="tooltip">Messages</span>
            </li>
            <li>
                <a href="{{ route('admin.analytics') }}">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-folder'></i>
                    <span class="links_name">Files</span>
                </a>
                <span class="tooltip">Files</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Settings</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img src="{{ asset('favicon.ico') }}" alt="profileImg">
                    <div class="name_job">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="job">Administrator</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <section class="home-section">
        @yield('content')
    </section>

    <script>
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
