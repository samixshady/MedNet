<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    </x-slot>

    @include('layouts.sidebar')

    <div class="main-content">
        <div class="py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <span class="text-blue-600 font-bold text-base sm:text-lg">1</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Checkout</h1>
            </div>
            <div class="h-1 bg-gradient-to-r from-blue-500 to-blue-300 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Order Summary -->
                <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8 mb-6 sm:mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 2C7.89543 2 7 2.89543 7 4V20C7 21.1046 7.89543 22 9 22H15C16.1046 22 17 21.1046 17 20V4C17 2.89543 16.1046 2 15 2H9Z"/>
                        </svg>
                        Order Items
                    </h2>

                    <div class="space-y-4">
                        @forelse($cartItems as $item)
                            <div class="flex items-start justify-between p-4 border border-gray-200 rounded-xl hover:border-blue-300 transition-colors">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $item->product->generic_name ?? 'Generic' }}</p>
                                    <p class="text-xs text-gray-500 mt-2">Quantity: {{ $item->quantity }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-blue-600">৳{{ number_format($item->subtotal, 2) }}</p>
                                    <p class="text-sm text-gray-600">৳{{ number_format($item->product->updated_price ?? $item->product->price, 2) }}/unit</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <p class="text-gray-600">Your cart is empty</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Saved Addresses Section -->
                @if($savedAddresses->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8 mb-6 sm:mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z"/>
                            </svg>
                            Use Saved Address
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($savedAddresses as $address)
                                <button type="button" class="p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-all text-left" onclick="useSavedAddress({{ $address->id }})">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="font-semibold text-gray-900">{{ $address->alias_name }}</span>
                                        @if($address->is_inside_dhaka)
                                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-semibold">Inside Dhaka</span>
                                        @else
                                            <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-xs font-semibold">Outside Dhaka</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-700">{{ $address->address }}</p>
                                    <p class="text-xs text-gray-600 mt-2">📞 {{ $address->phone }}</p>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Delivery Information -->
                <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8 mb-6 sm:mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"/>
                        </svg>
                        Delivery Details
                    </h2>

                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-xl p-6 mb-6">
                        <div class="mb-4">
                            <p class="text-sm font-semibold text-gray-700 mb-1">Delivery Address</p>
                            <p id="deliveryAddressDisplay" class="text-lg font-bold text-gray-900">{{ $deliveryAddress }}</p>
                        </div>
                        <div id="deliveryCoordsDisplay"></div>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="bg-white rounded-xl border-2 border-gray-200 p-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Select Payment Method</h3>
                        <div class="space-y-3">
                            <!-- Credit/Debit Card Option -->
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all group">
                                <input type="radio" name="payment_method" value="card" class="w-5 h-5 text-blue-600 cursor-pointer" checked>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 8H4V6h16m0 10H4v-6h16m0-4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z"/>
                                        </svg>
                                        <span class="font-bold text-gray-900">Credit/Debit Card</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Visa, Mastercard, American Express</p>
                                </div>
                            </label>

                            <!-- PayPal Option -->
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all group">
                                <input type="radio" name="payment_method" value="paypal" class="w-5 h-5 text-blue-600 cursor-pointer">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 3H3v18h6c3.31 0 6-2.69 6-6s-2.69-6-6-6zm0 10H5v-4h4c1.66 0 3 1.34 3 3s-1.34 3-3 3zm11-8H11v10h9c3.31 0 6-2.69 6-6s-2.69-6-6-6z"/>
                                        </svg>
                                        <span class="font-bold text-gray-900">PayPal</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Fast and secure payment</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('checkout.process-payment') }}" id="deliveryForm" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <input type="hidden" name="payment_method_field" id="payment_method_field" value="card">
                        <input type="hidden" name="delivery_address" value="{{ $deliveryAddress }}">
                        <input type="hidden" name="delivery_fee" value="40">

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                            Proceed to Payment
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar - Price Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8 sticky top-4">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Price Summary</h3>

                    <div class="space-y-4 mb-6 pb-6 border-b-2 border-gray-200">
                        <div class="flex justify-between">
                            <span class="text-gray-700">Subtotal</span>
                            <span class="font-semibold text-gray-900" id="subtotalDisplay">৳{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Delivery Fee</span>
                            <span class="font-semibold text-gray-900" id="deliveryFeeDisplay">৳40</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Discount</span>
                            <span class="font-semibold text-green-600">-৳0.00</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex justify-between">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent" id="totalDisplay">৳{{ number_format($total + 40, 2) }}</span>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-blue-700">
                        <p class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                            </svg>
                            Delivery fee varies based on location and method
                        </p>
                    </div>

                    <div class="mt-6 text-xs text-gray-600 text-center">
                        <p>Items: {{ $cartItems->count() }}</p>
                        <p>Estimated delivery: 2-3 days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.main-content {
    margin-left: 280px;
    transition: margin-left 0.3s ease;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 0;
    }
}
</style>

