<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkemaPenelitian extends Model
{
    use HasFactory;
    protected $fillable = ['skema_penelitian'];

    public function laporan_penelitians()
    {
        return $this->hasMany(LaporanPenelitian::class);
    }
}
