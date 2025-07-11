@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('content')

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-journal-text text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Metadata Laporan Kemajuan Pengabdian</h3>
                <p class="text-muted mb-0">Rekapitulasi data dari laporan kemajuan pengabdian masyarakat.</p>
            </div>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex gap-2">
            {{-- Tombol Kembali --}}
            <a href="{{ route('laporan_kemajuan_pengabdian.index') }}" class="btn btn-secondary shadow-sm d-inline-flex align-items-center">
                <i class="icon-action-undo align-middle mr-1"></i>Kembali
            </a>

            {{-- Tombol Unduh Excel --}}
            <a href="{{ route('laporan_kemajuan_pengabdian.metadata.export', ['search' => request('search')]) }}" class="btn btn-success shadow-sm d-inline-flex align-items-center ms-2" style="margin-left: 0.5rem;">
                 <i class="icon-cloud-download me-1 align-middle mr-1"></i>Unduh Excel
            </a>
        </div>
    </div>

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">{{ session('search_error') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('laporan_kemajuan_pengabdian.metadata') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Filter laporan kemajuan..." value="{{ request('search') }}">
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
                    <th>Nama Ketua</th>
                    <th>Skema</th>
                    <th>Tahun</th>
                    <th>Periode</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $index => $item)
                    <tr class="align-middle text-center">
                        <td>{{ $laporan->firstItem() + $loop->index }}</td>
                        <td style="white-space: normal; word-break: break-word; max-width: 250px;" class="text-start">{{ $item->judul_kegiatan }}</td>
                        <td style="white-space: normal; word-break: break-word;">{{ $item->nama_ketua }}</td>
                        <td style="white-space: normal;">{{ $item->skemaRelasi->skema_pengabdian ?? '-' }}</td>
                        <td>{{ $item->tahun_pelaksanaan }}</td>
                        <td>{{ $item->periode_laporan }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data metadata laporan kemajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end">
        {{ $laporan->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

@endsection
