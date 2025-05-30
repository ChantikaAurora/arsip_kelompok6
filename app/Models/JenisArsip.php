<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisArsip extends Model
{
    protected $table = 'jenis_arsips';
    protected $fillable = ['jenis', 'keterangan'];
<<<<<<< HEAD

    public function suratKeluars() {
    return $this->hasMany(SuratKeluar::class, 'jenis'); // foreign key di surat_keluars
    }

    public function suratMasuks()
    {
        return $this->hasMany(SuratMasuk::class, 'jenis');
=======
    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'jenis');
>>>>>>> nurman
    }

    public function anggaran_penelitians()
    {
        return $this->hasMany(AnggaranPenelitian::class);
    }
    public function laporan_penelitians()
    {
        return $this->hasMany(LaporanPenelitian::class);
    }
}

