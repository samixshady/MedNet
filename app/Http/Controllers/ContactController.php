<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showContact()
    {
        // Replace the hardcoded values with your actual data
        $data = [
            'username' => 'Admin Support',
            'phoneNumber' => '+880123456789'
        ];

        return view('contact', $data);
    }
}
