<?php

namespace App\Http\Controllers;

use App\Models\JenisArsip;
use Illuminate\Http\Request;
use App\Models\LaporanPenelitian;
use Illuminate\Support\Facades\Storage;

class LaporanPenelitianController extends Controller
{
    public function index()
    {
        $laporan_penelitians = LaporanPenelitian::paginate(10);
        return view('laporan_penelitian.index', compact('laporan_penelitians'));
    }

    public function create()
    {
        // $jenisarsips = JenisArsip::all();
        return view('laporan_penelitian.create');
    }

    public function store(Request $request)
    {
        $validated =  $request->validate([
            'kode_seri' => 'required|string|max:255',
            'judul_penelitian' => 'required|string|max:255',
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
            $file->storeAs('laporan_penelitians', $fileName, 'public');  // pastikan tidak ada disk kedua!
            $validated['file'] = $fileName;
        }

        LaporanPenelitian::create($validated);
        return redirect()->route('laporan_penelitian.index')->with('success', 'Data penelitian berhasil ditambahkan.');
    }

    public function show(LaporanPenelitian $laporan_penelitian)
    {
        // $laporan_penelitian->load('jenisArsip'); // muat relasi jika perlu
        return view('laporan_penelitian.show', compact('laporan_penelitian'));
    }

    public function edit($id)
    {
        $laporan_penelitian = LaporanPenelitian::findOrFail($id);
        return view('laporan_penelitian.edit', compact('laporan_penelitian'));
    }

    public function update(Request $request, LaporanPenelitian $laporan_penelitian)
    {
        $validated = $request->validate([
            'kode_seri' => 'required|string|max:255',
            'judul_penelitian' => 'required|string|max:255',
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
            if ($laporan_penelitian->file && Storage::exists('laporan_penelitians/' . $laporan_penelitian->file)) {
                Storage::delete('laporan_penelitians/' . $laporan_penelitian->file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('laporan_penelitians', $fileName);
            $validated['file'] = $fileName;
        }

        $laporan_penelitian->update($validated);
        return redirect()->route('laporan_penelitian.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(LaporanPenelitian $laporan_penelitian)
    {
        $laporan_penelitian->delete();
        return redirect()->route('laporan_penelitian.index')->with('success', 'Laporan Penelitian dihapus!');
    }

    public function download($id)
    {
        $laporan_penelitian = LaporanPenelitian::findOrFail($id);
        $fileName = $laporan_penelitian->file;

        $filePath = 'laporan_penelitians/' . $fileName;

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
                if (in_array($extension, ['pdf', 'docx', 'xls', 'xlsl'])) {
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
