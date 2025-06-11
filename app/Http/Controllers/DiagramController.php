<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\LaporanPenelitian;
use App\Models\AnggaranPenelitian;
use Illuminate\Support\Facades\DB;

class DiagramController extends Controller
{
    // public function index()
    // {
    //     // Total Data
    //     $data = [
    //         'totalproposal' => Proposal::count(),
    //         'totallaporan' => LaporanPenelitian::count(),
    //         'totalanggaran' => AnggaranPenelitian::count(),
    //     ];

    //     // Ambil jumlah data per tahun dari masing-masing tabel
    //     $proposal = Proposal::select('tahun_pengajuan as tahun', DB::raw('count(*) as total'))->groupBy('tahun')->orderBy('tahun')->get();
    //     $laporan = LaporanPenelitian::select('tahun_penelitian as tahun', DB::raw('count(*) as total'))->groupBy('tahun')->orderBy('tahun')->get();
    //     $anggaran = AnggaranPenelitian::select('tahun', DB::raw('count(*) as total'))->groupBy('tahun')->orderBy('tahun')->get();

    //     // Gabungkan semua tahun unik dari ketiga tabel
    //     $allYears = collect($proposal)->pluck('tahun')
    //         ->merge($laporan->pluck('tahun'))
    //         ->merge($anggaran->pluck('tahun'))
    //         ->unique()
    //         ->sort()
    //         ->values();

    //     // Buat map untuk akses cepat
    //     $proposalMap = $proposal->pluck('total', 'tahun');
    //     $laporanMap = $laporan->pluck('total', 'tahun');
    //     $anggaranMap = $anggaran->pluck('total', 'tahun');

    //     // Buat data untuk Chart
    //     $labels = [];
    //     $values = [];
    //     $values2 = [];
    //     $values3 = [];

    //     foreach ($allYears as $tahun) {
    //         $labels[] = $tahun;
    //         $values[] = $proposalMap[$tahun] ?? 0;
    //         $values2[] = $laporanMap[$tahun] ?? 0;
    //         $values3[] = $anggaranMap[$tahun] ?? 0;
    //     }

    //     return view('diagram', compact('data', 'labels', 'values', 'values2', 'values3'));
    // }

    public function index()
    {
        return view('diagram');
    }

    public function getData()
    {
        $tahun = 2025;

        $jumlahProposal = Proposal::whereYear('created_at', $tahun)->count();
        $jumlahLaporan = LaporanPenelitian::whereYear('created_at', $tahun)->count();
        $jumlahAnggaran = AnggaranPenelitian::whereYear('created_at', $tahun)->count();

        return response()->json([
            'labels' => ['Proposal', 'Laporan', 'Anggaran'],
            'data' => [$jumlahProposal, $jumlahLaporan, $jumlahAnggaran],
        ]);
    }

}
