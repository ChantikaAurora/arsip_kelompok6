<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = ['jurusan_id', 'kode_prodi', 'prodi'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    // public function laporan_penelitians()
    // {
    //     return $this->hasMany(LaporanPenelitian::class,'prodi');
    // }

    // public function laporan_pengabdians()
    // {
    //     return $this->hasMany(LaporanPengabdian::class, 'prodi');
    // }

    // public function laporan_kegiatan_pengabdians()
    // {
    //     return $this->hasMany(LaporanPengabdian::class, 'prodi');
    // }
}
