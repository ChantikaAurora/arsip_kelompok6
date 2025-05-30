<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JenisArsipController;
use App\Http\Controllers\SuratKeluarController;

Route::get('/home', function () {
    return view('welcome');
});


Route::resource('/pengguna', PenggunaController::class);
Route::resource('jenisarsip', JenisArsipController::class);
// Route::resource('suratmasuk', SuratMasukController::class);


Route::get('/', [LoginController::class,'login'])->name('auth.login');
Route::post('/',[LoginController::class,'authenticate']);

Route::resource('/suratkeluar', SuratKeluarController::class);
Route::get('/suratkeluar/download/{id}', [SuratKeluarController::class, 'download'])->name('suratkeluar.download');






Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
