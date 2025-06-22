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
        $validated = $request->validate([
            'id_laporan_akhir'   => 'required|string|max:50',
            'judul_kegiatan'     => 'required|string|max:255',
            'skema'              => 'required|string|max:100',
            'tahun_pelaksanaan'  => 'required|string|max:4',
            'file'               => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('laporan_akhirpengabdian'), $fileName);
            $validated['file'] = $fileName;
        }

        LaporanAkhirPengabdian::create($validated);

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
        $validated = $request->validate([
            'id_laporan_akhir'   => 'required|string|max:50',
            'judul_kegiatan'     => 'required|string|max:255',
            'skema'              => 'required|string|max:100',
            'tahun_pelaksanaan'  => 'required|string|max:4',
            'file'               => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            if ($laporan_akhir_pengabdian->file && file_exists(public_path('laporan_akhirpengabdian/' . $laporan_akhir_pengabdian->file))) {
                unlink(public_path('laporan_akhirpengabdian/' . $laporan_akhir_pengabdian->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('laporan_akhir_pengabdian'), $fileName);
            $validated['file'] = $fileName;
        }

        $laporan_akhir_pengabdian->update($validated);

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
        $filePath = public_path('laporan_akhirpengabdian/' . $laporan->file);

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
            $url = asset('laporan_akhirpengabdian/' . $laporan->file);
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
