<?php

namespace App\Http\Controllers;

use App\Models\LaporanAkhirPengabdian;
use App\Models\SkemaPenelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\LaporanAkhirPengabdianExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanAkhirPengabdianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $laporan = LaporanAkhirPengabdian::when($search, function ($query, $search) {
                $query->where('judul_kegiatan', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%")
                      ->orWhere('tahun_pelaksanaan', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan_akhir_pengabdian.index', compact('laporan'));
    }

    public function create()
    {
        $skemas = SkemaPenelitian::all();
        return view('laporan_akhir_pengabdian.create', compact('skemas'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_laporan_akhir'   => 'required|string|max:50',
        'judul_kegiatan'     => 'required|string|max:255',
        'skema'              => 'required|string|max:100',
        'tahun_pelaksanaan'  => 'required|string|max:4',
        'file'               => 'required|mimes:pdf,doc,docx|max:5120',
    ], [
        'id_laporan_akhir.required'   => 'ID laporan wajib diisi.',
        'id_laporan_akhir.max'        => 'ID laporan maksimal 50 karakter.',
        'judul_kegiatan.required'     => 'Judul kegiatan wajib diisi.',
        'judul_kegiatan.max'          => 'Judul kegiatan maksimal 255 karakter.',
        'skema.required'              => 'Skema wajib diisi.',
        'skema.max'                   => 'Skema maksimal 100 karakter.',
        'tahun_pelaksanaan.required'  => 'Tahun pelaksanaan wajib diisi.',
        'tahun_pelaksanaan.max'       => 'Tahun pelaksanaan maksimal 4 karakter.',
        'file.required'               => 'File wajib diunggah.',
        'file.mimes'                  => 'File harus berupa PDF, DOC, atau DOCX.',
        'file.max'                    => 'Ukuran file maksimal 5MB.',
    ]);

    $path = $request->file('file')->store('laporan_akhirpengabdian', 'public');

    LaporanAkhirPengabdian::create([
        'id_laporan_akhir'   => $request->id_laporan_akhir,
        'judul_kegiatan'     => $request->judul_kegiatan,
        'skema'              => $request->skema,
        'tahun_pelaksanaan'  => $request->tahun_pelaksanaan,
        'file'               => $path,
    ]);

    return redirect()->route('laporan_akhir_pengabdian.index')->with('success', 'Laporan Akhir Pengabdian berhasil ditambahkan.');
}


    public function show($id)
    {
        $laporan = LaporanAkhirPengabdian::findOrFail($id);
        return view('laporan_akhir_pengabdian.detail', compact('laporan'));
    }

    public function edit(LaporanAkhirPengabdian $laporan_akhir_pengabdian)
    {
        $skemas = SkemaPenelitian::all();
        return view('laporan_akhir_pengabdian.edit', compact('laporan_akhir_pengabdian', 'skemas'));
    }

    public function update(Request $request, LaporanAkhirPengabdian $laporan_akhir_pengabdian)
{
    $request->validate([
        'id_laporan_akhir'   => 'required|string|max:50',
        'judul_kegiatan'     => 'required|string|max:255',
        'skema'              => 'required|string|max:100',
        'tahun_pelaksanaan'  => 'required|string|max:4',
        'file'               => 'nullable|mimes:pdf,doc,docx|max:5120',
    ], [
        'id_laporan_akhir.required'   => 'ID laporan wajib diisi.',
        'id_laporan_akhir.max'        => 'ID laporan maksimal 50 karakter.',
        'judul_kegiatan.required'     => 'Judul kegiatan wajib diisi.',
        'judul_kegiatan.max'          => 'Judul kegiatan maksimal 255 karakter.',
        'skema.required'              => 'Skema wajib diisi.',
        'skema.max'                   => 'Skema maksimal 100 karakter.',
        'tahun_pelaksanaan.required'  => 'Tahun pelaksanaan wajib diisi.',
        'tahun_pelaksanaan.max'       => 'Tahun pelaksanaan maksimal 4 karakter.',
        'file.mimes'                  => 'File harus berupa PDF, DOC, atau DOCX.',
        'file.max'                    => 'Ukuran file maksimal 5MB.',
    ]);

    $data = $request->only([
        'id_laporan_akhir',
        'judul_kegiatan',
        'skema',
        'tahun_pelaksanaan',
    ]);

    if ($request->hasFile('file')) {
        if ($laporan_akhir_pengabdian->file && Storage::disk('public')->exists($laporan_akhir_pengabdian->file)) {
            Storage::disk('public')->delete($laporan_akhir_pengabdian->file);
        }

        $data['file'] = $request->file('file')->store('laporan_akhirpengabdian', 'public');
    }

    $laporan_akhir_pengabdian->update($data);

    return redirect()->route('laporan_akhir_pengabdian.index')->with('success', 'Laporan Akhir Pengabdian berhasil diperbarui.');
}


    public function destroy($id)
    {
        $laporan = LaporanAkhirPengabdian::findOrFail($id);

        if ($laporan->file && file_exists(public_path('laporan_akhirpengabdian/' . $laporan->file))) {
            unlink(public_path('laporan_akhirpengabdian/' . $laporan->file));
        }

        $laporan->delete();

        return redirect()->route('laporan_akhir_pengabdian.index')->with('success', 'Laporan Akhir Pengabdian berhasil dihapus.');
    }

    public function download($id)
    {
        $laporan = LaporanAkhirPengabdian::findOrFail($id);
        $filePath = public_path('laporan_akhirpengabdian/' . $laporan->file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, $laporan->file);
    }

   public function preview($id)
    {
        $laporan = LaporanAkhirPengabdian::findOrFail($id);

        if (!$laporan->file || !Storage::disk('public')->exists($laporan->file)) {
            abort(404, 'File tidak ditemukan.');
        }

        $filePath = Storage::disk('public')->path($laporan->file);
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if ($extension === 'pdf') {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
            ]);
        } elseif (in_array($extension, ['doc', 'docx'])) {
            $url = asset('storage/' . $laporan->file); // sesuaikan dengan lokasi akses publik
            return redirect("https://docs.google.com/gview?url=$url&embedded=true");
        } else {
            abort(415, 'Format file tidak didukung untuk preview.');
        }
    }


    public function metadata(Request $request)
    {
        $search = $request->input('search');

        $laporan = LaporanAkhirPengabdian::when($search, function ($query, $search) {
                $query->where('judul_kegiatan', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan_akhir_pengabdian.metadata', compact('laporan', 'search'));
    }

    public function exportMetadata(Request $request)
    {
        $search = $request->input('search');

        return Excel::download(new LaporanAkhirPengabdianExport($search), 'metadata_laporan_akhir_pengabdian.xlsx');
    }
}
