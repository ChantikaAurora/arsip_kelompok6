<?php

namespace App\Exports;

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\ProposalMandiriPenelitian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MandiriPenelitianExport implements FromCollection, WithMapping, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return ProposalMandiriPenelitian::with(['skemaPenelitian', 'jurusan', 'prodi'])
            ->when($this->search, function ($query) {
                $query->where('judul', 'like', "%{$this->search}%")
                    ->orWhere('peneliti', 'like', "%{$this->search}%")
                    ->orWhere('anggota', 'like', "%{$this->search}%")
                    ->orWhere('kode_klasifikasi', 'like', "%{$this->search}%")
                    ->orWhere('keterangan', 'like', "%{$this->search}%")
                    ->orWhereHas('skemaPenelitian', function ($q) {
                        $q->where('skema_penelitian', 'like', "%{$this->search}%");
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

    public function map($proposal): array
    {
        return [
            $proposal->no,
            $proposal->kode_klasifikasi,
            $proposal->judul,
            $proposal->peneliti,
            $proposal->skemaPenelitian->skema_penelitian ?? '-',
            $proposal->anggota,
            $proposal->jurusan->jurusan ?? '-',
            $proposal->prodi->prodi ?? '-',
            \Carbon\Carbon::parse($proposal->tanggal_pengajuan)->format('d-m-Y'),
            $proposal->keterangan,
            $proposal->file,
            $proposal->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Klasifikasi',
            'Judul',
            'Peneliti',
            'Skema Penelitian',
            'Anggota',
            'Jurusan',
            'Prodi',
            'Tanggal Pengajuan',
            'Keterangan',
            'File',
            'Tanggal Upload',
        ];
    }
}
