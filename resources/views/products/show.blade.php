<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <style>
            .product-details-container {
                background: white;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                overflow: hidden;
            }

            .product-details-wrapper {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 40px;
                padding: 40px;
            }

            @media (max-width: 968px) {
                .product-details-wrapper {
                    grid-template-columns: 1fr;
                    gap: 30px;
                    padding: 30px 20px;
                }
            }

            .product-image-section {
                display: flex;
                align-items: center;
                justify-content: center;
                background: #f5f5f5;
                border-radius: 12px;
                min-height: 400px;
                overflow: hidden;
            }

            .product-image-section img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .product-image-placeholder {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                font-size: 80px;
                color: #ccc;
            }

            .product-info-section {
                display: flex;
                flex-direction: column;
            }

            .product-title {
                font-size: 28px;
                font-weight: 700;
                color: #11101D;
                margin-bottom: 12px;
            }

            .product-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                margin-bottom: 24px;
                padding-bottom: 24px;
                border-bottom: 1px solid #f0f0f0;
            }

            .meta-item {
                display: flex;
                flex-direction: column;
            }

            .meta-label {
                font-size: 12px;
                font-weight: 600;
                color: #999;
                text-transform: uppercase;
                margin-bottom: 4px;
            }

            .meta-value {
                font-size: 16px;
                font-weight: 600;
                color: #11101D;
            }

            .product-description {
                margin-bottom: 24px;
                line-height: 1.6;
                color: #555;
            }

            .product-description h3 {
                font-size: 16px;
                font-weight: 700;
                color: #11101D;
                margin-bottom: 12px;
            }

            .pricing-section {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 12px;
                margin-bottom: 24px;
            }

            .price-display {
                display: flex;
                align-items: center;
                gap: 16px;
                margin-bottom: 12px;
            }

            .discount-badge {
                background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);
                color: white;
                padding: 8px 16px;
                border-radius: 8px;
                font-weight: 700;
                font-size: 14px;
            }

            .price-original {
                font-size: 18px;
                color: #999;
                text-decoration: line-through;
            }

            .price-current {
                font-size: 32px;
                font-weight: 700;
                color: #27ae60;
            }

            .price-savings {
                font-size: 14px;
                color: #27ae60;
                margin-top: 8px;
            }

            .stock-status {
                padding: 12px;
                border-radius: 8px;
                font-weight: 600;
                text-align: center;
                margin-bottom: 24px;
            }

            .stock-status.in-stock {
                background: #d4edda;
                color: #155724;
            }

            .stock-status.low-stock {
                background: #fff3cd;
                color: #856404;
            }

            .stock-status.out-of-stock {
                background: #f8d7da;
                color: #721c24;
            }

            .details-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                margin-bottom: 24px;
            }

            .detail-item {
                display: flex;
                flex-direction: column;
            }

            .detail-label {
                font-size: 12px;
                font-weight: 600;
                color: #999;
                text-transform: uppercase;
                margin-bottom: 6px;
            }

            .detail-value {
                font-size: 16px;
                font-weight: 600;
                color: #11101D;
            }

            .actions {
                display: flex;
                gap: 12px;
                margin-top: auto;
            }

            .btn {
                flex: 1;
                padding: 14px 24px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .btn-add-to-cart {
                background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
                color: white;
            }

            .btn-add-to-cart:hover {
                background: linear-gradient(135deg, #2980b9 0%, #1e5f8c 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            }

            .btn-add-to-cart:disabled {
                background: #ccc;
                cursor: not-allowed;
                opacity: 0.6;
            }

            .btn-back {
                background: #f0f0f0;
                color: #333;
                text-decoration: none;
            }

            .btn-back:hover {
                background: #e0e0e0;
                transform: translateY(-2px);
            }

            .back-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 24px;
                color: #3498db;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .back-link:hover {
                color: #2980b9;
            }

            .badge-inline {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                background: #e8f5e9;
                color: #2e7d32;
            }

            .badge-inline.required {
                background: #fce4ec;
                color: #c2185b;
            }

            .badge-inline.supplement {
                background: #e3f2fd;
                color: #1565c0;
            }

            .badge-inline.first-aid {
                background: #fff3e0;
                color: #e65100;
            }
        </style>
    </x-slot>

    @include('layouts.sidebar')

    <div class="main-content">
        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                @php
                    $backRoute = match($product->tag) {
                        'medicine' => route('medicine'),
                        'supplement' => route('supplements'),
                        'first_aid' => route('first-aid'),
                        default => route('dashboard'),
                    };
                    $backLabel = match($product->tag) {
                        'medicine' => 'Back to Medicines',
                        'supplement' => 'Back to Supplements',
                        'first_aid' => 'Back to First Aid',
                        default => 'Back',
                    };
                @endphp
                <a href="{{ $backRoute }}" class="back-link">
                    <i class='bx bx-chevron-left'></i> {{ $backLabel }}
                </a>

                <div class="product-details-container">
                    <div class="product-details-wrapper">
                        <!-- Product Image -->
                        <div class="product-image-section">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <div class="product-image-placeholder">
                                    <i class='bx bx-image'></i>
                                </div>
                            @endif
                        </div>

                        <!-- Product Information -->
                        <div class="product-info-section">
                            <h1 class="product-title">{{ $product->name }}</h1>

                            <!-- Meta Information -->
                            <div class="product-meta">
                                <div class="meta-item">
                                    <span class="meta-label">Dosage</span>
                                    <span class="meta-value">{{ $product->dosage }}</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Manufacturer</span>
                                    <span class="meta-value">{{ $product->manufacturer }}</span>
                                </div>
                            </div>

                            <!-- Description -->
                            @if($product->description)
                                <div class="product-description">
                                    <h3>Description</h3>
                                    <p>{{ $product->description }}</p>
                                </div>
                            @endif

                            <!-- Pricing -->
                            <div class="pricing-section">
                                @if($product->discount && $product->updated_price < $product->price)
                                    <div class="price-display">
                                        <div class="discount-badge">
                                            {{ $product->discount }}% OFF
                                        </div>
                                    </div>
                                    <div class="price-display">
                                        <span class="price-original">৳{{ number_format($product->price, 2) }}</span>
                                        <span class="price-current">৳{{ number_format($product->updated_price, 2) }}</span>
                                    </div>
                                    <div class="price-savings">
                                        Save ৳{{ number_format($product->price - $product->updated_price, 2) }}
                                    </div>
                                @else
                                    <div class="price-current">৳{{ number_format($product->price, 2) }}</div>
                                @endif
                            </div>

                            <!-- Stock Status -->
                            <div class="stock-status {{ strtolower(str_replace('_', '-', $product->stock_status)) }}">
                                @if($product->stock_status === 'normal')
                                    <i class='bx bx-check-circle'></i> In Stock
                                @elseif($product->stock_status === 'low_stock')
                                    <i class='bx bx-time'></i> Low Stock
                                @else
                                    <i class='bx bx-x-circle'></i> Out of Stock
                                @endif
                            </div>

                            <!-- Details Grid -->
                            <div class="details-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Expiry Date</span>
                                    <span class="detail-value">{{ $product->expiry_date->format('d M, Y') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Category</span>
                                    <span class="detail-value">
                                        @if($product->tag === 'medicine')
                                            <span class="badge-inline">Medicine</span>
                                        @elseif($product->tag === 'supplement')
                                            <span class="badge-inline supplement">Supplement</span>
                                        @elseif($product->tag === 'first_aid')
                                            <span class="badge-inline first-aid">First Aid</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Quantity in Stock</span>
                                    <span class="detail-value">{{ $product->quantity }} units</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Prescription Required</span>
                                    <span class="detail-value">
                                        @if($product->prescription_required)
                                            <span class="badge-inline required">Yes</span>
                                        @else
                                            <span class="badge-inline">No</span>
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="actions">
                                <button class="btn btn-add-to-cart" @if($product->stock_status === 'out_of_stock') disabled @endif>
                                    <i class='bx bx-cart-add'></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
