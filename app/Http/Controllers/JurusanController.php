<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jurusans = Jurusan::when($search, function ($query, $search) {
                            return $query->where('jurusan', 'like', "%$search%")
                                         ->orWhere('kode_jurusan', 'like', "%$search%");
                        })
                        ->orderBy('kode_jurusan','asc')
                        ->get();

        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jurusan' => [
                'required',
                'max:10',
                'unique:jurusans,kode_jurusan',
            ],
            'jurusan' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/',
            ],
        ], [
            'kode_jurusan.required' => 'Kode jurusan wajib diisi.',
            'kode_jurusan.max' => 'Kode jurusan maksimal 10 karakter.',
            'kode_jurusan.unique' => 'Kode jurusan sudah digunakan.',

            'jurusan.required' => 'Nama jurusan wajib diisi.',
            'jurusan.string' => 'Nama jurusan harus berupa teks.',
            'jurusan.max' => 'Nama jurusan maksimal 100 karakter.',
            'jurusan.regex' => 'Nama jurusan hanya boleh berisi huruf dan spasi.',
        ]);

        // Simpan data jurusan
        Jurusan::create([
            'kode_jurusan' => $request->kode_jurusan,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }



    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
         $request->validate([
        'kode_jurusan' => [
            'required',
            'max:10',
            'unique:jurusans,kode_jurusan',
        ],
        'jurusan' => [
            'required',
            'string',
            'max:100',
            'regex:/^[a-zA-Z\s]+$/',
        ],
        ], [
            'kode_jurusan.required' => 'Kode jurusan wajib diisi.',
            'kode_jurusan.max' => 'Kode jurusan maksimal 10 karakter.',
            'kode_jurusan.unique' => 'Kode jurusan sudah digunakan.',

            'jurusan.required' => 'Nama jurusan wajib diisi.',
            'jurusan.string' => 'Nama jurusan harus berupa teks.',
            'jurusan.max' => 'Nama jurusan maksimal 100 karakter.',
            'jurusan.regex' => 'Nama jurusan hanya boleh berisi huruf dan spasi.',
        ]);

        // Simpan jurusan
        Jurusan::create([
            'kode_jurusan' => $request->kode_jurusan,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
