<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    </x-slot>

    @include('layouts.sidebar')

    <div class="main-content">
        <div class="py-12 px-4">
            <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                    <span class="text-purple-600 font-bold text-lg">2</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Payment Method</h1>
            </div>
            <div class="h-1 bg-gradient-to-r from-purple-500 to-purple-300 rounded-full"></div>
        </div>

        <!-- Order Summary Preview -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex justify-between items-center" style="color: #111;">
                <div>
                    <p class="text-sm text-gray-600">Order Total (with delivery)</p>
                    <p class="text-3xl font-bold text-gray-900">৳{{ number_format($total, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Delivering to</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $deliveryAddress }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t flex gap-8 text-sm">
                <div>
                    <p class="text-gray-600">Subtotal</p>
                    <p class="font-bold text-gray-900">৳{{ number_format($subtotal, 2) }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Delivery Fee</p>
                    <p class="font-bold text-blue-600">৳{{ number_format($deliveryFee, 2) }}</p>
                </div>
                <div>
                    <p class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $deliveryLocation)) }} - {{ ucfirst($deliveryMethod) }}</p>
                    <p class="font-bold text-gray-900">{{ $deliveryLocation === 'inside_dhaka' ? 'Inside Dhaka' : 'Outside Dhaka' }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Method Selection -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8" style="color: #111;">Order Confirmation</h2>
            <style>
                .bg-white, .bg-white * {
                    color: #111 !important;
                }
            </style>

            <form id="paymentForm" method="POST" action="{{ route('checkout.process-payment') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="payment_method" value="test">
                <input type="hidden" name="delivery_address" value="{{ $deliveryAddress }}">
                <input type="hidden" name="delivery_fee" value="{{ $deliveryFee }}">
                <input type="hidden" name="delivery_location" value="{{ $deliveryLocation }}">
                <input type="hidden" name="delivery_method" value="{{ $deliveryMethod }}">

                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-xl p-6">
                    <p class="text-gray-700 mb-4">Your order is ready to be placed. Click the button below to confirm and receive your tracking number.</p>
                    <p class="text-sm text-gray-600">This is a test site - no actual payment will be charged.</p>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl text-lg">
                    Complete Order & Get Tracking Number
                </button>
            </form>
        </div>

        <!-- Test Site Notice -->
        <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border-2 border-yellow-300 rounded-2xl p-8 mb-8">
            <div class="flex gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-yellow-900 mb-2">⚠️ Test Environment</h3>
                    <p class="text-yellow-800 mb-3">This is a demonstration site. No actual payment will be processed. The payment is simulated for testing purposes only.</p>
                    <div class="bg-white bg-opacity-60 rounded-lg p-3 text-sm text-yellow-900">
                        <p><strong>Test Card Details:</strong></p>
                        <p>Card: 4111 1111 1111 1111</p>
                        <p>Exp: Any future date | CVV: Any 3 digits</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items Summary -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
                </svg>
                Items in Order
            </h3>
            <div class="space-y-3 max-h-48 overflow-y-auto">
                @foreach($cartItems as $item)
                    <div class="flex justify-between text-sm p-2 border-b">
                        <span class="text-gray-700">{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span class="font-semibold text-gray-900">৳{{ number_format($item->subtotal, 2) }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Payment Button -->
        <div class="flex gap-4">
            <a href="{{ route('checkout.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold py-4 px-6 rounded-xl transition-colors duration-300 text-center">
                ← Back
            </a>
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

input[type="radio"]:checked + label {
    outline: none;
}
</style>
</x-app-layout>
