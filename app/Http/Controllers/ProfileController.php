<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function view()
    {
        $user = auth()->user();
        return view('profile.view', compact('user'));
    }
    
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = auth()->user();
    
        $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string|max:255',
            'sex' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user->update([
            'full_name' => $request->input('full_name'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'sex' => $request->input('sex'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
        ]);
    
        // Handle file upload for picture
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('profile_pictures', 'public');
            $user->update(['picture' => $path]);
        }
    
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
}
