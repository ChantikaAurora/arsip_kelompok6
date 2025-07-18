<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prodi::with('jurusan');

        if ($request->has('search') && trim($request->search) !== '') {
            $query->where('prodi', 'like', "%{$request->search}%");
        }

        // Tambahkan orderBy untuk mengurutkan berdasarkan kode_prodi dari kecil ke besar
        $query->orderBy('kode_prodi', 'asc');

        $prodis = $query->paginate(10)->withQueryString();

        return view('prodi.index', compact('prodis'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('prodi.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => [
                'required',
                'exists:jurusans,id',
            ],
            'kode_prodi' => [
                'required',
                'string',
                'max:10',
                'unique:prodis,kode_prodi',
            ],
            'prodi' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'jurusan_id.required' => 'Jurusan wajib dipilih.',
            'jurusan_id.exists' => 'Jurusan tidak ditemukan dalam sistem.',

            'kode_prodi.required' => 'Kode prodi wajib diisi.',
            'kode_prodi.string' => 'Kode prodi harus berupa teks.',
            'kode_prodi.max' => 'Kode prodi maksimal 10 karakter.',
            'kode_prodi.unique' => 'Kode prodi sudah terdaftar.',

            'prodi.required' => 'Nama prodi wajib diisi.',
            'prodi.string' => 'Nama prodi harus berupa teks.',
            'prodi.max' => 'Nama prodi maksimal 255 karakter.',
        ]);

        Prodi::create([
            'jurusan_id' => $request->jurusan_id,
            'kode_prodi' => $request->kode_prodi,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        $jurusans = Jurusan::all();
        return view('prodi.edit', compact('prodi', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'jurusan_id' => [
                'required',
                'exists:jurusans,id',
            ],
            'kode_prodi' => [
                'required',
                'string',
                'max:10',
                Rule::unique('prodis', 'kode_prodi')->ignore($prodi->id),
            ],
            'prodi' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'jurusan_id.required' => 'Jurusan wajib dipilih.',
            'jurusan_id.exists' => 'Jurusan tidak ditemukan dalam sistem.',

            'kode_prodi.required' => 'Kode prodi wajib diisi.',
            'kode_prodi.string' => 'Kode prodi harus berupa teks.',
            'kode_prodi.max' => 'Kode prodi maksimal 10 karakter.',
            'kode_prodi.unique' => 'Kode prodi sudah terdaftar.',

            'prodi.required' => 'Nama prodi wajib diisi.',
            'prodi.string' => 'Nama prodi harus berupa teks.',
            'prodi.max' => 'Nama prodi maksimal 255 karakter.',
        ]);

        $prodi->update([
            'jurusan_id' => $request->jurusan_id,
            'kode_prodi' => $request->kode_prodi,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
    }

    // ProdiController.php
    public function getProdiByJurusan($jurusan_id)
    {
        $prodis = \App\Models\Prodi::where('jurusan_id', $jurusan_id)->get();
        return response()->json($prodis);
    }



}
