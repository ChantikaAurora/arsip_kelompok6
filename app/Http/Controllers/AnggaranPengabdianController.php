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
            ->paginate(10)
            ->withQueryString();

        return view('anggaran_pengabdian.index', compact('anggaran'));
    }

    public function create()
    {
        $skemas = SkemaPengabdian::all();
        return view('anggaran_pengabdian.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'           => 'required|string|max:100',
            'kegiatan'       => 'required|string|max:255',
            'volume_usulan'  => 'required|integer|min:1',
            'skema'          => 'required|string|max:100',
            'total_anggaran' => 'required|numeric|min:0',
            'file'           => 'required|mimes:pdf,doc,docx|max:5120',
        ], [
            'kode.required'           => 'Kode wajib diisi.',
            'kode.max'                => 'Kode maksimal 100 karakter.',
            'kegiatan.required'       => 'Nama kegiatan wajib diisi.',
            'kegiatan.max'            => 'Nama kegiatan maksimal 255 karakter.',
            'volume_usulan.required' => 'Volume usulan wajib diisi.',
            'volume_usulan.integer'  => 'Volume usulan harus berupa angka.',
            'volume_usulan.min'      => 'Volume usulan minimal 1.',
            'skema.required'         => 'Skema wajib diisi.',
            'skema.max'              => 'Skema maksimal 100 karakter.',
            'total_anggaran.required'=> 'Total anggaran wajib diisi.',
            'total_anggaran.numeric' => 'Total anggaran harus berupa angka.',
            'total_anggaran.min'     => 'Total anggaran tidak boleh negatif.',
            'file.required'          => 'File wajib diunggah.',
            'file.mimes'             => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max'               => 'Ukuran file maksimal 5MB.',
        ]);

        $path = $request->file('file')->store('anggaran_pengabdian', 'public');

        AnggaranPengabdian::create([
            'kode'           => $request->kode,
            'kegiatan'       => $request->kegiatan,
            'volume_usulan'  => $request->volume_usulan,
            'skema'          => $request->skema,
            'total_anggaran' => $request->total_anggaran,
            'file'           => $path,
        ]);

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
        $request->validate([
            'kode'           => 'required|string|max:100',
            'kegiatan'       => 'required|string|max:255',
            'volume_usulan'  => 'required|integer|min:1',
            'skema'          => 'required|string|max:100',
            'total_anggaran' => 'required|numeric|min:0',
            'file'           => 'nullable|mimes:pdf,doc,docx|max:5120',
        ], [
            'kode.required'           => 'Kode wajib diisi.',
            'kode.max'                => 'Kode maksimal 100 karakter.',
            'kegiatan.required'       => 'Nama kegiatan wajib diisi.',
            'kegiatan.max'            => 'Nama kegiatan maksimal 255 karakter.',
            'volume_usulan.required' => 'Volume usulan wajib diisi.',
            'volume_usulan.integer'  => 'Volume usulan harus berupa angka.',
            'volume_usulan.min'      => 'Volume usulan minimal 1.',
            'skema.required'         => 'Skema wajib diisi.',
            'skema.max'              => 'Skema maksimal 100 karakter.',
            'total_anggaran.required'=> 'Total anggaran wajib diisi.',
            'total_anggaran.numeric' => 'Total anggaran harus berupa angka.',
            'total_anggaran.min'     => 'Total anggaran tidak boleh negatif.',
            'file.mimes'             => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max'               => 'Ukuran file maksimal 5MB.',
        ]);

        $data = $request->only([
            'kode', 'kegiatan', 'volume_usulan', 'skema', 'total_anggaran'
        ]);

        if ($request->hasFile('file')) {
            if ($anggaran_pengabdian->file && Storage::disk('public')->exists($anggaran_pengabdian->file)) {
                Storage::disk('public')->delete($anggaran_pengabdian->file);
            }

            $data['file'] = $request->file('file')->store('anggaran_pengabdian', 'public');
        }

        $anggaran_pengabdian->update($data);

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

        return response()->download($filePath, basename($filePath));
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
