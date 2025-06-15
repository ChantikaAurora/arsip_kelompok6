<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;

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
            'jurusan_id' => 'required|exists:jurusans,id',
            'kode_prodi' => 'required|string|max:10|unique:prodis,kode_prodi',
            'prodi' => 'required|string|max:255',
        ]);

        Prodi::create($request->all());

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
            'jurusan_id' => 'required|exists:jurusans,id',
            'kode_prodi' => 'required|string|max:10|unique:prodis,kode_prodi,' . $prodi->id,
            'prodi' => 'required|string|max:255',
        ]);

        $prodi->update($request->all());

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
}
