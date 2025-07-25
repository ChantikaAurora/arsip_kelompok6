<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    // Menentukan nama tabel jika berbeda dari konvensi plural
    protected $table = 'suratmasuks';

    // Field yang bisa diisi (mass assignable)
    protected $fillable = [
        'nomor_surat',
        'kode_klasifikasi',
        'tanggal_surat',
        'tanggal_terima',
        'asal_surat',
        'pengirim',
        'perihal',
        'lampiran',
        'jenis',
        'keterangan',
        'file'
    ];

    protected $hidden = [

    ];

    public function jenisArsip()
    {
        return $this->belongsTo(JenisArsip::class, 'jenis');
    }

}
