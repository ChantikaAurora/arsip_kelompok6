<?php

namespace App\Http\Controllers;

use App\Models\ProposalPengabdian;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalPengabdianController extends Controller
{
    public function index(Request $request)
    {
        $query = ProposalPengabdian::with('jurusan', 'prodi');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%$search%")
                ->orWhere('peneliti', 'like', "%$search%")
                ->orWhere('tanggal_pengajuan', 'like', "%$search%");
        }

        $proposalpengabdian = $query->get(); // sesuai dengan variabel di view
        return view('proposalpengabdian.index', compact('proposalpengabdian'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        return view('proposalpengabdian.create', compact('jurusan', 'prodi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_seri' => 'required|string',
            'judul' => 'required|string',
            'peneliti' => 'required|string',
            'skema' => 'required|string',
            'anggota' => 'required|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id',
            'tanggal_pengajuan' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,docx',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('proposal_pengabdian');
        }

        ProposalPengabdian::create($validated);

        return redirect()->route('proposalpengabdian.index')->with('success', 'Proposal berhasil ditambahkan.');
    }

    public function show($id)
    {
        $proposal = ProposalPengabdian::with('jurusan', 'prodi')->findOrFail($id);
        return view('proposalpengabdian.show', compact('proposal'));
    }

    public function edit($id)
    {
        $proposal = ProposalPengabdian::findOrFail($id);
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        return view('proposalpengabdian.edit', compact('proposal', 'jurusan', 'prodi'));
    }

    public function update(Request $request, $id)
    {
        $proposal = ProposalPengabdian::findOrFail($id);

        $validated = $request->validate([
            'kode_seri' => 'required|string',
            'judul' => 'required|string',
            'peneliti' => 'required|string',
            'skema' => 'required|string',
            'anggota' => 'required|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id',
            'tanggal_pengajuan' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,docx',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            if ($proposal->file) {
                Storage::delete($proposal->file);
            }
            $validated['file'] = $request->file('file')->store('proposal_pengabdian');
        }

        $proposal->update($validated);

        return redirect()->route('proposalpengabdian.index')->with('success', 'Proposal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $proposal = ProposalPengabdian::findOrFail($id);
        if ($proposal->file) {
            Storage::delete($proposal->file);
        }
        $proposal->delete();
        return redirect()->route('proposalpengabdian.index')->with('success', 'Proposal berhasil dihapus.');
    }
}
