<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisArsipController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\SkemaPenelitianController;
use App\Http\Controllers\SkemaPengabdianController;
use App\Http\Controllers\LaporanPenelitianController;
use App\Http\Controllers\LaporanPengabdianController;
use App\Http\Controllers\AnggaranPenelitianController;

// Halaman utama
Route::get('/home', function () {
    $jumlahPenggunaAktif = DB::table('users')
        ->whereDate('last_login', Carbon::today())
        ->count();

    $jumlahSuratMasuk = DB::table('suratmasuks')->count();

    return view('welcome', compact('jumlahPenggunaAktif', 'jumlahSuratMasuk'));
});

// use App\Http\Controllers\LogAktivitasController;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggaranPengabdianController;
use App\Http\Controllers\LaporanKegiatanPengabdianController;


// Halaman utama
// Route::get('/home', function () {
//     return view('welcome');
// });

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
// Route::post('/register', [RegisterController::class, 'store'])->name('auth.register.store');


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

Route::resource('laporan_penelitian', LaporanPenelitianController::class);
Route::get('laporan_penelitian/{id}/download', [LaporanPenelitianController::class, 'download'])->name('laporan_penelitian.download');
Route::get('laporan_penelitian/{id}', [LaporanPenelitianController::class, 'show'])->name('laporan_penelitian.show');

Route::resource('proposal', ProposalController::class);
Route::get('proposal/{id}/download', [ProposalController::class, 'download'])->name('proposal.download');
Route::get('proposal/{id}', [ProposalController::class, 'show'])->name('proposal.show');

// Pengabdian
Route::get('anggaran_pengabdian/{id}/download', [AnggaranPengabdianController::class, 'download'])->name('anggaran_pengabdian.download');
Route::get('anggaran_pengabdian/{id}/preview', [AnggaranPengabdianController::class, 'preview'])->name('anggaran_pengabdian.preview');
Route::resource('anggaran_pengabdian', AnggaranPengabdianController::class);

// Penelitian
Route::get('anggaran_penelitian/{id}/download', [AnggaranPenelitianController::class, 'download'])->name('anggaran_penelitian.download');
Route::get('anggaran_penelitian/{id}/preview', [AnggaranPenelitianController::class, 'preview'])->name('anggaran_penelitian.preview');
Route::resource('anggaran_penelitian', AnggaranPenelitianController::class);

Route::resource('laporan_pengabdian', LaporanPengabdianController::class);
Route::get('laporan_pengabdian/{id}/download', [LaporanPengabdianController::class, 'download'])->name('laporan_pengabdian.download');
Route::get('laporan_pengabdian/{id}', [LaporanPengabdianController::class, 'show'])->name('laporan_pengabdian.show');

Route::resource('laporan_kegiatan_pengabdian', LaporanKegiatanPengabdianController::class);
Route::get('laporan_kegiatan_pengabdian/{id}/download', [LaporanKegiatanPengabdianController::class, 'download'])->name('laporan_kegiatan_pengabdian.download');
Route::get('laporan_kegiatan_pengabdian/{id}', [LaporanKegiatanPengabdianController::class, 'show'])->name('laporan_kegiatan_pengabdian.show');


// Log Aktivitas
Route::get('/logaktivitas', [LogAktivitasController::class, 'index'])->name('log.index');

// dashbordsuratkeluar

// Diagram Proposal, Laporan, Anggaran
// Route::middleware(['auth'])->get('diagram', [DiagramController::class, 'index'])->name('diagram');
// Route::get('/diagram', [DiagramController::class, 'index']);

Route::get('/diagram', [DiagramController::class, 'index'])->name('diagram');
Route::get('/diagram/data', [DiagramController::class, 'getData']); // untuk data AJAX
// // dashbordsuratkeluar

//skemapenelitian
Route::resource('skemaPenelitian', SkemaPenelitianController::class);

//skemapengabdian
Route::resource('skemaPengabdian', SkemaPengabdianController::class);


//jurusan
Route::resource('jurusan', JurusanController::class);

//prodi
Route::resource('prodi', ProdiController::class);

// Route::get('/surat-keluar', [DashboardSuratKeluarController::class, 'index'])->name('dashboardsuratkeluar');
