<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranPengabdian extends Model
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
}

