<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/adminsidebar.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="sidebar">
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
                <a href="{{ route('admin.products.create') }}">
                    <i class='bx bx-plus-circle'></i>
                    <span class="links_name">Add Product</span>
                </a>
                <span class="tooltip">Add Product</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Messages</span>
                </a>
                <span class="tooltip">Messages</span>
            </li>
            <li>
                <a href="">
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
        <div style="padding: 20px;">
            <h2 style="font-size: 25px; font-weight: 500; margin: 18px 0; color: #11101D;">
                {{ __('Admin Dashboard') }}
            </h2>
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div style="overflow-x-auto;">
                        <table class="min-w-full divide-y divide-gray-200" style="width: 100%; border-collapse: collapse;">
                            <thead style="background-color: #f5f5f5;">
                                <tr>
                                    <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">ID</th>
                                    <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">Name</th>
                                    <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">Email</th>
                                    <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">Admin</th>
                                    <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">Registered</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr style="border-bottom: 1px solid #e5e5e5;">
                                        <td style="padding: 12px 16px;">{{ $user->id }}</td>
                                        <td style="padding: 12px 16px;">{{ $user->name }}</td>
                                        <td style="padding: 12px 16px;">{{ $user->email }}</td>
                                        <td style="padding: 12px 16px;">{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                                        <td style="padding: 12px 16px;">{{ $user->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    <script defer>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        })

        searchBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        })

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }

        menuBtnChange();
    </script>
</body>
</html>
