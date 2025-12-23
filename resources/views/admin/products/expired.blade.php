@extends('layouts.admin')

@section('title', 'Expired Products')

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
        max-width: 1200px;
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

    .back-btn {
        background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
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

    .back-btn:hover {
        background: linear-gradient(135deg, #7f8c8d 0%, #5d6d7b 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(127, 140, 141, 0.4);
    }

    .products-table-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: auto;
        border: 1px solid #e5e5e5;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
    }

    .products-table thead {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
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

    .products-table td:last-child {
        border-right: none;
    }

    .products-table tbody tr {
        background-color: #fff7f7;
        transition: all 0.2s ease;
    }

    .products-table tbody tr:hover {
        background-color: #ffe8e8;
        transition: all 0.2s ease;
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

    .action-buttons {
        display: flex;
        gap: 6px;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    .btn-delete {
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
        background: #fce8e8;
        color: #e74c3c;
    }

    .btn-delete:hover {
        background: #e74c3c;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(231, 76, 60, 0.25);
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

    .sort-btn:hover {
        background: #f5f5f5;
        border-color: #999;
    }

    .sort-btn.active {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        border-color: #c0392b;
    }

    .expired-warning {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 16px;
        border-radius: 6px;
        margin-bottom: 20px;
        color: #856404;
        font-size: 14px;
    }

    @media (max-width: 1024px) {
        .products-table {
            font-size: 12px;
        }

        .products-table th,
        .products-table td {
            padding: 10px 8px;
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
        <h1>Expired Products</h1>
        <a href="{{ route('admin.products.index') }}" class="back-btn">
            <i class='bx bx-arrow-back'></i> Back to Products
        </a>
    </div>

    @if($products->count() > 0)
        <div class="expired-warning">
            <i class='bx bx-alert-triangle'></i> 
            <strong>{{ $products->count() }} expired product(s)</strong> - These items should be removed from inventory as they have passed their expiry date.
        </div>

        <div style="margin-bottom: 20px;">
            <div class="sort-controls">
                <span class="sort-label">Sort by:</span>
                <a href="{{ route('admin.products.expired', ['sort' => 'name']) }}" class="sort-btn {{ $sort === 'name' ? 'active' : '' }}">
                    <i class='bx bx-sort-alt-2'></i> Product Name
                </a>
                <a href="{{ route('admin.products.expired', ['sort' => 'expiry']) }}" class="sort-btn {{ $sort === 'expiry' ? 'active' : '' }}">
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
                        <th>Stock Status</th>
                        <th>Expiry Date</th>
                        <th>Tag</th>
                        <th>Actions</th>
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
                            <td>{{ $product->dosage }}</td>
                            <td>{{ $product->manufacturer }}</td>
                            <td>
                                <span class="stock-status {{ $product->stock_status }}">
                                    {{ ucfirst(str_replace('_', ' ', $product->stock_status)) }}
                                </span>
                            </td>
                            <td style="color: #d32f2f; font-weight: 600;">
                                {{ $product->expiry_date->format('M d, Y') }}
                            </td>
                            <td>
                                <span class="tag {{ $product->tag }}">
                                    {{ ucfirst(str_replace('_', ' ', $product->tag)) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button type="button" class="btn-delete" title="Delete Expired Product" onclick="deleteProduct({{ $product->id }})">
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
                    <i class='bx bx-check-circle'></i>
                </div>
                <p>No expired products found</p>
                <p style="font-size: 13px; color: #bbb; margin-top: 10px;">All products in your inventory are valid!</p>
                <a href="{{ route('admin.products.index') }}" class="back-btn" style="margin-top: 20px;">
                    <i class='bx bx-arrow-back'></i> Back to Products
                </a>
            </div>
        </div>
    @endif
</div>

<script defer>
    function deleteProduct(productId) {
        if (confirm('Are you sure you want to delete this expired product? This action cannot be undone.')) {
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
