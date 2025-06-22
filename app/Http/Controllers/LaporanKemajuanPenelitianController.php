<?php

namespace App\Http\Controllers;

use App\Models\LaporanKemajuanPenelitian;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\LaporanKemajuanPenelitianExport;
use App\Models\SkemaPenelitian;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKemajuanPenelitianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $laporan = LaporanKemajuanPenelitian::when($search, function ($query, $search) {
                $query->where('judul_kegiatan', 'like', "%{$search}%")
                      ->orWhere('nama_ketua', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%")
                      ->orWhere('tahun_pelaksanaan', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan_kemajuan_penelitian.index', compact('laporan'));
    }

    public function create()
    {
        $skemas = SkemaPenelitian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        return view('laporan_kemajuan_penelitian.create', compact('skemas', 'jurusans', 'prodis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
            'file'               => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('laporan_kemajuan'), $fileName);
            $validated['file'] = $fileName;
        }

        LaporanKemajuanPenelitian::create($validated);

        return redirect()->route('laporan_kemajuan_penelitian.index')->with('success', 'Laporan Kemajuan Penelitian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $laporan = LaporanKemajuanPenelitian::findOrFail($id);
        return view('laporan_kemajuan_penelitian.detail', compact('laporan'));
    }

    public function edit(LaporanKemajuanPenelitian $laporan_kemajuan_penelitian)
    {
        $skemas = SkemaPenelitian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        return view('laporan_kemajuan_penelitian.edit', compact('laporan_kemajuan_penelitian', 'skemas', 'jurusans', 'prodis'));
    }

    public function update(Request $request, LaporanKemajuanPenelitian $laporankemajuanpenelitian)
    {
        $validated = $request->validate([
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
            'file'               => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            if ($laporankemajuanpenelitian->file && file_exists(public_path('laporan_kemajuan/' . $laporankemajuanpenelitian->file))) {
                unlink(public_path('laporan_kemajuan/' . $laporankemajuanpenelitian->file));
            }
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('laporan_kemajuan'), $fileName);
            $validated['file'] = $fileName;
        }

        $laporankemajuanpenelitian->update($validated);

        return redirect()->route('laporan_kemajuan_penelitian.index')->with('success', 'Laporan Kemajuan Penelitian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = LaporanKemajuanPenelitian::findOrFail($id);

        if ($laporan->file && file_exists(public_path('laporan_kemajuan/' . $laporan->file))) {
            unlink(public_path('laporan_kemajuan/' . $laporan->file));
        }

        $laporan->delete();

        return redirect()->route('laporan_kemajuan_penelitian.index')->with('success', 'Laporan Kemajuan Penelitian berhasil dihapus.');
    }

    public function download($id)
    {
        $laporan = LaporanKemajuanPenelitian::findOrFail($id);
        $filePath = public_path('laporan_kemajuan/' . $laporan->file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, $laporan->file);
    }

    public function preview($id)
    {
        $laporan = LaporanKemajuanPenelitian::findOrFail($id);
        $filePath = public_path('laporan_kemajuan/' . $laporan->file);

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
            $url = asset('laporan_kemajuan/' . $laporan->file);
            return redirect("https://docs.google.com/gview?url=$url&embedded=true");
        } else {
            abort(415, 'Format file tidak didukung untuk preview.');
        }
    }

    public function metadata(Request $request)
    {
        $search = $request->input('search');

        $laporan = LaporanKemajuanPenelitian::when($search, function ($query, $search) {
                $query->where('judul_kegiatan', 'like', "%{$search}%")
                      ->orWhere('nama_ketua', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan_kemajuan_penelitian.metadata', compact('laporan', 'search'));
    }

    public function exportMetadata(Request $request)
    {
        $search = $request->input('search');

        return Excel::download(new LaporanKemajuanPenelitianExport($search), 'metadata_laporan_kemajuan_penelitian.xlsx');
    }
}
