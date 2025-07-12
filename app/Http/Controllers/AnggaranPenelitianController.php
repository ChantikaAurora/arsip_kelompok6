<?php

namespace App\Http\Controllers;

use App\Models\AnggaranPenelitian;
use App\Models\SkemaPenelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\AnggaranPenelitianExport;
use Maatwebsite\Excel\Facades\Excel;

class AnggaranPenelitianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $anggaran = AnggaranPenelitian::when($search, function ($query, $search) {
                $query->where('kode', 'like', "%{$search}%")
                      ->orWhere('kegiatan', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('anggaran_penelitian.index', compact('anggaran'));
    }

    public function create()
    {
        $skemas = SkemaPenelitian::all();
        return view('anggaran_penelitian.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'           => 'required|string|max:100',
            'kegiatan'       => 'required|string|max:255',
            'volume_usulan'  => 'required|integer|min:1',
            'skema'          => 'required|string|max:100',
            'total_anggaran' => 'required|numeric|min:0',
            'file'           => 'required|mimes:pdf,doc,docx|max:2048',
        ], [
            'kode.required'           => 'Kode wajib diisi.',
            'kode.max'                => 'Kode maksimal 100 karakter.',
            'kegiatan.required'       => 'Kegiatan wajib diisi.',
            'kegiatan.max'            => 'Kegiatan maksimal 255 karakter.',
            'volume_usulan.required' => 'Volume usulan wajib diisi.',
            'volume_usulan.integer'  => 'Volume usulan harus berupa angka.',
            'volume_usulan.min'      => 'Volume usulan minimal 1.',
            'skema.required'         => 'Skema wajib diisi.',
            'skema.max'              => 'Skema maksimal 100 karakter.',
            'total_anggaran.required'=> 'Total anggaran wajib diisi.',
            'total_anggaran.numeric' => 'Total anggaran harus berupa angka.',
            'total_anggaran.min'     => 'Total anggaran minimal 0.',
            'file.required'          => 'File wajib diunggah.',
            'file.mimes'             => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max'               => 'Ukuran file maksimal 2MB.',
        ]);

        $path = $request->file('file')->store('anggaran_penelitian', 'public');

        AnggaranPenelitian::create([
            'kode'           => $request->kode,
            'kegiatan'       => $request->kegiatan,
            'volume_usulan'  => $request->volume_usulan,
            'skema'          => $request->skema,
            'total_anggaran' => $request->total_anggaran,
            'file'           => $path,
        ]);

        return redirect()->route('anggaran_penelitian.index')->with('success', 'Laporan Keuangan Penelitian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $anggaran = AnggaranPenelitian::findOrFail($id);
        return view('anggaran_penelitian.detail', compact('anggaran'));
    }

    public function edit(AnggaranPenelitian $anggaran_penelitian)
    {
        $skemas = SkemaPenelitian::all();
        return view('anggaran_penelitian.edit', [
            'anggaran' => $anggaran_penelitian,
            'skemas'   => $skemas,
        ]);
    }

    public function update(Request $request, AnggaranPenelitian $anggaran_penelitian)
    {
        $request->validate([
            'kode'           => 'required|string|max:100',
            'kegiatan'       => 'required|string|max:255',
            'volume_usulan'  => 'required|integer|min:1',
            'skema'          => 'required|string|max:100',
            'total_anggaran' => 'required|numeric|min:0',
            'file'           => 'nullable|mimes:pdf,doc,docx|max:2048',
        ], [
            'kode.required'           => 'Kode wajib diisi.',
            'kode.max'                => 'Kode maksimal 100 karakter.',
            'kegiatan.required'       => 'Kegiatan wajib diisi.',
            'kegiatan.max'            => 'Kegiatan maksimal 255 karakter.',
            'volume_usulan.required' => 'Volume usulan wajib diisi.',
            'volume_usulan.integer'  => 'Volume usulan harus berupa angka.',
            'volume_usulan.min'      => 'Volume usulan minimal 1.',
            'skema.required'         => 'Skema wajib diisi.',
            'skema.max'              => 'Skema maksimal 100 karakter.',
            'total_anggaran.required'=> 'Total anggaran wajib diisi.',
            'total_anggaran.numeric' => 'Total anggaran harus berupa angka.',
            'total_anggaran.min'     => 'Total anggaran minimal 0.',
            'file.mimes'             => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max'               => 'Ukuran file maksimal 2MB.',
        ]);

        $data = $request->only([
            'kode',
            'kegiatan',
            'volume_usulan',
            'skema',
            'total_anggaran',
        ]);

        if ($request->hasFile('file')) {
            if ($anggaran_penelitian->file && Storage::disk('public')->exists($anggaran_penelitian->file)) {
                Storage::disk('public')->delete($anggaran_penelitian->file);
            }

            $data['file'] = $request->file('file')->store('anggaran_penelitian', 'public');
        }

        $anggaran_penelitian->update($data);

        return redirect()->route('anggaran_penelitian.index')->with('success', 'Laporan Keuangan Penelitian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggaran = AnggaranPenelitian::findOrFail($id);

        if ($anggaran->file && Storage::disk('public')->exists($anggaran->file)) {
            Storage::disk('public')->delete($anggaran->file);
        }

        $anggaran->delete();

        return redirect()->route('anggaran_penelitian.index')->with('success', 'Laporan Keuangan Penelitian berhasil dihapus.');
    }

    public function download($id)
    {
        $anggaran = AnggaranPenelitian::findOrFail($id);
        $filePath = public_path('anggaran/' . $anggaran->file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, basename($filePath));
    }

    public function preview($id)
    {
        $anggaran = AnggaranPenelitian::findOrFail($id);
        $filePath = public_path('anggaran/' . $anggaran->file);

        if (!$anggaran->file || !file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if ($extension === 'pdf') {
            return response()->file($filePath, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
            ]);
        } elseif (in_array($extension, ['doc', 'docx'])) {
            $url = asset('anggaran/' . $anggaran->file);
            return redirect("https://docs.google.com/gview?url=$url&embedded=true");
        }

        abort(415, 'Format file tidak didukung untuk preview.');
    }

    public function metadata(Request $request)
    {
        $search = $request->input('search');

        $anggaran = AnggaranPenelitian::when($search, function ($query, $search) {
                $query->where('kode', 'like', "%{$search}%")
                      ->orWhere('kegiatan', 'like', "%{$search}%")
                      ->orWhere('skema', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('anggaran_penelitian.metadata', compact('anggaran', 'search'));
    }

    public function exportMetadata(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new AnggaranPenelitianExport($search), 'metadata_anggaran_penelitian.xlsx');
    }
}
