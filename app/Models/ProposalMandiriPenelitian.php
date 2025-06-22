<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalMandiriPenelitian extends Model
{
    protected $table = 'proposal_mandiri_penelitians';

    protected $fillable = [
        'no', 'kode_klasifikasi', 'judul', 'peneliti', 'skema_penelitian_id',
        'anggota', 'jurusan_id', 'prodi_id', 'tanggal_pengajuan',
        'keterangan', 'file',
    ];

    public function skemaPenelitian()
    {
        return $this->belongsTo(SkemaPenelitian::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
