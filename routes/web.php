<?php

use App\Http\Controllers\AnggaranPenelitianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JenisArsipController;
use App\Http\Controllers\LaporanPenelitianController;
use App\Http\Controllers\SuratMasukController;


Route::get('/home', function () {
    return view('welcome');
});


Route::resource('/pengguna', PenggunaController::class);
Route::resource('jenisarsip', JenisArsipController::class);
Route::resource('anggaran_penelitian', AnggaranPenelitianController::class);
Route::resource('laporan_penelitian', LaporanPenelitianController::class);
Route::get('/laporan-penelitian/download/{id}', [LaporanPenelitianController::class, 'download'])->name('laporan_penelitian.download');
Route::get('/anggaran-penelitian/download/{id}', [AnggaranPenelitianController::class, 'download'])->name('anggaran_penelitian.download');

// Route::resource('suratmasuk', SuratMasukController::class);


Route::get('/', [LoginController::class,'login'])->name('auth.login');
Route::post('/',[LoginController::class,'authenticate']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');