<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\JenisArsipController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\ProposalPenelitianDpController;
use App\Http\Controllers\ProposalPengabdianController;
use App\Http\Controllers\ProposalPenelitianUnggulanController;
use App\Http\Controllers\LaporanPenelitianController;
use App\Http\Controllers\AnggaranPenelitianController;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\LogAktivitasController;

// Halaman utama
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Login & Logout
Route::get('/', [LoginController::class, 'login'])->name('auth.login');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Registrasi
Route::get('/register', [RegisterController::class, 'create'])->name('auth.register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('auth.register.store');

// Pengguna & Jenis Arsip
Route::resource('pengguna', PenggunaController::class);
Route::resource('jenisarsip', JenisArsipController::class);

// Surat Masuk
Route::resource('suratmasuk', SuratMasukController::class);
Route::get('suratmasuk/{id}/download', [SuratMasukController::class, 'download'])->name('suratmasuk.download');
Route::get('suratmasuk/{id}', [SuratMasukController::class, 'show'])->name('suratmasuk.detail');

// Surat Keluar
Route::resource('suratkeluar', SuratKeluarController::class);
Route::get('suratkeluar/download/{id}', [SuratKeluarController::class, 'download'])->name('suratkeluar.download');

// Proposal Penelitian DP
// Route::resource('proposal', ProposalController::class);
// Route::get('proposal/{id}/download', [ProposalController::class, 'download'])->name('proposal.download');
// Route::get('proposal/{id}', [ProposalController::class, 'show'])->name('proposal.show');
Route::resource('proposal-penelitian-dp', ProposalPenelitianDpController::class);
Route::get('proposal-penelitian-dp/{id}/download', [ProposalPenelitianDpController::class, 'download'])->name('proposal-penelitian-dp.download');

// Route::resource('proposal', ProposalPenelitianDpController::class);
// Route::get('proposal/{id}/download', [ProposalPenelitianDpController::class, 'download'])->name('proposal.download');

// Proposal Pengabdian
Route::resource('proposal_pengabdian', ProposalPengabdianController::class);
Route::get('proposal_pengabdian/{id}/download', [ProposalPengabdianController::class, 'download'])->name('proposal_pengabdian.download');

// Proposal Penelitian Unggulan
Route::resource('proposal_unggulan', ProposalPenelitianUnggulanController::class);
Route::get('proposal_unggulan/{id}/download', [ProposalPenelitianUnggulanController::class, 'download'])->name('proposal_unggulan.download');

// Penelitian
Route::resource('anggaran_penelitian', AnggaranPenelitianController::class);
Route::get('anggaran-penelitian/download/{id}', [AnggaranPenelitianController::class, 'download'])->name('anggaran_penelitian.download');

Route::resource('laporan_penelitian', LaporanPenelitianController::class);
Route::get('laporan-penelitian/download/{id}', [LaporanPenelitianController::class, 'download'])->name('laporan_penelitian.download');

// Log Aktivitas
Route::get('/logaktivitas', [LogAktivitasController::class, 'index'])->name('log.index');

// Diagram
Route::get('/diagram', [DiagramController::class, 'index'])->name('diagram');
Route::get('/diagram/data', [DiagramController::class, 'getData']);
