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
     * Middleware ini melakukan dua hal:
     * 1. Memastikan user sudah login
     * 2. Memastikan role user sesuai dengan route yang diakses
     *
     * Pemisahan session admin vs customer dilakukan melalui
     * guard berbeda: guard 'admin' untuk role admin,
     * guard 'web' untuk role customer.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Tentukan guard berdasarkan role yang dibutuhkan route
        $guard = ($role === 'admin') ? 'admin' : 'web';

        if (!Auth::guard($guard)->check()) {
            // Coba guard lain — mungkin sudah login tapi guard salah
            $otherGuard = ($guard === 'admin') ? 'web' : 'admin';
            if (Auth::guard($otherGuard)->check()) {
                $otherUser = Auth::guard($otherGuard)->user();
                if ($otherUser->role !== $role) {
                    Session::flash('error', 'Anda tidak memiliki akses ke halaman ini');
                    return redirect($otherUser->role === 'admin' ? '/dashboard' : '/');
                }
            }
            Session::flash('error', 'Anda harus Sign In dahulu');
            return redirect('/auth/sign-in');
        }

        $user = Auth::guard($guard)->user();

        if ($user->role !== $role) {
            Session::flash('error', 'Anda tidak memiliki akses');
            return redirect($user->role === 'admin' ? '/dashboard' : '/');
        }

        // Set guard aktif agar Auth::user() di controller & view bekerja benar
        Auth::shouldUse($guard);

        return $next($request);
    }
}
