<?php

namespace App\Http\Controllers;

use App\Models\AnggaranPengabdian;
use App\Models\SkemaPengabdian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\AnggaranPengabdianExport;
use Maatwebsite\Excel\Facades\Excel;

class AnggaranPengabdianController extends Controller
{
  public function index(Request $request)
    {
        $search = $request->input('search');

        $anggaran = AnggaranPengabdian::when($search, function ($query, $search) {
            $query->where('kode', 'like', "%{$search}%")
                ->orWhere('kegiatan', 'like', "%{$search}%")
                ->orWhere('skema', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)->withQueryString();

        return view('anggaran_pengabdian.index', compact('anggaran'));
    }

    public function create()
    {
        $skemas = SkemaPengabdian::all();
        return view('anggaran_pengabdian.create', compact('skemas'));
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'kode'           => 'required|string|max:100',
            'kegiatan'       => 'required|string|max:255',
            'volume_usulan'  => 'required|integer|min:1',
            'skema'          => 'required|string|max:100',
            'total_anggaran' => 'required|numeric|min:0',
            'file'           => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('anggaran'), $fileName);
            $validated['file'] = $fileName;
        }

        AnggaranPengabdian::create($validated);

        return redirect()->route('anggaran_pengabdian.index')->with('success', 'Laporan Keuangan Pengabdian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $anggaran = AnggaranPengabdian::findOrFail($id);
        return view('anggaran_pengabdian.detail', compact('anggaran'));
    }


    public function edit(AnggaranPengabdian $anggaran_pengabdian)
    {
        return view('anggaran_pengabdian.edit', compact('anggaran_pengabdian'));
    }


    public function update(Request $request, AnggaranPengabdian $anggaran_pengabdian)
    {
        $validated = $request->validate([
            'kode'           => 'required|string|max:100',
            'kegiatan'       => 'required|string|max:255',
            'volume_usulan'  => 'required|integer|min:1',
            'skema'          => 'required|string|max:100',
            'total_anggaran' => 'required|numeric|min:0',
            'file'           => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            // hapus file lama jika ada
            if ($anggaran_pengabdian->file && file_exists(public_path('anggaran/' . $anggaran_pengabdian->file))) {
                unlink(public_path('anggaran/' . $anggaran_pengabdian->file));
            }
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('anggaran'), $fileName);
            $validated['file'] = $fileName;
        }


        $anggaran_pengabdian->update($validated);

        return redirect()->route('anggaran_pengabdian.index')->with('success', 'Laporan Keuangan Pengabdian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggaran = AnggaranPengabdian::findOrFail($id);

        if ($anggaran->file && Storage::disk('public')->exists($anggaran->file)) {
            Storage::disk('public')->delete($anggaran->file);
        }

        $anggaran->delete();

        return redirect()->route('anggaran_pengabdian.index')->with('success', 'Laporan Keuangan Pengabdian berhasil dihapus.');
    }

    public function download($id)
    {
        $anggaran = AnggaranPengabdian::findOrFail($id);
        $filePath = public_path('anggaran/' . $anggaran->file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, $anggaran->file);

    }

    public function preview($id)
    {
        $anggaran = AnggaranPengabdian::findOrFail($id);
        $filePath = public_path('anggaran/' . $anggaran->file);

        if (!$anggaran->file || !file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if (in_array($extension, ['pdf'])) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.basename($filePath).'"'
            ]);
        } elseif (in_array($extension, ['doc', 'docx'])) {
            // Untuk doc/docx, browser biasanya tidak punya viewer bawaan
            // Solusi: Redirect atau sarankan user download, atau gunakan Google Docs Viewer
            $url = asset('anggaran/' . $anggaran->file);
            return redirect("https://docs.google.com/gview?url=$url&embedded=true");
        } else {
            abort(415, 'Format file tidak didukung untuk preview.');
        }
    }

    public function metadata(Request $request)
    {
        $search = $request->input('search');

        $anggaran = AnggaranPengabdian::when($search, function ($query, $search) {
                $query->where('kode', 'like', "%{$search}%")
                    ->orWhere('kegiatan', 'like', "%{$search}%")
                    ->orWhere('skema', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('anggaran_pengabdian.metadata', compact('anggaran', 'search'));
    }

    public function exportMetadata(Request $request)
    {
        $search = $request->input('search');

        return Excel::download(new AnggaranPengabdianExport($search), 'metadata_anggaran_pengabdian.xlsx');
    }
}

