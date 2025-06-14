<?php

namespace App\Http\Controllers;

use App\Models\ProposalPenelitianDp;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalPenelitianDpController extends Controller
{
    public function index()
    {
        $proposals = ProposalPenelitianDp::latest()->get();
        return view('proposal_penelitian_dp.index', compact('proposals'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        return view('proposal_penelitian_dp.create', compact('jurusan', 'prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_seri' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema' => 'nullable|string|max:255',
            'anggota' => 'nullable|string',
            'jurusan_id' => 'required|integer',
            'prodi_id' => 'required|integer',
            'tanggal_pengajuan' => 'required|date',
            'file' => 'required|mimes:pdf|max:2048',
            'keterangan' => 'nullable|string'
        ]);

        $file = $request->file('file')->store('proposal_penelitian_dp', 'public');

        ProposalPenelitianDp::create([
            'kode_seri' => $request->kode_seri,
            'judul' => $request->judul,
            'peneliti' => $request->peneliti,
            'skema' => $request->skema,
            'anggota' => $request->anggota,
            'jurusan_id' => $request->jurusan_id,
            'prodi_id' => $request->prodi_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'file' => $file,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('proposal-penelitian-dp.index')->with('success', 'Proposal berhasil disimpan');
    }

    public function show($id)
    {
        $proposal = ProposalPenelitianDp::findOrFail($id);
        return view('proposal_penelitian_dp.show', compact('proposal'));
    }

    public function edit($id)
    {
        $proposal = ProposalPenelitianDp::findOrFail($id);
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        return view('proposal_penelitian_dp.edit', compact('proposal', 'jurusan', 'prodi'));
    }

    public function update(Request $request, $id)
    {
        $proposal = ProposalPenelitianDp::findOrFail($id);

        $request->validate([
            'kode_seri' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema' => 'nullable|string|max:255',
            'anggota' => 'nullable|string',
            'jurusan_id' => 'required|integer',
            'prodi_id' => 'required|integer',
            'tanggal_pengajuan' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:2048',
            'keterangan' => 'nullable|string'
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($proposal->file && Storage::disk('public')->exists($proposal->file)) {
                Storage::disk('public')->delete($proposal->file);
            }

            $file = $request->file('file')->store('proposal_penelitian_dp', 'public');
            $proposal->file = $file;
        }

        $proposal->update([
            'kode_seri' => $request->kode_seri,
            'judul' => $request->judul,
            'peneliti' => $request->peneliti,
            'skema' => $request->skema,
            'anggota' => $request->anggota,
            'jurusan_id' => $request->jurusan_id,
            'prodi_id' => $request->prodi_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('proposal-penelitian-dp.index')->with('success', 'Proposal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $proposal = ProposalPenelitianDp::findOrFail($id);

        // Hapus file jika ada
        if ($proposal->file && Storage::disk('public')->exists($proposal->file)) {
            Storage::disk('public')->delete($proposal->file);
        }

        $proposal->delete();

        return redirect()->route('proposal-penelitian-dp.index')->with('success', 'Proposal berhasil dihapus');
    }

    public function download($id)
    {
        $proposal = ProposalPenelitianDp::findOrFail($id);

        if (Storage::disk('public')->exists($proposal->file)) {
            return Storage::disk('public')->download($proposal->file);
        }

        return back()->with('error', 'File tidak ditemukan.');
    }
}
