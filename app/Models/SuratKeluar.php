<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluars';
    protected $fillable = [
    'no',
    'nomor_surat',
    'tanggal_surat',
    'tujuan_surat',
    'perihal',
    'pengirim',
    'penerima',
    'jenis',
    'file',
    ];

    protected $hidden = [

    ];

    public function jenisArsip() {
        return $this->belongsTo(JenisArsip::class, 'jenis'); // foreign key: jenis
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // sesuaikan jika beda nama kolom
    }
}
