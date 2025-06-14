<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenelitian extends Model
{
    /** @use HasFactory<\Database\Factories\LaporanPenelitianFactory> */
    use HasFactory;

    protected $table = 'laporan_penelitians';

    protected $fillable = ['kode_seri','judul_penelitian', 'peneliti','skema','anggota','jurusan','prodi', 'tanggal_laporan_diterima', 'file', 'keterangan'];

    // public function jenisArsip()
    // {
    //     return $this->belongsTo(JenisArsip::class,'jenis_arsip_laporan');
    // }
}