@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h4>Daftar Metadata Laporan Keuangan Pengabdian</h4>
    <a href="{{ route('anggaran_pengabdian.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>
    <a href="{{ route('anggaran_pengabdian.metadata.export', ['search' => request('search')]) }}" class="btn btn-outline-success mb-3">⬇ Export ke Excel</a>

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">{{ session('search_error') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('anggaran_pengabdian.metadata') }}">
            <input
                type="text"
                name="search"
                class="form-control me-2 text-center"
                placeholder="Cari"
                value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr class="text-center">
                <th style="width: 50px;">No</th>
                <th style="width: 150px;">Kode Klasifikasi</th>
                <th>Kegiatan</th>
                <th style="width: 120px;">Volume Usulan</th>
                <th style="width: 150px;">Nominal</th>
                <th style="width: 180px;">Tanggal Input</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($anggaran as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">{{ $item->kode }}</td>
                <td style="white-space: normal; word-wrap: break-word; max-width: 300px;">{{ $item->kegiatan }}</td>
                <td class="text-center">{{ $item->volume_usulan }}</td>
                <td class="text-end">{{ number_format($item->total_anggaran, 0, ',', '.') }}</td>
                <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>

            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada data metadata laporan keuangan pengabdian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <!-- Tambahkan pagination -->
    <div class="d-flex justify-content-end">
        {{ $anggaran->links() }}
    </div>
</div>

@endsection
