<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\JenisArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Validasi pencarian
        if ($search && !preg_match("/^[a-zA-Z0-9\s\-\/]+$/", $search)) {
            return redirect()->back()->with('search_error', 'Data yang Anda masukkan tidak valid!');
        }

        // Ambil semua surat masuk beserta relasi jenis arsip
        $suratMasuks = SuratMasuk::with('jenisArsip')->get();

        $suratmasuks = SuratMasuk::when($search, function ($query) use ($search) {
            return $query->where('nomor_surat', 'like', "%{$search}%")
                         ->orWhere('pengirim', 'like', "%{$search}%")
                         ->orWhere('perihal', 'like', "%{$search}%");
        })->paginate(10);

        return view('suratmasuk.index', compact('suratmasuks'));
    }

    public function create()
    {
        $jenisarsips = JenisArsip::all(); // ambil semua jenis arsip dari database
        return view('suratmasuk.create', compact('jenisarsips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat'    => 'required|string|max:255',
            'tanggal_surat'  => 'required|date',
            'tanggal_terima' => 'required|date',
            'asal_surat'     => 'required|string|max:255',
            'perihal'        => 'required|string|max:255',
            'pengirim'       => 'required|string|max:255',
            'jenis'          => 'required|integer',
            'file'           => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('file')->store('suratmasuk', 'public');
        SuratMasuk::create([
            'nomor_surat'    => $request->nomor_surat,
            'tanggal_surat'  => $request->tanggal_surat,
            'tanggal_terima' => $request->tanggal_terima,
            'asal_surat'     => $request->asal_surat,
            'perihal'        => $request->perihal,
            'pengirim'       => $request->pengirim,
            'jenis'          => $request->jenis,
            'file'           => $path,
        ]);

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
    }


    public function edit(SuratMasuk $suratmasuk)
    {
        $jenisarsips = JenisArsip::all();
        return view('suratmasuk.edit', compact('suratmasuk', 'jenisarsips'));
    }

    public function update(Request $request, SuratMasuk $suratmasuk)
    {
        $request->validate([
            'nomor_surat'    => 'required|string|max:255|unique:suratmasuks,nomor_surat,' . $suratmasuk->id,
            'tanggal_surat'  => 'required|date',
            'tanggal_terima' => 'required|date',
            'asal_surat'     => 'required|string|max:255',
            'perihal'        => 'required|string|max:255',
            'pengirim'       => 'required|string|max:255',
            'jenis'          => 'required|integer',
            'file'           => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'nomor_surat', 'tanggal_surat', 'tanggal_terima', 'asal_surat',
            'perihal', 'pengirim', 'jenis'
        ]);

        if ($request->hasFile('file')) {
            if ($suratmasuk->file && Storage::disk('public')->exists($suratmasuk->file)) {
                Storage::disk('public')->delete($suratmasuk->file);
            }

            $data['file'] = $request->file('file')->store('suratmasuk', 'public');
        }

        $suratmasuk->update($data);

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil diperbarui.');
    }


    public function destroy(SuratMasuk $suratmasuk)
    {
        // Hapus file dari storage
        if ($suratmasuk->file && Storage::disk('public')->exists($suratmasuk->file)) {
            Storage::disk('public')->delete($suratmasuk->file);
        }

        $suratmasuk->delete();

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil dihapus.');
    }

    public function show($id)
    {
        // Ambil data surat masuk beserta relasi jenis arsip (jika ada)
        $suratmasuk = SuratMasuk::with('jenisArsip')->findOrFail($id);

        return view('suratmasuk.detail', compact('suratmasuk'));
    }

    public function download($id)
    {
        $suratmasuk = SuratMasuk::findOrFail($id);

        if (!$suratmasuk->file || !Storage::disk('public')->exists($suratmasuk->file)) {
            abort(404, 'File tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($suratmasuk->file);

        // Untuk preview PDF di browser
        if (request()->has('preview')) {
            return response()->file($path, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        // Untuk download
        return Storage::disk('public')->download($suratmasuk->file);
    }

}
