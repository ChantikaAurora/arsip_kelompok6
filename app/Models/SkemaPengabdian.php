<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkemaPengabdian extends Model
{
    use HasFactory;
    protected $fillable = ['skema_pengabdian'];

    public function laporan_pengabdians()
    {
        return $this->hasMany(LaporanPengabdian::class, 'skema_pengabdian');
    }
}
