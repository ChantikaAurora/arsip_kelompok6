<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggaranPenelitian;
use App\Http\Controllers\Controller;
use App\Models\JenisArsip;
use Illuminate\Support\Facades\Storage;


class AnggaranPenelitianController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel anggaran_penelitian
        $data = AnggaranPenelitian::paginate(10);


        // Tampilkan ke view index
        return view('anggaran_penelitian.index', compact('data'));
    }

    public function create()
    {
        $jenisarsips = JenisArsip::all(); //ambil semua jenis arsip dari database
        return view('anggaran_penelitian.create', compact('jenisarsips'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'judul_penelitian' => 'required|string|max:255',
        'peneliti' => 'required|string|max:255',
        'tahun' => 'required|digits:4|integer',
        'total_anggaran' => 'required|numeric',
        'jenis_arsip_id' => 'required|exists:jenis_arsips,id', // Pastikan validasi
        'rincian_anggaran' => 'nullable|string',
        'status' => 'required|string',
        'file' => 'required|file|mimes:pdf,docx|max:10240', // ukuran untuk 10 MB
        'keterangan' => 'nullable|string',
    ]);
    // Buat instance model
        $anggaran = new AnggaranPenelitian();

        $anggaran->judul_penelitian = $request->judul_penelitian;
        $anggaran->peneliti = $request->peneliti;
        $anggaran->tahun = $request->tahun;
        $anggaran->total_anggaran = $request->total_anggaran;
        $anggaran->jenis_arsip_id = $request->jenis_arsip_id;
        $anggaran->rincian_anggaran = $request->rincian_anggaran;
        $anggaran->status = $request->status;
        $anggaran->keterangan = $request->keterangan;

        // Tangani file upload
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('laporan_penelitian', 'public');
            $anggaran->file = $path;
        }
        // Simpan nama file ke database (bukan path)
        $anggaran->file = $path;

    $anggaran->save();

    return redirect()->route('anggaran_penelitian.index')->with('success', 'Data penelitian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $item = AnggaranPenelitian::findOrFail($id);
        return view('anggaran_penelitian.show', compact('item'));
    }

    public function edit($id)
    {
        $anggaran_penelitian = AnggaranPenelitian::findOrFail($id);
        return view('anggaran_penelitian.edit', compact('anggaran_penelitian'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'judul_penelitian' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'total_anggaran' => 'required|numeric',
            'jenis_arsip_id' => 'required|numeric',
            'rincian_anggaran' => 'nullable|string',
            'status' => 'required|in:draft,done',
            'file' => 'required|file|mimes:pdf,docx|max:10240', // ukuran untuk 10 MB
            'keterangan' => 'nullable|string',
        ]);

        // Temukan data yang akan di-update
        $anggaran = AnggaranPenelitian::findOrFail($id);

        // Update data
        $anggaran->judul_penelitian = $request->judul_penelitian;
        $anggaran->peneliti = $request->peneliti;
        $anggaran->tahun = $request->tahun;
        $anggaran->total_anggaran = $request->total_anggaran;
        $anggaran->jenis_arsip_id = $request->jenis_arsip_id;
        $anggaran->rincian_anggaran = $request->rincian_anggaran;
        $anggaran->status = $request->status;
        $anggaran->file = $request->file;
        $anggaran->keterangan = $request->keterangan;

        // Tangani file upload
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($anggaran->file && Storage::disk('public')->exists($anggaran->file)) {
                Storage::disk('public')->delete($anggaran->file);
            }
            // Simpan file baru
            $path = $request->file('file')->store('laporan_penelitian', 'public');
            $anggaran->file = $path;
        }


    $anggaran->save();

    return redirect()->route('anggaran_penelitian.index')->with('success', 'Data penelitian berhasil ditambahkan.');
    }

    public function destroy(AnggaranPenelitian $anggaran_penelitian)
    {
        $anggaran_penelitian->delete();
        return redirect()->route('anggaran_penelitian.index')->with('success', 'Laporan Penelitian dihapus!');
    }

    public function download($id)
    {
        $anggaran_penelitian= AnggaranPenelitian::findOrFail($id);

        if (!$anggaran_penelitian->file || !Storage::disk('public')->exists($anggaran_penelitian->file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($anggaran_penelitian->file);
    }

}
