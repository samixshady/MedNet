<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    </x-slot>

    @include('layouts.sidebar')

    <div class="main-content">
        <div class="py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Success Animation -->
                <div class="text-center mb-8 sm:mb-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 mb-6 sm:mb-8 animate-bounce shadow-2xl">
                        <svg class="w-10 h-10 sm:w-14 sm:h-14 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-2 sm:mb-4">🎉 Order Confirmed!</h1>
                    <p class="text-base sm:text-lg lg:text-xl text-gray-600 mb-1 sm:mb-2">Your order has been successfully placed</p>
                    <p class="text-base sm:text-lg text-emerald-600 font-semibold">Your product will arrive soon!</p>
                </div>

                <!-- Tracking Number Card - Large and Prominent -->
                <div class="bg-gradient-to-br from-blue-600 via-blue-500 to-indigo-600 rounded-2xl sm:rounded-3xl shadow-2xl p-6 sm:p-8 lg:p-10 mb-8 sm:mb-10 text-white transform hover:scale-105 transition-transform duration-300">
                    <div class="text-center">
                        <p class="text-blue-100 text-sm font-bold uppercase tracking-widest mb-4">Your Tracking Number</p>
                        <div class="mb-6">
                            <p class="text-6xl font-black font-mono mb-3 break-words" id="trackingNumber">{{ $order->tracking_number }}</p>
                            <p class="text-blue-100 text-lg">Save this number to track your order</p>
                        </div>
                        <div class="flex gap-3 justify-center flex-wrap">
                            <button onclick="copyTracking()" class="bg-white bg-opacity-25 hover:bg-opacity-40 rounded-lg px-6 py-3 transition-all duration-300 flex items-center gap-2 font-semibold backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7 3a1 1 0 000 2h6v2H7a2 2 0 00-2 2v2h12V7a1 1 0 10-2 0v1h-2V5a2 2 0 00-2-2H7z"/>
                                    <path fill-rule="evenodd" d="M5 9a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2V9zm2 0h8v8H7V9z" clip-rule="evenodd"/>
                                </svg>
                                Copy Tracking Number
                            </button>
                            <button onclick="downloadTracking()" class="bg-white bg-opacity-25 hover:bg-opacity-40 rounded-lg px-6 py-3 transition-all duration-300 flex items-center gap-2 font-semibold backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Download Receipt
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Order Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                    <!-- Order Total -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-green-500">
                        <p class="text-gray-600 text-sm font-bold uppercase mb-2">Order Total</p>
                        <p class="text-4xl font-bold text-gray-900 mb-2">৳{{ number_format($order->total_amount, 2) }}</p>
                        <p class="text-sm text-gray-500">including delivery fee</p>
                    </div>

                    <!-- Order Date -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-blue-500">
                        <p class="text-gray-600 text-sm font-bold uppercase mb-2">Order Date</p>
                        <p class="text-3xl font-bold text-gray-900 mb-2">{{ $order->created_at->format('M d') }}</p>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('Y') }} at {{ $order->created_at->format('h:i A') }}</p>
                    </div>

                    <!-- Delivery Address -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-purple-500">
                        <p class="text-gray-600 text-sm font-bold uppercase mb-2">Delivery Address</p>
                        <p class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $order->delivery_address }}</p>
                        <p class="text-sm text-gray-500">Standard Delivery</p>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-orange-500">
                        <p class="text-gray-600 text-sm font-bold uppercase mb-2">Payment Method</p>
                        <div class="flex items-center gap-2 mb-2">
                            @if($order->payment_method === 'card')
                                <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 8H4V6h16m0 10H4v-6h16m0-4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z"/>
                                </svg>
                                <span class="font-bold text-gray-900">Credit Card</span>
                            @elseif($order->payment_method === 'paypal')
                                <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 3H3v18h6c3.31 0 6-2.69 6-6s-2.69-6-6-6zm0 10H5v-4h4c1.66 0 3 1.34 3 3s-1.34 3-3 3zm11-8H11v10h9c3.31 0 6-2.69 6-6s-2.69-6-6-6z"/>
                                </svg>
                                <span class="font-bold text-gray-900">PayPal</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500">{{ ucfirst($order->payment_status) }}</p>
                    </div>
                </div>
                        <p class="text-3xl font-bold text-gray-900 mb-2">{{ $order->created_at->format('M d') }}</p>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('Y') }} at {{ $order->created_at->format('h:i A') }}</p>
                    </div>

                    <!-- Delivery Address -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-purple-500">
                        <p class="text-gray-600 text-sm font-bold uppercase mb-2">Delivery Address</p>
                        <p class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $order->delivery_address }}</p>
                        <p class="text-sm text-gray-500">Standard Delivery</p>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-10">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
                        </svg>
                        Order Items
                    </h2>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex items-center justify-between p-5 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-200 hover:border-blue-300 transition-colors group">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 text-lg">{{ $item->product->name }}</h3>
                                <p class="text-gray-600 text-sm mt-1">
                                    <span class="font-semibold text-gray-900">{{ $item->quantity }}</span> 
                                    <span class="text-gray-500">× ৳{{ number_format($item->price, 2) }}</span>
                                </p>
                            </div>
                            <div class="text-right mr-4">
                                <p class="text-2xl font-bold text-blue-600">৳{{ number_format($item->subtotal, 2) }}</p>
                                <p class="text-sm text-gray-500 mt-1">Subtotal</p>
                            </div>
                            <form method="POST" action="{{ route('checkout.reduce-quantity', $item->id) }}" class="inline" onsubmit="return confirm('❓ Deduct this product quantity? This will return the item to stock.');">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm opacity-0 group-hover:opacity-100 transition-opacity hover:underline px-3 py-2 bg-red-50 rounded hover:bg-red-100 whitespace-nowrap">
                                    🔄 Deduct Qty
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>

                    <!-- Cost Breakdown -->
                    <div class="mt-8 pt-6 border-t-2 border-gray-200 space-y-3">
                        @php
                        $subtotal = $order->items->sum('subtotal');
                        $deliveryFee = $order->total_amount - $subtotal;
                        @endphp
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-semibold">Subtotal</span>
                            <span class="text-gray-900 font-bold">৳{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-semibold">Delivery Fee</span>
                            <span class="text-blue-600 font-bold">৳{{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t-2 border-gray-200">
                            <span class="text-gray-900 font-bold text-lg">Total Amount</span>
                            <span class="text-2xl font-bold text-green-600">৳{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- What Happens Next -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-lg p-8 mb-10 border border-blue-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z" clip-rule="evenodd"/>
                        </svg>
                        What Happens Next
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">1</div>
                            <div>
                                <p class="font-bold text-gray-900">Order Confirmed</p>
                                <p class="text-gray-600 text-sm">Your order has been received and confirmed. Your tracking number is above.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">2</div>
                            <div>
                                <p class="font-bold text-gray-900">Processing</p>
                                <p class="text-gray-600 text-sm">Your order is being prepared for shipment.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">3</div>
                            <div>
                                <p class="font-bold text-gray-900">On the Way</p>
                                <p class="text-gray-600 text-sm">Your package will be delivered to the address provided.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-600 flex items-center justify-center text-white font-bold">✓</div>
                            <div>
                                <p class="font-bold text-gray-900">Delivered</p>
                                <p class="text-gray-600 text-sm">Your order has been delivered successfully!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('profile.orders') }}" class="flex-1 sm:flex-initial bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl text-center text-lg inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                        </svg>
                        View My Orders
                    </a>
                    <a href="{{ route('dashboard') }}" class="flex-1 sm:flex-initial bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl text-center text-lg inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Continue Shopping
                    </a>
                </div>

                <!-- Test Site Notice -->
                <div class="mt-10 bg-amber-50 border-2 border-amber-300 rounded-2xl p-6">
                    <div class="flex gap-3">
                        <svg class="w-6 h-6 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="font-bold text-amber-900">This is a Test Site</p>
                            <p class="text-amber-800 text-sm mt-1">This is a demonstration environment. No actual delivery will occur. This is for testing purposes only.</p>
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
        function copyTracking() {
            const trackingNumber = document.getElementById('trackingNumber').textContent.trim();
            navigator.clipboard.writeText(trackingNumber).then(() => {
                alert('✅ Tracking number copied to clipboard: ' + trackingNumber);
            }).catch(() => {
                alert('Failed to copy tracking number');
            });
        }

        function downloadTracking() {
            const trackingNumber = document.getElementById('trackingNumber').textContent.trim();
            const content = `
ORDER RECEIPT
=============
Tracking Number: ${trackingNumber}
Order Date: {{ $order->created_at->format('M d, Y h:i A') }}
Total Amount: ৳{{ number_format($order->total_amount, 2) }}
Delivery Address: {{ $order->delivery_address }}

Your product will arrive soon!
Visit your profile orders page to track your order.
            `;
            const element = document.createElement('a');
            element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(content));
            element.setAttribute('download', `receipt-${trackingNumber}.txt`);
            element.style.display = 'none';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        }
    </script>
</x-app-layout>

