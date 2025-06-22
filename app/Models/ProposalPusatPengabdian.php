<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalPusatPengabdian extends Model
{
    protected $table = 'proposal_pusat_pengabdians';

    protected $fillable = [
        'no', 'kode_klasifikasi', 'judul', 'peneliti', 'skema_pengabdian_id',
        'anggota', 'jurusan_id', 'prodi_id', 'tanggal_pengajuan',
        'keterangan', 'file',
    ];

    public function skemaPengabdian()
    {
        return $this->belongsTo(SkemaPengabdian::class, 'skema_pengabdian_id');
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

