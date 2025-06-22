<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\JenisArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Exports\MetadataMasukExport;
use Maatwebsite\Excel\Facades\Excel;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search && !preg_match("/^[a-zA-Z0-9\s\-\/]+$/", $search)) {
            return redirect()->back()->with('search_error', 'Data yang Anda masukkan tidak valid!');
        }

        $suratmasuks = SuratMasuk::with('jenisArsip')
            ->when($search, function ($query) use ($search) {
                return $query->where('nomor_surat', 'like', "%{$search}%")
                            ->orWhere('pengirim', 'like', "%{$search}%")
                            ->orWhere('perihal', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('suratmasuk.index', compact('suratmasuks', 'search'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat'    => 'required|string|max:255',
            'kode_klasifikasi' => 'required',
            'tanggal_surat'  => 'required|date',
            'tanggal_terima' => 'required|date',
            'asal_surat'       => 'required|string|max:255',
            'pengirim'       => 'required|string|max:255',
            'perihal'        => 'required|string|max:255',
            'lampiran' => 'nullable|string',
            'jenis'          => 'required|integer',
            'keterangan' => 'nullable|string',
            'file'           => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('file')->store('suratmasuk', 'public');

        SuratMasuk::create([
            'nomor_surat'      => $request->nomor_surat,
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'tanggal_surat'    => $request->tanggal_surat,
            'tanggal_terima'   => $request->tanggal_terima,
            'asal_surat'       => $request->asal_surat,
            'pengirim'         => $request->pengirim,
            'perihal'          => $request->perihal,
            'lampiran'         => $request->lampiran,
            'jenis'            => $request->jenis,
            'keterangan'       => $request->keterangan,
            'file'             => $path,
        ]);


        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
    }

    public function create()
    {
        $jenisarsips = JenisArsip::all(); // ambil semua jenis arsip dari tabel
        return view('suratmasuk.create', compact('jenisarsips'));
    }

    public function edit(SuratMasuk $suratmasuk)
    {
        $jenisarsips = JenisArsip::all();
        return view('suratmasuk.edit', compact('suratmasuk', 'jenisarsips'));
    }

    public function update(Request $request, SuratMasuk $suratmasuk)
    {
        $request->validate([
            'nomor_surat'    => 'required|string|max:255',
            'kode_klasifikasi' => 'required',
            'tanggal_surat'  => 'required|date',
            'tanggal_terima' => 'required|date',
            'tanggal_terima'   => 'required|date',
            'pengirim'       => 'required|string|max:255',
            'perihal'        => 'required|string|max:255',
            'lampiran' => 'nullable|string',
            'jenis'          => 'required|integer',
            'keterangan' => 'nullable|string',
            'file'           => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'nomor_surat', 'tanggal_surat', 'tanggal_terima', 'asal_surat',
            'perihal', 'pengirim', 'jenis'
        ]);

        if ($request->hasFile('file')) {
            if ($suratmasuk->file && Storage::disk('public')->exists($suratmasuk->file)) {
                Storage::disk('public')->delete($suratmasuk->file);
            }

            $data['file'] = $request->file('file')->store('suratmasuk', 'public');
        }

        $suratmasuk->update($data);

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil diperbarui.');
    }


    public function destroy(SuratMasuk $suratmasuk)
    {
        // Hapus file dari storage
        if ($suratmasuk->file && Storage::disk('public')->exists($suratmasuk->file)) {
            Storage::disk('public')->delete($suratmasuk->file);
        }

        $suratmasuk->delete();

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil dihapus.');
    }

    public function show($id)
    {
        // Ambil data surat masuk beserta relasi jenis arsip (jika ada)
        $suratmasuk = SuratMasuk::with('jenisArsip')->findOrFail($id);

        return view('suratmasuk.detail', compact('suratmasuk'));
    }

    public function download($id)
    {
        $suratmasuk = SuratMasuk::findOrFail($id);

        if (!$suratmasuk->file || !Storage::disk('public')->exists($suratmasuk->file)) {
            abort(404, 'File tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($suratmasuk->file);

        // Untuk preview PDF di browser
        if (request()->has('preview')) {
            return response()->file($path, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        // Default: download file
        return Storage::disk('public')->download($suratmasuk->file);
    }

    public function metadata(Request $request)
    {
        $search = $request->search;
        $data = SuratMasuk::with('jenisArsip')
            ->when($search, function ($query, $search) {
                $query->where('nomor_surat', 'like', "%$search%")
                    ->orWhere('perihal', 'like', "%$search%")
                    ->orWhere('pengirim', 'like', "%$search%");
            })
            ->get();

        return view('suratmasuk.metadata', compact('data'));
    }

    public function exportMetadata(Request $request)
    {
        return Excel::download(new MetadataMasukExport($request->search), 'metadata_suratmasuk.xlsx');
    }

}
