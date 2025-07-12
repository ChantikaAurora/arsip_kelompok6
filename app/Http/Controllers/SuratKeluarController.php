<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\JenisArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MetadataKeluarExport;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SuratKeluar::query();

        if ($request->has('search')) {
            $query->where('perihal', 'like', '%' . $request->search . '%');
        }

        $data = $query->with('jenisArsip')->paginate(10)->withQueryString();

        return view('suratkeluar.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisarsips = JenisArsip::all(); //mengambil jenis arsip dari database
        return view('suratkeluar.create', compact('jenisarsips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat'      => 'required|string|max:255',
            'nomor_agenda'     => 'required|string|max:255',
            'kode_klasifikasi' => 'required|string|max:100',
            'tanggal_surat'    => 'required|date',
            'tujuan_surat'     => 'required|string|max:255',
            'penerima'         => 'required|string|max:255',
            'perihal'          => 'required|string|max:255',
            'lampiran'         => 'required|string|max:100',
            'jenis'            => 'required|integer|exists:jenis_arsips,id',
            'keterangan'       => 'nullable|string|max:1000',
            'file'             => 'required|mimes:pdf,doc,docx,txt|max:10240',
        ], [
            'nomor_surat.required'      => 'Nomor surat wajib diisi.',
            'nomor_surat.max'           => 'Nomor surat maksimal 255 karakter.',

            'nomor_agenda.max'          => 'Nomor agenda maksimal 255 karakter.',

            'kode_klasifikasi.required' => 'Kode klasifikasi wajib diisi.',
            'kode_klasifikasi.max'      => 'Kode klasifikasi maksimal 100 karakter.',

            'tanggal_surat.required'    => 'Tanggal surat wajib diisi.',
            'tanggal_surat.date'        => 'Tanggal surat harus berupa tanggal yang valid.',

            'tujuan_surat.required'     => 'Tujuan surat wajib diisi.',
            'tujuan_surat.max'          => 'Tujuan surat maksimal 255 karakter.',

            'penerima.required'         => 'Nama penerima wajib diisi.',
            'penerima.max'              => 'Nama penerima maksimal 255 karakter.',

            'perihal.required'          => 'Perihal wajib diisi.',
            'perihal.max'               => 'Perihal maksimal 255 karakter.',

            'lampiran.required'         => 'Lampiran wajib diisi.',
            'lampiran.max'              => 'Lampiran maksimal 100 karakter.',

            'jenis.required'            => 'Jenis arsip wajib dipilih.',
            'jenis.integer'             => 'Jenis arsip tidak valid.',

            'keterangan.max'            => 'Keterangan maksimal 1000 karakter.',

            'file.required'             => 'File wajib diisi.',
            'file.mimes'                => 'File harus berformat PDF, DOC, DOCX, atau TXT.',
            'file.max'                  => 'Ukuran file maksimal 10MB.',
        ]);

        // Simpan file jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filePath = $file->storeAs('suratkeluar', $originalName, 'public');
        }

        // Simpan data ke database
        SuratKeluar::create([
            'nomor_surat'      => $request->nomor_surat,
            'nomor_agenda'     => $request->nomor_agenda,
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'tanggal_surat'    => $request->tanggal_surat,
            'tujuan_surat'     => $request->tujuan_surat,
            'penerima'         => $request->penerima,
            'perihal'          => $request->perihal,
            'lampiran'         => $request->lampiran,
            'jenis'            => $request->jenis,
            'keterangan'       => $request->keterangan,
            'file'             => $filePath,
        ]);

        return redirect()->route('suratkeluar.index')->with('success', 'Surat Keluar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = SuratKeluar::findOrFail($id);
        // Hitung nomor urut berdasarkan ID kecil ke besar
        $no = SuratKeluar::where('id', '<=', $data->id)->count();
        return view('suratkeluar.detail', compact('data','no'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);
        $jenisarsips = JenisArsip::all(); // kalau kamu juga butuh list jenis arsip
        return view('suratkeluar.edit', compact('suratkeluar', 'jenisarsips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratKeluar $suratkeluar)
    {
        $request->validate([
            'nomor_surat'      => 'required|string|max:255',
            'nomor_agenda'     => 'required|string|max:255',
            'kode_klasifikasi' => 'required|string|max:100',
            'tanggal_surat'    => 'required|date',
            'tujuan_surat'     => 'required|string|max:255',
            'penerima'         => 'required|string|max:255',
            'perihal'          => 'required|string|max:255',
            'lampiran'         => 'required|string|max:100',
            'jenis'            => 'required|integer|exists:jenis_arsips,id',
            'keterangan'       => 'nullable|string|max:1000',
            'file'             => 'nullable|mimes:pdf,doc,docx,txt|max:10240',
        ], [
            'nomor_surat.required'      => 'Nomor surat wajib diisi.',
            'nomor_surat.max'           => 'Nomor surat maksimal 255 karakter.',

            'nomor_agenda.max'          => 'Nomor agenda maksimal 255 karakter.',

            'kode_klasifikasi.required' => 'Kode klasifikasi wajib diisi.',
            'kode_klasifikasi.max'      => 'Kode klasifikasi maksimal 100 karakter.',

            'tanggal_surat.required'    => 'Tanggal surat wajib diisi.',
            'tanggal_surat.date'        => 'Tanggal surat tidak valid.',

            'tujuan_surat.required'     => 'Tujuan surat wajib diisi.',
            'tujuan_surat.max'          => 'Tujuan surat maksimal 255 karakter.',

            'penerima.required'         => 'Nama penerima wajib diisi.',
            'penerima.max'              => 'Nama penerima maksimal 255 karakter.',

            'perihal.required'          => 'Perihal wajib diisi.',
            'perihal.max'               => 'Perihal maksimal 255 karakter.',

            'lampiran.required'         => 'Lampiran wajib diisi.',
            'lampiran.max'              => 'Lampiran maksimal 100 karakter.',

            'jenis.required'            => 'Jenis arsip wajib dipilih.',
            'jenis.integer'             => 'Jenis arsip tidak valid.',

            'keterangan.max'            => 'Keterangan maksimal 1000 karakter.',

            'file.mimes'                => 'File harus berformat PDF, DOC, DOCX, atau TXT.',
            'file.max'                  => 'Ukuran file maksimal 10MB.',
        ]);

        // Ambil field yang akan diupdate
        $data = $request->only([
            'nomor_surat',
            'nomor_agenda',
            'kode_klasifikasi',
            'tanggal_surat',
            'tujuan_surat',
            'penerima',
            'perihal',
            'lampiran',
            'jenis',
            'keterangan',
        ]);

        // Handle file baru jika ada
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($suratkeluar->file && Storage::disk('public')->exists($suratkeluar->file)) {
                Storage::disk('public')->delete($suratkeluar->file);
            }

            // Simpan file baru
            $data['file'] = $request->file('file')->storeAs(
                'suratkeluar',
                $request->file('file')->getClientOriginalName(),
                'public'
            );
        }

        $suratkeluar->update($data);

        return redirect()->route('suratkeluar.index')->with('success', 'Surat Keluar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = SuratKeluar::findOrFail($id);
        if ($data->file) {
            Storage::disk('public')->delete($data->file);
        }
        $data->delete();
        return redirect('/suratkeluar')->with('success', 'Data berhasil dihapus');
    }

    public function download($id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);

        if (!$suratkeluar->file || !Storage::disk('public')->exists($suratkeluar->file)) {
            abort(404, 'File tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($suratkeluar->file);
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        // Preview hanya jika file adalah PDF atau TXT
        if (request()->has('preview')) {
            if (in_array($extension, ['pdf', 'txt'])) {
                return response()->file($path, [
                    'Content-Type' => $extension === 'pdf' ? 'application/pdf' : 'text/plain',
                ]);
            } else {
                return redirect()->route('suratkeluar.download', ['id' => $id]);
            }
        }

        // ✅ Ini bagian yang belum ada: download biasa
        return Storage::disk('public')->download($suratkeluar->file);
    }

    public function metadata(Request $request)
    {
        $search = $request->search;

        $data = SuratKeluar::with('jenisArsip', 'user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nomor_surat', 'like', "%$search%")
                    ->orWhere('nomor_agenda', 'like', "%$search%")
                    ->orWhere('kode_klasifikasi', 'like', "%$search%")
                    ->orWhere('tanggal_surat', 'like', "%$search%")
                    ->orWhere('tujuan_surat', 'like', "%$search%")
                    ->orWhere('penerima', 'like', "%$search%")
                    ->orWhere('perihal', 'like', "%$search%")
                    ->orWhere('lampiran', 'like', "%$search%")
                    ->orWhere('keterangan', 'like', "%$search%");
                });
            })
            ->get();

        return view('suratkeluar.metadata', compact('data'));
    }

    public function exportMetadata(Request $request)
    {
        return Excel::download(new MetadataKeluarExport($request->search), 'metadata_suratkeluar.xlsx');
    }
}
