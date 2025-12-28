<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::orderBy('created_at', 'desc')->get();
        return view('admin.pharmacy.index', compact('pharmacies'));
    }

    public function create()
    {
        return view('admin.pharmacy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => ['required', 'string', 'max:255'],
            'owner_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pharmacies'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'trade_license_number' => ['required', 'string', 'unique:pharmacies'],
            'trade_license_date' => ['required', 'date'],
            'license_expiry_date' => ['nullable', 'date', 'after:trade_license_date'],
            'status' => ['required', 'in:pending,approved,rejected,banned'],
        ]);

        Pharmacy::create([
            'shop_name' => $request->shop_name,
            'owner_name' => $request->owner_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'trade_license_number' => $request->trade_license_number,
            'trade_license_date' => $request->trade_license_date,
            'license_expiry_date' => $request->license_expiry_date,
            'status' => $request->status,
            'approved_at' => $request->status === 'approved' ? now() : null,
        ]);

        return redirect()->route('admin.pharmacy.index')->with('success', 'Pharmacy added successfully!');
    }

    public function approve($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->update([
            'status' => 'approved',
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', 'Pharmacy approved successfully!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_at' => null,
        ]);

        return back()->with('success', 'Pharmacy rejected.');
    }

    public function ban($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->update([
            'status' => 'banned',
        ]);

        return back()->with('success', 'Pharmacy banned successfully!');
    }

    public function unban($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Pharmacy unbanned successfully!');
    }

    public function destroy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->delete();

        return back()->with('success', 'Pharmacy removed successfully!');
    }
}
