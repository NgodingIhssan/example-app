<?php

namespace App\Http\Controllers;namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors(['login' => 'Email atau password salah']);
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
