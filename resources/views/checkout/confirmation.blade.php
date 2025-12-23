@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-green-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Success Animation -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-100 mb-6 animate-bounce">
                <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Order Confirmed!</h1>
            <p class="text-xl text-gray-600">Your order has been successfully placed</p>
        </div>

        <!-- Tracking Number Card -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-2xl p-8 mb-8 text-white">
            <p class="text-green-100 text-sm font-semibold mb-2">TRACKING NUMBER</p>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-5xl font-bold mb-2" id="trackingNumber">{{ $order->tracking_number }}</p>
                    <p class="text-green-100">Save this number to track your order</p>
                </div>
                <button onclick="copyTracking()" class="bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg p-3 transition-all duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 3a1 1 0 000 2h6v2H7a2 2 0 00-2 2v2h12V7a1 1 0 10-2 0v1h-2V5a2 2 0 00-2-2H7z"/>
                        <path fill-rule="evenodd" d="M5 9a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2V9zm2 0h8v8H7V9z" clip-rule="evenodd"/>
                    </svg>
                    Copy
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Order Details -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                    </svg>
                    Order Details
                </h2>

                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                        <span class="text-gray-700">Order Date</span>
                        <span class="font-semibold text-gray-900">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                        <span class="text-gray-700">Order Time</span>
                        <span class="font-semibold text-gray-900">{{ $order->created_at->format('h:i A') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                        <span class="text-gray-700">Payment Method</span>
                        <span class="font-semibold text-gray-900 capitalize">{{ $order->payment_method }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                        <span class="text-gray-700">Payment Status</span>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Paid
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Order Status</span>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">Processing</span>
                    </div>
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"/>
                    </svg>
                    Delivery Info
                </h2>

                <div class="space-y-4 bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl border border-green-200">
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Delivery Address</p>
                        <p class="text-gray-900 font-medium">{{ $order->delivery_address }}</p>
                    </div>
                    @if($order->delivery_latitude && $order->delivery_longitude)
                        <div class="text-xs text-gray-600 space-y-1">
                            <p>📍 Latitude: {{ number_format($order->delivery_latitude, 4) }}</p>
                            <p>📍 Longitude: {{ number_format($order->delivery_longitude, 4) }}</p>
                        </div>
                    @endif
                    <div class="bg-white rounded-lg p-3 text-sm">
                        <p class="text-gray-700 mb-1">Estimated Delivery</p>
                        <p class="font-bold text-green-600">{{ $order->created_at->addDays(2)->format('M d, Y') }} - {{ $order->created_at->addDays(3)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
                </svg>
                Order Items ({{ $order->items->count() }})
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left py-3 px-4 font-bold text-gray-700">Product</th>
                            <th class="text-center py-3 px-4 font-bold text-gray-700">Qty</th>
                            <th class="text-right py-3 px-4 font-bold text-gray-700">Price</th>
                            <th class="text-right py-3 px-4 font-bold text-gray-700">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $item->product->generic_name ?? 'Generic' }}</p>
                                    </div>
                                </td>
                                <td class="text-center py-4 px-4 font-semibold text-gray-900">{{ $item->quantity }}</td>
                                <td class="text-right py-4 px-4 text-gray-900">৳{{ number_format($item->price, 2) }}</td>
                                <td class="text-right py-4 px-4 font-bold text-green-600">৳{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Section -->
            <div class="mt-6 flex justify-end">
                <div class="w-full sm:w-80">
                    <div class="flex justify-between py-3 border-b-2 border-gray-200 mb-4">
                        <span class="text-gray-700">Subtotal</span>
                        <span class="font-semibold">৳{{ number_format($order->items->sum(fn($item) => $item->subtotal), 2) }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b-2 border-gray-200 mb-4">
                        <span class="text-gray-700">Delivery Fee</span>
                        <span class="font-semibold text-blue-600">৳{{ number_format($order->total_amount - $order->items->sum(fn($item) => $item->subtotal), 2) }}</span>
                    </div>
                    <div class="flex justify-between py-3">
                        <span class="text-lg font-bold text-gray-900">Total Amount</span>
                        <span class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">৳{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('checkout.order-details', $order) }}" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl text-center flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2H2a1 1 0 00-1 1v14a1 1 0 001 1h14a1 1 0 001-1V7a1 1 0 00-1-1h2a1 1 0 100 2 2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z" clip-rule="evenodd"/>
                </svg>
                View Full Details
            </a>
            <a href="/" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold py-3 px-6 rounded-xl transition-colors duration-300 text-center flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                Continue Shopping
            </a>
        </div>

        <!-- Support Section -->
        <div class="mt-12 bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-2xl p-8 text-center">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Need Help?</h3>
            <p class="text-gray-700 mb-4">You will receive an email confirmation shortly with all order details and a link to track your order.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="mailto:support@mednet.com" class="text-blue-600 hover:text-blue-800 font-semibold">📧 Email Support</a>
                <span class="text-gray-400">•</span>
                <a href="tel:+8801234567890" class="text-blue-600 hover:text-blue-800 font-semibold">📞 Call Us</a>
                <span class="text-gray-400">•</span>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">💬 Live Chat</a>
            </div>
        </div>
    </div>
</div>

<script>
function copyTracking() {
    const tracking = document.getElementById('trackingNumber').textContent;
    navigator.clipboard.writeText(tracking).then(() => {
        alert('Tracking number copied to clipboard!');
    });
}
</script>
@endsection
