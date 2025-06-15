<?php

namespace App\Http\Controllers;

use App\Models\AnggaranPenelitian;
use App\Models\SkemaPenelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        ->paginate(10)->withQueryString();

        return view('anggaran_penelitian.index', compact('anggaran'));
    }

    public function create()
    {
        $skemas = SkemaPenelitian::all();
        return view('anggaran_penelitian.create', compact('skemas'));
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

        AnggaranPenelitian::create($validated);

        return redirect()->route('anggaran_penelitian.index')->with('success', 'Data anggaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $anggaran = AnggaranPenelitian::findOrFail($id);
        return view('anggaran_penelitian.detail', compact('anggaran'));
    }

    public function edit(AnggaranPenelitian $anggaran_penelitian)
    {
        return view('anggaran_penelitian.edit', compact('anggaran_penelitian'));
    }

    public function update(Request $request, AnggaranPenelitian $anggaran_penelitian)
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
            if ($anggaran_penelitian->file && file_exists(public_path('anggaran/' . $anggaran_penelitian->file))) {
                unlink(public_path('anggaran/' . $anggaran_penelitian->file));
            }
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('anggaran'), $fileName);
            $validated['file'] = $fileName;
        }

        $anggaran_penelitian->update($validated);

        return redirect()->route('anggaran_penelitian.index')->with('success', 'Data anggaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggaran = AnggaranPenelitian::findOrFail($id);

        if ($anggaran->file && Storage::disk('public')->exists($anggaran->file)) {
            Storage::disk('public')->delete($anggaran->file);
        }

        $anggaran->delete();

        return redirect()->route('anggaran_penelitian.index')->with('success', 'Data anggaran berhasil dihapus.');
    }

    public function download($id)
    {
        $anggaran = AnggaranPenelitian::findOrFail($id);
        $filePath = public_path('anggaran/' . $anggaran->file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, $anggaran->file);
    }

    public function preview($id)
    {
        $anggaran = AnggaranPenelitian::findOrFail($id);
        $filePath = public_path('anggaran/' . $anggaran->file);

        if (!$anggaran->file || !file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if (in_array($extension, ['pdf'])) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
            ]);
        } elseif (in_array($extension, ['doc', 'docx'])) {
            $url = asset('anggaran/' . $anggaran->file);
            return redirect("https://docs.google.com/gview?url=$url&embedded=true");
        } else {
            abort(415, 'Format file tidak didukung untuk preview.');
        }
    }
}
