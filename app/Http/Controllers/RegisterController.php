<?php
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
    }
}



