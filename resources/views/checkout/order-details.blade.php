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
            <a href="/" class="text-indigo-600 hover:text-indigo-800 font-semibold flex items-center gap-2 mb-6">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Back to Home
            </a>
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Order Tracking</h1>
            <p class="text-xl text-gray-600">Track your order and view complete details</p>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Tracking & Status -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Tracking Number Card -->
                <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-xl p-8 text-white">
                    <p class="text-indigo-100 text-sm font-semibold mb-2">YOUR TRACKING NUMBER</p>
                    <div class="flex items-end justify-between">
                        <div>
                            <p class="text-4xl font-bold mb-2" id="trackingNumber">{{ $order->tracking_number }}</p>
                            <p class="text-indigo-100">Track order status in real-time</p>
                        </div>
                        <button onclick="copyTracking()" class="bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg p-3 transition-all duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6v2H7a2 2 0 00-2 2v2h12V7a1 1 0 10-2 0v1h-2V5a2 2 0 00-2-2H7z"/>
                                <path fill-rule="evenodd" d="M5 9a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2V9zm2 0h8v8H7V9z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Order Status Timeline -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">Order Status</h2>

                    <div class="relative">
                        <!-- Timeline Line -->
                        <div class="absolute left-5 top-0 bottom-0 w-1 bg-gradient-to-b from-green-400 to-gray-300"></div>

                        <!-- Timeline Items -->
                        <div class="space-y-8">
                            <!-- Completed -->
                            <div class="relative pl-16">
                                <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-green-100 border-4 border-green-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg">Order Confirmed</h3>
                                    <p class="text-gray-600">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Your order has been successfully placed</p>
                                </div>
                            </div>

                            <!-- Current - Processing -->
                            <div class="relative pl-16">
                                <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-indigo-100 border-4 border-indigo-500 flex items-center justify-center animate-pulse">
                                    <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011-1h8a1 1 0 011 1v1h4a1 1 0 010 2h-1v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5H1a1 1 0 010-2h4V2z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg">Processing</h3>
                                    <p class="text-gray-600">In Progress</p>
                                    <p class="text-sm text-gray-500 mt-1">We're preparing your order for shipment</p>
                                </div>
                            </div>

                            <!-- Pending - Shipped -->
                            <div class="relative pl-16">
                                <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-gray-100 border-4 border-gray-400 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg">Shipped</h3>
                                    <p class="text-gray-600">Expected: {{ $order->created_at->addDays(2)->format('M d, Y') }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Your order will be on its way soon</p>
                                </div>
                            </div>

                            <!-- Pending - Delivered -->
                            <div class="relative pl-16">
                                <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-gray-100 border-4 border-gray-400 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg">Delivered</h3>
                                    <p class="text-gray-600">Expected: {{ $order->created_at->addDays(3)->format('M d, Y') }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Order will arrive at your doorstep</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Items in This Order</h2>

                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl hover:border-indigo-300 hover:bg-indigo-50 transition-all">
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 text-lg">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $item->product->generic_name ?? 'Generic' }}</p>
                                    <p class="text-xs text-gray-500 mt-2">Quantity: <span class="font-semibold">{{ $item->quantity }}</span></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-indigo-600">৳{{ number_format($item->subtotal, 2) }}</p>
                                    <p class="text-sm text-gray-600">৳{{ number_format($item->price, 2) }} each</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Summary -->
            <div class="lg:col-span-1">
                <!-- Order Summary Card -->
                <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-4 space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                            </svg>
                            Order Information
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Order ID</span>
                                <span class="font-semibold text-gray-900">#{{ $order->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Order Date</span>
                                <span class="font-semibold text-gray-900">{{ $order->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Method</span>
                                <span class="font-semibold capitalize text-gray-900">{{ $order->payment_method }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Status</span>
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded">PAID</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t-2 border-gray-200 pt-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"/>
                            </svg>
                            Delivery Address
                        </h3>
                        <p class="text-gray-900 font-medium text-sm">{{ $order->delivery_address }}</p>
                        @if($order->delivery_latitude && $order->delivery_longitude)
                            <p class="text-xs text-gray-600 mt-2">
                                📍 {{ number_format($order->delivery_latitude, 4) }}, {{ number_format($order->delivery_longitude, 4) }}
                            </p>
                        @endif
                        <p class="text-xs text-gray-600 mt-3">
                            <strong>Estimated Delivery:</strong><br>
                            {{ $order->created_at->addDays(2)->format('M d') }} - {{ $order->created_at->addDays(3)->format('M d, Y') }}
                        </p>
                    </div>

                    <div class="border-t-2 border-gray-200 pt-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Price Summary</h3>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold text-gray-900">৳{{ number_format($order->items->sum(fn($item) => $item->subtotal), 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Delivery</span>
                                <span class="font-semibold text-blue-600">৳{{ number_format($order->total_amount - $order->items->sum(fn($item) => $item->subtotal), 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Discount</span>
                                <span class="font-semibold text-green-600">-৳0.00</span>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">৳{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Support Card -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-200 rounded-xl p-4">
                        <h4 class="font-bold text-gray-900 text-sm mb-2">Need Help?</h4>
                        <p class="text-xs text-gray-700 mb-3">Contact our support team if you have any questions about your order.</p>
                        <div class="space-y-2 text-xs">
                            <a href="mailto:support@mednet.com" class="block text-indigo-600 hover:text-indigo-800 font-semibold">📧 support@mednet.com</a>
                            <a href="tel:+8801234567890" class="block text-indigo-600 hover:text-indigo-800 font-semibold">📞 +880 123 456 7890</a>
                        </div>
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
    const tracking = document.getElementById('trackingNumber').textContent;
    navigator.clipboard.writeText(tracking).then(() => {
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '✓ Copied!';
        setTimeout(() => {
            btn.innerHTML = originalText;
        }, 2000);
    });
}
</script>
</x-app-layout>
