@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h4>Daftar Metadata Laporan Kemajuan Pengabdian</h4>

    <a href="{{ route('laporan_kemajuan_pengabdian.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>
    <a href="{{ route('laporan_kemajuan_pengabdian.metadata.export', ['search' => request('search')]) }}" class="btn btn-outline-success mb-3">
        ⬇ Export ke Excel
    </a>

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">{{ session('search_error') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('laporan_kemajuan_pengabdian.metadata') }}">
            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Cari laporan kemajuan..."
                value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr class="text-center">
                <th style="width: 50px;">No</th>
                <th style="width: 200px;">Judul Kegiatan</th>
                <th style="width: 150px;">Nama Ketua</th>
                <th style="width: 150px;">Skema</th>
                <th style="width: 100px;">Tahun</th>
                <th style="width: 120px;">Periode</th>
                <th style="width: 180px;">Tanggal Input</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($laporan as $item)
            <tr>
                <td class="text-center">{{ ($laporan->currentPage() - 1) * $laporan->perPage() + $loop->iteration }}</td>
                <td style="white-space: normal; word-wrap: break-word; max-width: 250px;">{{ $item->judul_kegiatan }}</td>
                <td style="white-space: normal; word-wrap: break-word;">{{ $item->nama_ketua }}</td>
                <td style="white-space: normal; word-wrap: break-word;">{{ $item->skemaRelasi->skema_pengabdian ?? '-' }}</td>
                <td class="text-center">{{ $item->tahun_pelaksanaan }}</td>
                <td class="text-center">{{ $item->periode_laporan }}</td>
                <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada data metadata laporan kemajuan pengabdian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $laporan->withQueryString()->links() }}
    </div>
</div>
@endsection
