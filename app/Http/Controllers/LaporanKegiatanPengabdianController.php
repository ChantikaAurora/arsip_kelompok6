<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\JenisArsip;
use Illuminate\Http\Request;
use App\Models\LaporanKegiatanPengabdian;
use App\Models\SkemaPengabdian;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class LaporanKegiatanPengabdianController extends Controller
{
    public function index()
    {
        $laporan_kegiatan_pengabdians = LaporanKegiatanPengabdian::with('jurusan','prodi','skema')->paginate(10);
        return view('laporan_kegiatan_pengabdian.index', compact('laporan_kegiatan_pengabdians'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        $jurusans = Jurusan::all();
        $skemas = SkemaPengabdian::all();
        return view('laporan_kegiatan_pengabdian.create', compact('prodis','jurusans','skemas'));
    }

    public function store(Request $request)
    {
        $validated =  $request->validate([
            'kode_seri' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema' => 'required|integer|max:255',
            'anggota' => 'required|string|max:255',
            'jurusan' => 'required|integer|max:255',
            'prodi' => 'required|integer|max:255',
            'tanggal_laporan_diterima' => 'required|date',
            'file' => 'required|file|mimes:pdf,docx,xls,xlsx|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('laporan_kegiatan_pengabdians', $fileName, 'public');  // pastikan tidak ada disk kedua!
            $validated['file'] = $fileName;
        }

        LaporanKegiatanPengabdian::create($validated);
        return redirect()->route('laporan_kegiatan_pengabdian.index')->with('success', 'Data pengabdian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $laporan_kegiatan_pengabdian = LaporanKegiatanPengabdian::with(['skema', 'jurusan', 'prodi'])->findOrFail($id); // muat relasi jika perlu
        return view('laporan_kegiatan_pengabdian.show', compact('laporan_kegiatan_pengabdian'));
    }

    public function edit($id)
    {
        $laporan_kegiatan_pengabdian = LaporanKegiatanPengabdian::findOrFail($id);
        return view('laporan_kegiatan_pengabdian.edit', compact('laporan_kegiatan_pengabdian'));
    }

    public function update(Request $request, LaporanKegiatanPengabdian $laporan_kegiatan_pengabdian)
    {
        $validated = $request->validate([
            'kode_seri' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema' => 'required|integer|max:255',
            'anggota' => 'required|string|max:255',
            'jurusan' => 'required|integer|max:255',
            'prodi' => 'required|integer|max:255',
            'tanggal_laporan_diterima' => 'required|date',
            'file' => 'required|file|mimes:pdf,docx,xls,xlsx|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            if ($laporan_kegiatan_pengabdian->file && Storage::exists('laporan_kegiatan_pengabdians/' . $laporan_kegiatan_pengabdian->file)) {
                Storage::delete('laporan_penelitians/' . $laporan_kegiatan_pengabdian->file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('laporan_kegiatan_pengabdians', $fileName);
            $validated['file'] = $fileName;
        }

        $laporan_kegiatan_pengabdian->update($validated);
        return redirect()->route('laporan_kegiatan_pengabdian.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(LaporanKegiatanPengabdian $laporan_kegiatan_pengabdian)
    {
        $laporan_kegiatan_pengabdian->delete();
        return redirect()->route('laporan_kegiatan_pengabdian.index')->with('success', 'Laporan Pengabdian dihapus!');
    }

    public function download($id)
    {
        $laporan_kegiatan_pengabdian = LaporanKegiatanPengabdian::findOrFail($id);
        $fileName = $laporan_kegiatan_pengabdian->file;

        $filePath = 'laporan_kegiatan_pengabdians/' . $fileName;

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
