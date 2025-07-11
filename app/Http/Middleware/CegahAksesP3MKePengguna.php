<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CegahAksesP3MKePengguna
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->pengguna?->role === 'P3M') {
    return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke menu pengguna.');
}


        return $next($request);
    }
}
