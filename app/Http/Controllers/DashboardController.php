<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

use App\Models\Proposal;
use App\Models\LaporanPenelitian;
use App\Models\AnggaranPenelitian;

use App\Models\User;
use App\Models\Pengguna;
use App\Models\Model;
use Carbon\Carbon;

class DashboardController extends Controller
{
     public function index()
    {
        $totalSuratKeluar = SuratKeluar::count();
        $totalPengguna = Pengguna::count();
$penggunaTerbaru = Pengguna::latest()->take(5)->get();
$totalSuratMasuk = SuratMasuk::count();       // <-- Surat Masuk
        // $totalDokumenLainnya = DokumenLainnya::count();  // <-- Dokumen Lainnya

        // Hitung total dokumen lainnya dari 3 tabel
        $totalProposal = Proposal::count();
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
        // $totalDokumenLainnya = 47033;

        return view('welcome', compact(
            'totalSuratKeluar',
            'totalPengguna',
            'totalSuratMasuk',
            'penggunaTerbaru',
            'suratKeluarLast30Days',
            'growthPercent',
            'totalDokumenLainnya',
            'todayBookings',
            'totalBookings',
            'totalDokumenLainnya'
        ));
    }
    // public function index()
    // {
    //     $totalSuratKeluar = SuratKeluar::count();
    //     $totalPengguna = User::count();
    //     // $totalPengguna = User::count(); // ✅ HARUS ADA
    //     $penggunaTerbaru = User::latest()->take(5)->get();

    //     // Hitung pertumbuhan 30 hari terakhir
    //     $thirtyDaysAgo = Carbon::now()->subDays(30);
    //     $suratKeluarLast30Days = SuratKeluar::where('created_at', '>=', $thirtyDaysAgo)->count();

    //     $growthPercent = $totalSuratKeluar > 0
    //         ? round(($suratKeluarLast30Days / $totalSuratKeluar) * 100, 2)
    //         : 0;

    //     // Dummy data lainnya (Anda bisa sesuaikan nanti)
    //     $todayBookings = 4006;
    //     $totalBookings = 61344;
    //     $totalDokumenLainnya = 47033;

    //     return view('welcome', compact(
    //         'totalSuratKeluar',
    //         'suratKeluarLast30Days',
    //         'growthPercent',
    //         'todayBookings',
    //         'totalBookings',
    //         'totalDokumenLainnya'
    //     ));
    // }
}
