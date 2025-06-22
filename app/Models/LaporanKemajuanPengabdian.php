<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKemajuanPengabdian extends Model
{
    protected $primaryKey = 'id_laporan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'laporankemajuanpengabdians';
    protected $fillable = ['id_laporan', 'judul_kegiatan', 'nama_ketua','nama_anggota','skema','tahun_pelaksanaan','jurusan','prodi','periode_laporan','ringkasan','file'];

    public function skemaRelasi()
    {
        return $this->belongsTo(SkemaPengabdian::class, 'skema', 'id');
    }
     public function jurusanRelasi()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan');
    }

    public function prodiRelasi()
    {
        return $this->belongsTo(Prodi::class, 'prodi');
    }
}
