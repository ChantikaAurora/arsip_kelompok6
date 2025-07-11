<?php

namespace App\Http\Controllers;

use App\Models\LaporanAkhirPenelitian;
use App\Models\SkemaPenelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\LaporanAkhirPenelitianExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanAkhirPenelitianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $laporan = LaporanAkhirPenelitian::when($search, function ($query, $search) {
                $query->where('judul_kegiatan', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%")
                      ->orWhere('tahun_pelaksanaan', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan_akhir_penelitian.index', compact('laporan'));
    }

    public function create()
    {
        $skemas = SkemaPenelitian::all();
        return view('laporan_akhir_penelitian.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_laporan_akhir'   => 'required|string|max:50',
            'judul_kegiatan'     => 'required|string|max:255',
            'skema'              => 'required|string|max:100',
            'tahun_pelaksanaan'  => 'required|string|max:4',
            'file'               => 'required|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'id_laporan_akhir.required'   => 'ID laporan akhir wajib diisi.',
            'id_laporan_akhir.max'        => 'ID laporan maksimal 50 karakter.',
            'judul_kegiatan.required'     => 'Judul kegiatan wajib diisi.',
            'judul_kegiatan.max'          => 'Judul kegiatan maksimal 255 karakter.',
            'skema.required'              => 'Skema wajib diisi.',
            'skema.max'                   => 'Skema maksimal 100 karakter.',
            'tahun_pelaksanaan.required'  => 'Tahun pelaksanaan wajib diisi.',
            'tahun_pelaksanaan.max'       => 'Tahun pelaksanaan maksimal 4 karakter.',
            'file.required'               => 'File wajib diunggah.',
            'file.mimes'                  => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max'                    => 'Ukuran file maksimal 5MB.',
        ]);

        $data = $request->only([
            'id_laporan_akhir',
            'judul_kegiatan',
            'skema',
            'tahun_pelaksanaan'
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('laporan_akhirpenelitian', 'public');
        }

        LaporanAkhirPenelitian::create($data);

        return redirect()->route('laporan_akhir_penelitian.index')->with('success', 'Laporan Akhir Penelitian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $laporan = LaporanAkhirPenelitian::findOrFail($id);
        return view('laporan_akhir_penelitian.detail', compact('laporan'));
    }

    public function edit(LaporanAkhirPenelitian $laporan_akhir_penelitian)
    {
        $skemas = SkemaPenelitian::all();
        return view('laporan_akhir_penelitian.edit', compact('laporan_akhir_penelitian', 'skemas'));
    }

    public function update(Request $request, LaporanAkhirPenelitian $laporan_akhir_penelitian)
    {
        $request->validate([
            'id_laporan_akhir'   => 'required|string|max:50',
            'judul_kegiatan'     => 'required|string|max:255',
            'skema'              => 'required|string|max:100',
            'tahun_pelaksanaan'  => 'required|string|max:4',
            'file'               => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'id_laporan_akhir.required'   => 'ID laporan akhir wajib diisi.',
            'id_laporan_akhir.max'        => 'ID laporan maksimal 50 karakter.',
            'judul_kegiatan.required'     => 'Judul kegiatan wajib diisi.',
            'judul_kegiatan.max'          => 'Judul kegiatan maksimal 255 karakter.',
            'skema.required'              => 'Skema wajib diisi.',
            'skema.max'                   => 'Skema maksimal 100 karakter.',
            'tahun_pelaksanaan.required'  => 'Tahun pelaksanaan wajib diisi.',
            'tahun_pelaksanaan.max'       => 'Tahun pelaksanaan maksimal 4 karakter.',
            'file.mimes'                  => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max'                    => 'Ukuran file maksimal 5MB.',
        ]);

        $data = $request->only([
            'id_laporan_akhir',
            'judul_kegiatan',
            'skema',
            'tahun_pelaksanaan'
        ]);

        if ($request->hasFile('file')) {
            if ($laporan_akhir_penelitian->file && Storage::disk('public')->exists($laporan_akhir_penelitian->file)) {
                Storage::disk('public')->delete($laporan_akhir_penelitian->file);
            }

            $data['file'] = $request->file('file')->store('laporan_akhirpenelitian', 'public');
        }

        $laporan_akhir_penelitian->update($data);

        return redirect()->route('laporan_akhir_penelitian.index')->with('success', 'Laporan Akhir Penelitian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = LaporanAkhirPenelitian::findOrFail($id);

        if ($laporan->file && Storage::disk('public')->exists($laporan->file)) {
            Storage::disk('public')->delete($laporan->file);
        }

        $laporan->delete();

        return redirect()->route('laporan_akhir_penelitian.index')->with('success', 'Laporan Akhir Penelitian berhasil dihapus.');
    }

    public function download($id)
    {
        $laporan = LaporanAkhirPenelitian::findOrFail($id);
        $filePath = public_path('laporan_akhirpenelitian/' . $laporan->file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, basename($filePath));
    }

    public function preview($id)
    {
        $laporan = LaporanAkhirPenelitian::findOrFail($id);
        $filePath = public_path('laporan_akhirpenelitian/' . $laporan->file);

        if (!$laporan->file || !file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if ($extension === 'pdf') {
            return response()->file($filePath, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
            ]);
        } elseif (in_array($extension, ['doc', 'docx'])) {
            $url = asset('laporan_akhirpenelitian/' . $laporan->file);
            return redirect("https://docs.google.com/gview?url=$url&embedded=true");
        }

        abort(415, 'Format file tidak didukung untuk preview.');
    }

    public function metadata(Request $request)
    {
        $search = $request->input('search');

        $laporan = LaporanAkhirPenelitian::when($search, function ($query, $search) {
                $query->where('judul_kegiatan', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan_akhir_penelitian.metadata', compact('laporan', 'search'));
    }

    public function exportMetadata(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new LaporanAkhirPenelitianExport($search), 'metadata_laporan_akhir_penelitian.xlsx');
    }
}
