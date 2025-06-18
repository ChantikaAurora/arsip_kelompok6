<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\JenisArsip;
use Illuminate\Http\Request;
use App\Models\LaporanPengabdian;
use App\Models\SkemaPengabdian;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class LaporanPengabdianController extends Controller
{
    public function index()
    {
        $laporan_pengabdians = LaporanPengabdian::paginate(10);
        return view('laporan_pengabdian.index', compact('laporan_pengabdians'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        $jurusans = Jurusan::all();
        $skemas = SkemaPengabdian::all();
        return view('laporan_pengabdian.create', compact('prodis','jurusans','skemas'));
    }

    public function store(Request $request)
    {
        $validated =  $request->validate([
            'kode_seri' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema' => 'required|string|max:255',
            'anggota' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'tanggal_laporan_diterima' => 'required|date',
            'file' => 'required|file|mimes:pdf,docx,xls,xlsx|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('laporan_pengabdians', $fileName, 'public');  // pastikan tidak ada disk kedua!
            $validated['file'] = $fileName;
        }

        LaporanPengabdian::create($validated);
        return redirect()->route('laporan_pengabdian.index')->with('success', 'Data pengabdian berhasil ditambahkan.');
    }

    public function show(LaporanPengabdian $laporan_pengabdian)
    {
        // $laporan_penelitian->load('jenisArsip'); // muat relasi jika perlu
        return view('laporan_pengabdian.show', compact('laporan_pengabdian'));
    }

    public function edit($id)
    {
        $laporan_pengabdian = LaporanPengabdian::findOrFail($id);
        return view('laporan_pengabdian.edit', compact('laporan_pengabdian'));
    }

    public function update(Request $request, LaporanPengabdian $laporan_pengabdian)
    {
        $validated = $request->validate([
            'kode_seri' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema' => 'required|string|max:255',
            'anggota' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'tanggal_laporan_diterima' => 'required|date',
            'file' => 'required|file|mimes:pdf,docx,xls,xlsx|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            if ($laporan_pengabdian->file && Storage::exists('laporan_pengabdians/' . $laporan_pengabdian->file)) {
                Storage::delete('laporan_penelitians/' . $laporan_pengabdian->file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('laporan_pengabdians', $fileName);
            $validated['file'] = $fileName;
        }

        $laporan_pengabdian->update($validated);
        return redirect()->route('laporan_pengabdian.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(LaporanPengabdian $laporan_pengabdian)
    {
        $laporan_pengabdian->delete();
        return redirect()->route('laporan_pengabdian.index')->with('success', 'Laporan Pengabdian dihapus!');
    }

    public function download($id)
    {
        $laporan_pengabdian = LaporanPengabdian::findOrFail($id);
        $fileName = $laporan_pengabdian->file;

        $filePath = 'laporan_pengabdians/' . $fileName;

        if (!$fileName || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($filePath);
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if (!file_exists($path)) {
            abort(404, "File tidak ditemukan di path: $path");
        }

        // Preview
            if (request()->has('preview') && request('preview') == 1) {
                if (in_array($extension, ['pdf', 'docx'])) {
                    return response()->file($path, [
                        'Content-Type' => $extension === 'pdf' ? 'application/pdf' : 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ]);
                } else {
                    return Storage::disk('public')->download($filePath);
                }
            }

        return Storage::disk('public')->download($filePath);
    }
}
