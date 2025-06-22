<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Hash;


class PenggunaController extends Controller
{
   public function index(Request $request)
    {
        // Awalnya buat query builder dari model Pengguna
        $pengguna = Pengguna::query();

        if ($request->has('search')) {
            $search = $request->input('search');

            // Validasi: hanya huruf dan spasi
            if (!preg_match("/^[a-zA-Z\s]+$/", $search)) {
                return redirect()->back()->with('search_error', 'Data yang Anda masukkan tidak valid!');
            }

            // Gunakan query builder yang sudah disimpan di $pengguna
            $pengguna->where('username', 'like', "%{$search}%");
        }

        // Pagination (10 item per halaman)
        $pengguna = $pengguna->paginate(10);

        return view('pengguna.index', compact('pengguna'));
    }


    public function create()
    {
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:penggunas',
            'email' => 'required|email|unique:penggunas',
            'password' => 'required',
            'role' => 'required|in:admin,p3m',
        ]);

        Pengguna::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(Pengguna $pengguna)
    {
        return view('pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:penggunas,email,' . $pengguna->id,
            'role' => 'required|in:admin,p3m,dosen',
            'password' => 'nullable|min:6', // password opsional, minimal 6 karakter jika diisi
        ]);

        // Update field selain password
        $pengguna->username = $request->username;
        $pengguna->email = $request->email;
        $pengguna->role = $request->role;

        // Cek jika password diisi
        if ($request->filled('password')) {
            $pengguna->password = Hash::make($request->password);
        }

        // Simpan perubahan
        $pengguna->save();

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
