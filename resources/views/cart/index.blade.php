<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <style>
            .cart-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 16px;
            }

            @media (min-width: 640px) {
                .cart-container {
                    padding: 20px;
                }
            }

            @media (min-width: 1024px) {
                .cart-container {
                    padding: 24px;
                }
            }

            .cart-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 20px;
                margin-bottom: 40px;
            }

            @media (min-width: 1024px) {
                .cart-grid {
                    grid-template-columns: 1fr 380px;
                    gap: 24px;
                }
            }

            @media (min-width: 1280px) {
                .cart-grid {
                    grid-template-columns: 1fr 400px;
                    gap: 24px;
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
            
            .dark .cart-header h1 {
                color: #f3f4f6;
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
                background: transparent;
                border-radius: 0;
                box-shadow: none;
                overflow: visible;
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .cart-item {
                display: grid;
                grid-template-columns: 90px 1fr auto;
                gap: 12px;
                padding: 12px;
                border-bottom: none;
                align-items: center;
                transition: all 0.3s ease;
                background: white;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                border: 1px solid #f0f0f0;
                color: #111;
            }
            .cart-item * {
                color: #111 !important;
            }
            }

            @media (min-width: 640px) {
                .cart-item {
                    grid-template-columns: 110px 1fr auto;
                    gap: 16px;
                    padding: 16px;
                }
            }

            @media (min-width: 1024px) {
                .cart-item {
                    grid-template-columns: 120px 1fr auto;
                    gap: 20px;
                    padding: 20px;
                }
            }

            .cart-item:hover {
                background: white;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
                transform: translateY(-2px);
            }

            .cart-item:last-child {
                border-bottom: none;
            }

            .item-image {
                width: 120px;
                height: 120px;
                object-fit: cover;
                border-radius: 10px;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 48px;
                color: #ccc;
            }

            .item-details {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .item-name {
                font-size: 16px;
                font-weight: 700;
                color: #11101D;
                line-height: 1.4;
            }
            
            .dark .item-name {
                color: #f3f4f6;
            }

            .item-generic {
                font-size: 13px;
                color: #999;
                font-weight: 500;
            }

            .item-price {
                font-size: 18px;
                font-weight: 700;
                color: #27ae60;
            }

            .item-controls {
                display: flex;
                flex-direction: column;
                gap: 14px;
                align-items: flex-end;
            }

            .quantity-control {
                display: flex;
                align-items: center;
                gap: 2px;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-radius: 8px;
                padding: 6px;
                border: 1px solid #e9ecef;
            }

            .qty-btn {
                width: 36px;
                height: 36px;
                border: none;
                background: white;
                border-radius: 6px;
                cursor: pointer;
                font-weight: 700;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                color: #27ae60;
            }

            .qty-btn:hover {
                background: #27ae60;
                color: white;
                transform: scale(1.05);
            }

            .qty-btn:active {
                transform: scale(0.95);
            }

            .qty-input {
                width: 60px;
                text-align: center;
                border: none;
                background: transparent;
                font-weight: 700;
                font-size: 15px;
                color: #11101D;
            }
            
            .dark .qty-input {
                color: #111827;
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
                margin-top: 12px;
                padding: 12px;
                background: #fff3cd;
                border-left: 4px solid #ffc107;
                border-radius: 6px;
            }

            .prescription-label {
                font-size: 13px;
                color: #856404;
                font-weight: 700;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .prescription-required-badge {
                background: #dc3545;
                color: white;
                padding: 2px 8px;
                border-radius: 4px;
                font-size: 10px;
                font-weight: 700;
                text-transform: uppercase;
                margin-left: 4px;
            }

            .file-input-wrapper {
                position: relative;
                display: block;
                width: 100%;
                margin-top: 8px;
            }

            .file-input {
                display: none;
            }

            .file-btn {
                background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
                color: white;
                padding: 10px 16px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                border: none;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
            }

            .file-btn:hover {
                background: linear-gradient(135deg, #2980b9 0%, #1f618d 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            }

            .file-name {
                font-size: 13px;
                margin-top: 8px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .file-name.uploaded {
                color: #27ae60;
                background: #d4edda;
                padding: 8px 12px;
                border-radius: 6px;
                border-left: 3px solid #28a745;
            }

            .file-name.pending {
                color: #0066cc;
                padding: 8px 12px;
            }

            .prescription-warning {
                background: #e7f3ff;
                border-left: 4px solid #0066cc;
                padding: 16px;
                border-radius: 8px;
                margin: 20px 0;
                display: none;
            }

            .prescription-warning.show {
                display: block;
                animation: shake 0.5s;
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-10px); }
                75% { transform: translateX(10px); }
            }

            .prescription-warning-text {
                font-size: 14px;
                color: #004085;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .prescription-items-list {
                margin-top: 12px;
                padding-left: 20px;
            }

            .prescription-item {
                font-size: 13px;
                color: #004085;
                margin-bottom: 6px;
            }

            .remove-btn {
                background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
                color: white;
                padding: 8px 14px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 600;
                cursor: pointer;
                border: none;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }

            .remove-btn:hover {
                background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
            }

            @media (max-width: 768px) {
                .cart-item {
                    grid-template-columns: 100px 1fr;
                    gap: 16px;
                }

                .item-image {
                    width: 100px;
                    height: 100px;
                    font-size: 36px;
                }

                .item-controls {
                    grid-column: 2;
                    align-items: flex-start;
                }
            }

            .file-name {
                font-size: 12px;
                color: #27ae60;
                margin-top: 4px;
                font-weight: 600;
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
                color: #111;
            }
            .order-summary * {
                color: #111 !important;
            }

            .summary-title {
                font-size: 18px;
                font-weight: 700;
                color: #11101D;
                margin-bottom: 20px;
                padding-bottom: 16px;
                border-bottom: 2px solid #e5e5e5;
            }
            
            .dark .summary-title {
                color: #f3f4f6;
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
                .cart-container {
                    padding: 16px;
                    margin: 0;
                    max-width: 100%;
                }

                .cart-header {
                    margin-bottom: 16px;
                }

                .cart-header h1 {
                    font-size: 24px;
                }

                .cart-grid {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }

                .cart-item {
                    grid-template-columns: 80px 1fr;
                    gap: 12px;
                    padding: 16px 12px;
                }

                .item-controls {
                    grid-column: 1 / -1;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                    flex-wrap: wrap;
                    gap: 12px;
                }

                .item-image {
                    width: 80px;
                    height: 80px;
                }

                .order-summary {
                    position: static;
                }

                .prescription-upload {
                    padding: 12px;
                }

                .file-btn {
                    font-size: 13px;
                    padding: 10px 16px;
                }

                .prescription-label {
                    font-size: 13px;
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
                                                    <label class="prescription-label">
                                                        <i class='bx bx-file-blank'></i>
                                                        Prescription Needed
                                                    </label>
                                                    <div class="file-input-wrapper">
                                                        <input type="file" id="prescription-{{ $item->id }}" class="file-input" accept=".pdf,.jpg,.jpeg,.png" onchange="uploadPrescription({{ $item->id }})" data-required="true">
                                                        <label for="prescription-{{ $item->id }}" class="file-btn">
                                                            <i class='bx bx-upload'></i> 
                                                            Upload Prescription
                                                        </label>
                                                    </div>
                                                    <div class="file-name {{ $item->prescription_file_path ? 'uploaded' : 'pending' }}" id="file-name-{{ $item->id }}">
                                                        @if($item->prescription_file_path)
                                                            <i class='bx bx-check-circle'></i> 
                                                            <span>Uploaded</span>
                                                        @else
                                                            <i class='bx bx-info-circle'></i>
                                                            <span>Required for checkout</span>
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

                                    <!-- Saved Addresses Dropdown -->
                                    @if($savedAddresses->count() > 0)
                                        <div class="form-group" style="margin-bottom: 24px;">
                                            <label class="form-label">Quick Select Saved Address</label>
                                            <select class="form-select" id="saved_address_select" onchange="useSavedAddressInCart()">
                                                <option value="">-- Choose a saved address --</option>
                                                @foreach($savedAddresses as $address)
                                                    <option value="{{ $address->id }}" data-address="{{ $address->address }}" data-location="{{ $address->is_inside_dhaka ? 'inside_dhaka' : 'outside_dhaka' }}">
                                                        {{ $address->alias_name }} ({{ $address->is_inside_dhaka ? 'Inside Dhaka' : 'Outside Dhaka' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

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

                                        <div class="form-group delivery-section-box" id="delivery_options_section">
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

                                        <!-- Prescription Warning Box -->
                                        <div class="prescription-warning" id="prescription-warning">
                                            <div class="prescription-warning-text">
                                                <i class='bx bx-info-circle' style="font-size: 24px;"></i>
                                                <div>
                                                    <strong>Prescription Required</strong>
                                                    <div style="font-weight: normal; margin-top: 4px;">Upload prescriptions to complete your order:</div>
                                                </div>
                                            </div>
                                            <ul class="prescription-items-list" id="missing-prescriptions-list"></ul>
                                        </div>

                                        <button type="submit" class="checkout-btn" id="checkout-btn">Proceed to Checkout</button>
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

            // Validate file type
            const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                showToast('Please upload a valid file (PDF, JPG, or PNG)', 'error');
                fileInput.value = '';
                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                showToast('File size must be less than 5MB', 'error');
                fileInput.value = '';
                return;
            }

            const formData = new FormData();
            formData.append('prescription', file);

            // Show loading state
            document.getElementById(`file-name-${itemId}`).innerHTML = '<i class="bx bx-loader-alt bx-spin" style="color: #3498db;"></i> Uploading...';

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
                    document.getElementById(`file-name-${itemId}`).innerHTML = '<i class="bx bx-check-circle" style="color: #27ae60;"></i> <span>Prescription Uploaded Successfully</span>';
                    document.getElementById(`file-name-${itemId}`).classList.add('uploaded');
                    showToast('Prescription uploaded successfully', 'success');
                    checkPrescriptionRequirements();
                } else {
                    showToast(data.message || 'Upload failed', 'error');
                    document.getElementById(`file-name-${itemId}`).innerHTML = '<i class="bx bx-info-circle" style="color: #ffc107;"></i> <span style="color: #856404;">Upload required to proceed</span>';
                }
            })
            .catch(error => {
                showToast('Upload failed. Please try again.', 'error');
                document.getElementById(`file-name-${itemId}`).innerHTML = '<i class="bx bx-info-circle" style="color: #ffc107;"></i> <span style="color: #856404;">Upload required to proceed</span>';
            });
        }

        // Check prescription requirements
        function checkPrescriptionRequirements() {
            const prescriptionInputs = document.querySelectorAll('input[data-required="true"]');
            const warningBox = document.getElementById('prescription-warning');
            const missingList = document.getElementById('missing-prescriptions-list');
            const checkoutBtn = document.getElementById('checkout-btn');
            
            let missingItems = [];
            
            prescriptionInputs.forEach(input => {
                const itemId = input.id.split('-')[1];
                const fileName = document.getElementById(`file-name-${itemId}`);
                
                if (!fileName.classList.contains('uploaded')) {
                    const itemElement = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                    const productName = itemElement.querySelector('.item-name').textContent;
                    missingItems.push(productName);
                }
            });
            
            if (missingItems.length > 0) {
                warningBox.classList.add('show');
                missingList.innerHTML = missingItems.map(item => `<li class="prescription-item">• ${item}</li>`).join('');
                checkoutBtn.style.opacity = '0.6';
                checkoutBtn.style.cursor = 'not-allowed';
                return false;
            } else {
                warningBox.classList.remove('show');
                checkoutBtn.style.opacity = '1';
                checkoutBtn.style.cursor = 'pointer';
                return true;
            }
        }

        // Run check on page load
        document.addEventListener('DOMContentLoaded', function() {
            checkPrescriptionRequirements();
        });

        function removeItem(itemId) {
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

            // Check prescription requirements before proceeding
            if (!checkPrescriptionRequirements()) {
                const warningBox = document.getElementById('prescription-warning');
                warningBox.classList.add('show');
                warningBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                showToast('Please upload all required prescriptions before checkout', 'error');
                return false;
            }

            const address = document.querySelector('textarea[name="address"]').value;
            const deliveryLocation = document.querySelector('select[name="delivery_location"]').value;
            const deliveryOption = document.querySelector('input[name="delivery_option"]:checked').value;

            // Store delivery information in localStorage
            localStorage.setItem('mednet_delivery_location', address);
            localStorage.setItem('mednet_delivery_location_type', deliveryLocation);
            localStorage.setItem('mednet_delivery_method', deliveryOption);
            
            // Redirect to new checkout page
            window.location.href = '{{ route('checkout.index') }}';
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
            const deliverySection = document.getElementById('delivery_options_section');
            
            if (!location) {
                // Hide delivery options and reset prices
                deliverySection.classList.remove('show');
                document.getElementById('standard_price').textContent = '(৳40)';
                document.getElementById('express_price').textContent = '(৳80)';
                document.getElementById('overnight_price').textContent = '(৳100)';
                return;
            }

            // Show delivery options
            deliverySection.classList.add('show');
            
            const prices = deliveryPricing[location];
            document.getElementById('standard_price').textContent = `(৳${prices.standard})`;
            document.getElementById('express_price').textContent = `(৳${prices.express})`;
            document.getElementById('overnight_price').textContent = `(৳${prices.overnight})`;
        }

        // Function to use saved address in cart
        function useSavedAddressInCart() {
            const select = document.getElementById('saved_address_select');
            const selectedOption = select.options[select.selectedIndex];
            
            if (selectedOption.value === '') {
                return;
            }
            
            const address = selectedOption.getAttribute('data-address');
            const location = selectedOption.getAttribute('data-location');
            
            // Fill address field
            document.querySelector('textarea[name="address"]').value = address;
            
            // Set location dropdown
            document.getElementById('delivery_location').value = location;
            
            // Update delivery options and calculate totals
            updateDeliveryOptions();
            calculateTotals();
        }

        calculateTotals();
    </script>
</x-app-layout>
