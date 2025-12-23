<!-- Addresses Section -->
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-4xl">
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-3 mb-2">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                </svg>
                Saved Addresses
            </h3>
            <p class="text-gray-600 text-sm">Save up to 5 delivery addresses for quick checkout</p>
        </div>

        <!-- Addresses List -->
        <div class="mb-8">
            @if($addresses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    @foreach($addresses as $address)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-400 transition-colors">
                            <div class="flex justify-between items-start mb-3 gap-2">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs sm:text-sm font-semibold">
                                        {{ $address->alias_name }}
                                    </span>
                                    @if($address->is_inside_dhaka)
                                        <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-semibold">Inside Dhaka</span>
                                    @else
                                        <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-xs font-semibold">Outside Dhaka</span>
                                    @endif
                                </div>
                                <div class="flex gap-1 flex-shrink-0">
                                    <button onclick="openEditModal({{ $address->id }}, '{{ $address->alias_name }}', '{{ addslashes($address->address) }}', '{{ $address->phone }}', {{ $address->is_inside_dhaka ? 'true' : 'false' }})" class="text-blue-600 hover:text-blue-700 text-xs font-semibold px-2 py-1 bg-blue-50 rounded hover:bg-blue-100 transition">✎ Edit</button>
                                    <form method="POST" action="{{ route('addresses.destroy', $address->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 text-xs font-semibold px-2 py-1 bg-red-50 rounded hover:bg-red-100 transition" onclick="return confirm('Delete this address?')">✕ Delete</button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm mb-2 break-words">{{ $address->address }}</p>
                            <p class="text-gray-600 text-xs">📞 {{ $address->phone }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 bg-gray-50 rounded-lg mb-6">
                    <p class="text-gray-600 mb-4">No saved addresses yet</p>
                </div>
            @endif

            @if($addresses->count() < 5)
                <!-- Add New Address Form -->
                <div class="border-2 border-dashed border-blue-300 rounded-lg p-6 bg-blue-50">
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="text-blue-600 font-bold">+</span> Add New Address
                    </h4>

                    <form method="POST" action="{{ route('addresses.store') }}">
                        @csrf

                        <!-- Alias Name -->
                        <div class="mb-4">
                            <label for="alias_name" class="block text-sm font-semibold text-gray-700 mb-2">Address Label *</label>
                            <div class="flex gap-2 mb-3">
                                @foreach(['Home', 'Work', 'Gym', 'Parents', 'Other'] as $preset)
                                    <button type="button" class="px-3 py-1 border border-gray-300 rounded-lg text-sm hover:bg-blue-100 transition" onclick="setAlias('{{ $preset }}')">
                                        {{ $preset }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="text" id="alias_name" name="alias_name" placeholder="e.g., Home" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('alias_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Full Address *</label>
                            <textarea id="address" name="address" placeholder="Enter your full address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3" required></textarea>
                            @error('address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" placeholder="01xxxxxxxxx" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <!-- Inside/Outside Dhaka -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Location Type *</label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_inside_dhaka" value="1" checked class="w-4 h-4 text-blue-600">
                                    <span class="text-gray-700">Inside Dhaka</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_inside_dhaka" value="0" class="w-4 h-4 text-blue-600">
                                    <span class="text-gray-700">Outside Dhaka</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            💾 Save Address
                        </button>
                    </form>
                </div>
            @else
                <div class="text-center py-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-yellow-700 font-semibold">✓ You have saved the maximum of 5 addresses</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Address Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-3 sm:p-4">
    <div class="bg-white rounded-lg w-full max-w-sm max-h-screen overflow-y-auto p-4 sm:p-6">
        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-4">Edit Address</h3>
        
        <form id="editForm" method="POST">
            @csrf
            @method('PATCH')

            <!-- Alias Name -->
            <div class="mb-4">
                <label for="edit_alias_name" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">Address Label *</label>
                <input type="text" id="edit_alias_name" name="alias_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" required>
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="edit_address" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">Full Address *</label>
                <textarea id="edit_address" name="address" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" rows="3" required></textarea>
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label for="edit_phone" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">Phone Number *</label>
                <input type="tel" id="edit_phone" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" required>
            </div>

            <!-- Inside/Outside Dhaka -->
            <div class="mb-6">
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-3">Location Type *</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" id="edit_inside" name="is_inside_dhaka" value="1" class="w-4 h-4 text-blue-600">
                        <span class="text-gray-700 text-sm">Inside Dhaka</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" id="edit_outside" name="is_inside_dhaka" value="0" class="w-4 h-4 text-blue-600">
                        <span class="text-gray-700 text-sm">Outside Dhaka</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-2">
                <button type="button" onclick="closeEditModal()" class="flex-1 px-3 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function setAlias(aliasName) {
        document.getElementById('alias_name').value = aliasName;
    }

    function openEditModal(addressId, aliasName, address, phone, isInsideDhaka) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('edit_alias_name').value = aliasName;
        document.getElementById('edit_address').value = address;
        document.getElementById('edit_phone').value = phone;
        
        if (isInsideDhaka) {
            document.getElementById('edit_inside').checked = true;
        } else {
            document.getElementById('edit_outside').checked = true;
        }
        
        // Update the form action to the correct route
        const form = document.getElementById('editForm');
        form.action = `/addresses/${addressId}`;
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
</script>
