<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function signIn()
    {
        return view('auth.sign-in');
    }

    public function proccessSignIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Input email harus diisi',
            'email.email' => 'Input email harus diisi format @',
            'password.required' => 'Input password harus diisi',
        ]);

        if ($validator->fails()) return redirect('/auth/sign-in')->withErrors($validator)->withInput();

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            if ($user && $user->status == 'active') {
                if ($user->role == 'admin') {
                    // Login ulang ke guard 'admin' agar session terpisah
                    Auth::logout();
                    Auth::guard('admin')->attempt($data);
                    $request->session()->regenerate();
                    Session::flash('success_timer', 'Sign In berhasil');
                    return redirect('/dashboard');
                } else if ($user->role == 'customer') {
                    // Tetap di guard 'web' (default)
                    $request->session()->regenerate();
                    Session::flash('success_timer', 'Sign In berhasil');
                    return redirect('/');
                }
            } else if ($user->status == 'inactive') {
                Auth::logout();
                Session::flash('error', 'Maaf, akun anda tidak aktif');
                return redirect('/auth/sign-in');
            } else if ($user->status == 'banned') {
                Auth::logout();
                Session::flash('error', 'Maaf, akun anda telah dibanned');
                return redirect('/auth/sign-in');
            }
        } else {
            Session::flash('error', 'Email atau password anda salah');
            return redirect('/auth/sign-in');
        }
    }

    public function signUp()
    {
        return view('auth.sign-up');
    }

    public function proccessSignUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'

        ], [
            'first_name.required' => 'Input first name harus diisi',
            'first_name.string' => 'Input first name harus diisi dengan string',
            'last_name.required' => 'Input last name harus diisi',
            'last_name.string' => 'Input last name harus diisi dengan string',
            'email.required' => 'Input email harus diisi',
            'email.email' => 'Input email harus diisi format @',
            'email.unique' => 'Email tersebut sudah tersedia',
            'password.required' => 'Input password harus diisi',
            'password.min' => 'Input password minimal 8 karakter'
        ]);

        if ($validator->fails()) return redirect('/auth/sign-up')->withErrors($validator)->withInput();

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status' => 'active',
            'role' => 'customer',
        ]);

        if ($user) {
            Session::flash('success', 'Berhasil untuk membuat akun');
            return redirect('/auth/sign-in');
        } else {
            Session::flash('error', 'Tidak berhasil untuk membuat akun');
            return redirect('/auth/sign-up');
        }
    }

    public function signOut(Request $request)
    {
        // Logout dari kedua guard agar tidak ada sisa session
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('success', 'Berhasil Sign Out');
        return redirect()->to('/auth/sign-in')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function processForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Input email harus diisi',
            'email.email' => 'Input email harus diisi format @',
        ]);

        if ($validator->fails()) return redirect('/auth/forgot-password')->withErrors($validator)->withInput();

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            Session::flash('success', 'Tautan reset password telah dikirim ke email anda');
            return redirect('/auth/forgot-password');
        }

        Session::flash('error', 'Email tersebut tidak terdaftar');
        return redirect('/auth/forgot-password')->withInput();
    }

    public function resetPassword(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->query('email')]);
    }

    public function processResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'token.required' => 'Token reset tidak valid',
            'email.required' => 'Input email harus diisi',
            'email.email' => 'Input email harus diisi format @',
            'password.required' => 'Input password harus diisi',
            'password.min' => 'Input password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            Session::flash('success', 'Password berhasil diubah, silakan sign in');
            return redirect('/auth/sign-in');
        }

        Session::flash('error', 'Gagal reset password, token mungkin sudah kadaluarsa');
        return back()->withInput();
    }
}