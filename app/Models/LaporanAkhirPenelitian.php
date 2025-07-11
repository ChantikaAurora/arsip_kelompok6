<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAkhirPenelitian extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika nama tabel sesuai konvensi plural Laravel)
    protected $table = 'laporanakhirpenelitians';

    // Primary key
    protected $primaryKey = 'id_laporan_akhir';

    // Jika menggunakan UUID, non-incrementing
    public $incrementing = false;


    // Mass assignment
    protected $fillable = [
        'id_laporan_akhir',
        'judul_kegiatan',
        'skema',
        'tahun_pelaksanaan',
        'file',
    ];
    public function skemaRelasi()
    {
        return $this->belongsTo(SkemaPenelitian::class, 'skema', 'id');
    }
}
