<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            Session::flash('error', "Anda harus Sign In dahulu");
            return redirect('/auth/sign-in');
        }

        $user = Auth::user();
        if ($user->role !== $role) {
            Session::flash('error', "Anda tidak memiliki akses");
            return redirect('/');
        }
        return $next($request);
    }
}