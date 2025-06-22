<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\ProposalDipaPengabdian;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DipaPengabdianExport implements FromCollection, WithMapping, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

public function collection()
{
    return ProposalDipaPengabdian::with(['skemaPengabdian', 'jurusan', 'prodi'])
        ->when($this->search, function ($query) {
            $query->where('judul', 'like', "%{$this->search}%")
                ->orWhere('peneliti', 'like', "%{$this->search}%")
                ->orWhere('anggota', 'like', "%{$this->search}%")
                ->orWhere('kode_klasifikasi', 'like', "%{$this->search}%")
                ->orWhere('keterangan', 'like', "%{$this->search}%")
                ->orWhereHas('skemaPengabdian', function ($q) {
                    $q->where('skema_pengabdian', 'like', "%{$this->search}%");
                })
                ->orWhereHas('jurusan', function ($q) {
                    $q->where('jurusan', 'like', "%{$this->search}%");
                })
                ->orWhereHas('prodi', function ($q) {
                    $q->where('prodi', 'like', "%{$this->search}%");
                });
        })
        ->get();
}

    public function map($item): array
    {
        return [
            $item->kode_klasifikasi,
            $item->judul,
            $item->peneliti,
            $item->skemaPengabdian->skema_pengabdian ?? '-',
            $item->anggota,
            $item->jurusan->jurusan ?? '-',
            $item->prodi->prodi ?? '-',
            \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y'),
            $item->keterangan,
            $item->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Klasifikasi',
            'Judul',
            'Peneliti',
            'Skema',
            'Anggota',
            'Jurusan',
            'Prodi',
            'Tanggal Pengajuan',
            'Keterangan',
            'Tanggal Upload',
        ];
    }
}
