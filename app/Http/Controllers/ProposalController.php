<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\JenisArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $proposal = Proposal::with('jenisArsip')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('peneliti', 'like', "%{$search}%")
                    ->orWhere('jurusan', 'like', "%{$search}%")
                    // ->orWhere('tahun_pengajuan', 'like', "%{$search}%")
                    ->orWhere('tanggal_pengajuan', 'like', "%{$search}%");
            });
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return view('proposal.index', compact('proposal'));
}


    public function create()
    {
        $jenisarsips = JenisArsip::all();
        return view('proposal.create', compact('jenisarsips'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'             => 'required|string|max:255',
            'peneliti'          => 'required|string|max:255',
            'jurusan'           => 'required|string|max:255',
            'jenis'             => 'required|exists:jenis_arsips,id', 
            'tahun_pengajuan'   => 'required|integer',
            'jenis'             => 'required|exists:jenis_arsips,id',
            'tahun_pengajuan'   => 'required|integer',
            'status'            => 'required|string|max:100',
            'tanggal_pengajuan' => 'required|date',
            'dana_diajukan'     => 'required|numeric',
            'keterangan'        => 'nullable|string',
            'file_proposal'     => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file_proposal')) {
            $file = $request->file('file_proposal');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('proposals', $fileName, 'public');  // pastikan tidak ada disk kedua!
            $validated['file_proposal'] = $fileName;
        }

        // $path = $request->file('file')->store('suratmasuk', 'public’);
        Proposal::create($validated);

        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil ditambahkan.');
    }

    public function edit(Proposal $proposal)
    {
         $jenisarsips = JenisArsip::all(); // Ubah jadi nama "jenisarsips"
         return view('proposal.edit', compact('proposal', 'jenisarsips'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        $validated = $request->validate([
            'judul'             => 'required|string|max:255',
            'peneliti'          => 'required|string|max:255',
            'jurusan'           => 'required|string|max:255',
            'jenis'             => 'required|integer',
            // 'tahun_pengajuan'   => 'required|integer',
            'status'            => 'required|string|max:100',
            'tanggal_pengajuan' => 'required|date',
            'dana_diajukan'     => 'required|numeric',
            'keterangan'        => 'nullable|string',
            'file_proposal'     => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file_proposal')) {
            if ($proposal->file_proposal && Storage::exists('proposals/' . $proposal->file_proposal)) {
                Storage::delete('proposals/' . $proposal->file_proposal);
            }

            $file = $request->file('file_proposal');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('proposals', $fileName);
            $validated['file_proposal'] = $fileName;
        }

        $proposal->update($validated);

        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil diperbarui.');
    }


    public function destroy(Proposal $proposal)
    {
        if ($proposal->file_proposal && Storage::exists('proposals/' . $proposal->file_proposal)) {
            Storage::delete('proposals/' . $proposal->file_proposal);
        }

        $proposal->delete();

        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil dihapus.');
    }

    public function show(Proposal $proposal)
    {
        $proposal->load('jenisArsip'); // muat relasi jika perlu
        return view('proposal.show', compact('proposal'));
    }

    public function download($id)
{
    $proposal = Proposal::findOrFail($id);
    $fileName = $proposal->file_proposal;

    // Tambahkan folder proposals di sini
    $filePath = 'proposals/' . $fileName;

    if (!$fileName || !Storage::disk('public')->exists($filePath)) {
        abort(404, 'File tidak ditemukan.');
    }

    $path = Storage::disk('public')->path($filePath);
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    if (!file_exists($path)) {
        abort(404, "File tidak ditemukan di path: $path");
    }

    // Preview
    if (request()->has('preview') && request('preview') == 1) {
        if (in_array($extension, ['pdf', 'txt'])) {
            return response()->file($path, [
                'Content-Type' => $extension === 'pdf' ? 'application/pdf' : 'text/plain',
            ]);
        } else {
            return Storage::disk('public')->download($filePath);
        }
    }

    // Download
    return Storage::disk('public')->download($filePath);
}


    // {
    //     $suratkeluar = SuratKeluar::findOrFail($id);

    //     if (!$suratkeluar->file || !Storage::disk('public')->exists($suratkeluar->file)) {
    //         abort(404, 'File tidak ditemukan.');
    //     }

    //     $path = Storage::disk('public')->path($suratkeluar->file);
    //     $extension = pathinfo($path, PATHINFO_EXTENSION);

    //     // Preview hanya jika file adalah PDF atau TXT
    //     if (request()->has('preview')) {
    //         if (in_array($extension, ['pdf', 'txt'])) {
    //             return response()->file($path, [
    //                 'Content-Type' => $extension === 'pdf' ? 'application/pdf' : 'text/plain',
    //             ]);
    //         } else {
    //             // Redirect ke download jika bukan file yang bisa ditampilkan
    //             return redirect()->route('suratkeluar.download', ['id' => $id]);
    //         }
    //     }

    //     // Download
    //     return Storage::disk('public')->download($suratkeluar->file);
    // }


}
