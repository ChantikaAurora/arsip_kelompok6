<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalPenelitianDp extends Model
{
    protected $table = 'proposal_penelitian_dp';

    protected $fillable = [
        'kode_seri',
        'judul',
        'peneliti',
        'skema',
        'anggota',
        'jurusan_id',
        'prodi_id',
        'tanggal_pengajuan',
        'file',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
