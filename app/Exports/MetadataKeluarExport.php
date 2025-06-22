<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MetadataKeluarExport implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return SuratKeluar::with('jenisArsip', 'user')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nomor_surat', 'like', "%{$this->search}%")
                    ->orWhere('nomor_agenda', 'like', "%{$this->search}%")
                    ->orWhere('kode_klasifikasi', 'like', "%{$this->search}%")
                    ->orWhere('tanggal_surat', 'like', "%{$this->search}%")
                    ->orWhere('tujuan_surat', 'like', "%{$this->search}%")
                    ->orWhere('penerima', 'like', "%{$this->search}%")
                    ->orWhere('perihal', 'like', "%{$this->search}%")
                    ->orWhere('lampiran', 'like', "%{$this->search}%")
                    ->orWhere('keterangan', 'like', "%{$this->search}%");
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'Nomor Surat'      => $item->nomor_surat,
                    'Nomor Agenda'     => $item->nomor_agenda,
                    'Kode Klasifikasi' => $item->kode_klasifikasi,
                    'Tanggal'          => \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y'),
                    'Tujuan'           => $item->tujuan_surat,
                    'Penerima'         => $item->penerima,
                    'Perihal'          => $item->perihal,
                    'Lampiran'         => $item->lampiran ?? '-',
                    'Keterangan'       => $item->keterangan ?? '-',
                    'Jenis Arsip'      => $item->jenisArsip->jenis ?? '-',
                    'Waktu Upload'     => $item->created_at->format('Y-m-d H:i:s'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nomor Surat',
            'Nomor Agenda',
            'Kode Klasifikasi',
            'Tanggal',
            'Tujuan',
            'Penerima',
            'Perihal',
            'Lampiran',
            'Keterangan',
            'Jenis Arsip',
            'Waktu Upload',
        ];
    }
}

