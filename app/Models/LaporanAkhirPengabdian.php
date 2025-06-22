<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAkhirPengabdian extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika sesuai konvensi Laravel, misalnya "laporan_akhir_pengabdians")
    protected $table = 'laporanakhirpengabdians';

    // Primary key
    protected $primaryKey = 'id_laporan_akhir';

    // Non-incrementing karena primary key bukan auto-increment
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
        return $this->belongsTo(SkemaPengabdian::class, 'skema', 'id');
    }
}
