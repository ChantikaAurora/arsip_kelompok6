<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranPenelitian extends Model
{
    /** @use HasFactory<\Database\Factories\AnggaranPenelitianFactory> */
    use HasFactory;
    protected $table = 'anggaran_penelitians';

    protected $fillable = ['judul_penelitian', 'peneliti', 'tahun', 'total_anggaran', 'jenis_arsip_id', 'rincian_anggaran', 'status', 'keterangan'];

    public function jenisArsip()
    {
        return $this->belongsTo(JenisArsip::class,'jenis_arsip_id');
    }
}
