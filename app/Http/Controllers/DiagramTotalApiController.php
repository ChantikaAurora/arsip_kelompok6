<?php

namespace App\Http\Controllers;

use App\Models\AnggaranPenelitian;
use App\Models\AnggaranPengabdian;
use App\Models\LaporanAkhirPengabdian;
use App\Models\LaporanAkhirPenelitian;
use App\Models\LaporanKemajuanPengabdian;
use App\Models\LaporanKemajuanPenelitian;

use App\Models\ProposalDipaPenelitian;
use App\Models\ProposalDipaPengabdian;
use App\Models\ProposalMandiriPenelitian;
use App\Models\ProposalMandiriPengabdian;
use App\Models\ProposalPusatPenelitian;
use App\Models\ProposalPusatPengabdian;
use Illuminate\Http\JsonResponse;

class DiagramTotalApiController extends Controller
{
    public function getSummary(): JsonResponse
    {
        $totalAnggaranPenelitian = AnggaranPenelitian::count();
        $totalAnggaranPengabdian = AnggaranPengabdian::count();
        $totalLaporanAkhirPengabdian = LaporanAkhirPengabdian::count();
        $totalLaporanAkhirPenelitian = LaporanAkhirPenelitian::count();
        $totalLaporanKemajuanPengabdian = LaporanKemajuanPengabdian::count();
        $totalLaporanKemajuanPenelitian = LaporanKemajuanPenelitian::count();

        $totalProposalDipaPenelitian = ProposalDipaPenelitian::count();
        $totalProposalDipaPengabdian = ProposalDipaPengabdian::count();
        $totalProposalMandiriPenelitian = ProposalMandiriPenelitian::count();
        $totalProposalMandiriPengabdian = ProposalMandiriPengabdian::count();
        $totalProposalPusatPenelitian = ProposalPusatPenelitian::count();
        $totalProposalPusatPengabdian = ProposalPusatPengabdian::count();


        return response()->json([
            'total_anggaran_penelitian' => $totalAnggaranPenelitian,
            'total_anggaran_pengabdian' => $totalAnggaranPengabdian,
            'total_laporan_akhir_pengabdian' => $totalLaporanAkhirPengabdian,
            'total_laporan_akhir_penelitian' => $totalLaporanAkhirPenelitian,
            'total_laporan_kemajuan_penelitian' => $totalLaporanKemajuanPenelitian,
            'total_laporan_kemajuan_pengabdian' => $totalLaporanKemajuanPengabdian,

            'total_proposal_dipa_penelitian' => $totalProposalDipaPenelitian,
            'total_proposal_dipa_pengabdian' => $totalProposalDipaPengabdian,
            'total_proposal_mandiri_penelitian' => $totalProposalMandiriPenelitian,
            'total_proposal_mandiri_pengabdian' => $totalProposalMandiriPengabdian,
            'total_proposal_pusat_penelitian' => $totalProposalPusatPenelitian,
            'total_proposal_pusat_pengabdian' => $totalProposalPusatPengabdian
        ]);
    }
}
