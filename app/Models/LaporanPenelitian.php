<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenelitian extends Model
{
    /** @use HasFactory<\Database\Factories\LaporanPenelitianFactory> */
    use HasFactory;

    protected $table = 'laporan_penelitians';

    protected $fillable = ['judul_penelitian', 'peneliti','jenis_arsip_laporan', 'jurusan', 'tahun_penelitian', 'tanggal_laporan_diterima', 'status_laporan', 'file', 'keterangan'];

    public function jenisArsip()
    {
        return $this->belongsTo(JenisArsip::class,'jenis_arsip_laporan');
    }
}
