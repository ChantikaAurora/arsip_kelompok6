<?php

namespace App\Exports;

use App\Models\LaporanAkhirPengabdian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanAkhirPengabdianExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return LaporanAkhirPengabdian::when($this->search, function ($query) {
                $query->where('judul_kegiatan', 'like', "%{$this->search}%")
                      ->orWhere('tahun_pelaksanaan', 'like', "%{$this->search}%");
            })
            ->with('skemaRelasi')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul Kegiatan',
            'Skema',
            'Tahun',
            'Tanggal Input'
        ];
    }

    public function map($laporan): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $laporan->judul_kegiatan,
            optional($laporan->skemaRelasi)->skema_penelitian ?? '-',
            $laporan->tahun_pelaksanaan,
            $laporan->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
