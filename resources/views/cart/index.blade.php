<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <style>
            .cart-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .cart-grid {
                display: grid;
                grid-template-columns: 1fr 400px;
                gap: 24px;
                margin-bottom: 40px;
            }

            @media (max-width: 968px) {
                .cart-grid {
                    grid-template-columns: 1fr;
                }
            }

            .cart-header {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 30px;
            }

            .cart-header h1 {
                font-size: 32px;
                font-weight: 700;
                color: #11101D;
            }

            .cart-badge {
                background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
                color: white;
                padding: 6px 14px;
                border-radius: 20px;
                font-weight: 600;
                font-size: 14px;
            }

            .cart-items {
                background: white;
                border-radius: 12px;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
                overflow: hidden;
            }

            .cart-item {
                display: grid;
                grid-template-columns: 100px 1fr auto;
                gap: 20px;
                padding: 20px;
                border-bottom: 1px solid #e5e5e5;
                align-items: start;
                transition: all 0.2s ease;
            }

            .cart-item:hover {
                background: #f9f9f9;
            }

            .cart-item:last-child {
                border-bottom: none;
            }

            .item-image {
                width: 100px;
                height: 100px;
                object-fit: cover;
                border-radius: 8px;
                background: #f5f5f5;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 40px;
                color: #ccc;
            }

            .item-details {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .item-name {
                font-size: 16px;
                font-weight: 700;
                color: #11101D;
            }

            .item-generic {
                font-size: 13px;
                color: #666;
            }

            .item-price {
                font-size: 18px;
                font-weight: 700;
                color: #27ae60;
            }

            .item-controls {
                display: flex;
                flex-direction: column;
                gap: 12px;
                align-items: flex-end;
            }

            .quantity-control {
                display: flex;
                align-items: center;
                gap: 8px;
                background: #f5f5f5;
                border-radius: 8px;
                padding: 6px;
            }

            .qty-btn {
                width: 32px;
                height: 32px;
                border: none;
                background: white;
                border-radius: 4px;
                cursor: pointer;
                font-weight: 600;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .qty-btn:hover {
                background: #e5e5e5;
            }

            .qty-input {
                width: 50px;
                text-align: center;
                border: none;
                background: transparent;
                font-weight: 600;
                font-size: 14px;
            }

            .qty-input::-webkit-outer-spin-button,
            .qty-input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            .error-message {
                font-size: 12px;
                color: #e74c3c;
                font-weight: 600;
            }

            .prescription-upload {
                margin-top: 8px;
            }

            .prescription-label {
                font-size: 12px;
                color: #666;
                font-weight: 600;
                margin-bottom: 4px;
                display: block;
            }

            .file-input-wrapper {
                position: relative;
                display: inline-block;
                width: 100%;
            }

            .file-input {
                display: none;
            }

            .file-btn {
                background: #3498db;
                color: white;
                padding: 8px 16px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 600;
                cursor: pointer;
                border: none;
                transition: all 0.2s ease;
                display: inline-block;
            }

            .file-btn:hover {
                background: #2980b9;
            }

            .file-name {
                font-size: 12px;
                color: #666;
                margin-top: 4px;
            }

            .remove-btn {
                background: #e74c3c;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .remove-btn:hover {
                background: #c0392b;
            }

            .empty-cart {
                text-align: center;
                padding: 60px 20px;
                color: #999;
            }

            .empty-icon {
                font-size: 60px;
                margin-bottom: 20px;
                opacity: 0.5;
            }

            .empty-text {
                font-size: 18px;
                margin-bottom: 20px;
            }

            .continue-shopping {
                display: inline-block;
                background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .continue-shopping:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            }

            .order-summary {
                background: white;
                border-radius: 12px;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
                padding: 24px;
                position: sticky;
                top: 20px;
            }

            .summary-title {
                font-size: 18px;
                font-weight: 700;
                color: #11101D;
                margin-bottom: 20px;
                padding-bottom: 16px;
                border-bottom: 2px solid #e5e5e5;
            }

            .summary-row {
                display: flex;
                justify-content: space-between;
                margin-bottom: 12px;
                font-size: 14px;
            }

            .summary-label {
                color: #666;
                font-weight: 500;
            }

            .summary-value {
                color: #333;
                font-weight: 600;
            }

            .summary-total {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
                padding-top: 16px;
                border-top: 2px solid #e5e5e5;
                font-size: 18px;
                font-weight: 700;
            }

            .summary-total .summary-value {
                color: #27ae60;
                font-size: 24px;
            }

            .delivery-section {
                margin-top: 24px;
                padding-top: 24px;
                border-top: 2px solid #e5e5e5;
            }

            .section-title {
                font-size: 16px;
                font-weight: 700;
                color: #11101D;
                margin-bottom: 16px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-label {
                display: block;
                font-size: 13px;
                font-weight: 600;
                color: #333;
                margin-bottom: 8px;
            }

            .form-input,
            .form-select,
            .form-textarea {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #ddd;
                border-radius: 6px;
                font-size: 14px;
                font-family: inherit;
                transition: all 0.2s ease;
            }

            .form-input:focus,
            .form-select:focus,
            .form-textarea:focus {
                outline: none;
                border-color: #3498db;
                box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            }

            .form-textarea {
                resize: vertical;
                min-height: 80px;
            }

            .delivery-options {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .delivery-option {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px;
                border: 1px solid #ddd;
                border-radius: 6px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .delivery-option:hover {
                border-color: #3498db;
                background: #f9f9f9;
            }

            .delivery-option input[type="radio"] {
                cursor: pointer;
                width: 16px;
                height: 16px;
            }

            .option-label {
                display: flex;
                flex-direction: column;
                gap: 4px;
                cursor: pointer;
                flex: 1;
            }

            .option-name {
                font-weight: 600;
                color: #333;
                font-size: 14px;
            }

            .option-desc {
                font-size: 12px;
                color: #999;
            }

            .checkout-btn {
                width: 100%;
                background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
                color: white;
                padding: 14px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-top: 20px;
            }

            .checkout-btn:hover:not(:disabled) {
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(39, 174, 96, 0.3);
            }

            .checkout-btn:disabled {
                background: #ccc;
                cursor: not-allowed;
                opacity: 0.6;
            }

            .delivery-section-box {
                display: none;
            }

            .delivery-section-box.show {
                display: block;
            }

            .toast {
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
                animation: slideIn 0.3s ease;
                z-index: 9999;
            }

            .toast.success {
                border-left: 4px solid #27ae60;
            }

            .toast.error {
                border-left: 4px solid #e74c3c;
            }

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

            .toast.hide {
                animation: slideOut 0.3s ease forwards;
            }

            @media (max-width: 768px) {
                .cart-item {
                    grid-template-columns: 80px 1fr;
                    gap: 12px;
                }

                .item-controls {
                    grid-column: 1 / -1;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                }

                .item-image {
                    width: 80px;
                    height: 80px;
                }

                .order-summary {
                    position: static;
                }
            }
        </style>
    </x-slot>

    @include('layouts.sidebar')

    <div class="main-content">
        <div class="py-12">
            <div class="cart-container">
                <div class="cart-header">
                    <h1>Shopping Cart</h1>
                    @if(count($cartItems) > 0)
                        <span class="cart-badge">{{ count($cartItems) }} items</span>
                    @endif
                </div>

                @if(count($cartItems) > 0)
                    <div class="cart-grid">
                        <div>
                            <div class="cart-items">
                                @foreach($cartItems as $item)
                                    <div class="cart-item" data-item-id="{{ $item->id }}">
                                        <div>
                                            @if($item->product->image_path)
                                                <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="item-image">
                                            @else
                                                <div class="item-image">
                                                    <i class='bx bx-image'></i>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="item-details">
                                            <div class="item-name">{{ $item->product->name }}</div>
                                            @if($item->product->generic_name)
                                                <div class="item-generic">{{ $item->product->generic_name }}</div>
                                            @endif
                                            <div class="item-price">৳{{ number_format($item->product->updated_price ?? $item->product->price, 2) }}</div>
                                        </div>

                                        <div class="item-controls">
                                            <div class="quantity-control">
                                                <button class="qty-btn qty-decrease" onclick="updateQuantity({{ $item->id }}, -1)">−</button>
                                                <input type="number" class="qty-input" value="{{ $item->quantity }}" min="1" max="50" data-item-id="{{ $item->id }}" onchange="updateQuantityFromInput({{ $item->id }}, this.value)">
                                                <button class="qty-btn qty-increase" onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                            </div>
                                            <div class="error-message" id="error-{{ $item->id }}"></div>

                                            @if($item->product->prescription_required)
                                                <div class="prescription-upload">
                                                    <label class="prescription-label">Prescription Required</label>
                                                    <div class="file-input-wrapper">
                                                        <input type="file" id="prescription-{{ $item->id }}" class="file-input" accept=".pdf,.jpg,.jpeg,.png" onchange="uploadPrescription({{ $item->id }})">
                                                        <label for="prescription-{{ $item->id }}" class="file-btn">
                                                            <i class='bx bx-upload'></i> Upload
                                                        </label>
                                                    </div>
                                                    <div class="file-name" id="file-name-{{ $item->id }}">
                                                        @if($item->prescription_file)
                                                            <i class='bx bx-check' style="color: #27ae60;"></i> Uploaded
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                            <button class="remove-btn" onclick="removeItem({{ $item->id }})">
                                                <i class='bx bx-trash'></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <div class="order-summary">
                                <div class="summary-title">Order Summary</div>

                                <div class="summary-row">
                                    <span class="summary-label">Subtotal</span>
                                    <span class="summary-value" id="subtotal">৳0.00</span>
                                </div>

                                <div class="summary-row">
                                    <span class="summary-label">Shipping</span>
                                    <span class="summary-value" id="shipping">৳0.00</span>
                                </div>

                                <div class="summary-total">
                                    <span>Total</span>
                                    <span class="summary-value" id="total">৳0.00</span>
                                </div>

                                <div class="delivery-section">
                                    <div class="section-title">Delivery Information</div>

                                    <form id="checkoutForm">
                                        <div class="form-group">
                                            <label class="form-label">Delivery Address *</label>
                                            <textarea class="form-textarea" name="address" required placeholder="Enter your complete delivery address"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Additional Comments</label>
                                            <textarea class="form-textarea" name="comments" placeholder="Any special instructions or comments (optional)"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Delivery Location *</label>
                                            <select name="delivery_location" id="delivery_location" class="form-select" required onchange="updateDeliveryOptions()">
                                                <option value="">Select Location</option>
                                                <option value="inside_dhaka">Inside Dhaka</option>
                                                <option value="outside_dhaka">Outside Dhaka</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Delivery Option *</label>
                                            <div class="delivery-options">
                                                <label class="delivery-option">
                                                    <input type="radio" name="delivery_option" value="standard" required checked>
                                                    <div class="option-label">
                                                        <span class="option-name">Standard Delivery <span id="standard_price">(৳40)</span></span>
                                                        <span class="option-desc">3-5 business days</span>
                                                    </div>
                                                </label>

                                                <label class="delivery-option">
                                                    <input type="radio" name="delivery_option" value="express" required>
                                                    <div class="option-label">
                                                        <span class="option-name">Express Delivery <span id="express_price">(৳80)</span></span>
                                                        <span class="option-desc">1-2 business days</span>
                                                    </div>
                                                </label>

                                                <label class="delivery-option">
                                                    <input type="radio" name="delivery_option" value="overnight" required>
                                                    <div class="option-label">
                                                        <span class="option-name">Overnight Delivery <span id="overnight_price">(৳100)</span></span>
                                                        <span class="option-desc">Next business day</span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="cart-items">
                        <div class="empty-cart">
                            <div class="empty-icon">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                            <div class="empty-text">Your cart is empty</div>
                            <a href="{{ route('medicine') }}" class="continue-shopping">Continue Shopping</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(itemId, change) {
            const input = document.querySelector(`.qty-input[data-item-id="${itemId}"]`);
            let newQuantity = parseInt(input.value) + change;
            
            if (newQuantity < 1) newQuantity = 1;
            if (newQuantity > 50) newQuantity = 50;
            
            input.value = newQuantity;
            updateQuantityFromInput(itemId, newQuantity);
        }

        function updateQuantityFromInput(itemId, quantity) {
            const input = document.querySelector(`.qty-input[data-item-id="${itemId}"]`);
            const errorDiv = document.getElementById(`error-${itemId}`);
            
            quantity = parseInt(quantity);
            
            if (quantity < 1) {
                quantity = 1;
                input.value = 1;
            }
            if (quantity > 50) {
                errorDiv.textContent = 'You can add only 50 items of this product';
                input.value = 50;
                return;
            }
            
            errorDiv.textContent = '';

            fetch(`/cart/${itemId}/quantity`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateSummary(data.subtotal, data.total);
                }
            });
        }

        function uploadPrescription(itemId) {
            const fileInput = document.getElementById(`prescription-${itemId}`);
            const file = fileInput.files[0];
            
            if (!file) return;

            const formData = new FormData();
            formData.append('prescription', file);

            fetch(`/cart/${itemId}/prescription`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`file-name-${itemId}`).innerHTML = '<i class="bx bx-check" style="color: #27ae60;"></i> Uploaded';
                    showToast('Prescription uploaded successfully', 'success');
                }
            });
        }

        function removeItem(itemId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                fetch(`/cart/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    }
                });
            }
        }

        function updateSummary(subtotal, total) {
            document.getElementById('subtotal').textContent = '৳' + parseFloat(subtotal).toFixed(2);
            document.getElementById('total').textContent = '৳' + parseFloat(total).toFixed(2);
        }

        function calculateTotals() {
            let subtotal = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const quantity = parseInt(item.querySelector('.qty-input').value);
                const price = parseFloat(item.querySelector('.item-price').textContent.replace('৳', ''));
                subtotal += quantity * price;
            });

            document.getElementById('subtotal').textContent = '৳' + subtotal.toFixed(2);

            const deliveryLocation = document.getElementById('delivery_location').value;
            const deliveryOption = document.querySelector('input[name="delivery_option"]:checked').value;
            let shipping = 0;

            if (deliveryLocation) {
                const prices = deliveryPricing[deliveryLocation];
                shipping = prices[deliveryOption];
            }

            document.getElementById('shipping').textContent = '৳' + shipping.toFixed(2);
            document.getElementById('total').textContent = '৳' + (subtotal + shipping).toFixed(2);
        }

        document.getElementById('delivery_location').addEventListener('change', calculateTotals);
        document.querySelectorAll('input[name="delivery_option"]').forEach(option => {
            option.addEventListener('change', calculateTotals);
        });

        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const address = document.querySelector('textarea[name="address"]').value;
            const comments = document.querySelector('textarea[name="comments"]').value;
            const deliveryOption = document.querySelector('input[name="delivery_option"]:checked').value;

            fetch('{{ route('cart.checkout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    address: address,
                    comments: comments,
                    delivery_option: deliveryOption
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    showToast(data.message, 'error');
                }
            });
        });

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <div style="display: flex; align-items: center; gap: 12px;">
                    <i class='bx ${type === 'success' ? 'bx-check-circle' : 'bx-error-circle'}' style="font-size: 20px; color: ${type === 'success' ? '#27ae60' : '#e74c3c'};"></i>
                    <span>${message}</span>
                </div>
            `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Delivery pricing for Inside and Outside Dhaka
        const deliveryPricing = {
            inside_dhaka: {
                standard: 40,
                express: 80,
                overnight: 100
            },
            outside_dhaka: {
                standard: 70,
                express: 110,
                overnight: 130
            }
        };

        function updateDeliveryOptions() {
            const location = document.getElementById('delivery_location').value;
            
            if (!location) {
                // Reset prices
                document.getElementById('standard_price').textContent = '(৳40)';
                document.getElementById('express_price').textContent = '(৳80)';
                document.getElementById('overnight_price').textContent = '(৳100)';
                return;
            }

            const prices = deliveryPricing[location];
            document.getElementById('standard_price').textContent = `(৳${prices.standard})`;
            document.getElementById('express_price').textContent = `(৳${prices.express})`;
            document.getElementById('overnight_price').textContent = `(৳${prices.overnight})`;
        }

        calculateTotals();
    </script>
</x-app-layout>
