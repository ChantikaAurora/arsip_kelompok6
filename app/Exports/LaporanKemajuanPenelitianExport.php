<?php

namespace App\Exports;

use App\Models\LaporanKemajuanPenelitian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanKemajuanPenelitianExport implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return LaporanKemajuanPenelitian::with(['skemaRelasi', 'jurusanRelasi', 'prodiRelasi'])
            ->when($this->search, function ($query) {
                $query->where('judul_kegiatan', 'like', "%{$this->search}%")
                      ->orWhere('nama_ketua', 'like', "%{$this->search}%")
                      ->orWhere('tahun_pelaksanaan', 'like', "%{$this->search}%")
                      ->orWhere('periode_laporan', 'like', "%{$this->search}%");
            })
            ->get()
            ->map(function ($item) {
                return [
                    $item->id_laporan,
                    $item->judul_kegiatan,
                    $item->nama_ketua,
                    $item->nama_anggota,
                    optional($item->skemaRelasi)->skema_penelitian ?? '-',
                    $item->tahun_pelaksanaan,
                    optional($item->jurusanRelasi)->jurusan ?? '-',
                    optional($item->prodiRelasi)->prodi ?? '-',
                    $item->periode_laporan,
                    $item->created_at ? $item->created_at->format('Y-m-d H:i:s') : '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Kode Klasifikasi',
            'Judul Kegiatan',
            'Nama Ketua',
            'Nama Anggota',
            'Skema',
            'Tahun Pelaksanaan',
            'Jurusan',
            'Prodi',
            'Periode Laporan',
            'Tanggal Input',
        ];
    }
}
