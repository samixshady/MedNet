@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        Support Messages
                    </h1>
                    <p class="mt-2 text-gray-600">Manage customer feedback and support requests</p>
                </div>
                
                <!-- Stats -->
                <div class="flex gap-4 flex-wrap">
                    <div class="bg-white rounded-lg shadow px-4 py-2 text-center min-w-[80px]">
                        <div class="text-2xl font-bold text-indigo-600">{{ $feedbacks->total() }}</div>
                        <div class="text-xs text-gray-600">Total</div>
                    </div>
                    <div class="bg-white rounded-lg shadow px-4 py-2 text-center min-w-[80px]">
                        <div class="text-2xl font-bold text-amber-600">{{ $feedbacks->where('status', 'pending')->count() }}</div>
                        <div class="text-xs text-gray-600">Pending</div>
                    </div>
                    <div class="bg-white rounded-lg shadow px-4 py-2 text-center min-w-[80px]">
                        <div class="text-2xl font-bold text-red-600">{{ $feedbacks->where('is_urgent', true)->count() }}</div>
                        <div class="text-xs text-gray-600">Urgent</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 mb-6">
            <form method="GET" action="{{ route('admin.support-feedback.index') }}" class="space-y-4" id="filterForm">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search by name, phone, or message..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                        <select name="sort_by" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date</option>
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
                        </select>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                        <select name="sort_order" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Newest First</option>
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                    </div>
                </div>

                <!-- Quick Filters -->
                <div class="flex gap-3 flex-wrap items-center">
                    <button type="button" onclick="toggleFilter('urgent')" 
                            class="filter-btn text-sm {{ request('urgent') == '1' ? 'active' : '' }}" data-filter="urgent">
                        🚨 Urgent Only
                    </button>
                    <button type="button" onclick="toggleFilter('pinned')" 
                            class="filter-btn text-sm {{ request('pinned') == '1' ? 'active' : '' }}" data-filter="pinned">
                        📌 Pinned Only
                    </button>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition font-medium">
                        Apply Filters
                    </button>
                    <a href="{{ route('admin.support-feedback.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300 transition font-medium">
                        Clear All
                    </a>
                </div>

                <input type="hidden" name="urgent" id="urgentFilter" value="{{ request('urgent') }}">
                <input type="hidden" name="pinned" id="pinnedFilter" value="{{ request('pinned') }}">
            </form>
        </div>

        <!-- Messages List -->
        <div class="space-y-4">
            @forelse ($feedbacks as $feedback)
                <div class="bg-white rounded-xl shadow-lg border-2 border-gray-900 hover:shadow-xl hover:border-indigo-600 transition-all duration-300 overflow-hidden message-card" data-id="{{ $feedback->id }}" data-status="{{ $feedback->status }}" data-pinned="{{ $feedback->is_pinned ? '1' : '0' }}" data-urgent="{{ $feedback->is_urgent ? '1' : '0' }}">
                    <div class="p-3 sm:p-4">
                        <!-- Desktop: 3 Column Layout | Mobile: Stacked -->
                        <div class="lg:grid lg:grid-cols-12 lg:gap-4">
                            <!-- Column 1: User Info (Mobile: Full width, Desktop: 3 cols) -->
                            <div class="lg:col-span-3 flex items-start gap-3 mb-3 lg:mb-0">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold text-base shadow-md">
                                        {{ strtoupper(substr($feedback->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-bold text-gray-900 mb-1 truncate">{{ $feedback->name }}</h3>
                                    <div class="flex items-center gap-1.5 mb-1 flex-wrap badge-container">
                                        @if($feedback->is_pinned)
                                            <span class="pinned-badge inline-flex items-center px-1.5 py-0.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">📌</span>
                                        @endif
                                        @if($feedback->is_urgent)
                                            <span class="urgent-badge inline-flex items-center px-1.5 py-0.5 bg-red-100 text-red-700 text-xs font-medium rounded-full">🚨</span>
                                        @endif
                                        <span class="status-badge inline-flex items-center px-1.5 py-0.5 text-xs font-medium rounded-full {{ $feedback->status == 'resolved' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ ucfirst($feedback->status) }}
                                        </span>
                                    </div>
                                    <div class="text-xs text-gray-600 space-y-0.5">
                                        <a href="tel:{{ $feedback->phone }}" class="flex items-center gap-1 hover:text-indigo-600 transition truncate">
                                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <span class="truncate">{{ $feedback->phone }}</span>
                                        </a>
                                        <div class="flex items-center gap-1 text-gray-500">
                                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="truncate">{{ $feedback->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Column 2: Message Content (Mobile: Full width, Desktop: 7 cols) -->
                            <div class="lg:col-span-7 mb-3 lg:mb-0">
                                <div class="message-content bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-3 border-l-4 {{ $feedback->is_urgent ? 'border-red-500' : 'border-indigo-500' }}">
                                    <p class="text-sm text-gray-800 leading-relaxed break-words whitespace-pre-wrap">{{ $feedback->message }}</p>
                                </div>
                            </div>

                            <!-- Column 3: Action Buttons (Mobile: Full width, Desktop: 2 cols) -->
                            <div class="lg:col-span-2 flex lg:flex-col items-center lg:items-end justify-end gap-1.5">
                                <button onclick="togglePin({{ $feedback->id }})" 
                                        class="p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200 transition {{ $feedback->is_pinned ? 'text-blue-600 bg-blue-50' : 'text-gray-400' }}" 
                                        title="Pin">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.074 1.632.775 2.016.29.16.613.238.93.238.458 0 .905-.165 1.242-.476A.75.75 0 106.75 13.5c-.057 0-.11.019-.165.05a.517.517 0 01-.313.045.75.75 0 01-.5-.865l.818-2.552a1 1 0 00-.595-1.198zM10 6a1 1 0 00-1 1v5a1 1 0 102 0V7a1 1 0 00-1-1z"></path>
                                </svg>
                            </button>
                            
                                <button onclick="toggleUrgent({{ $feedback->id }})" 
                                        class="p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200 transition {{ $feedback->is_urgent ? 'text-red-600 bg-red-50' : 'text-gray-400' }}" 
                                        title="Mark Urgent">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            
                                <button onclick="toggleStatus({{ $feedback->id }})" 
                                        class="p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200 transition {{ $feedback->status == 'resolved' ? 'text-green-600 bg-green-50' : 'text-amber-600 bg-amber-50' }}" 
                                        title="Toggle Status">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                            
                                <button onclick="deleteFeedback({{ $feedback->id }})" 
                                        class="p-2 rounded-lg hover:bg-red-100 active:bg-red-200 text-red-600 transition" 
                                        title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="flex items-center justify-between text-xs text-gray-500 gap-2 flex-wrap mt-2 lg:mt-3">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $feedback->created_at->format('M d, Y · h:i A') }}
                            </span>
                            @if($feedback->resolved_at)
                                <span class="inline-flex items-center gap-1.5 text-green-600 font-medium">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Resolved
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm p-8 md:p-12 text-center">
                    <svg class="mx-auto h-12 md:h-16 w-12 md:w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No messages found</h3>
                    <p class="text-gray-600">Try adjusting your filters or check back later.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($feedbacks->hasPages())
            <div class="mt-6 md:mt-8">
                {{ $feedbacks->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        border: 2px solid #e5e7eb;
        background: white;
        color: #6b7280;
        font-weight: 500;
        transition: all 0.2s;
        cursor: pointer;
    }
    
    .filter-btn:hover {
        border-color: #a855f7;
        color: #a855f7;
    }
    
    .filter-btn.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
    }
    
    .message-card {
        animation: slideIn 0.3s ease;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Modern Notification Toast -->
<div id="notification-toast" class="fixed top-4 right-4 z-50 transform translate-x-full transition-all duration-500 ease-out opacity-0">
    <div class="bg-white rounded-lg shadow-2xl border-l-4 border-green-500 p-4 flex items-center gap-3 min-w-[320px] max-w-md">
        <div id="toast-icon" class="flex-shrink-0">
            <!-- Icon will be inserted here -->
        </div>
        <div class="flex-1">
            <p id="toast-message" class="font-medium text-gray-900"></p>
        </div>
        <button onclick="hideToast()" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</div>

<!-- Modern Confirmation Modal -->
<div id="confirm-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 backdrop-blur-sm" onclick="hideConfirmModal()"></div>
        
        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-6 pt-6 pb-4">
                <div class="sm:flex sm:items-start">
                    <div id="modal-icon-container" class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full sm:mx-0 sm:h-12 sm:w-12">
                        <!-- Icon will be inserted here -->
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                        <h3 id="modal-title" class="text-xl font-bold text-gray-900 leading-6"></h3>
                        <div class="mt-2">
                            <p id="modal-message" class="text-sm text-gray-600"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse gap-3">
                <button id="modal-confirm-btn" onclick="confirmAction()" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-5 py-2.5 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:w-auto sm:text-sm transition-all">
                    Confirm
                </button>
                <button onclick="hideConfirmModal()" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-5 py-2.5 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm transition-all">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let confirmCallback = null;

    function showToast(message, type = 'success') {
        const toast = document.getElementById('notification-toast');
        const toastIcon = document.getElementById('toast-icon');
        const toastMessage = document.getElementById('toast-message');
        const toastContainer = toast.querySelector('div');
        
        // Set message
        toastMessage.textContent = message;
        
        // Set icon and colors based on type
        if (type === 'success') {
            toastContainer.className = 'bg-white rounded-lg shadow-2xl border-l-4 border-green-500 p-4 flex items-center gap-3 min-w-[320px] max-w-md';
            toastIcon.innerHTML = `
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            `;
        } else if (type === 'error') {
            toastContainer.className = 'bg-white rounded-lg shadow-2xl border-l-4 border-red-500 p-4 flex items-center gap-3 min-w-[320px] max-w-md';
            toastIcon.innerHTML = `
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            `;
        } else if (type === 'info') {
            toastContainer.className = 'bg-white rounded-lg shadow-2xl border-l-4 border-blue-500 p-4 flex items-center gap-3 min-w-[320px] max-w-md';
            toastIcon.innerHTML = `
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            `;
        }
        
        // Show toast
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
        
        // Auto hide after 4 seconds
        setTimeout(() => {
            hideToast();
        }, 4000);
    }

    function hideToast() {
        const toast = document.getElementById('notification-toast');
        toast.classList.remove('translate-x-0', 'opacity-100');
        toast.classList.add('translate-x-full', 'opacity-0');
    }

    function showConfirmModal(title, message, type, callback) {
        const modal = document.getElementById('confirm-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalMessage = document.getElementById('modal-message');
        const modalIconContainer = document.getElementById('modal-icon-container');
        const modalConfirmBtn = document.getElementById('modal-confirm-btn');
        
        // Set content
        modalTitle.textContent = title;
        modalMessage.textContent = message;
        confirmCallback = callback;
        
        // Set icon and colors based on type
        if (type === 'danger') {
            modalIconContainer.className = 'mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-red-100 sm:mx-0 sm:h-12 sm:w-12';
            modalIconContainer.innerHTML = `
                <svg class="h-7 w-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            `;
            modalConfirmBtn.className = 'w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-5 py-2.5 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm transition-all';
        } else if (type === 'warning') {
            modalIconContainer.className = 'mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-yellow-100 sm:mx-0 sm:h-12 sm:w-12';
            modalIconContainer.innerHTML = `
                <svg class="h-7 w-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            `;
            modalConfirmBtn.className = 'w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-5 py-2.5 bg-yellow-600 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:w-auto sm:text-sm transition-all';
        } else {
            modalIconContainer.className = 'mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-100 sm:mx-0 sm:h-12 sm:w-12';
            modalIconContainer.innerHTML = `
                <svg class="h-7 w-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            `;
            modalConfirmBtn.className = 'w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-5 py-2.5 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm transition-all';
        }
        
        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function hideConfirmModal() {
        const modal = document.getElementById('confirm-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        confirmCallback = null;
    }

    function confirmAction() {
        if (confirmCallback) {
            confirmCallback();
        }
        hideConfirmModal();
    }

    function toggleFilter(filterName) {
        const input = document.getElementById(filterName + 'Filter');
        const btn = document.querySelector(`[data-filter="${filterName}"]`);
        
        if (input.value === '1') {
            input.value = '';
            btn.classList.remove('active');
        } else {
            input.value = '1';
            btn.classList.add('active');
        }
    }
    
    async function toggleStatus(id) {
        try {
            const response = await fetch(`/admin/support-feedback/${id}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Update UI without reload
                const card = document.querySelector(`[data-id="${id}"]`);
                const statusBadge = card.querySelector('.status-badge');
                const statusButton = card.querySelector(`button[onclick*="toggleStatus(${id})"]`);
                
                const newStatus = data.status;
                card.setAttribute('data-status', newStatus);
                
                if (newStatus === 'resolved') {
                    statusBadge.className = 'status-badge inline-flex items-center px-1.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-700';
                    statusBadge.textContent = 'Resolved';
                    statusButton.className = 'p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200 transition text-green-600 bg-green-50';
                } else {
                    statusBadge.className = 'status-badge inline-flex items-center px-1.5 py-0.5 text-xs font-medium rounded-full bg-amber-100 text-amber-700';
                    statusBadge.textContent = 'Pending';
                    statusButton.className = 'p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200 transition text-amber-600 bg-amber-50';
                }
                
                showToast('Status updated successfully!', 'success');
            } else {
                showToast('Failed to update status', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('An error occurred while updating status', 'error');
        }
    }
    
    async function togglePin(id) {
        try {
            const response = await fetch(`/admin/support-feedback/${id}/toggle-pin`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Update UI without reload
                const card = document.querySelector(`[data-id="${id}"]`);
                const badgeContainer = card.querySelector('.badge-container');
                const pinButton = card.querySelector(`button[onclick*="togglePin(${id})"]`);
                
                const isPinned = data.is_pinned;
                card.setAttribute('data-pinned', isPinned ? '1' : '0');
                
                // Update button
                pinButton.className = `p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200 transition ${isPinned ? 'text-blue-600 bg-blue-50' : 'text-gray-400'}`;
                
                // Update or add badge
                let pinnedBadge = badgeContainer.querySelector('.pinned-badge');
                if (isPinned) {
                    if (!pinnedBadge) {
                        pinnedBadge = document.createElement('span');
                        pinnedBadge.className = 'pinned-badge inline-flex items-center px-1.5 py-0.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-full';
                        pinnedBadge.textContent = '📌';
                        badgeContainer.insertBefore(pinnedBadge, badgeContainer.firstChild);
                    }
                } else {
                    if (pinnedBadge) pinnedBadge.remove();
                }
                
                showToast(isPinned ? 'Message pinned!' : 'Message unpinned!', 'success');
            } else {
                showToast('Failed to update pin status', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('An error occurred while updating pin status', 'error');
        }
    }
    
    async function toggleUrgent(id) {
        try {
            const response = await fetch(`/admin/support-feedback/${id}/toggle-urgent`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Update UI without reload
                const card = document.querySelector(`[data-id="${id}"]`);
                const badgeContainer = card.querySelector('.badge-container');
                const urgentButton = card.querySelector(`button[onclick*="toggleUrgent(${id})"]`);
                const messageBorder = card.querySelector('.message-content');
                
                const isUrgent = data.is_urgent;
                card.setAttribute('data-urgent', isUrgent ? '1' : '0');
                
                // Update button
                urgentButton.className = `p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200 transition ${isUrgent ? 'text-red-600 bg-red-50' : 'text-gray-400'}`;
                
                // Update or add badge
                let urgentBadge = badgeContainer.querySelector('.urgent-badge');
                if (isUrgent) {
                    if (!urgentBadge) {
                        urgentBadge = document.createElement('span');
                        urgentBadge.className = 'urgent-badge inline-flex items-center px-1.5 py-0.5 bg-red-100 text-red-700 text-xs font-medium rounded-full';
                        urgentBadge.textContent = '🚨';
                        const pinnedBadge = badgeContainer.querySelector('.pinned-badge');
                        if (pinnedBadge) {
                            pinnedBadge.after(urgentBadge);
                        } else {
                            badgeContainer.insertBefore(urgentBadge, badgeContainer.firstChild);
                        }
                    }
                } else {
                    if (urgentBadge) urgentBadge.remove();
                }
                
                // Update message border color
                if (isUrgent) {
                    messageBorder.className = 'message-content bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-3 border-l-4 border-red-500';
                } else {
                    messageBorder.className = 'message-content bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-3 border-l-4 border-indigo-500';
                }
                
                showToast(isUrgent ? 'Marked as urgent!' : 'Removed urgent status!', 'success');
            } else {
                showToast('Failed to update urgent status', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('An error occurred while updating urgent status', 'error');
        }
    }
    
    async function deleteFeedback(id) {
        showConfirmModal(
            'Delete Feedback',
            'Are you sure you want to delete this feedback? This action cannot be undone.',
            'danger',
            async () => {
                try {
                    const response = await fetch(`/admin/support-feedback/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        const element = document.querySelector(`[data-id="${id}"]`);
                        element.style.transition = 'all 0.3s ease-out';
                        element.style.transform = 'scale(0.95)';
                        element.style.opacity = '0';
                        setTimeout(() => {
                            element.remove();
                            showToast('Feedback deleted successfully', 'success');
                        }, 300);
                    } else {
                        showToast('Failed to delete feedback', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('An error occurred while deleting feedback', 'error');
                }
            }
        );
    }
    
    // Auto-submit form on select change
    document.querySelectorAll('select[name="status"], select[name="sort_by"], select[name="sort_order"]').forEach(select => {
        select.addEventListener('change', () => {
            document.getElementById('filterForm').submit();
        });
    });
</script>
@endsection
