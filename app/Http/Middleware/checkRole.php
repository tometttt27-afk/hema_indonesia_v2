<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Belum login sama sekali
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus Sign In dahulu');
            return redirect('/auth/sign-in');
        }

        $user = Auth::user();

        // Sudah login tapi role tidak sesuai
        if ($user->role !== $role) {
            Session::flash('error', 'Anda tidak memiliki akses ke halaman ini');
            return redirect($user->role === 'admin' ? '/dashboard' : '/');
        }

        return $next($request);
    }
}
