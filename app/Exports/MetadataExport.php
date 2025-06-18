<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MetadataExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return SuratKeluar::with('jenisArsip')->get()->map(function ($item) {
            return [
                'Nomor Surat' => $item->nomor_surat,
                'Tanggal Surat' => $item->tanggal_surat,
                'Tujuan' => $item->tujuan_surat,
                'Perihal' => $item->perihal,
                'Pengirim' => $item->pengirim,
                'Penerima' => $item->penerima,
                'Jenis Arsip' => $item->jenisArsip->jenis ?? '-',
                'Waktu Upload' => $item->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nomor Surat', 'Tanggal Surat', 'Tujuan', 'Perihal',
            'Pengirim', 'Penerima', 'Jenis Arsip', 'Waktu Upload'
        ];
    }
}

