<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = ['kode_jurusan', 'jurusan'];

    public function laporan_penelitians()
    {
        return $this->hasMany(LaporanPenelitian::class,'prodi');
    }

    public function laporan_pengabdians()
    {
        return $this->hasMany(LaporanPengabdian::class, 'prodi');
    }
    
    public function laporanKegiatanPengabdians()
    {
    return $this->hasMany(LaporanKegiatanPengabdian::class, 'jurusan');
    }

}
