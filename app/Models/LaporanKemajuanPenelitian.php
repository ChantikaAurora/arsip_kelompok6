<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKemajuanPenelitian extends Model
{
    protected $primaryKey = 'id_laporan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'laporankemajuanpenelitians';
    protected $fillable = ['id_laporan', 'judul_kegiatan', 'nama_ketua','nama_anggota','skema','tahun_pelaksanaan','jurusan','prodi','periode_laporan','ringkasan','file'];

    public function skemaRelasi()
    {
        return $this->belongsTo(SkemaPenelitian::class, 'skema', 'id');
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
