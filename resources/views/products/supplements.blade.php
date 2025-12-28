<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <style>
            .supplements-header {
                text-align: center;
                margin-bottom: 40px;
            }

            .supplements-header h1 {
                font-size: 32px;
                font-weight: 700;
                color: #11101D;
                margin-bottom: 8px;
            }
            
            .dark .supplements-header h1 {
                color: #f3f4f6;
            }
            .supplements-header p {
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
                width: 100%;
            }

            @media (max-width: 1200px) {
                .products-grid {
                    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                    gap: 20px;
                }
            }

            @media (max-width: 768px) {
                .products-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 10px;
                    margin-left: 0;
                    margin-right: 0;
                }
            }

            @media (max-width: 480px) {
                .products-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 8px;
                    margin-left: 0;
                    margin-right: 0;
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
                color: #111;
            }
            .product-info * {
                color: #111 !important;
            }

            .product-name {
                font-size: 16px;
                font-weight: 700;
                color: #11101D;
                margin-bottom: 4px;
                line-height: 1.3;
                min-height: 38px;
            }
            
            .dark .product-name {
                color: #f3f4f6;
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

    <div class="main-content" style="overflow-x: hidden;">
        <div class="py-6 sm:py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="supplements-header">
                    <h1>Supplement Products</h1>
                    <p class="text-gray-600">Browse our collection of supplements</p>
                </div>
                @if($products->count() > 0)
                    <div class="products-grid">
                        @foreach($products as $product)
                            <a href="{{ route('supplements.show', $product->id) }}" class="product-card-link">
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
                                    <button class="add-to-cart-btn" onclick="event.preventDefault(); event.stopPropagation(); openQuantityModal({{ $product->id }}, '{{ $product->name }}')" @if($product->stock_status === 'out_of_stock') disabled @endif>
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
                        <p>No supplement products available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quantity Selection Modal -->
    <div id="quantityModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9998; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 12px; padding: 24px; max-width: 400px; width: 90%; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
            <h3 id="modalProductName" class="dark:text-gray-100" style="font-size: 18px; font-weight: 700; margin-bottom: 20px; color: #11101D;">Select Quantity</h3>
            <div style="display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 24px;">
                <button onclick="decreaseQuantityModal()" style="background: #f0f0f0; border: none; width: 44px; height: 44px; border-radius: 8px; cursor: pointer; font-size: 18px; color: #333; transition: all 0.2s;">−</button>
                <input type="number" id="quantityInput" class="dark:text-gray-900" value="1" min="1" max="50" style="border: 1px solid #e5e7eb; border-radius: 8px; text-align: center; font-size: 16px; padding: 12px; width: 80px; outline: none;">
                <button onclick="increaseQuantityModal()" style="background: #f0f0f0; border: none; width: 44px; height: 44px; border-radius: 8px; cursor: pointer; font-size: 18px; color: #333; transition: all 0.2s;">+</button>
            </div>
            <div style="display: flex; gap: 12px;">
                <button onclick="closeQuantityModal()" style="flex: 1; padding: 12px; background: #e5e7eb; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; color: #333; transition: all 0.2s;">Cancel</button>
                <button onclick="addToCartFromModal()" style="flex: 1; padding: 12px; background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); border: none; border-radius: 8px; font-weight: 600; cursor: pointer; color: white; transition: all 0.2s;">Add to Cart</button>
            </div>
        </div>
    </div>

    <script>
        let modalProductId = null;

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 9999;
                display: flex;
                align-items: center;
                gap: 12px;
                font-size: 14px;
                animation: slideIn 0.3s ease-out;
            `;
            toast.innerHTML = `
                <i class='bx ${type === 'success' ? 'bx-check-circle' : 'bx-error-circle'}' style="font-size: 20px;"></i>
                <span>${message}</span>
            `;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function openQuantityModal(productId, productName) {
            modalProductId = productId;
            document.getElementById('modalProductName').textContent = `Add "${productName}" to cart`;
            document.getElementById('quantityInput').value = 1;
            document.getElementById('quantityModal').style.display = 'flex';
        }

        function closeQuantityModal() {
            document.getElementById('quantityModal').style.display = 'none';
            modalProductId = null;
        }

        function decreaseQuantityModal() {
            const input = document.getElementById('quantityInput');
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function increaseQuantityModal() {
            const input = document.getElementById('quantityInput');
            if (input.value < 50) {
                input.value = parseInt(input.value) + 1;
            } else {
                showToast('Maximum quantity is 50 items', 'error');
            }
        }

        function addToCartFromModal() {
            if (!modalProductId) {
                showToast('Please select a product first', 'error');
                return;
            }
            const quantity = parseInt(document.getElementById('quantityInput').value);

            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: modalProductId,
                    quantity: quantity
                })
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401 || response.status === 419) {
                        showToast('Please log in to add items to cart', 'error');
                        setTimeout(() => {
                            window.location.href = '{{ route('login') }}';
                        }, 1500);
                        throw new Error('Unauthenticated');
                    }
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    closeQuantityModal();
                    updateCartBadge();
                } else {
                    showToast(data.message || 'Error adding to cart', 'error');
                }
            })
            .catch(error => {
                if (error.message !== 'Unauthenticated') {
                    showToast('Error adding to cart. Please try again.', 'error');
                    console.error('Error:', error);
                }
            });
        }

        function updateCartBadge() {
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('cart-badge');
                    if (badge) {
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.style.display = 'inline-flex';
                        } else {
                            badge.style.display = 'none';
                        }
                    }
                });
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeQuantityModal();
            }
        });

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        if (!document.querySelector('style[data-toast-animations]')) {
            style.setAttribute('data-toast-animations', 'true');
            document.head.appendChild(style);
        }

        // Initialize cart badge on page load
        window.addEventListener('load', updateCartBadge);
    </script>
</x-app-layout>
