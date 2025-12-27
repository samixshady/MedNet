@extends('layouts.admin')

@section('title', 'Products')

@section('extra-css')
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
        
        .dark body {
            background-color: #111827;
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
        
        .dark .products-header {
            background: #1f2937;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .products-header h1 {
            color: #11101D;
            font-size: 28px;
            font-weight: 600;
        }
        
        .dark .products-header h1 {
            color: #f3f4f6;
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
            overflow: auto;
            border: 1px solid #e5e5e5;
        }
        
        .dark .products-table-wrapper {
            background: #1f2937;
            border-color: #374151;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        .products-table thead {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        .dark .products-table thead {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
        }

        .products-table th {
            padding: 12px 10px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: #555;
            border-bottom: 2px solid #d0d0d0;
            border-right: 1px solid #e5e5e5;
            background: linear-gradient(135deg, #f8f9fa 0%, #f0f2f5 100%);
            white-space: nowrap;
        }
        
        .dark .products-table th {
            color: #d1d5db;
            border-bottom-color: #4b5563;
            border-right-color: #374151;
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
        }

        .products-table th:last-child {
            border-right: none;
        }

        .products-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #e5e5e5;
            border-right: 1px solid #f0f0f0;
            color: #333;
            font-size: 13px;
            vertical-align: middle;
        }
        
        .dark .products-table td {
            color: #d1d5db;
            border-bottom-color: #374151;
            border-right-color: #1f2937;
        }

        .products-table td:last-child {
            border-right: none;
        }

        .products-table tbody tr:hover {
            background-color: #f9f9f9;
            transition: all 0.2s ease;
        }
        
        .dark .products-table tbody tr:hover {
            background-color: #374151;
        }

        .products-table tbody tr {
            transition: all 0.2s ease;
        }

        .products-table tbody tr.expired-row {
            background-color: #ffe6e6;
        }
        
        .dark .products-table tbody tr.expired-row {
            background-color: #7f1d1d;
        }

        .products-table tbody tr.expired-row:hover {
            background-color: #ffd9d9;
            border: 1px solid #d32f2f;
        }
        
        .dark .products-table tbody tr.expired-row:hover {
            background-color: #991b1b;
        }

        .expired-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            background: #d32f2f;
            color: white;
        }

        .valid-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            background: #388e3c;
            color: white;
        }

        .sort-controls {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            align-items: center;
        }

        .sort-label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }
        
        .dark .sort-label {
            color: #d1d5db;
        }

        .sort-btn {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
            color: #333;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dark .sort-btn {
            background: #374151;
            color: #d1d5db;
            border-color: #4b5563;
        }

        .sort-btn:hover {
            background: #f5f5f5;
            border-color: #999;
        }
        
        .dark .sort-btn:hover {
            background: #4b5563;
            border-color: #6b7280;
        }

        .sort-btn.active {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border-color: #2980b9;
        }

        .product-image {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 5px;
        }

        .tag {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 11px;
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
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 11px;
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
            padding: 3px 10px;
            border-radius: 5px;
            font-size: 11px;
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

        .original-price {
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }
        
        .dark .original-price {
            color: #9ca3af;
        }

        .discount-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-width: 40px;
            text-align: center;
        }

        .discount-badge.no-discount {
            background: #e8e8e8;
            color: #999;
            font-weight: 600;
        }

        .discounted-price {
            font-weight: 700;
            color: white;
            font-size: 13px;
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            padding: 4px 10px;
            border-radius: 5px;
            display: inline-block;
            min-width: 55px;
            text-align: center;
        }

        .price-comparison {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .btn-edit, .btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .btn-edit {
            background: #e8f4f8;
            color: #3498db;
        }
        
        .dark .btn-edit {
            background: #1e3a5f;
            color: #60a5fa;
        }

        .btn-edit:hover {
            background: #3498db;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(52, 152, 219, 0.25);
            text-decoration: none;
        }
        
        .dark .btn-edit:hover {
            background: #2563eb;
        }

        .btn-delete {
            background: #fce8e8;
            color: #e74c3c;
        }
        
        .dark .btn-delete {
            background: #7f1d1d;
            color: #fca5a5;
        }

        .btn-delete:hover {
            background: #e74c3c;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(231, 76, 60, 0.25);
        }
        
        .dark .btn-delete:hover {
            background: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }
        
        .dark .empty-state {
            color: #6b7280;
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
@endsection

@section('content')
<div class="products-container">
    <div class="products-header">
        <h1>All Products</h1>
        <div style="display: flex; gap: 12px; align-items: center;">
            <a href="{{ route('admin.products.expired') }}" class="add-product-btn" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
                <i class='bx bx-alert-circle'></i> Expired Products
            </a>
            <a href="{{ route('admin.products.create') }}" class="add-product-btn">
                <i class='bx bx-plus'></i> Add New Product
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); padding: 20px; margin-bottom: 20px; border: 1px solid #e5e5e5;">
        <form method="GET" action="{{ route('admin.products.index') }}" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px; position: relative;">
                <input type="text" name="search" placeholder="🔍 Search by product name, generic name, manufacturer, or dosage..." value="{{ $search }}" style="width: 100%; padding: 12px 16px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; transition: all 0.3s ease;" onkeyup="this.style.borderColor = this.value ? '#3498db' : '#ddd';">
            </div>
            <button type="submit" style="padding: 12px 24px; background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; white-space: nowrap;">
                <i class='bx bx-search'></i> Search
            </button>
            @if($search)
            <a href="{{ route('admin.products.index') }}" style="padding: 12px 24px; background: #f0f0f0; color: #333; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                <i class='bx bx-x'></i> Clear
            </a>
            @endif
        </form>
        @if($search)
        <div style="margin-top: 12px; padding: 12px; background: #e8f4f8; border-left: 4px solid #3498db; border-radius: 4px;">
            <p style="margin: 0; color: #333; font-size: 13px;"><strong>Search Results:</strong> Found <span style="color: #3498db; font-weight: 700;">{{ $products->count() }}</span> product(s) matching "<strong>{{ $search }}</strong>"</p>
        </div>
        @endif
    </div>

    @if($products->count() > 0)
                <div style="margin-bottom: 20px;">
                    <div class="sort-controls">
                        <span class="sort-label">Sort by:</span>
                        <a href="{{ route('admin.products.index', ['sort' => 'name']) }}" class="sort-btn {{ $sort === 'name' ? 'active' : '' }}">
                            <i class='bx bx-sort-alt-2'></i> Product Name
                        </a>
                        <a href="{{ route('admin.products.index', ['sort' => 'expiry']) }}" class="sort-btn {{ $sort === 'expiry' ? 'active' : '' }}">
                            <i class='bx bx-calendar'></i> Expiry Date
                        </a>
                    </div>
                </div>

                <div class="products-table-wrapper">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Dosage</th>
                                <th>Manufacturer</th>
                                <th>Original Price</th>
                                <th>Discount</th>
                                <th>Discounted Price</th>
                                <th>Stock Status</th>
                                <th>Status</th>
                                <th>Expiry Date</th>
                                <th>Tag</th>
                                <th>Prescription</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                @php
                                    $isExpired = $product->expiry_date < now();
                                @endphp
                                <tr class="{{ $isExpired ? 'expired-row' : '' }}">
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
                                    <td>{{ $product->dosage }}</td>
                                    <td>{{ $product->manufacturer }}</td>
                                    <td class="original-price">৳{{ number_format($product->price, 2) }}</td>
                                    <td>
                                        @if($product->discount)
                                            <span class="discount-badge">{{ $product->discount }}%</span>
                                        @else
                                            <span class="discount-badge no-discount">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->updated_price && $product->updated_price < $product->price)
                                            <span class="discounted-price">৳{{ number_format($product->updated_price, 2) }}</span>
                                        @else
                                            <span class="original-price">৳{{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="stock-status {{ $product->stock_status }}" style="font-size: 13px; font-weight: 700;">
                                            {{ $product->quantity }} {{ $product->quantity === 1 ? 'unit' : 'units' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="{{ $isExpired ? 'expired-badge' : 'valid-badge' }}">
                                            {{ $isExpired ? 'EXPIRED' : 'Valid' }}
                                        </span>
                                    </td>
                                    <td style="{{ $isExpired ? 'color: #d32f2f; font-weight: 600;' : '' }}">
                                        {{ $product->expiry_date->format('M d, Y') }}
                                    </td>
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
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit" title="Edit Product">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <button type="button" class="btn-delete" title="Delete Product" onclick="deleteProduct({{ $product->id }})">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </div>
                                    </td>
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
    </div>

    <script defer>
        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/products/${productId}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
