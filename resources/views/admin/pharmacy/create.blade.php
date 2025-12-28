@extends('layouts.admin')

@section('title', 'Add Pharmacy')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Add New Pharmacy</h1>
                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Manually register a pharmacy to the system</p>
            </div>
            <a href="{{ route('admin.pharmacy.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 flex items-center">
                <i class='bx bx-arrow-back mr-2'></i>
                Back to List
            </a>
        </div>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg">
            <div class="flex items-start">
                <i class='bx bx-error-circle text-red-600 dark:text-red-400 text-xl mr-3 mt-0.5'></i>
                <div class="flex-1">
                    <p class="text-red-700 dark:text-red-300 text-sm font-medium mb-2">Please correct the following errors:</p>
                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <form action="{{ route('admin.pharmacy.store') }}" method="POST" class="p-6">
            @csrf

            <!-- Shop Information Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center">
                    <i class='bx bx-store mr-2 text-purple-600 dark:text-purple-400'></i>
                    Shop Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Shop Name -->
                    <div class="md:col-span-2">
                        <label for="shop_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Shop Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="shop_name" 
                            name="shop_name" 
                            value="{{ old('shop_name') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            placeholder="e.g., ABC Pharmacy"
                            required
                        >
                    </div>

                    <!-- Owner Name -->
                    <div>
                        <label for="owner_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Owner Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="owner_name" 
                            name="owner_name" 
                            value="{{ old('owner_name') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            placeholder="Full name"
                            required
                        >
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            value="{{ old('phone') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            placeholder="+880 1234-567890"
                            required
                        >
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Shop Address <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="address" 
                            name="address" 
                            rows="2"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300 resize-none"
                            placeholder="Full address with city and postal code"
                            required
                        >{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Trade License Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center">
                    <i class='bx bx-id-card mr-2 text-purple-600 dark:text-purple-400'></i>
                    Trade License Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <!-- Trade License Number -->
                    <div class="md:col-span-3">
                        <label for="trade_license_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Trade License Number <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="trade_license_number" 
                            name="trade_license_number" 
                            value="{{ old('trade_license_number') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            placeholder="e.g., TL-2025-123456"
                            required
                        >
                    </div>

                    <!-- Trade License Issue Date -->
                    <div>
                        <label for="trade_license_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Issue Date <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="trade_license_date" 
                            name="trade_license_date" 
                            value="{{ old('trade_license_date') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            required
                        >
                    </div>

                    <!-- License Expiry Date -->
                    <div class="md:col-span-2">
                        <label for="license_expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Expiry Date <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="license_expiry_date" 
                            name="license_expiry_date" 
                            value="{{ old('license_expiry_date') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            required
                        >
                    </div>
                </div>
            </div>

            <!-- Account Credentials Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center">
                    <i class='bx bx-lock-alt mr-2 text-purple-600 dark:text-purple-400'></i>
                    Account Credentials
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            placeholder="shop@example.com"
                            required
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                            placeholder="Minimum 8 characters"
                            required
                            minlength="8"
                        >
                    </div>
                </div>
            </div>

            <!-- Status Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center">
                    <i class='bx bx-shield-alt-2 mr-2 text-purple-600 dark:text-purple-400'></i>
                    Account Status
                </h3>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="status" 
                        name="status" 
                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300"
                        required
                    >
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending Review</option>
                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="banned" {{ old('status') == 'banned' ? 'selected' : '' }}>Banned</option>
                    </select>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Select "Approved" to give immediate access, or "Pending" for review.
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a 
                    href="{{ route('admin.pharmacy.index') }}" 
                    class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center"
                >
                    <i class='bx bx-check-circle mr-2'></i>
                    Add Pharmacy
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
