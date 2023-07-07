<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Session::has('user')) {
            // User is not authenticated, redirect to login or show an error message
            return redirect('/login');
        }
        
        $user = Session::get('user');
        
        if ($user->account_type == $role) {
            return $next($request);
        } else {
            // User does not have the required role, show an error message or redirect
            return redirect('/login');
        }
    }
}
