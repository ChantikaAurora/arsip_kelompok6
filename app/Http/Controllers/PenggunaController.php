<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


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
            'username' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
                'unique:penggunas',
            ],
            'email' => 'required|email|unique:penggunas',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,p3m',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.regex' => 'Username hanya boleh berisi huruf dan spasi, tanpa angka atau simbol.',
            'username.unique' => 'Username sudah digunakan.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',

            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role hanya boleh admin atau p3m.',
        ]);

        // Simpan pengguna
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
            'username' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
                Rule::unique('penggunas')->ignore($pengguna->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('penggunas')->ignore($pengguna->id),
            ],
            'role' => 'required|in:admin,p3m',
            'password' => 'nullable|min:8',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.regex' => 'Username hanya boleh berisi huruf dan spasi, tanpa angka atau simbol.',
            'username.unique' => 'Username sudah digunakan.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'password.min' => 'Password minimal harus 8 karakter.',

            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role hanya boleh admin atau p3m.',
        ]);

        // Update data
        $pengguna->username = $request->username;
        $pengguna->email = $request->email;
        $pengguna->role = $request->role;

        if ($request->filled('password')) {
            $pengguna->password = Hash::make($request->password);
        }

        $pengguna->save();

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
