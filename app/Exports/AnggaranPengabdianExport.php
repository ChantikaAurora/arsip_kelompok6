<?php

namespace App\Exports;

use App\Models\AnggaranPengabdian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnggaranPengabdianExport implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return AnggaranPengabdian::when($this->search, function ($query) {
                $query->where('kode', 'like', "%{$this->search}%")
                      ->orWhere('kegiatan', 'like', "%{$this->search}%")
                      ->orWhere('skema', 'like', "%{$this->search}%");
            })
            ->get(['kode', 'kegiatan', 'volume_usulan', 'total_anggaran', 'created_at']);
    }

    public function headings(): array
    {
        return [
            'Kode',
            'Kegiatan',
            'Volume Usulan',
            'Total Anggaran',
            'Tanggal Input',
        ];
    }
}
