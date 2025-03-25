<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
                    Session::flash('success_auth', 'Sign In berhasil');
                    return redirect('/dashboard');
                } else if ($user->role == 'customer') {
                    Session::flash('success_auth', 'Sign In berhasil');
                    return redirect('/');
                }
            } else if ($user->status == 'inactive') {
                Session::flash('error', 'Maaf, akun anda tidak aktif');
                return redirect('/auth/sign-in');
            } else if ($user->status == 'banned') {
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
            Session::flash('success_auth', 'Berhasil untuk membuat akun');
            return redirect('/auth/sign-in');
        } else {
            Session::flash('error', 'Tidak berhasil untuk membuat akun');
            return redirect('/auth/sign-up');
        }
    }

    public function signOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('success_auth', 'Berhasil Sign Out');
        return redirect()->to('/auth/sign-in')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }
}