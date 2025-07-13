<?php

namespace App\Http\Controllers;

use App\Models\ProposalDipaPenelitian;
use App\Models\SkemaPenelitian;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\DipaPenelitianExport;
use Maatwebsite\Excel\Facades\Excel;

class ProposalDipaPenelitianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search && !preg_match("/^[a-zA-Z0-9\s\-\/]+$/", $search)) {
            return redirect()->back()->with('search_error', 'Pencarian tidak valid!');
        }

        $proposals = ProposalDipaPenelitian::with(['skemaPenelitian', 'jurusan', 'prodi'])
            ->when($search, function ($query) use ($search) {
                return $query->where('no', 'like', "%{$search}%")
                             ->orWhere('judul', 'like', "%{$search}%")
                             ->orWhere('peneliti', 'like', "%{$search}%");
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('proposaldipapenelitian.index', compact('proposals', 'search'));
    }

    public function create()
    {
        $skemaPenelitians = SkemaPenelitian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        // cek debug
        //dd($skemaPenelitians, $jurusans, $prodis);
        return view('proposaldipapenelitian.create', compact('skemaPenelitians', 'jurusans', 'prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no'                 => 'required|string|max:255',
            'kode_klasifikasi'   => 'required|string|max:255',
            'judul'              => 'required|string|max:255',
            'peneliti'           => 'required|string|max:255',
            'skema_penelitian_id'=> 'required|exists:skema_penelitians,id',
            'anggota'            => 'nullable|string',
            'jurusan_id'         => 'required|exists:jurusans,id',
            'prodi_id'           => 'required|exists:prodis,id',
            'tanggal_pengajuan'  => 'required|date',
            'keterangan'         => 'nullable|string|max:1000',
            'file'               => 'required|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'no.required'                 => 'Nomor proposal wajib diisi.',
            'kode_klasifikasi.required'   => 'Kode klasifikasi wajib diisi.',
            'judul.required'              => 'Judul wajib diisi.',
            'peneliti.required'           => 'Nama peneliti wajib diisi.',
            'skema_penelitian_id.required'=> 'Skema penelitian wajib dipilih.',
            'jurusan_id.required'         => 'Jurusan wajib dipilih.',
            'prodi_id.required'           => 'Program studi wajib dipilih.',
            'tanggal_pengajuan.required'  => 'Tanggal pengajuan wajib diisi.',
            'file.mimes'                  => 'File harus berformat PDF.',
            'file.max'                    => 'Ukuran file maksimal 2MB.',
        ]);

        $data = $request->only([
            'no', 'kode_klasifikasi', 'judul', 'peneliti',
            'skema_penelitian_id', 'anggota', 'jurusan_id',
            'prodi_id', 'tanggal_pengajuan', 'keterangan',
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('proposal_dipa_penelitian', 'public');
        }

        ProposalDipaPenelitian::create($data);

        return redirect()->route('proposal_dipa_penelitian.index')->with('success', 'Proposal berhasil ditambahkan.');
    }


    public function show($id)
    {
        $proposal = ProposalDipaPenelitian::with(['skemaPenelitian', 'jurusan', 'prodi'])->findOrFail($id);
        return view('proposaldipapenelitian.detail', compact('proposal'));
    }

    public function edit(ProposalDipaPenelitian $proposal_dipa_penelitian)
    {
        $skemaPenelitians = SkemaPenelitian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();

        return view('proposaldipapenelitian.edit', [
            'proposal' => $proposal_dipa_penelitian,
            'skemaPenelitians' => $skemaPenelitians,
            'jurusans' => $jurusans,
            'prodis' => $prodis,
        ]);
    }


    public function update(Request $request, ProposalDipaPenelitian $proposal_dipa_penelitian)
    {
        $request->validate([
            'no'                 => 'required|string|max:255',
            'kode_klasifikasi'   => 'required|string|max:255',
            'judul'              => 'required|string|max:255',
            'peneliti'           => 'required|string|max:255',
            'skema_penelitian_id'=> 'required|exists:skema_penelitians,id',
            'anggota'            => 'nullable|string',
            'jurusan_id'         => 'required|exists:jurusans,id',
            'prodi_id'           => 'required|exists:prodis,id',
            'tanggal_pengajuan'  => 'required|date',
            'keterangan'         => 'nullable|string|max:1000',
            'file'               => 'nullable|mimes:pdf|max:2048',
        ], [
            'no.required'                 => 'Nomor proposal wajib diisi.',
            'kode_klasifikasi.required'   => 'Kode klasifikasi wajib diisi.',
            'judul.required'              => 'Judul wajib diisi.',
            'peneliti.required'           => 'Nama peneliti wajib diisi.',
            'skema_penelitian_id.required'=> 'Skema penelitian wajib dipilih.',
            'jurusan_id.required'         => 'Jurusan wajib dipilih.',
            'prodi_id.required'           => 'Program studi wajib dipilih.',
            'tanggal_pengajuan.required'  => 'Tanggal pengajuan wajib diisi.',
            'file.mimes'                  => 'File harus berformat PDF.',
            'file.max'                    => 'Ukuran file maksimal 2MB.',
        ]);

        $data = $request->only([
            'no', 'kode_klasifikasi', 'judul', 'peneliti',
            'skema_penelitian_id', 'anggota', 'jurusan_id',
            'prodi_id', 'tanggal_pengajuan', 'keterangan',
        ]);

        if ($request->hasFile('file')) {
            if ($proposal_dipa_penelitian->file && Storage::disk('public')->exists($proposal_dipa_penelitian->file)) {
                Storage::disk('public')->delete($proposal_dipa_penelitian->file);
            }

            $data['file'] = $request->file('file')->store('proposal_dipa_penelitian', 'public');
        }

        $proposal_dipa_penelitian->update($data);

        return redirect()->route('proposal_dipa_penelitian.index')->with('success', 'Proposal berhasil diperbarui.');
    }


    public function destroy(ProposalDipaPenelitian $proposal_dipa_penelitian)
    {
        // Hapus file jika ada
        if ($proposal_dipa_penelitian->file && Storage::disk('public')->exists($proposal_dipa_penelitian->file)) {
            Storage::disk('public')->delete($proposal_dipa_penelitian->file);
        }

        // Hapus data dari database
        $proposal_dipa_penelitian->delete();

        return redirect()->route('proposal_dipa_penelitian.index')->with('success', 'Proposal berhasil dihapus.');
    }

    public function download($id)
    {
        $proposal = ProposalDipaPenelitian::findOrFail($id);

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
        $search = $request->search;

        $data = ProposalDipaPenelitian::with(['skemaPenelitian', 'jurusan', 'prodi'])
            ->when($search, function ($query, $search) {
                $query->where('judul', 'like', "%$search%")
                    ->orWhere('peneliti', 'like', "%$search%")
                    ->orWhere('anggota', 'like', "%$search%")
                    ->orWhere('kode_klasifikasi', 'like', "%$search%")
                    ->orWhere('keterangan', 'like', "%$search%");
            })
            ->latest()
            ->get();

        return view('proposaldipapenelitian.metadata', compact('data'));
    }


    public function exportMetadata(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new DipaPenelitianExport($search), 'metadata_proposal_dipa.xlsx');
    }
}
