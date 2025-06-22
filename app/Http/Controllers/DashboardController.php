<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Proposal;
use App\Models\Pengguna;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();
        $totalPengguna = Pengguna::count();

        // Ambil 5 pengguna terbaru
        $penggunaTerbaru = Pengguna::latest()->take(5)->get();

        // Hitung surat keluar 30 hari terakhir
        $suratKeluarLast30Days = SuratKeluar::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // Hitung persentase pertumbuhan
        $growthPercent = $totalSuratKeluar > 0
            ? round(($suratKeluarLast30Days / $totalSuratKeluar) * 100, 2)
            : 0;

        // Dummy data (bisa dihapus atau ganti logika asli nanti)
        $todayBookings = 4006;
        $totalBookings = 61344;

        // Hitung dokumen lainnya jika perlu


        return view('welcome', compact(
            'totalSuratMasuk',
            'totalSuratKeluar',
            'totalPengguna',
            'totalProposal',
            'penggunaTerbaru',
            'suratKeluarLast30Days',
            'growthPercent',
            'todayBookings',
            'totalBookings'
        ));
    }
}
