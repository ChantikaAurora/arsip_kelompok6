<?php

namespace App\Http\Controllers;

use App\Models\Prodi;

class AjaxController extends Controller
{
    public function getProdi($jurusan_id)
    {
        return response()->json(Prodi::where('jurusan_id', $jurusan_id)->get());
    }
}