<script>
// Delivery pricing structure
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

document.addEventListener('DOMContentLoaded', function() {
    // Handle payment method selection
    const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
    const paymentMethodField = document.getElementById('payment_method_field');
    
    paymentMethodRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (paymentMethodField) {
                paymentMethodField.value = this.value;
            }
        });
    });
    
    // Get stored delivery information from localStorage
    const savedAddress = localStorage.getItem('mednet_delivery_location');
    const savedLocationType = localStorage.getItem('mednet_delivery_location_type') || 'inside_dhaka';
    const savedMethod = localStorage.getItem('mednet_delivery_method') || 'standard';
    
    // Update form hidden inputs - find them by name instead of ID
    const addressInput = document.querySelector('input[name="delivery_address"]');
    const locationInput = document.querySelector('input[name="delivery_location"]');
    const methodInput = document.querySelector('input[name="delivery_method"]');
    const feeInput = document.querySelector('input[name="delivery_fee"]');
    
    if (savedAddress && addressInput) {
        addressInput.value = savedAddress;
        document.getElementById('deliveryAddressDisplay').textContent = savedAddress;
    }
    
    if (savedLocationType && locationInput) {
        locationInput.value = savedLocationType;
    }
    
    if (savedMethod && methodInput) {
        methodInput.value = savedMethod;
    }
    
    // Calculate delivery fee
    const deliveryFee = deliveryPricing[savedLocationType][savedMethod];
    if (feeInput) {
        feeInput.value = deliveryFee;
    }
    document.getElementById('deliveryFeeDisplay').textContent = '৳' + deliveryFee;
    
    // Update total - parse the subtotal properly
    const subtotalText = document.getElementById('subtotalDisplay').textContent.replace('৳', '').trim();
    const subtotal = parseFloat(subtotalText.replace(/,/g, ''));
    
    if (!isNaN(subtotal)) {
        const total = subtotal + deliveryFee;
        document.getElementById('totalDisplay').textContent = '৳' + total.toFixed(2);
    }
    
    // Function to use saved address
    window.useSavedAddress = function(addressId) {
        @foreach($savedAddresses as $address)
            if (addressId === {{ $address->id }}) {
                document.querySelector('input[name="delivery_address"]').value = '{{ $address->address }}';
                document.getElementById('deliveryAddressDisplay').textContent = '{{ $address->address }}';
                
                // Update location type (inside/outside dhaka)
                const locationType = {{ $address->is_inside_dhaka ? 'true' : 'false' }} ? 'inside_dhaka' : 'outside_dhaka';
                if (document.querySelector('input[name="delivery_location"]')) {
                    document.querySelector('input[name="delivery_location"]').value = locationType;
                }
                
                // Update delivery fee based on location
                const deliveryFee = deliveryPricing[locationType]['standard'];
                const feeInput = document.querySelector('input[name="delivery_fee"]');
                if (feeInput) {
                    feeInput.value = deliveryFee;
                }
                document.getElementById('deliveryFeeDisplay').textContent = '৳' + deliveryFee;
                
                // Update total
                const subtotalText = document.getElementById('subtotalDisplay').textContent.replace('৳', '').trim();
                const subtotal = parseFloat(subtotalText.replace(/,/g, ''));
                if (!isNaN(subtotal)) {
                    const total = subtotal + deliveryFee;
                    document.getElementById('totalDisplay').textContent = '৳' + total.toFixed(2);
                }
            }
        @endforeach
    }
});
</script>
</x-app-layout>
