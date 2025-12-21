<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <style>
            .medicine-header {
                text-align: center;
                margin-bottom: 40px;
            }

            .medicine-header h1 {
                font-size: 32px;
                font-weight: 700;
                color: #11101D;
                margin-bottom: 8px;
            }

            .medicine-header p {
                font-size: 16px;
                color: #666;
            }

            .product-card-link {
                text-decoration: none;
                color: inherit;
                display: block;
                cursor: pointer;
            }

            .products-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 24px;
                margin-bottom: 40px;
            }

            @media (max-width: 1200px) {
                .products-grid {
                    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                    gap: 20px;
                }
            }

            @media (max-width: 768px) {
                .products-grid {
                    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                    gap: 16px;
                }
            }

            @media (max-width: 480px) {
                .products-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 12px;
                }
            }

            .product-card {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                transition: all 0.3s ease;
                display: flex;
                flex-direction: column;
            }

            .product-card:hover {
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
                transform: translateY(-4px);
            }

            .product-image-wrapper {
                position: relative;
                width: 100%;
                height: 200px;
                background: #f5f5f5;
                overflow: hidden;
            }

            .product-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .product-card:hover .product-image {
                transform: scale(1.05);
            }

            .product-image-placeholder {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                color: #999;
                font-size: 48px;
            }

            .discount-badge {
                position: absolute;
                top: 12px;
                right: 12px;
                background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);
                color: white;
                padding: 6px 12px;
                border-radius: 6px;
                font-weight: 700;
                font-size: 13px;
                box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
            }

            .product-info {
                padding: 16px;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

            .product-name {
                font-size: 16px;
                font-weight: 700;
                color: #11101D;
                margin-bottom: 4px;
                line-height: 1.3;
                min-height: 38px;
            }

            .product-dosage {
                font-size: 13px;
                color: #666;
                margin-bottom: 4px;
            }

            .product-manufacturer {
                font-size: 12px;
                color: #999;
                margin-bottom: 12px;
            }

            .pricing-section {
                margin-bottom: 12px;
                padding: 12px;
                background: #f8f9fa;
                border-radius: 8px;
            }

            .price-with-discount {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .original-price {
                font-size: 13px;
                color: #999;
                text-decoration: line-through;
            }

            .discounted-price {
                font-size: 20px;
                font-weight: 700;
                color: #27ae60;
            }

            .price-only {
                display: flex;
                align-items: center;
            }

            .normal-price {
                font-size: 20px;
                font-weight: 700;
                color: #27ae60;
            }

            .stock-status-badge {
                margin-bottom: 12px;
            }

            .badge {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
            }

            .badge.normal {
                background: #d4edda;
                color: #155724;
            }

            .badge.low_stock {
                background: #fff3cd;
                color: #856404;
            }

            .badge.out_of_stock {
                background: #f8d7da;
                color: #721c24;
            }

            .add-to-cart-btn {
                width: 100%;
                padding: 12px;
                background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                transition: all 0.3s ease;
                margin-top: auto;
            }

            .add-to-cart-btn:hover:not(:disabled) {
                background: linear-gradient(135deg, #2980b9 0%, #1e5f8c 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            }

            .add-to-cart-btn:disabled {
                background: #ccc;
                cursor: not-allowed;
                opacity: 0.6;
            }

            .pagination-wrapper {
                display: flex;
                justify-content: center;
                margin-top: 40px;
            }

            .pagination {
                display: flex;
                gap: 8px;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
            }

            .pagination a,
            .pagination span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 40px;
                height: 40px;
                padding: 0 8px;
                border: 1px solid #ddd;
                border-radius: 6px;
                font-size: 14px;
                font-weight: 600;
                text-decoration: none;
                color: #333;
                background: white;
                transition: all 0.3s ease;
            }

            .pagination a:hover {
                background: #f5f5f5;
                border-color: #999;
            }

            .pagination .active span {
                background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
                color: white;
                border-color: #2980b9;
            }

            .pagination .disabled span {
                color: #ccc;
                cursor: not-allowed;
            }

            .empty-state {
                text-align: center;
                padding: 60px 20px;
                color: #999;
            }

            .empty-state i {
                font-size: 60px;
                margin-bottom: 20px;
                opacity: 0.5;
                display: block;
            }

            .empty-state p {
                font-size: 16px;
            }
        </style>
    </x-slot>

    @include('layouts.sidebar')

    <div class="main-content">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="medicine-header">
                    <h1>Medicine Products</h1>
                    <p class="text-gray-600">Browse our collection of medicines</p>
                </div>

                @if($products->count() > 0)
                    <div class="products-grid">
                        @foreach($products as $product)
                            <a href="{{ route('medicine.show', $product->id) }}" class="product-card-link">
                                <div class="product-card">
                                <!-- Product Image -->
                                <div class="product-image-wrapper">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-image">
                                    @else
                                        <div class="product-image-placeholder">
                                            <i class='bx bx-image'></i>
                                        </div>
                                    @endif

                                    @if($product->discount)
                                        <div class="discount-badge">
                                            {{ $product->discount }}% OFF
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="product-info">
                                    <h3 class="product-name">{{ $product->name }}</h3>
                                    <p class="product-dosage">{{ $product->dosage }}</p>
                                    <p class="product-manufacturer">{{ $product->manufacturer }}</p>

                                    <!-- Pricing -->
                                    <div class="pricing-section">
                                        @if($product->discount && $product->updated_price < $product->price)
                                            <div class="price-with-discount">
                                                <span class="original-price">৳{{ number_format($product->price, 2) }}</span>
                                                <span class="discounted-price">৳{{ number_format($product->updated_price, 2) }}</span>
                                            </div>
                                        @else
                                            <div class="price-only">
                                                <span class="normal-price">৳{{ number_format($product->price, 2) }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Stock Status -->
                                    <div class="stock-status-badge">
                                        <span class="badge {{ $product->stock_status }}">
                                            @if($product->stock_status === 'normal')
                                                In Stock
                                            @elseif($product->stock_status === 'low_stock')
                                                Low Stock
                                            @else
                                                Out of Stock
                                            @endif
                                        </span>
                                    </div>

                                    <!-- Add to Cart Button -->
                                    <button class="add-to-cart-btn" onclick="event.preventDefault(); event.stopPropagation();" @if($product->stock_status === 'out_of_stock') disabled @endif>
                                        <i class='bx bx-cart-add'></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class='bx bx-inbox'></i>
                        <p>No medicine products available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
