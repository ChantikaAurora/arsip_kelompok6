<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKegiatanPengabdian extends Model
{
    /** @use HasFactory<\Database\Factories\LaporanPenelitianFactory> */
    use HasFactory;

    protected $table = 'laporan_kegiatan_pengabdians';

    protected $fillable = ['kode_seri','judul', 'peneliti','skema','anggota','jurusan','prodi', 'tanggal_laporan_diterima', 'file', 'keterangan'];

    // public function jenisArsip()
    // {
    //     return $this->belongsTo(JenisArsip::class,'jenis_arsip_laporan');
    // }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi');
    }

    public function skema()
    {
        return $this->belongsTo(SkemaPengabdian::class, 'skema');
    }

}
