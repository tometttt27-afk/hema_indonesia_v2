<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function signIn()
    {
        return view('auth.sign-in');
    }

    public function signUp()
    {
        return view('auth.sign-up');
    }
}