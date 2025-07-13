<?php

namespace App\Http\Controllers;

use App\Models\ProposalMandiriPengabdian;
use App\Models\SkemaPengabdian;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\MandiriPengabdianExport;
use Maatwebsite\Excel\Facades\Excel;

class ProposalMandiriPengabdianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search && !preg_match("/^[a-zA-Z0-9\s\-\/]+$/", $search)) {
            return redirect()->back()->with('search_error', 'Pencarian tidak valid!');
        }

        $proposals = ProposalMandiriPengabdian::with(['skemaPengabdian', 'jurusan', 'prodi'])
            ->when($search, function ($query) use ($search) {
                return $query->where('no', 'like', "%{$search}%")
                             ->orWhere('judul', 'like', "%{$search}%")
                             ->orWhere('peneliti', 'like', "%{$search}%");
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('proposalmandiripengabdian.index', compact('proposals', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skemaPengabdians = SkemaPengabdian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        // cek debug
        //dd($skemapengabdians, $jurusans, $prodis);
        return view('proposalmandiripengabdian.create', compact('skemaPengabdians', 'jurusans', 'prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no' => 'required|string|max:255',
            'kode_klasifikasi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema_pengabdian_id' => 'required|exists:skema_pengabdians,id',
            'anggota' => 'nullable|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id',
            'tanggal_pengajuan' => 'required|date',
            'keterangan' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'no', 'kode_klasifikasi', 'judul', 'peneliti',
            'skema_pengabdian_id', 'anggota', 'jurusan_id',
            'prodi_id', 'tanggal_pengajuan', 'keterangan',
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('proposal_mandiri_pengabdian', 'public');
        }

        ProposalMandiriPengabdian::create($data);

        return redirect()->route('proposal_mandiri_pengabdian.index')->with('success', 'Proposal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProposalMandiriPengabdian $proposalMandiriPengabdian)
    {
        $proposal = $proposalMandiriPengabdian->load(['skemaPengabdian', 'jurusan', 'prodi']);
        return view('proposalmandiripengabdian.detail', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProposalMandiriPengabdian $proposalMandiriPengabdian)
    {
        $skemaPengabdians = SkemaPengabdian::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();

        return view('proposalmandiripengabdian.edit', [
            'proposal' => $proposalMandiriPengabdian,
            'skemaPengabdians' => $skemaPengabdians,
            'jurusans' => $jurusans,
            'prodis' => $prodis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProposalMandiriPengabdian $proposalMandiriPengabdian)
    {
        $request->validate([
            'no' => 'required|string|max:255',
            'kode_klasifikasi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'peneliti' => 'required|string|max:255',
            'skema_pengabdian_id' => 'required|exists:skema_pengabdians,id',
            'anggota' => 'nullable|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id',
            'tanggal_pengajuan' => 'required|date',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only([
            'no', 'kode_klasifikasi', 'judul', 'peneliti',
            'skema_pengabdian_id', 'anggota', 'jurusan_id',
            'prodi_id', 'tanggal_pengajuan', 'keterangan',
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($proposal_mandiri_pengabdian->file && Storage::disk('public')->exists($proposal_mandiri_pengabdian->file)) {
                Storage::disk('public')->delete($proposal_mandiri_pengabdian->file);
            }
            $data['file'] = $request->file('file')->store('proposal_mandiri_pengabdian', 'public');
        }

        $proposalMandiriPengabdian->update($data);

        return redirect()->route('proposal_mandiri_pengabdian.index')->with('success', 'Proposal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProposalMandiriPengabdian $proposalMandiriPengabdian)
    {
        // Hapus file jika ada
        if ($proposalMandiriPengabdian->file && Storage::disk('public')->exists($proposalMandiriPengabdian->file)) {
            Storage::disk('public')->delete($proposalMandiriPengabdian->file);
        }

        // Hapus data dari database
        $proposalMandiriPengabdian->delete();

        return redirect()->route('proposal_mandiri_pengabdian.index')->with('success', 'Proposal berhasil dihapus.');
    }


    public function download($id)
    {
        $proposal = ProposalMandiriPengabdian::findOrFail($id);

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
        $search = $request->input('search');

        $data = ProposalMandiriPengabdian::with(['skemaPengabdian', 'jurusan', 'prodi'])
            ->when($search, function ($query) use ($search) {
                $query->where('no', 'like', "%$search%")
                    ->orWhere('kode_klasifikasi', 'like', "%$search%")
                    ->orWhere('judul', 'like', "%$search%")
                    ->orWhere('peneliti', 'like', "%$search%")
                    ->orWhere('anggota', 'like', "%$search%")
                    ->orWhere('keterangan', 'like', "%$search%")
                    ->orWhereHas('skemaPengabdian', function ($q) use ($search) {
                        $q->where('skema_pengabdian', 'like', "%$search%");
                    })
                    ->orWhereHas('jurusan', function ($q) use ($search) {
                        $q->where('jurusan', 'like', "%$search%");
                    })
                    ->orWhereHas('prodi', function ($q) use ($search) {
                        $q->where('prodi', 'like', "%$search%");
                    });
            })
            ->latest()
            ->get();

        return view('proposalmandiripengabdian.metadata', compact('data'));
    }


    public function exportMetadata(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new MandiriPengabdianExport($search), 'metadata_proposal_mandiri_pengabdian.xlsx');
    }

}

