<?php

namespace App\Http\Middleware;

use App\Models\BannedEmail;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBannedEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()) {
            $user = auth()->user();

            // Check if user's email is in the banned list
            if (BannedEmail::where('email', $user->email)->exists()) {
                auth()->logout();
                return redirect('/')->with('error', 'This account has been banned and is no longer accessible.');
            }
        }

        return $next($request);
    }
}
