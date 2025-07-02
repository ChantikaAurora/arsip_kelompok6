<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Http\Controllers\{
    LoginController,
    DashboardController,
    PenggunaController,
    JenisArsipController,
    SuratMasukController,
    SuratKeluarController,
    SkemaPenelitianController,
    SkemaPengabdianController,
    AnggaranPenelitianController,
    AnggaranPengabdianController,
    ProdiController,
    JurusanController,
    LaporanKemajuanPenelitianController,
    LaporanKemajuanPengabdianController,
    LaporanAkhirPenelitianController,
    LaporanAkhirPengabdianController,
    ProposalDipaPenelitianController,
    ProposalDipaPengabdianController,
    ProposalPusatPenelitianController,
    ProposalPusatPengabdianController,
    ProposalMandiriPenelitianController,
    ProposalMandiriPengabdianController,
    AjaxController
};

// =====================
// dropdown dinamis
// =====================
Route::get('/get-prodi/{jurusan_id}', [ProdiController::class, 'getProdiByJurusan']);

// ===================
// AUTH
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
// DASHBOARD
// ===================
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// ===================
// MASTER DATA
// ===================
Route::resources([
    'pengguna' => PenggunaController::class,
    'jenisarsip' => JenisArsipController::class,
    'jurusan' => JurusanController::class,
    'prodi' => ProdiController::class,
    'skemaPenelitian' => SkemaPenelitianController::class,
    'skemaPengabdian' => SkemaPengabdianController::class,
]);

// ===================
// SURAT MASUK
// ===================
Route::resource('suratmasuk', SuratMasukController::class);
Route::get('suratmasuk/{id}/download', [SuratMasukController::class, 'download'])->name('suratmasuk.download');
Route::get('suratmasuk/metadata', [SuratMasukController::class, 'metadata'])->name('suratmasuk.metadata');
Route::get('suratmasuk/metadata/download', [SuratMasukController::class, 'exportMetadata'])->name('suratmasuk.metadata.download');

// ===================
// SURAT KELUAR
// ===================
Route::resource('suratkeluar', SuratKeluarController::class);
Route::get('suratkeluar/{id}/download', [SuratKeluarController::class, 'download'])->name('suratkeluar.download');
Route::get('suratkeluar/metadata', [SuratKeluarController::class, 'metadata'])->name('suratkeluar.metadata');
Route::get('suratkeluar/metadata/export', [SuratKeluarController::class, 'exportMetadata'])->name('suratkeluar.metadata.export');

// Proposal DIPA
Route::resource('proposal_dipa_penelitian', ProposalDipaPenelitianController::class);
Route::get('proposal_dipa_penelitian/{id}/download', [ProposalDipaPenelitianController::class, 'download'])->name('proposal_dipa_penelitian.download');
Route::get('proposal_dipa_penelitian/metadata', [ProposalDipaPenelitianController::class, 'metadata'])->name('proposal_dipa_penelitian.metadata');
Route::get('proposal_dipa_penelitian/metadata/download', [ProposalDipaPenelitianController::class, 'exportMetadata'])->name('proposal_dipa_penelitian.metadata.download');

Route::resource('proposal_dipa_pengabdian', ProposalDipaPengabdianController::class);
Route::get('proposal_dipa_pengabdian/{id}/download', [ProposalDipaPengabdianController::class, 'download'])->name('proposal_dipa_pengabdian.download');
Route::get('proposal_dipa_pengabdian/metadata', [ProposalDipaPengabdianController::class, 'metadata'])->name('proposal_dipa_pengabdian.metadata');
Route::get('proposal_dipa_pengabdian/metadata/download', [ProposalDipaPengabdianController::class, 'exportMetadata'])->name('proposal_dipa_pengabdian.metadata.download');

// Proposal Pusat
Route::resource('proposal_pusat_penelitian', ProposalPusatPenelitianController::class);
Route::get('proposal_pusat_penelitian/{id}/download', [ProposalPusatPenelitianController::class, 'download'])->name('proposal_pusat_penelitian.download');
Route::get('proposal_pusat_penelitian/metadata', [ProposalPusatPenelitianController::class, 'metadata'])->name('proposal_pusat_penelitian.metadata');
Route::get('proposal_pusat_penelitian/metadata/download', [ProposalPusatPenelitianController::class, 'exportMetadata'])->name('proposal_pusat_penelitian.metadata.download');

Route::resource('proposal_pusat_pengabdian', ProposalPusatPengabdianController::class);
Route::get('proposal_pusat_pengabdian/{id}/download', [ProposalPusatPengabdianController::class, 'download'])->name('proposal_pusat_pengabdian.download');
Route::get('proposal_pusat_pengabdian/metadata', [ProposalPusatPengabdianController::class, 'metadata'])->name('proposal_pusat_pengabdian.metadata');
Route::get('proposal_pusat_pengabdian/metadata/download', [ProposalPusatPengabdianController::class, 'exportMetadata'])->name('proposal_pusat_pengabdian.metadata.download');

// Proposal Mandiri
Route::resource('proposal_mandiri_penelitian', ProposalMandiriPenelitianController::class);
Route::get('proposal_mandiri_penelitian/{id}/download', [ProposalMandiriPenelitianController::class, 'download'])->name('proposal_mandiri_penelitian.download');
Route::get('proposal_mandiri_penelitian/metadata', [ProposalMandiriPenelitianController::class, 'metadata'])->name('proposal_mandiri_penelitian.metadata');
Route::get('proposal_mandiri_penelitian/metadata/download', [ProposalMandiriPenelitianController::class, 'exportMetadata'])->name('proposal_mandiri_penelitian.metadata.download');

Route::resource('proposal_mandiri_pengabdian', ProposalMandiriPengabdianController::class);
Route::get('proposal_mandiri_pengabdian/{id}/download', [ProposalMandiriPengabdianController::class, 'download'])->name('proposal_mandiri_pengabdian.download');
Route::get('proposal_mandiri_pengabdian/metadata', [ProposalMandiriPengabdianController::class, 'metadata'])->name('proposal_mandiri_pengabdian.metadata');
Route::get('proposal_mandiri_pengabdian/metadata/download', [ProposalMandiriPengabdianController::class, 'exportMetadata'])->name('proposal_mandiri_pengabdian.metadata.download');

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
