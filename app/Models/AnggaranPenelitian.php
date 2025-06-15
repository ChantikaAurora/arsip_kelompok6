<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranPenelitian extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'kegiatan',
        'volume_usulan',
        'skema',
        'total_anggaran',
        'file',
    ];

    public function skemaRelasi()
    {
        return $this->belongsTo(SkemaPenelitian::class, 'skema', 'id');
    }
}
