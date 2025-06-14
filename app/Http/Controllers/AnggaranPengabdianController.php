<?php

namespace App\Http\Controllers;

use App\Models\AnggaranPengabdian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggaranPengabdianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $anggaran = AnggaranPengabdian::when($search, function ($query, $search) {
            $query->where('kode', 'like', "%{$search}%")
                  ->orWhere('kegiatan', 'like', "%{$search}%")
                  ->orWhere('skema', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->get();

        return view('anggaran_pengabdian.index', compact('anggaran'));
    }

    public function create()
    {
        return view('anggaran_pengabdian.create');
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
            $file->storeAs('anggaran', $fileName, 'public');
            $validated['file'] = $fileName;
        }

        AnggaranPengabdian::create($validated);

        return redirect()->route('anggaran_pengabdian.index')->with('success', 'Data anggaran berhasil ditambahkan.');
    }

    public function show(AnggaranPengabdian $anggaran)
    {
        return view('anggaran_pengabdian.detail', compact('anggaran'));
    }

    public function edit(AnggaranPengabdian $anggaran)
    {
        return view('anggaran_pengabdian.edit', compact('anggaran'));
    }

    public function update(Request $request, AnggaranPengabdian $anggaran)
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
            if ($anggaran->file && Storage::disk('public')->exists('anggaran/' . $anggaran->file)) {
                Storage::disk('public')->delete('anggaran/' . $anggaran->file);
            }
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('anggaran', $fileName, 'public');
            $validated['file'] = $fileName;
        }

        $anggaran->update($validated);

        return redirect()->route('anggaran_pengabdian.index')->with('success', 'Data anggaran berhasil diperbarui.');
    }

    public function destroy(AnggaranPengabdian $anggaran)
    {
        if ($anggaran->file && Storage::disk('public')->exists('anggaran/' . $anggaran->file)) {
            Storage::disk('public')->delete('anggaran/' . $anggaran->file);
        }

        $anggaran->delete();

        return redirect()->route('anggaran_pengabdian.index')->with('success', 'Data anggaran berhasil dihapus.');
    }

    public function download($id)
    {
        $anggaran = AnggaranPengabdian::findOrFail($id);
        $filePath = 'anggaran/' . $anggaran->file;

        if (!$anggaran->file || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        if (request()->has('preview') && request('preview') == 1) {
            $path = Storage::disk('public')->path($filePath);
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if (in_array($extension, ['pdf', 'txt'])) {
                return response()->file($path, [
                    'Content-Type' => $extension === 'pdf' ? 'application/pdf' : 'text/plain',
                ]);
            }
        }

        return Storage::disk('public')->download($filePath);
    }
}

