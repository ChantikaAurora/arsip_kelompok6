<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

use App\Models\ProposalPengabdian;
use App\Models\ProposalPenelitianDp;
use App\Models\ProposalPenelitianUnggulan;

use App\Models\LaporanPenelitian;
use App\Models\AnggaranPenelitian;

use App\Models\Pengguna;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSuratKeluar = SuratKeluar::count();
        $totalPengguna = Pengguna::count();
        $penggunaTerbaru = Pengguna::latest()->take(5)->get();
        $totalSuratMasuk = SuratMasuk::count();

        // Hitung total dari semua jenis proposal
        $totalProposal = ProposalPengabdian::count()
                        + ProposalPenelitianDp::count()
                        + ProposalPenelitianUnggulan::count();

        $totalLaporan = LaporanPenelitian::count();
        $totalAnggaran = AnggaranPenelitian::count();

        $totalDokumenLainnya = $totalProposal + $totalLaporan + $totalAnggaran;

        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $suratKeluarLast30Days = SuratKeluar::where('created_at', '>=', $thirtyDaysAgo)->count();

        $growthPercent = $totalSuratKeluar > 0
            ? round(($suratKeluarLast30Days / $totalSuratKeluar) * 100, 2)
            : 0;

        $todayBookings = 4006;
        $totalBookings = 61344;

        return view('welcome', compact(
            'totalSuratKeluar',
            'totalPengguna',
            'totalSuratMasuk',
            'penggunaTerbaru',
            'suratKeluarLast30Days',
            'growthPercent',
            'totalDokumenLainnya',
            'todayBookings',
            'totalBookings'
        ));
    }
}
