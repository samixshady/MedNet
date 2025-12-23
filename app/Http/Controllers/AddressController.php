<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AddressController extends Controller
{
    use AuthorizesRequests;

    public function update(Request $request, Address $address)
    {
        // Check if user owns this address
        if ($address->user_id !== auth()->id()) {
            return redirect()->route('profile.addresses')->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'alias_name' => 'required|string|max:50|unique:addresses,alias_name,' . $address->id . ',id,user_id,' . auth()->id(),
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'is_inside_dhaka' => 'required|boolean',
        ]);

        $address->update($validated);

        return redirect()->route('profile.addresses')->with('success', 'Address updated successfully!');
    }

    public function destroy(Address $address)
    {
        // Check if user owns this address
        if ($address->user_id !== auth()->id()) {
            return redirect()->route('profile.addresses')->with('error', 'Unauthorized action.');
        }
        
        $address->delete();

        return redirect()->route('profile.addresses')->with('success', 'Address deleted successfully!');
    }
}
