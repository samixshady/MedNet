<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BannedEmail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserManagementController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index(Request $request): View
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        // Sort by most recent
        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.user-management', compact('users'));
    }

    /**
     * Ban a user by moving their email to the banned_emails table.
     */
    public function ban(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        try {
            // Add email to banned list
            BannedEmail::firstOrCreate(
                ['email' => $user->email],
                ['reason' => $request->reason ?? 'Admin ban']
            );

            // Delete the user account
            $user->delete();

            return redirect()
                ->route('admin.users.index')
                ->with('success', "User {$user->email} has been banned and their account deleted.");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Failed to ban user. Please try again.');
        }
    }

    /**
     * Hard delete a user permanently.
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $email = $user->email;
            $user->forceDelete();

            return redirect()
                ->route('admin.users.index')
                ->with('success', "User {$email} has been permanently deleted.");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Failed to delete user. Please try again.');
        }
    }

    /**
     * Get user statistics via AJAX (optional, for dashboard summary).
     */
    public function stats(): array
    {
        return [
            'total_users' => User::count(),
            'admin_users' => User::where('is_admin', true)->count(),
            'regular_users' => User::where('is_admin', false)->count(),
            'banned_emails' => BannedEmail::count(),
        ];
    }
}
