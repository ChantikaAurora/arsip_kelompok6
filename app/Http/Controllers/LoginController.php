<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/home');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Menghapus session dan token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
