<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - MedNet</title>
    <link rel="stylesheet" href="{{ asset('css/adminsidebar.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: #e4e9f7;
        }

        .home-section {
            position: relative;
            background: #e4e9f7;
            min-height: 100vh;
            top: 0;
            left: 78px;
            width: calc(100% - 78px);
            transition: all 0.5s ease;
            padding: 20px;
        }

        .sidebar.open ~ .home-section {
            left: 250px;
            width: calc(100% - 250px);
        }

        .products-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .products-header h1 {
            color: #11101D;
            font-size: 28px;
            font-weight: 600;
        }

        .add-product-btn {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .add-product-btn:hover {
            background: linear-gradient(135deg, #2980b9 0%, #1e5f8c 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
        }

        .products-table-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table thead {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .products-table th {
            padding: 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #333;
            border-bottom: 2px solid #e5e5e5;
        }

        .products-table td {
            padding: 16px;
            border-bottom: 1px solid #e5e5e5;
            color: #333;
            font-size: 14px;
        }

        .products-table tr:hover {
            background-color: #f9f9f9;
        }

        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }

        .tag {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .tag.medicine {
            background: #d4edda;
            color: #155724;
        }

        .tag.supplement {
            background: #cce5ff;
            color: #004085;
        }

        .tag.first_aid {
            background: #f8d7da;
            color: #721c24;
        }

        .stock-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .stock-status.normal {
            background: #d4edda;
            color: #155724;
        }

        .stock-status.low_stock {
            background: #fff3cd;
            color: #856404;
        }

        .stock-status.out_of_stock {
            background: #f8d7da;
            color: #721c24;
        }

        .prescription-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .prescription-badge.yes {
            background: #f8d7da;
            color: #721c24;
        }

        .prescription-badge.no {
            background: #d4edda;
            color: #155724;
        }

        .price {
            font-weight: 600;
            color: #27ae60;
            font-size: 15px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state-icon {
            font-size: 60px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        @media (max-width: 1024px) {
            .products-table {
                font-size: 12px;
            }

            .products-table th,
            .products-table td {
                padding: 12px;
            }

            .product-image {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 768px) {
            .products-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .home-section {
                left: 78px;
                width: calc(100% - 78px);
                padding: 10px;
            }

            .sidebar.open ~ .home-section {
                left: 250px;
                width: calc(100% - 250px);
            }
        }
    </style>
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
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="{{ route('admin.products.create') }}">
                    <i class='bx bx-plus-circle'></i>
                    <span class="links_name">Add Product</span>
                </a>
                <span class="tooltip">Add Product</span>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}" style="background: #fff;">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Products</span>
                </a>
                <span class="tooltip">Products</span>
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
        <div class="products-container">
            <div class="products-header">
                <h1>All Products</h1>
                <a href="{{ route('admin.products.create') }}" class="add-product-btn">
                    <i class='bx bx-plus'></i> Add New Product
                </a>
            </div>

            @if($products->count() > 0)
                <div class="products-table-wrapper">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Manufacturer</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Stock Status</th>
                                <th>Expiry Date</th>
                                <th>Tag</th>
                                <th>Prescription</th>
                                <th>Dosage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        @if($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-image">
                                        @else
                                            <div class="product-image" style="background: #ecf0f1; display: flex; align-items: center; justify-content: center;">
                                                <i class='bx bx-image'></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td><strong>{{ $product->name }}</strong></td>
                                    <td>{{ $product->manufacturer }}</td>
                                    <td class="price">₹{{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <span class="stock-status {{ $product->stock_status }}">
                                            {{ ucfirst(str_replace('_', ' ', $product->stock_status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $product->expiry_date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="tag {{ $product->tag }}">
                                            {{ ucfirst(str_replace('_', ' ', $product->tag)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="prescription-badge {{ $product->prescription_required ? 'yes' : 'no' }}">
                                            {{ $product->prescription_required ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td>{{ $product->dosage }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="products-table-wrapper">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class='bx bx-inbox'></i>
                        </div>
                        <p>No products found</p>
                        <a href="{{ route('admin.products.create') }}" class="add-product-btn">
                            <i class='bx bx-plus'></i> Add Your First Product
                        </a>
                    </div>
                </div>
            @endif
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
