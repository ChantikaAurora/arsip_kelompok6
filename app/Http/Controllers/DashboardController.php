<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Pengguna;
use App\Models\ProposalDipaPenelitian;
use App\Models\ProposalDipaPengabdian;
use App\Models\ProposalMandiriPenelitian;
use App\Models\ProposalMandiriPengabdian;
use App\Models\ProposalPusatPenelitian;
use App\Models\ProposalPusatPengabdian;
use App\Models\AnggaranPenelitian;
use App\Models\AnggaranPengabdian;
use App\Models\LaporanAkhirPengabdian;
use App\Models\LaporanAkhirPenelitian;
use App\Models\LaporanKemajuanPengabdian;
use App\Models\LaporanKemajuanPenelitian;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();
        $totalPengguna = Pengguna::count();

        // Hitung total semua proposal
        $totalProposalDipaPenelitian = ProposalDipaPenelitian::count();
        $totalProposalDipaPengabdian = ProposalDipaPengabdian::count();
        $totalProposalMandiriPenelitian = ProposalMandiriPenelitian::count();
        $totalProposalMandiriPengabdian = ProposalMandiriPengabdian::count();
        $totalProposalPusatPenelitian = ProposalPusatPenelitian::count();
        $totalProposalPusatPengabdian = ProposalPusatPengabdian::count();

        $totalProposal =
            $totalProposalDipaPenelitian +
            $totalProposalDipaPengabdian +
            $totalProposalMandiriPenelitian +
            $totalProposalMandiriPengabdian +
            $totalProposalPusatPenelitian +
            $totalProposalPusatPengabdian;

        // Total Laporan
        $totalAnggaranPenelitian = AnggaranPenelitian::count();
        $totalAnggaranPengabdian = AnggaranPengabdian::count();
        $totalLaporanAkhirPengabdian = LaporanAkhirPengabdian::count();
        $totalLaporanAkhirPenelitian = LaporanAkhirPenelitian::count();
        $totalLaporanKemajuanPengabdian = LaporanKemajuanPengabdian::count();
        $totalLaporanKemajuanPenelitian = LaporanKemajuanPenelitian::count();

        $totalLaporan =
            $totalAnggaranPenelitian +
            $totalAnggaranPengabdian +
            $totalLaporanAkhirPengabdian +
            $totalLaporanAkhirPenelitian +
            $totalLaporanKemajuanPengabdian +
            $totalLaporanKemajuanPenelitian;

        // Ambil 5 pengguna terbaru
        $penggunaTerbaru = Pengguna::latest()->take(5)->get();

        // Hitung surat keluar 30 hari terakhir
        $suratKeluarLast30Days = SuratKeluar::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // Hitung persentase pertumbuhan
        $growthPercent = $totalSuratKeluar > 0
            ? round(($suratKeluarLast30Days / $totalSuratKeluar) * 100, 2)
            : 0;


        // Return view dan kirim semua data
        return view('welcome', compact(
            'totalSuratMasuk',
            'totalSuratKeluar',
            'totalPengguna',
            'penggunaTerbaru',
            'suratKeluarLast30Days',
            'growthPercent',
            'totalProposal',
            'totalLaporan'

        ));
    }
}
