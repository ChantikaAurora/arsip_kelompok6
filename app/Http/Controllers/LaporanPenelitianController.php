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
        $jenisarsips = JenisArsip::all();
        return view('laporan_penelitian.create', compact('jenisarsips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_penelitian' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'jenis_arsip_laporan' => 'required|exists:jenis_arsips,id',
            'jurusan' => 'required|string|max:255',
            'tahun_penelitian' => 'required|digits:4',
            'tanggal_laporan_diterima' => 'required|date',
            'status_laporan' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,docx|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        $laporan = new LaporanPenelitian();

        $laporan->judul_penelitian = $request->judul_penelitian;
        $laporan->peneliti = $request->peneliti;
        $laporan->jenis_arsip_laporan = $request->jenis_arsip_laporan;
        $laporan->jurusan = $request->jurusan;
        $laporan->tahun_penelitian = $request->tahun_penelitian;
        $laporan->tanggal_laporan_diterima = $request->tanggal_laporan_diterima;
        $laporan->status_laporan = $request->status_laporan;
        $laporan->keterangan = $request->keterangan;

        // Upload file ke storage/app/public/laporan_penelitian
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('laporan_penelitian', 'public');
            $laporan->file = $path; // simpan path relatif
        }
        $laporan->save();
        return redirect()->route('laporan_penelitian.index')->with('success', 'Data penelitian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $laporan_penelitian = LaporanPenelitian::findOrFail($id);
        return view('laporan_penelitian.show', compact('laporan_penelitian'));
    }

    public function edit($id)
    {
        $laporan_penelitian = LaporanPenelitian::findOrFail($id);
        return view('laporan_penelitian.edit', compact('laporan_penelitian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_penelitian' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'jenis_arsip_laporan' => 'required|exists:jenis_arsips,id',
            'jurusan' => 'required|string|max:255',
            'tahun_penelitian' => 'required|digits:4',
            'tanggal_laporan_diterima' => 'required|date',
            'status_laporan' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        $laporan_penelitian = LaporanPenelitian::findOrFail($id);

        $laporan_penelitian->judul_penelitian = $request->judul_penelitian;
        $laporan_penelitian->peneliti = $request->peneliti;
        $laporan_penelitian->jenis_arsip_laporan = $request->jenis_arsip_laporan;
        $laporan_penelitian->jurusan = $request->jurusan;
        $laporan_penelitian->tahun_penelitian = $request->tahun_penelitian;
        $laporan_penelitian->tanggal_laporan_diterima = $request->tanggal_laporan_diterima;
        $laporan_penelitian->status_laporan = $request->status_laporan;
        $laporan_penelitian->keterangan = $request->keterangan;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('laporan_penelitian', 'public');
            $laporan_penelitian->file = $path;
        }

        $laporan_penelitian->save();

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

        if (!$laporan_penelitian->file || !Storage::disk('public')->exists($laporan_penelitian->file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($laporan_penelitian->file);
    }
}
