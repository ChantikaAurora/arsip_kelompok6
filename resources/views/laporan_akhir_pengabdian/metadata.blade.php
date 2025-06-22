@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h4>Daftar Metadata Laporan Akhir Pengabdian</h4>

    <a href="{{ route('laporan_akhir_pengabdian.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>
    <a href="{{ route('laporan_akhir_pengabdian.metadata.export', ['search' => request('search')]) }}" class="btn btn-outline-success mb-3">
        ⬇ Export ke Excel
    </a>

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">{{ session('search_error') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('laporan_akhir_pengabdian.metadata') }}">
            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Cari laporan akhir..."
                value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr class="text-center">
                <th style="width: 50px;">No</th>
                <th style="width: 50px;">Kode Klasifikasi</th>
                <th style="width: 200px;">Judul Kegiatan</th>
                <th style="width: 150px;">Skema</th>
                <th style="width: 100px;">Tahun</th>
                <th style="width: 180px;">Tanggal Input</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($laporan as $item)
            <tr>
                <td class="text-center">{{ ($laporan->currentPage() - 1) * $laporan->perPage() + $loop->iteration }}</td>
                <td style="white-space: normal; word-wrap: break-word; max-width: 250px;">{{ $item->id_laporan_akhir }}</td>
                <td style="white-space: normal; word-wrap: break-word; max-width: 250px;">{{ $item->judul_kegiatan }}</td>
                <td style="white-space: normal; word-wrap: break-word;">{{ optional($item->skemaRelasi)->skema_penelitian ?? '-' }}</td>
                <td class="text-center">{{ $item->tahun_pelaksanaan }}</td>
                <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data metadata laporan akhir pengabdian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $laporan->withQueryString()->links() }}
    </div>
</div>
@endsection
