@extends('tampilan.main')

@section('content')

<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Laporan Akhir Penelitian</h3>

    {{-- Tombol Tambah dan Cetak Metadata --}}
    <div class="mb-4">
        <a href="{{ route('laporan_akhir_penelitian.create') }}" class="btn btn-primary">+ Tambah Laporan</a>
        <a href="{{ route('laporan_akhir_penelitian.metadata') }}" class="btn btn-success">📄 Cetak Metadata</a>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">{{ session('search_error') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('laporan_akhir_penelitian.index') }}">
            <input
                type="text"
                name="search"
                class="form-control me-2 text-center"
                placeholder="Cari"
                value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel Data Laporan Akhir Penelitian --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Klasifikasi</th>
                    <th>Judul Kegiatan</th>
                    <th>Skema</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                    <tr class="text-center">
                        <td>{{ ($laporan->currentPage() - 1) * $laporan->perPage() + $loop->iteration }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 250px;">{{ $item->id_laporan_akhir }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 250px;">{{ $item->judul_kegiatan }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $item->skemaRelasi->skema_penelitian ?? '-' }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 50px;">{{ $item->tahun_pelaksanaan }}</td>
                        <td class="text-center" style="white-space: normal; word-wrap: break-word; max-width: 300px;">
                            <a href="{{ route('laporan_akhir_penelitian.download', $item->id_laporan_akhir) }}" class="btn btn-sm btn-success">Unduh</a>
                            <a href="{{ route('laporan_akhir_penelitian.show', $item->id_laporan_akhir) }}" class="btn btn-sm btn-primary">Detail</a>
                            <a href="{{ route('laporan_akhir_penelitian.edit', $item->id_laporan_akhir) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('laporan_akhir_penelitian.destroy', $item->id_laporan_akhir) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data laporan akhir penelitian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end">
        {{ $laporan->withQueryString()->links() }}
    </div>
</div>

@endsection
