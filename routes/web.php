<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\JenisArsipController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\LaporanPenelitianController;
use App\Http\Controllers\AnggaranPenelitianController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\DashboardController;


// Halaman utama
// Route::get('/home', function () {
//     return view('welcome');
// });

Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Login
Route::get('/', [LoginController::class, 'login'])->name('auth.login');
Route::post('/', [LoginController::class, 'authenticate']);

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Pengguna
Route::resource('/pengguna', PenggunaController::class);

// Jenis Arsip

// Pengguna dan Jenis Arsip
Route::resource('/pengguna', PenggunaController::class);

Route::resource('jenisarsip', JenisArsipController::class);

// Surat Masuk
Route::resource('suratmasuk', SuratMasukController::class);
Route::get('/suratmasuk/{id}/download', [SuratMasukController::class, 'download'])->name('suratmasuk.download');
Route::get('/suratmasuk/{id}', [SuratMasukController::class, 'show'])->name('suratmasuk.detail');

// Surat Keluar
Route::resource('/suratkeluar', SuratKeluarController::class);
Route::get('/suratkeluar/download/{id}', [SuratKeluarController::class, 'download'])->name('suratkeluar.download');

// Proposal
Route::resource('proposal', ProposalController::class);
Route::get('/proposal/{id}/download', [ProposalController::class, 'download'])->name('proposal.download');
Route::get('/proposal/{id}', [ProposalController::class, 'show'])->name('proposal.show');

Route::resource('/proposal', ProposalController::class);
Route::get('/proposal/{id}/download', [ProposalController::class, 'download'])->name('proposal.download');
Route::get('/proposal/{id}', [ProposalController::class, 'show'])->name('proposal.show');

// Penelitian
Route::resource('anggaran_penelitian', AnggaranPenelitianController::class);
Route::resource('laporan_penelitian', LaporanPenelitianController::class);
Route::get('/laporan-penelitian/download/{id}', [LaporanPenelitianController::class, 'download'])->name('laporan_penelitian.download');
Route::get('/anggaran-penelitian/download/{id}', [AnggaranPenelitianController::class, 'download'])->name('anggaran_penelitian.download');

// Log Aktivitas
Route::get('/logaktivitas', [LogAktivitasController::class, 'index'])->name('log.index');

// // dashbordsuratkeluar
// Route::get('/surat-keluar', [DashboardSuratKeluarController::class, 'index'])->name('dashboardsuratkeluar');

