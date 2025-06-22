<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdiController;
use App\Exports\MetadataSuratKeluarExport;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PenggunaController;
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
use App\Http\Controllers\AnggaranPengabdianController;

// Halaman utama
Route::get('/home', function () {
    $jumlahPenggunaAktif = DB::table('users')
        ->whereDate('last_login', Carbon::today())
        ->count();

    $jumlahSuratMasuk = DB::table('suratmasuks')->count();

    return view('welcome', compact('jumlahPenggunaAktif', 'jumlahSuratMasuk'));
});


use App\Http\Controllers\ProposalDipaPenelitianController;
use App\Http\Controllers\ProposalDipaPengabdianController;
use App\Http\Controllers\ProposalPusatPenelitianController;
use App\Http\Controllers\ProposalPusatPengabdianController;
use App\Http\Controllers\LaporanKegiatanPengabdianController;
use App\Http\Controllers\ProposalMandiriPenelitianController;
use App\Http\Controllers\ProposalMandiriPengabdianController;


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

//metada surat masuk
Route::get('/suratmasuk/metadata', [SuratMasukController::class, 'metadata'])->name('suratmasuk.metadata');
Route::get('/suratmasuk/metadata/download', [SuratMasukController::class, 'exportMetadata'])->name('suratmasuk.metadata.download');
// Surat Masuk
Route::resource('suratmasuk', SuratMasukController::class);
Route::get('suratmasuk/{id}/download', [SuratMasukController::class, 'download'])->name('suratmasuk.download');
Route::get('suratmasuk/{id}', [SuratMasukController::class, 'show'])->name('suratmasuk.detail');

//metada surat keluar
Route::get('suratkeluar/download/{id}', [SuratKeluarController::class, 'download'])->name('suratkeluar.download');
Route::get('/suratkeluar/metadata', [SuratKeluarController::class, 'metadata'])->name('suratkeluar.metadata');
Route::get('/suratkeluar/metadata/export', [SuratKeluarController::class, 'exportMetadataKeluar'])->name('suratkeluar.metadata.export');
// Surat Keluar
Route::resource('suratkeluar', SuratKeluarController::class);

// //laporan penelitian
// Route::resource('laporan_penelitian', LaporanPenelitianController::class);
// Route::get('laporan_penelitian/{id}/download', [LaporanPenelitianController::class, 'download'])->name('laporan_penelitian.download');
// Route::get('laporan_penelitian/{id}', [LaporanPenelitianController::class, 'show'])->name('laporan_penelitian.show');

// Route::resource('laporan_pengabdian', LaporanPengabdianController::class);
// Route::get('laporan_pengabdian/{id}/download', [LaporanPengabdianController::class, 'download'])->name('laporan_pengabdian.download');
// Route::get('laporan_pengabdian/{id}', [LaporanPengabdianController::class, 'show'])->name('laporan_pengabdian.show');

// Route::resource('laporan_kegiatan_pengabdian', LaporanKegiatanPengabdianController::class);
// Route::get('laporan_kegiatan_pengabdian/{id}/download', [LaporanKegiatanPengabdianController::class, 'download'])->name('laporan_kegiatan_pengabdian.download');
// Route::get('laporan_kegiatan_pengabdian/{id}', [LaporanKegiatanPengabdianController::class, 'show'])->name('laporan_kegiatan_pengabdian.show');


//metada dipa penelitian
Route::get('proposal_dipa_penelitian/metadata', [ProposalDipaPenelitianController::class, 'metadata'])->name('proposal_dipa_penelitian.metadata');
Route::get('proposal_dipa_penelitian/export', [ProposalDipaPenelitianController::class, 'export'])->name('proposal_dipa_penelitian.export');
Route::get('/proposal_dipa_penelitian/metadata/download', [ProposalDipaPenelitianController::class, 'exportMetadata'])->name('proposal_dipa_penelitian.metadata.download');
//proposal dipa penelitian
Route::resource('proposal_dipa_penelitian', ProposalDipaPenelitianController::class);
Route::get('proposal_dipa_penelitian/{id}/download', [ProposalDipaPenelitianController::class, 'download'])
    ->name('proposal_dipa_penelitian.download');

