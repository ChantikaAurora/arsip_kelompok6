<?php

// 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\JenisArsipController;
<<<<<<< HEAD
use App\Http\Controllers\SuratKeluarController;
=======
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\LogAktivitasController;
>>>>>>> nurman

Route::get('/home', function () {
    return view('welcome');
});

<<<<<<< HEAD

Route::resource('/pengguna', PenggunaController::class);
Route::resource('jenisarsip', JenisArsipController::class);
Route::resource('suratmasuk', SuratMasukController::class);
Route::get('/suratmasuk/{id}/download', [SuratMasukController::class, 'download'])->name('suratmasuk.download');
Route::get('/suratmasuk/{id}', [SuratMasukController::class, 'show'])->name('suratmasuk.detail');

Route::get('/', [LoginController::class,'login'])->name('auth.login');
Route::post('/',[LoginController::class,'authenticate']);
=======
Route::get('/', [LoginController::class, 'login'])->name('auth.login');
Route::post('/', [LoginController::class, 'authenticate']);
>>>>>>> nurman

Route::resource('/suratkeluar', SuratKeluarController::class);
Route::get('/suratkeluar/download/{id}', [SuratKeluarController::class, 'download'])->name('suratkeluar.download');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

<<<<<<< HEAD
=======
Route::resource('/pengguna', PenggunaController::class);
Route::resource('jenisarsip', JenisArsipController::class);
Route::resource('/proposal', ProposalController::class);
Route::get('/proposal/{id}/download', [ProposalController::class, 'download'])->name('proposal.download');
// Route::get('/proposal/{id}/download', [ProposalController::class, 'download'])->name('proposal.download');
// Route::get('/proposal/create', [ProposalController::class, 'create'])->name('proposal.create');
// Route::get('/proposal/{proposal}', [ProposalController::class, 'show'])->name('proposal.show');
Route::resource('proposal', ProposalController::class);

Route::get('/logaktivitas', [LogAktivitasController::class, 'index'])->name('log.index');
Route::get('/proposal/{id}', [ProposalController::class, 'show'])->name('proposal.show');
>>>>>>> nurman
