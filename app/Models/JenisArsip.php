<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisArsip extends Model
{
    protected $fillable = ['jenis', 'keterangan'];


    public function suratKeluars() {
    return $this->hasMany(SuratKeluar::class, 'jenis'); // foreign key di surat_keluars
    }

    public function suratMasuks()
    {
        return $this->hasMany(SuratMasuk::class, 'jenis');
    }

}
