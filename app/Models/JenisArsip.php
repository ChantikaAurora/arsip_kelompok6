<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisArsip extends Model
{
    protected $table = 'jenis_arsips';
    protected $fillable = ['jenis', 'keterangan'];

    public function anggaran_penelitians()
    {
        return $this->hasMany(AnggaranPenelitian::class);
    }
    public function laporan_penelitians()
    {
        return $this->hasMany(LaporanPenelitian::class);
    }
}