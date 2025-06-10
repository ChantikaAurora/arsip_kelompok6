<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\JenisArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
        'nomor_surat' => 'required',
        'tanggal_surat' => 'required|date',
        'tujuan_surat' => 'required',
        'perihal' => 'required',
        'pengirim' => 'required',
        'penerima' => 'required',
        'jenis' => 'required',
        'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filePath = $file->storeAs('suratkeluar', $originalName, 'public');
        }

        // Dapatkan nomor urut terakhir
        $autoNo = SuratKeluar::count() + 1;
        
        SuratKeluar::create([
        'no' => (string)$autoNo, // simpan sebagai string
        'nomor_surat' => $validated['nomor_surat'],
        'tanggal_surat' => $validated['tanggal_surat'],
        'tujuan_surat' => $validated['tujuan_surat'],
        'perihal' => $validated['perihal'],
        'pengirim' => $validated['pengirim'],
        'penerima' => $validated['penerima'],
        'jenis' => $validated['jenis'],
        'file' => $filePath,

        ]);

        return redirect()->route('suratkeluar.index')->with('success', 'Data berhasil disimpan');
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
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'tujuan_surat' => 'required',
            'perihal' => 'required',
            'pengirim' => 'required',
            'penerima' => 'required',
            'jenis' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240',
        ]);

        $data = SuratKeluar::findOrFail($id);

        // Hindari perubahan pada kolom 'no'
        $validatedData = $validated;
        $validatedData['no'] = $data->no;

        if ($request->hasFile('file')) {
            if ($data->file) {
                Storage::disk('public')->delete($data->file);
            }
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $validated['file'] = $file->storeAs('suratkeluar', $originalName, 'public');
        }

        $data->update($validatedData);
        return redirect('/suratkeluar')->with('success', 'Data berhasil diupdate');
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
                // Redirect ke download jika bukan file yang bisa ditampilkan
                return redirect()->route('suratkeluar.download', ['id' => $id]);
            }
        }

        // Download
        return Storage::disk('public')->download($suratkeluar->file);
    }

}
