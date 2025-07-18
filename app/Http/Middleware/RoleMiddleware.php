<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = Auth::user();

        // Check if user has the required role
        if (!$user->hasRole($role)) {
            // If user tries to access admin area but is not admin
            if ($role === 'admin') {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Access denied. Admin privileges required.'], 403);
                }
                return redirect()->route('dashboard')->with('error', 'Access denied. Admin privileges required.');
            }
            
            // If admin tries to access user area, redirect to admin dashboard
            if ($role === 'user' && $user->isAdmin()) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Redirecting to admin dashboard.'], 302);
                }
                return redirect()->route('admin.dashboard')->with('info', 'Redirected to admin dashboard.');
            }

            // General access denied
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Access denied. Insufficient permissions.'], 403);
            }
            
            abort(403);
        }

        return $next($request);
    }
}
