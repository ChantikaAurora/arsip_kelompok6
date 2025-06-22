<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MetadataMasukExport implements FromCollection, WithMapping, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return SuratMasuk::with('jenisArsip')
            ->when($this->search, function ($query) {
                $query->where('nomor_surat', 'like', "%{$this->search}%")
                      ->orWhere('perihal', 'like', "%{$this->search}%")
                      ->orWhere('pengirim', 'like', "%{$this->search}%");
            })
            ->get();
    }

    public function map($suratmasuk): array
    {
        return [
            $suratmasuk->nomor_surat,
            \Carbon\Carbon::parse($suratmasuk->tanggal_surat)->format('d-m-Y'),
            \Carbon\Carbon::parse($suratmasuk->tanggal_terima)->format('d-m-Y'),
            $suratmasuk->asal_surat,
            $suratmasuk->perihal,
            $suratmasuk->pengirim,
            $suratmasuk->jenisArsip->jenis ?? '-',
            $suratmasuk->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Nomor Surat',
            'Tanggal Surat',
            'Tanggal Diterima',
            'Asal Surat',
            'Perihal',
            'Pengirim',
            'Jenis Arsip',
            'Tanggal Upload',
        ];
    }
}
