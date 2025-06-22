<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    DashboardController,
    PenggunaController,
    JenisArsipController,
    SuratMasukController,
    SuratKeluarController,
    ProposalController,
    SkemaPenelitianController,
    SkemaPengabdianController,
    AnggaranPenelitianController,
    AnggaranPengabdianController,
    DiagramController,
    ProdiController,
    JurusanController,
    LaporanKemajuanPenelitianController,
    LaporanKemajuanPengabdianController,
    LaporanAkhirPenelitianController,
    LaporanAkhirPengabdianController,

};
use App\Exports\MetadataSuratKeluarExport;
use Maatwebsite\Excel\Facades\Excel;

// ===================
// Halaman utama / Dashboard
// ===================
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/diagram', [DiagramController::class, 'index'])->name('diagram');
Route::get('/diagram/data', [DiagramController::class, 'getData']);
Route::get('/test', fn() => 'Route test OK');

// ===================
// Auth
// ===================
Route::get('/', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ===================
// Master Data
// ===================
Route::resource('pengguna', PenggunaController::class);
Route::resource('jenisarsip', JenisArsipController::class);
Route::resource('jurusan', JurusanController::class);
Route::resource('prodi', ProdiController::class);
Route::resource('skemaPenelitian', SkemaPenelitianController::class);
Route::resource('skemaPengabdian', SkemaPengabdianController::class);

// ===================
// Surat Masuk
// ===================
Route::resource('suratmasuk', SuratMasukController::class);
Route::get('suratmasuk/{id}/download', [SuratMasukController::class, 'download'])->name('suratmasuk.download');
Route::get('suratmasuk/{id}', [SuratMasukController::class, 'show'])->name('suratmasuk.detail');

// ===================
// Surat Keluar
// ===================
Route::get('suratkeluar/download/{id}', [SuratKeluarController::class, 'download'])->name('suratkeluar.download');
Route::get('suratkeluar/metadata', [SuratKeluarController::class, 'metadata'])->name('suratkeluar.metadata');
Route::get('suratkeluar/metadata/export', [SuratKeluarController::class, 'exportMetadata'])->name('suratkeluar.metadata.export');
Route::resource('suratkeluar', SuratKeluarController::class);

// ===================
// Proposal
// ===================
Route::resource('proposal', ProposalController::class);
Route::get('proposal/{id}/download', [ProposalController::class, 'download'])->name('proposal.download');
Route::get('proposal/{id}', [ProposalController::class, 'show'])->name('proposal.show');

// ===================
// Laporan Kemajuan Penelitian
// ===================
Route::get('laporan_kemajuan_penelitian/metadata', [LaporanKemajuanPenelitianController::class, 'metadata'])->name('laporan_kemajuan_penelitian.metadata');
Route::get('laporan_kemajuan_penelitian/metadata/export', [LaporanKemajuanPenelitianController::class, 'exportMetadata'])->name('laporan_kemajuan_penelitian.metadata.export');
Route::get('laporan_kemajuan_penelitian/{id}/download', [LaporanKemajuanPenelitianController::class, 'download'])->name('laporan_kemajuan_penelitian.download');
Route::get('laporan_kemajuan_penelitian/{id}/preview', [LaporanKemajuanPenelitianController::class, 'preview'])->name('laporan_kemajuan_penelitian.preview');
Route::resource('laporan_kemajuan_penelitian', LaporanKemajuanPenelitianController::class);

// ===================
// Laporan Kemajuan Pengabdian
// ===================
Route::get('laporan_kemajuan_pengabdian/metadata', [LaporanKemajuanPengabdianController::class, 'metadata'])->name('laporan_kemajuan_pengabdian.metadata');
Route::get('laporan_kemajuan_pengabdian/metadata/export', [LaporanKemajuanPengabdianController::class, 'exportMetadata'])->name('laporan_kemajuan_pengabdian.metadata.export');
Route::get('laporan_kemajuan_pengabdian/{id}/download', [LaporanKemajuanPengabdianController::class, 'download'])->name('laporan_kemajuan_pengabdian.download');
Route::get('laporan_kemajuan_pengabdian/{id}/preview', [LaporanKemajuanPengabdianController::class, 'preview'])->name('laporan_kemajuan_pengabdian.preview');
Route::resource('laporan_kemajuan_pengabdian', LaporanKemajuanPengabdianController::class);

// ===================
// Laporan Akhir Penelitian
// ===================
Route::get('laporan_akhir_penelitian/metadata', [LaporanAkhirPenelitianController::class, 'metadata'])->name('laporan_akhir_penelitian.metadata');
Route::get('laporan_akhir_penelitian/metadata/export', [LaporanAkhirPenelitianController::class, 'exportMetadata'])->name('laporan_akhir_penelitian.metadata.export');
Route::get('laporan_akhir_penelitian/{id}/download', [LaporanAkhirPenelitianController::class, 'download'])->name('laporan_akhir_penelitian.download');
Route::get('laporan_akhir_penelitian/{id}/preview', [LaporanAkhirPenelitianController::class, 'preview'])->name('laporan_akhir_penelitian.preview');
Route::resource('laporan_akhir_penelitian', LaporanAkhirPenelitianController::class);

// ===================
// Laporan Akhir Pengabdian
// ===================
Route::get('laporan_akhir_pengabdian/metadata', [LaporanAkhirPengabdianController::class, 'metadata'])->name('laporan_akhir_pengabdian.metadata');
Route::get('laporan_akhir_pengabdian/metadata/export', [LaporanAkhirPengabdianController::class, 'exportMetadata'])->name('laporan_akhir_pengabdian.metadata.export');
Route::get('laporan_akhir_pengabdian/{id}/download', [LaporanAkhirPengabdianController::class, 'download'])->name('laporan_akhir_pengabdian.download');
Route::get('laporan_akhir_pengabdian/{id}/preview', [LaporanAkhirPengabdianController::class, 'preview'])->name('laporan_akhir_pengabdian.preview');
Route::resource('laporan_akhir_pengabdian', LaporanAkhirPengabdianController::class);


// ===================
// Laporan Keuangan Penelitian
// ===================
Route::get('anggaran_penelitian/metadata', [AnggaranPenelitianController::class, 'metadata'])->name('anggaran_penelitian.metadata');
Route::get('anggaran_penelitian/metadata/export', [AnggaranPenelitianController::class, 'exportMetadata'])->name('anggaran_penelitian.metadata.export');
Route::get('anggaran_penelitian/{id}/download', [AnggaranPenelitianController::class, 'download'])->name('anggaran_penelitian.download');
Route::get('anggaran_penelitian/{id}/preview', [AnggaranPenelitianController::class, 'preview'])->name('anggaran_penelitian.preview');
Route::resource('anggaran_penelitian', AnggaranPenelitianController::class);

// ===================
// Laporan Keuangan Pengabdian
// ===================
Route::get('anggaran_pengabdian/metadata', [AnggaranPengabdianController::class, 'metadata'])->name('anggaran_pengabdian.metadata');
Route::get('anggaran_pengabdian/metadata/export', [AnggaranPengabdianController::class, 'exportMetadata'])->name('anggaran_pengabdian.metadata.export');
Route::get('anggaran_pengabdian/{id}/download', [AnggaranPengabdianController::class, 'download'])->name('anggaran_pengabdian.download');
Route::get('anggaran_pengabdian/{id}/preview', [AnggaranPengabdianController::class, 'preview'])->name('anggaran_pengabdian.preview');
Route::resource('anggaran_pengabdian', AnggaranPengabdianController::class);
