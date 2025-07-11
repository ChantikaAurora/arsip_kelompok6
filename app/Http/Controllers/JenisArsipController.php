<?php

namespace App\Http\Controllers;

use App\Models\JenisArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisArsipController extends Controller
{
    public function index(Request $request)
    {
       $search = $request->input('search');

        // Validasi: hanya huruf dan spasi
        if ($search && !preg_match("/^[a-zA-Z\s]+$/", $search)) {
            return redirect()->back()->with('search_error', 'Data yang Anda masukkan tidak valid!');
        }

        $jenisarsips = JenisArsip::when($search, function ($query) use ($search) {
            return $query->where('jenis', 'like', "%{$search}%")
                        ->orWhere('keterangan', 'like', "%{$search}%");
        })->paginate(10);

        return view('jenisarsip.index', compact('jenisarsips'));
    }

    public function create()
    {
        return view('jenisarsip.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:255|unique:jenis_arsips',
            'keterangan' => 'nullable|string',
        ], [
            'jenis.required' => 'Jenis arsip wajib diisi.',
            'jenis.string' => 'Jenis arsip harus berupa teks.',
            'jenis.max' => 'Jenis arsip maksimal 255 karakter.',
            'jenis.unique' => 'Jenis arsip sudah tersedia dalam sistem.',

            'keterangan.string' => 'Keterangan harus berupa teks.',
        ]);

        JenisArsip::create([
            'jenis' => $request->jenis,
            'keterangan' => $request->keterangan ?? '', // bisa null, tidak masalah
        ]);

        return redirect()->route('jenisarsip.index')->with('success', 'Jenis Arsip berhasil ditambahkan.');
    }


    public function edit(JenisArsip $jenisarsip)
    {
        return view('jenisarsip.edit', compact('jenisarsip'));
    }

    public function update(Request $request, JenisArsip $jenisarsip)
    {
        $request->validate([
            'jenis' => 'required|string|max:255|unique:jenis_arsips,jenis,' . $jenisarsip->id,
            'keterangan' => 'nullable|string',
        ]);

        $jenisarsip->update($request->all());

        return redirect()->route('jenisarsip.index')->with('success', 'Jenis Arsip berhasil diperbarui.');
    }

    public function destroy(JenisArsip $jenisarsip)
    {
        $jenisarsip->delete();

        return redirect()->route('jenisarsip.index')->with('success', 'Jenis Arsip berhasil dihapus.');
    }
}
