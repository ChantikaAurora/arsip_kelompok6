<?php

namespace App\Http\Controllers;

use App\Models\ProposalPusatPenelitian;
use App\Models\SkemaPenelitian;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\PusatPenelitianExport;
use Maatwebsite\Excel\Facades\Excel;


class ProposalPusatPenelitianController extends Controller
{
public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search && !preg_match("/^[a-zA-Z0-9\s\-\/]+$/", $search)) {
            return redirect()->back()->with('search_error', 'Pencarian tidak valid!');
        }

        $proposals = ProposalPusatPenelitian::with(['skemaPenelitian', 'jurusan', 'prodi'])
            ->when($search, function ($query) use ($search) {
                return $query->where('no', 'like', "%{$search}%")
                             ->orWhere('judul', 'like', "%{$search}%")
                             ->orWhere('peneliti', 'like', "%{$search}%");
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('proposalpusatpenelitian.index', compact('proposals', 'search'));
    }

    public function create()
    {
        $skemaPenelitians = SkemaPenelitian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        // cek debug
        //dd($skemaPenelitians, $jurusans, $prodis);
        return view('proposalpusatpenelitian.create', compact('skemaPenelitians', 'jurusans', 'prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no' => 'required|string|max:255',
            'kode_klasifikasi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema_penelitian_id' => 'required|exists:skema_penelitians,id',
            'anggota' => 'nullable|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id',
            'tanggal_pengajuan' => 'required|date',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only([
            'no', 'kode_klasifikasi', 'judul', 'peneliti',
            'skema_penelitian_id', 'anggota', 'jurusan_id',
            'prodi_id', 'tanggal_pengajuan', 'keterangan',
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('proposal_pusat_penelitian', 'public');
        }

        ProposalPusatPenelitian::create($data);

        return redirect()->route('proposal_pusat_penelitian.index')->with('success', 'Proposal berhasil ditambahkan.');
    }

 public function show($id)
    {
        $proposal = ProposalPusatPenelitian::with(['skemaPenelitian', 'jurusan', 'prodi'])->findOrFail($id);
        return view('proposalpusatpenelitian.detail', compact('proposal'));
    }

    public function edit(ProposalPusatPenelitian $proposal_pusat_penelitian)
    {
        $skemaPenelitians = SkemaPenelitian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();

        return view('proposalpusatpenelitian.edit', [
            'proposal' => $proposal_pusat_penelitian,
            'skemaPenelitians' => $skemaPenelitians,
            'jurusans' => $jurusans,
            'prodis' => $prodis,
        ]);
    }


    public function update(Request $request, ProposalPusatPenelitian $proposal_pusat_penelitian)
    {
        $request->validate([
            'no' => 'required|string|max:255',
            'kode_klasifikasi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema_penelitian_id' => 'required|exists:skema_penelitians,id',
            'anggota' => 'nullable|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id',
            'tanggal_pengajuan' => 'required|date',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only([
            'no', 'kode_klasifikasi', 'judul', 'peneliti',
            'skema_penelitian_id', 'anggota', 'jurusan_id',
            'prodi_id', 'tanggal_pengajuan', 'keterangan',
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($proposal_pusat_penelitian->file && Storage::disk('public')->exists($proposal_pusat_penelitian->file)) {
                Storage::disk('public')->delete($proposal_pusat_penelitian->file);
            }
            $data['file'] = $request->file('file')->store('proposal_pusat_penelitian', 'public');
        }

        $proposal_pusat_penelitian->update($data);

        return redirect()->route('proposal_pusat_penelitian.index')->with('success', 'Proposal berhasil diperbarui.');
    }

    public function destroy(ProposalPusatPenelitian $proposal_pusat_penelitian)
    {
        // Hapus file jika ada
        if ($proposal_pusat_penelitian->file && Storage::disk('public')->exists($proposal_pusat_penelitian->file)) {
            Storage::disk('public')->delete($proposal_pusat_penelitian->file);
        }

        // Hapus data dari database
        $proposal_pusat_penelitian->delete();

        return redirect()->route('proposal_pusat_penelitian.index')->with('success', 'Proposal berhasil dihapus.');
    }

    public function download($id)
    {
        $proposal = ProposalPusatPenelitian::findOrFail($id);

        if (!$proposal->file || !Storage::disk('public')->exists($proposal->file)) {
            abort(404, 'File tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($proposal->file);

        if (request()->has('preview')) {
            return response()->file($path, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        return response()->download($path);
    }

    public function metadata(Request $request)
    {
        //dd(view()->exists('proposalPusatpenelitian.metadata'));
        $search = $request->input('search');

        $data = ProposalPusatPenelitian::with(['skemaPenelitian', 'jurusan', 'prodi'])
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%$search%")
                    ->orWhere('peneliti', 'like', "%$search%")
                    ->orWhere('anggota', 'like', "%$search%");
            })
            ->latest()
            ->get();

        return view('proposalpusatpenelitian.metadata', compact('data'));
    }

    public function exportMetadata(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new PusatPenelitianExport($search), 'metadata_proposal_pusat.xlsx');
    }
}

