@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('content')

{{-- Judul Halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center">
        <i class="bi bi-journal-text text-primary fs-3 me-2"></i>
        <div>
            <h3 class="mb-0 fw-semibold">Metadata Laporan Akhir Pengabdian</h3>
            <p class="text-muted mb-0">Rekapitulasi data laporan akhir kegiatan pengabdian yang telah diinputkan.</p>
        </div>
    </div>
</div>

{{-- Tombol Aksi --}}
<div class="d-flex justify-content-between mb-3">
    <div class="d-flex gap-2">
        {{-- Tombol Kembali --}}
        <a href="{{ route('laporan_akhir_pengabdian.index') }}" class="btn btn-secondary shadow-sm d-inline-flex align-items-center">
            <i class="icon-action-undo align-middle mr-1"></i>Kembali
        </a>

        {{-- Tombol Unduh --}}
        <a href="{{ route('laporan_akhir_pengabdian.metadata.export', ['search' => request('search')]) }}" class="btn btn-success shadow-sm d-inline-flex align-items-center" style="margin-left: 0.5rem;">
            <i class="icon-cloud-download me-1 align-middle mr-1"></i>Unduh Excel
        </a>
    </div>
</div>

{{-- Validasi pencarian --}}
@if (session('search_error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i> {{ session('search_error') }}
    </div>
@endif

{{-- Form Pencarian --}}
<div class="d-flex justify-content-end mb-3">
    <form class="d-flex" method="GET" action="{{ route('laporan_akhir_pengabdian.metadata') }}">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari laporan akhir..." value="{{ request('search') }}">
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
                <th>Judul Kegiatan</th>
                <th>Skema</th>
                <th>Tahun</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $i => $item)
                <tr class="align-middle text-center">
                    <td>{{ ($laporan->currentPage() - 1) * $laporan->perPage() + $loop->iteration }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 120px;">{{ $item->id_laporan_akhir }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 220px;">{{ $item->judul_kegiatan }}</td>
                    <td>{{ optional($item->skemaRelasi)->skema_penelitian ?? '-' }}</td>
                    <td>{{ $item->tahun_pelaksanaan }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada data laporan ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Navigasi Halaman --}}
<div class="d-flex justify-content-end mt-3">
    {{ $laporan->withQueryString()->links() }}
</div>

@endsection
