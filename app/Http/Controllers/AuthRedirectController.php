<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRedirectController extends Controller
{
    /**
     * Redirect user after login based on their role
     */
    public function redirectAfterLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        }
        
        return redirect()->route('login');
    }
}
