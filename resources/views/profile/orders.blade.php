<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    @include('layouts.sidebar')

    <div class="main-content">
        <div class="py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <!-- Header Section -->
                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900">Order History</h1>
                            <p class="text-gray-600 mt-1">Track and manage all your orders</p>
                        </div>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-blue-600 to-blue-300 rounded-full"></div>
                </div>

                <!-- Empty State -->
                @if($orders->isEmpty())
                    <div class="bg-white rounded-3xl shadow-lg p-16 text-center">
                        <div class="mb-6">
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-100 mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-3">No Orders Yet</h3>
                        <p class="text-gray-600 mb-8 text-lg">You haven't placed any orders yet. Start shopping to see your orders here.</p>
                        <a href="{{ route('dashboard') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold py-4 px-10 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                            🛍️ Start Shopping
                        </a>
                    </div>
                @else
                    <!-- Orders List -->
                    <div class="space-y-6">
                        @foreach($orders as $order)
                            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-l-4 border-blue-600">
                                <!-- Order Header with Tracking Number -->
                                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-gray-200">
                                    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                                        <!-- Tracking Number -->
                                        <div class="md:col-span-2">
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">📍 Tracking Number</p>
                                            <p class="text-xl font-bold text-blue-600 font-mono break-words">{{ $order->tracking_number }}</p>
                                            <button onclick="copyToClipboard('{{ $order->tracking_number }}')" class="text-xs text-blue-600 hover:text-blue-800 font-semibold mt-2 inline-flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M7 3a1 1 0 000 2h6v2H7a2 2 0 00-2 2v2h12V7a1 1 0 10-2 0v1h-2V5a2 2 0 00-2-2H7z"/>
                                                    <path fill-rule="evenodd" d="M5 9a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2V9zm2 0h8v8H7V9z" clip-rule="evenodd"/>
                                                </svg>
                                                Copy
                                            </button>
                                        </div>

                                        <!-- Order Date -->
                                        <div>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">📅 Date</p>
                                            <p class="text-lg font-bold text-gray-900">{{ $order->created_at->format('M d') }}</p>
                                            <p class="text-sm text-gray-600">{{ $order->created_at->format('Y') }}</p>
                                        </div>

                                        <!-- Total Amount -->
                                        <div>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">💰 Total</p>
                                            <p class="text-2xl font-bold text-green-600">৳{{ number_format($order->total_amount, 2) }}</p>
                                        </div>

                                        <!-- Status -->
                                        <div>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Status</p>
                                            <span class="inline-block px-4 py-2 rounded-full text-sm font-bold
                                                @if($order->order_status === 'pending')
                                                    bg-yellow-100 text-yellow-800
                                                @elseif($order->order_status === 'processing')
                                                    bg-blue-100 text-blue-800
                                                @else
                                                    bg-green-100 text-green-800
                                                @endif
                                            ">
                                                {{ ucfirst($order->order_status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Items -->
                                <div class="px-8 py-6 border-b border-gray-200">
                                    <h3 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wide">📦 Order Items ({{ $order->items->count() }})</h3>
                                    <div class="space-y-3">
                                        @foreach($order->items as $item)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                                <div class="flex-1">
                                                    <p class="font-semibold text-gray-900">{{ $item->product->name }}</p>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        <span class="font-bold">{{ $item->quantity }}</span> unit(s) 
                                                        <span class="text-gray-500">× ৳{{ number_format($item->price, 2) }}</span>
                                                    </p>
                                                </div>
                                                <div class="text-right mr-4">
                                                    <p class="font-bold text-gray-900">৳{{ number_format($item->subtotal, 2) }}</p>
                                                    <p class="text-xs text-gray-500 mt-1">Subtotal</p>
                                                </div>
                                                <form method="POST" action="{{ route('checkout.reduce-quantity', $item->id) }}" class="inline" onsubmit="return confirm('❓ Remove this item from order? This will return the quantity to stock.');">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm opacity-0 group-hover:opacity-100 transition-opacity hover:underline px-3 py-2 bg-red-50 rounded hover:bg-red-100">
                                                        🗑️ Remove
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Delivery Information -->
                                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
                                    <h3 class="text-sm font-bold text-gray-900 mb-3 uppercase tracking-wide">📍 Delivery Address</h3>
                                    <p class="text-gray-700 font-medium">{{ $order->delivery_address }}</p>
                                    <p class="text-xs text-gray-600 mt-2">Standard Delivery (2-3 days)</p>
                                </div>

                                <!-- Cost Breakdown -->
                                <div class="px-8 py-6 border-b border-gray-200">
                                    @php
                                    $subtotal = $order->items->sum('subtotal');
                                    $deliveryFee = $order->total_amount - $subtotal;
                                    @endphp
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-gray-600 text-sm font-semibold">Subtotal</p>
                                            <p class="text-2xl font-bold text-gray-900">৳{{ number_format($subtotal, 2) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm font-semibold">Delivery Fee</p>
                                            <p class="text-2xl font-bold text-blue-600">৳{{ number_format($deliveryFee, 2) }}</p>
                                        </div>
                                        <div class="bg-gradient-to-r from-green-100 to-emerald-100 rounded-lg p-4">
                                            <p class="text-gray-600 text-sm font-semibold">Total Amount</p>
                                            <p class="text-3xl font-bold text-green-600">৳{{ number_format($order->total_amount, 2) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="px-8 py-6 bg-gray-50 flex flex-col sm:flex-row gap-3">
                                    <a href="{{ route('checkout.order-details', $order->id) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 text-center inline-flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                        </svg>
                                        View Full Details
                                    </a>
                                    <button onclick="copyToClipboard('{{ $order->tracking_number }}')" class="flex-1 px-4 py-3 border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold rounded-lg transition-all duration-300 inline-flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M7 3a1 1 0 000 2h6v2H7a2 2 0 00-2 2v2h12V7a1 1 0 10-2 0v1h-2V5a2 2 0 00-2-2H7z"/>
                                            <path fill-rule="evenodd" d="M5 9a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2V9zm2 0h8v8H7V9z" clip-rule="evenodd"/>
                                        </svg>
                                        Copy Tracking
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Back to Shopping Button -->
                <div class="mt-12 text-center">
                    <a href="{{ route('dashboard') }}" class="inline-block bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold py-3 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                        ← Back to Shopping
                    </a>
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

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('✅ Tracking number copied to clipboard: ' + text);
            }).catch(() => {
                alert('Failed to copy tracking number');
            });
        }
    </script>
</x-app-layout>
