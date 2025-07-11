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
            'nomor_surat'      => 'required|string|max:255',
            'kode_klasifikasi' => 'required|string|max:255',
            'tanggal_surat'    => 'required|date',
            'tanggal_terima'   => 'required|date',
            'asal_surat'       => 'required|string|max:255',
            'pengirim'         => 'required|string|max:255',
            'perihal'          => 'required|string|max:255',
            'lampiran'         => 'required|string|max:255',
            'jenis'            => 'required|integer',
            'keterangan'       => 'nullable|string|max:1000',
            'file'             => 'required|mimes:pdf,doc,docx|max:2048',
        ], [
            'nomor_surat.required'      => 'Nomor surat wajib diisi.',
            'nomor_surat.max'           => 'Nomor surat maksimal 255 karakter.',

            'kode_klasifikasi.required' => 'Kode klasifikasi wajib diisi.',
            'kode_klasifikasi.max'      => 'Kode klasifikasi maksimal 255 karakter.',

            'tanggal_surat.required'    => 'Tanggal surat wajib diisi.',
            'tanggal_surat.date'        => 'Tanggal surat harus berupa tanggal yang valid.',

            'tanggal_terima.required'   => 'Tanggal terima wajib diisi.',
            'tanggal_terima.date'       => 'Tanggal terima harus berupa tanggal yang valid.',

            'asal_surat.required'       => 'Asal surat wajib diisi.',
            'asal_surat.max'            => 'Asal surat maksimal 255 karakter.',

            'pengirim.required'         => 'Nama pengirim wajib diisi.',
            'pengirim.max'              => 'Nama pengirim maksimal 255 karakter.',

            'perihal.required'          => 'Perihal wajib diisi.',
            'perihal.max'               => 'Perihal maksimal 255 karakter.',

            'lampiran.max'              => 'Lampiran maksimal 255 karakter.',

            'jenis.required'            => 'Jenis arsip wajib dipilih.',
            'jenis.integer'             => 'Jenis arsip tidak valid.',

            'keterangan.max'            => 'Keterangan maksimal 1000 karakter.',

            'file.required'             => 'File wajib diunggah.',
            'file.mimes'                => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max'                  => 'Ukuran file maksimal 2MB.',
        ]);

        // Simpan file
        $path = $request->file('file')->store('suratmasuk', 'public');

        // Simpan ke database
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
            'nomor_surat'      => 'required|string|max:255',
            'kode_klasifikasi' => 'required',
            'tanggal_surat'    => 'required|date',
            'tanggal_terima'   => 'required|date',
            'asal_surat'       => 'required|string|max:255',
            'pengirim'         => 'required|string|max:255',
            'perihal'          => 'required|string|max:255',
            'lampiran'         => 'required|string',
            'jenis'            => 'required|integer',
            'keterangan'       => 'nullable|string',
            'file'             => 'nullable|mimes:pdf,doc,docx|max:2048',
        ], [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'nomor_surat.max'      => 'Nomor surat maksimal 255 karakter.',

            'kode_klasifikasi.required' => 'Kode klasifikasi wajib diisi.',

            'tanggal_surat.required' => 'Tanggal surat wajib diisi.',
            'tanggal_surat.date'     => 'Tanggal surat tidak valid.',

            'tanggal_terima.required' => 'Tanggal terima wajib diisi.',
            'tanggal_terima.date'     => 'Tanggal terima tidak valid.',

            'asal_surat.required' => 'Asal surat wajib diisi.',
            'asal_surat.max'      => 'Asal surat maksimal 255 karakter.',

            'pengirim.required' => 'Nama pengirim wajib diisi.',
            'pengirim.max'      => 'Nama pengirim maksimal 255 karakter.',

            'perihal.required' => 'Perihal wajib diisi.',
            'perihal.max'      => 'Perihal maksimal 255 karakter.',

            'lampiran.required'  => 'Lampiran wajib diisi.',
            'lampiran.string' => 'Lampiran harus berupa teks.',

            'jenis.required' => 'Jenis arsip wajib dipilih.',
            'jenis.integer'  => 'Jenis arsip tidak valid.',

            'keterangan.string' => 'Keterangan harus berupa teks.',

            'file.mimes'    => 'File harus berformat pdf, doc, atau docx.',
            'file.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        // Ambil field yang boleh diupdate
        $data = $request->only([
            'nomor_surat',
            'kode_klasifikasi',
            'tanggal_surat',
            'tanggal_terima',
            'asal_surat',
            'pengirim',
            'perihal',
            'lampiran',
            'jenis',
            'keterangan',
        ]);

        // Handle upload file jika ada
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
                    ->orWhere('kode_klasifikasi', 'like', "%$search%")
                    ->orWhere('tanggal_surat', 'like', "%$search%")
                    ->orWhere('tanggal_terima', 'like', "%$search%")
                    ->orWhere('asal_surat', 'like', "%$search%")
                    ->orWhere('pengirim', 'like', "%$search%")
                    ->orWhere('perihal', 'like', "%$search%")
                    ->orWhere('lampiran', 'like', "%$search%")
                    ->orWhere('jenis', 'like', "%$search%")
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
