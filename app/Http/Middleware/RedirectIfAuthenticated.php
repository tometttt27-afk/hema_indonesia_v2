<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Mencegah user yang sudah login membuka halaman auth (sign-in, sign-up).
 * Admin    → redirect ke /dashboard
 * Customer → redirect ke /
 */
class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            return redirect($role === 'admin' ? '/dashboard' : '/');
        }

        return $next($request);
    }
}
