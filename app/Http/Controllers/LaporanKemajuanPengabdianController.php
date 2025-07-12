<?php

namespace App\Http\Controllers;

use App\Models\LaporanKemajuanPengabdian;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\SkemaPengabdian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\LaporanKemajuanPengabdianExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKemajuanPengabdianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $laporan = LaporanKemajuanPengabdian::when($search, function ($query, $search) {
                $query->where('judul_kegiatan', 'like', "%{$search}%")
                      ->orWhere('nama_ketua', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%")
                      ->orWhere('tahun_pelaksanaan', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan_kemajuan_pengabdian.index', compact('laporan'));
    }

    public function create()
    {
        $skemas = SkemaPengabdian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        return view('laporan_kemajuan_pengabdian.create', compact('skemas', 'jurusans', 'prodis'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_laporan'         => 'required|string|max:30',
        'judul_kegiatan'     => 'required|string|max:255',
        'nama_ketua'         => 'required|string|max:255',
        'nama_anggota'       => 'nullable|string|max:255',
        'skema'              => 'required|string|max:100',
        'tahun_pelaksanaan'  => 'required|string|max:4',
        'jurusan'            => 'required|string|max:100',
        'prodi'              => 'required|string|max:100',
        'periode_laporan'    => 'required|string|max:100',
        'ringkasan'          => 'required|string',
        'file'               => 'required|mimes:pdf,doc,docx|max:5120',
    ], [
        'id_laporan.required'        => 'ID laporan wajib diisi.',
        'judul_kegiatan.required'    => 'Judul kegiatan wajib diisi.',
        'nama_ketua.required'        => 'Nama ketua wajib diisi.',
        'skema.required'             => 'Skema wajib diisi.',
        'tahun_pelaksanaan.required' => 'Tahun pelaksanaan wajib diisi.',
        'jurusan.required'           => 'Jurusan wajib diisi.',
        'prodi.required'             => 'Program studi wajib diisi.',
        'periode_laporan.required'   => 'Periode laporan wajib diisi.',
        'ringkasan.required'         => 'Ringkasan wajib diisi.',
        'file.required'              => 'File wajib diunggah.',
        'file.mimes'                 => 'File harus berformat PDF, DOC, atau DOCX.',
        'file.max'                   => 'Ukuran file maksimal 5MB.',
    ]);

    $path = $request->file('file')->store('laporan_kemajuan_pengabdians', 'public');

    LaporanKemajuanPengabdian::create([
        'id_laporan'        => $request->id_laporan,
        'judul_kegiatan'    => $request->judul_kegiatan,
        'nama_ketua'        => $request->nama_ketua,
        'nama_anggota'      => $request->nama_anggota,
        'skema'             => $request->skema,
        'tahun_pelaksanaan' => $request->tahun_pelaksanaan,
        'jurusan'           => $request->jurusan,
        'prodi'             => $request->prodi,
        'periode_laporan'   => $request->periode_laporan,
        'ringkasan'         => $request->ringkasan,
        'file'              => $path,
    ]);

    return redirect()->route('laporan_kemajuan_pengabdian.index')
        ->with('success', 'Laporan Kemajuan Pengabdian berhasil ditambahkan.');
}


    public function show($id)
    {
        $laporan = LaporanKemajuanPengabdian::findOrFail($id);
        return view('laporan_kemajuan_pengabdian.detail', compact('laporan'));
    }

    public function edit(LaporanKemajuanPengabdian $laporan_kemajuan_pengabdian)
    {
        $skemas = SkemaPengabdian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        return view('laporan_kemajuan_pengabdian.edit', compact('laporan_kemajuan_pengabdian', 'skemas', 'jurusans', 'prodis'));
    }

    public function update(Request $request, LaporanKemajuanPengabdian $laporan_kemajuan_pengabdian)
{
    $request->validate([
        'id_laporan'         => 'required|string|max:30',
        'judul_kegiatan'     => 'required|string|max:255',
        'nama_ketua'         => 'required|string|max:255',
        'nama_anggota'       => 'nullable|string|max:255',
        'skema'              => 'required|string|max:100',
        'tahun_pelaksanaan'  => 'required|string|max:4',
        'jurusan'            => 'required|string|max:100',
        'prodi'              => 'required|string|max:100',
        'periode_laporan'    => 'required|string|max:100',
        'ringkasan'          => 'required|string',
        'file'               => 'nullable|mimes:pdf,doc,docx|max:5120',
    ], [
        'id_laporan.required'        => 'ID laporan wajib diisi.',
        'judul_kegiatan.required'    => 'Judul kegiatan wajib diisi.',
        'nama_ketua.required'        => 'Nama ketua wajib diisi.',
        'skema.required'             => 'Skema wajib diisi.',
        'tahun_pelaksanaan.required' => 'Tahun pelaksanaan wajib diisi.',
        'jurusan.required'           => 'Jurusan wajib diisi.',
        'prodi.required'             => 'Program studi wajib diisi.',
        'periode_laporan.required'   => 'Periode laporan wajib diisi.',
        'ringkasan.required'         => 'Ringkasan wajib diisi.',
        'file.mimes'                 => 'File harus berformat PDF, DOC, atau DOCX.',
        'file.max'                   => 'Ukuran file maksimal 5MB.',
    ]);

    $data = $request->only([
        'id_laporan',
        'judul_kegiatan',
        'nama_ketua',
        'nama_anggota',
        'skema',
        'tahun_pelaksanaan',
        'jurusan',
        'prodi',
        'periode_laporan',
        'ringkasan',
    ]);

    if ($request->hasFile('file')) {
        if ($laporan_kemajuan_pengabdian->file && Storage::disk('public')->exists($laporan_kemajuan_pengabdian->file)) {
            Storage::disk('public')->delete($laporan_kemajuan_pengabdian->file);
        }

        $data['file'] = $request->file('file')->store('laporan_kemajuan_pengabdians', 'public');
    }

    $laporan_kemajuan_pengabdian->update($data);

    return redirect()->route('laporan_kemajuan_pengabdian.index')
        ->with('success', 'Laporan Kemajuan Pengabdian berhasil diperbarui.');
}

    public function destroy($id)
    {
        $laporan = LaporanKemajuanPengabdian::findOrFail($id);

        if ($laporan->file && file_exists(public_path('laporan_kemajuan_pengabdians/' . $laporan->file))) {
            unlink(public_path('laporan_kemajuan_pengabdians/' . $laporan->file));
        }

        $laporan->delete();

        return redirect()->route('laporan_kemajuan_pengabdian.index')->with('success', 'Laporan Kemajuan Pengabdian berhasil dihapus.');
    }

    public function download($id)
    {
        $laporan = LaporanKemajuanPengabdian::findOrFail($id);
        $filePath = public_path('laporan_kemajuan_pengabdians/' . $laporan->file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, $laporan->file);
    }

    public function preview($id)
    {
        $laporan = LaporanKemajuanPengabdian::findOrFail($id);
        $filePath = public_path('laporan_kemajuan_pengabdians/' . $laporan->file);

        if (!$laporan->file || !file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if ($extension === 'pdf') {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
            ]);
        } elseif (in_array($extension, ['doc', 'docx'])) {
            $url = asset('laporan_kemajuan_pengabdians/' . $laporan->file);
            return redirect("https://docs.google.com/gview?url=$url&embedded=true");
        } else {
            abort(415, 'Format file tidak didukung untuk preview.');
        }
    }

    public function metadata(Request $request)
    {
        $search = $request->input('search');

        $laporan = LaporanKemajuanPengabdian::when($search, function ($query, $search) {
                $query->where('judul_kegiatan', 'like', "%{$search}%")
                      ->orWhere('nama_ketua', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan_kemajuan_pengabdian.metadata', compact('laporan', 'search'));
    }

    public function exportMetadata(Request $request)
    {
        $search = $request->input('search');

        return Excel::download(new LaporanKemajuanPengabdianExport($search), 'metadata_laporan_kemajuan_pengabdian.xlsx');
    }
}
