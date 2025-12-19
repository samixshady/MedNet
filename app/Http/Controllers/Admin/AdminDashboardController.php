<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $users = User::query()->latest()->get();

        return view('admin.dashboard', [
            'users' => $users,
        ]);
    }
}
