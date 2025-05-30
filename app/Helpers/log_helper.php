<?php

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

if (!function_exists('logAktivitas')) {
    function logAktivitas($aktivitas, $aksi, $modul)
    {
        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aktivitas' => $aktivitas,
            'aksi' => $aksi,
            'waktu' => now(),
            'modul' => $modul,
        ]);
    }
}
