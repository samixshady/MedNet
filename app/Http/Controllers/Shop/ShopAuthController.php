<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ShopAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('shop.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $pharmacy = Pharmacy::where('email', $request->email)->first();

        if (!$pharmacy) {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.',
            ])->onlyInput('email');
        }

        if ($pharmacy->status === 'pending') {
            return back()->withErrors([
                'email' => 'Your shop registration is pending admin approval.',
            ])->onlyInput('email');
        }

        if ($pharmacy->status === 'rejected') {
            return back()->withErrors([
                'email' => 'Your shop registration has been rejected. Reason: ' . $pharmacy->rejection_reason,
            ])->onlyInput('email');
        }

        if ($pharmacy->status === 'banned') {
            return back()->withErrors([
                'email' => 'Your shop has been banned. Please contact admin.',
            ])->onlyInput('email');
        }

        if (Auth::guard('pharmacy')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('shop.dashboard'));
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegistrationForm()
    {
        return view('shop.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'shop_name' => ['required', 'string', 'max:255'],
            'owner_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pharmacies'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'trade_license_number' => ['required', 'string', 'unique:pharmacies'],
            'trade_license_date' => ['required', 'date'],
            'license_expiry_date' => ['nullable', 'date', 'after:trade_license_date'],
        ]);

        $pharmacy = Pharmacy::create([
            'shop_name' => $request->shop_name,
            'owner_name' => $request->owner_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'trade_license_number' => $request->trade_license_number,
            'trade_license_date' => $request->trade_license_date,
            'license_expiry_date' => $request->license_expiry_date,
            'status' => 'pending',
        ]);

        return redirect()->route('shop.login')->with('success', 'Registration successful! Please wait for admin approval.');
    }

    public function logout(Request $request)
    {
        Auth::guard('pharmacy')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('shop.login');
    }
}
