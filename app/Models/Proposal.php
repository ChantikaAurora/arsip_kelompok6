<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    // Nama tabel (default 'proposals', bisa dihapus kalau sesuai)
    protected $table = 'proposals';

    // Kolom yang boleh diisi massal (mass assignment)
    protected $fillable = [
        'judul',
        'peneliti',
        'jurusan',
        'jenis',
        'tahun_pengajuan',
        'status',
        'tanggal_pengajuan',
        'dana_diajukan',
        'keterangan',
        'file_proposal',  // ini untuk menyimpan nama file
    ];

    // Jika kamu ingin mengubah format tanggal otomatis, bisa pakai $casts:
    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'tahun_pengajuan' => 'integer',
        'dana_diajukan' => 'float',
    ];

    public function jenisArsip()
    {
        return $this->belongsTo(JenisArsip::class, 'jenis');
    }
}
