<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisArsip extends Model
{
    protected $fillable = ['jenis', 'keterangan'];

    public function suratMasuks()
    {
        return $this->hasMany(SuratMasuk::class, 'jenis');
    }
}
