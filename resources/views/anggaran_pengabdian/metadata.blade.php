@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('navAnggaranPengabdian', 'active')
@section('content')

{{-- Judul Halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center">
        <i class="bi bi-cash-stack text-primary fs-3 me-2"></i>
        <div>
            <h3 class="mb-0 fw-semibold">Metadata Laporan Keuangan Pengabdian</h3>
            <p class="text-muted mb-0">Rekapitulasi data laporan keuangan pengabdian yang tercatat.</p>
        </div>
    </div>
</div>

{{-- Tombol Navigasi --}}
<div class="d-flex justify-content-between mb-3">
    <div class="d-flex gap-2">
        <a href="{{ route('anggaran_pengabdian.index') }}" class="btn btn-secondary shadow-sm d-inline-flex align-items-center">
            <i class="icon-action-undo me-1 mr-1"></i>Kembali
        </a>
        <a href="{{ route('anggaran_pengabdian.metadata.export', ['search' => request('search')]) }}" class="btn btn-success shadow-sm d-inline-flex align-items-center" style="margin-left: 0.5rem;">
            <i class="icon-cloud-download me-1 mr-1"></i>Unduh Excel
        </a>
    </div>
</div>

{{-- Validasi input pencarian --}}
@if (session('search_error'))
    <div class="alert alert-danger">
        {{ session('search_error') }}
    </div>
@endif

{{-- Form Pencarian --}}
<div class="d-flex justify-content-end mb-3">
    <form method="GET" action="{{ route('anggaran_pengabdian.metadata') }}" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Filter laporan keuangan..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i> Cari
        </button>
    </form>
</div>

{{-- Tabel Metadata --}}
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-light text-center align-middle">
            <tr>
                <th>No</th>
                <th>Kode Klasifikasi</th>
                <th>Kegiatan</th>
                <th>Volume Usulan</th>
                <th>Nominal</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($anggaran as $i => $item)
                <tr class="text-center align-middle">
                    <td>{{ $anggaran->firstItem() + $i }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $item->kode }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 300px;">{{ $item->kegiatan }}</td>
                    <td>{{ $item->volume_usulan }}</td>
                    <td class="text-end">{{ number_format($item->total_anggaran, 0, ',', '.') }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada data metadata laporan keuangan ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-end mt-3">
    {{ $anggaran->withQueryString()->links('pagination::bootstrap-5') }}
</div>

@endsection
