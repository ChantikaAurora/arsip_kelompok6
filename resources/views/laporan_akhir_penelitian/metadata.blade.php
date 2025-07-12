@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('navLaporanAkhirPenelitian', 'active')
@section('content')

{{-- Judul Halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center">
        <i class="bi bi-journal-text text-primary fs-3 me-2"></i>
        <div>
            <h3 class="mb-0 fw-semibold">Metadata Laporan Akhir Penelitian</h3>
            <p class="text-muted mb-0">Rekapitulasi data laporan akhir penelitian yang tercatat.</p>
        </div>
    </div>
</div>

{{-- Tombol Navigasi --}}
<div class="d-flex justify-content-between mb-3">
    <div class="d-flex gap-2">
        <a href="{{ route('laporan_akhir_penelitian.index') }}" class="btn btn-secondary shadow-sm d-inline-flex align-items-center">
            <i class="icon-action-undo align-middle mr-1"></i>Kembali
        </a>
        <a href="{{ route('laporan_akhir_penelitian.metadata.export', ['search' => request('search')]) }}" class="btn btn-success shadow-sm d-inline-flex align-items-center" style="margin-left: 0.5rem;">
            <i class="icon-cloud-download me-1 align-middle mr-1"></i>Unduh Excel
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
    <form method="GET" action="{{ route('laporan_akhir_penelitian.metadata') }}" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Filter laporan akhir..." value="{{ request('search') }}">
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
                <th>Judul Kegiatan</th>
                <th>Skema</th>
                <th>Tahun</th>
                <th>Tanggal Upload</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $i => $item)
                <tr class="text-center align-middle">
                    <td>{{ $laporan->firstItem() + $i }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">{{ $item->judul_kegiatan }}</td>
                    <td>{{ $item->skemaRelasi->skema_penelitian ?? '-' }}</td>
                    <td>{{ $item->tahun_pelaksanaan }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data metadata laporan ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-end mt-3">
    {{ $laporan->withQueryString()->links('pagination::bootstrap-5') }}
</div>

@endsection
