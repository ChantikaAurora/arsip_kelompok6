<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisArsip extends Model
{
    protected $fillable = ['jenis', 'keterangan'];
    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'jenis');
    }

}