//metada dipa pengabdian
Route::get('proposal_dipa_pengabdian/metadata', [ProposalDipaPengabdianController::class, 'metadata'])->name('proposal_dipa_pengabdian.metadata');
Route::get('proposal_dipa_pengabdian/export', [ProposalDipaPengabdianController::class, 'export'])->name('proposal_dipa_pengabdian.export');
Route::get('/proposal_dipa_pengabdian/metadata/download', [ProposalDipaPengabdianController::class, 'exportMetadata'])->name('proposal_dipa_pengabdian.metadata.download');
//proposal dipa pengabdian
Route::resource('proposal_dipa_pengabdian', ProposalDipaPengabdianController::class);
Route::get('proposal_dipa_pengabdian/{id}/download', [ProposalDipaPengabdianController::class, 'download'])
    ->name('proposal_dipa_pengabdian.download');

//metada pusat penelitian
Route::get('proposal_pusat_penelitian/metadata', [ProposalPusatPenelitianController::class, 'metadata'])->name('proposal_pusat_penelitian.metadata');
Route::get('proposal_pusat_penelitian/export', [ProposalPusatPenelitianController::class, 'export'])->name('proposal_pusat_penelitian.export');
Route::get('/proposal_pusat_penelitian/metadata/download', [ProposalPusatPenelitianController::class, 'exportMetadata'])->name('proposal_pusat_penelitian.metadata.download');
//proposal pusat penelitian
Route::resource('proposal_pusat_penelitian', ProposalPusatPenelitianController::class);
Route::get('proposal_pusat_penelitian/{id}/download', [ProposalPusatPenelitianController::class, 'download'])
    ->name('proposal_pusat_penelitian.download');

//metada pusat pengabdian
Route::get('proposal_pusat_pengabdian/metadata', [ProposalPusatPengabdianController::class, 'metadata'])->name('proposal_pusat_pengabdian.metadata');
Route::get('proposal_pusat_pengabdian/export', [ProposalPusatPengabdianController::class, 'export'])->name('proposal_pusat_pengabdian.export');
Route::get('/proposal_pusat_pengabdian/metadata/download', [ProposalPusatPengabdianController::class, 'exportMetadata'])->name('proposal_pusat_pengabdian.metadata.download');
//proposal pusat pengabdian
Route::resource('proposal_pusat_pengabdian', ProposalPusatPengabdianController::class);
Route::get('proposal_pusat_pengabdian/{id}/download', [ProposalPusatPengabdianController::class, 'download'])
    ->name('proposal_pusat_pengabdian.download');

//metada mandiri penelitian
Route::get('proposal_mandiri_penelitian/metadata', [ProposalMandiriPenelitianController::class, 'metadata'])->name('proposal_mandiri_penelitian.metadata');
Route::get('proposal_mandiri_penelitian/export', [ProposalMandiriPenelitianController::class, 'export'])->name('proposal_mandiri_penelitian.export');
Route::get('/proposal_mandiri_penelitian/metadata/download', [ProposalMandiriPenelitianController::class, 'exportMetadata'])->name('proposal_mandiri_penelitian.metadata.download');
//proposal mandiri penelitian
Route::resource('proposal_mandiri_penelitian', ProposalMandiriPenelitianController::class);
Route::get('proposal_mandiri_penelitian/{id}/download', [ProposalMandiriPenelitianController::class, 'download'])
    ->name('proposal_mandiri_penelitian.download');

//metada mandiri pengabdian
Route::get('proposal_mandiri_pengabdian/metadata', [ProposalMandiriPengabdianController::class, 'metadata'])->name('proposal_mandiri_pengabdian.metadata');
Route::get('proposal_mandiri_pengabdian/export', [ProposalMandiriPengabdianController::class, 'export'])->name('proposal_mandiri_pengabdian.export');
Route::get('/proposal_mandiri_pengabdian/metadata/download', [ProposalMandiriPengabdianController::class, 'exportMetadata'])->name('proposal_mandiri_pengabdian.metadata.download');
//proposal mandiri pengabdian
Route::resource('proposal_mandiri_pengabdian', ProposalMandiriPengabdianController::class);
Route::get('proposal_mandiri_pengabdian/{id}/download', [ProposalMandiriPengabdianController::class, 'download'])
    ->name('proposal_mandiri_pengabdian.download');

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
Route::get('/test', function () {
    return 'Route test OK';
});
