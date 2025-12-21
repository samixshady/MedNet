<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminAuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        $attempted = false;

        if (filter_var($validated['login'], FILTER_VALIDATE_EMAIL)) {
            $attempted = Auth::attempt([
                'email' => $validated['login'],
                'password' => $validated['password'],
            ], $remember);
        }

        if (! $attempted) {
            $attempted = Auth::attempt([
                'name' => $validated['login'],
                'password' => $validated['password'],
            ], $remember);
        }

        if (! $attempted) {
            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        if (! Auth::user()?->is_admin) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'login' => 'You are not authorized to access the admin dashboard.',
            ]);
        }

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
