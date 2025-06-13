<?php
namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Models\User;
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register'); // sesuaikan dengan lokasi file view kamu
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        Pengguna::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Simpan ke database
        $pengguna = Pengguna::create([
            'name' => $validated['username'], // atau 'username' tergantung nama kolom kamu
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

    //     // Redirect atau login otomatis
        // auth()->login($pengguna);

        // return redirect()->route('home'); // arahkan ke halaman dashboard atau home
