@extends('tampilan.main')

@section('content')

<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Laporan Keuangan Penelitian</h3>

    {{-- Tombol Tambah Anggaran Penelitian --}}
    <div class="mb-4">
        <a href="{{ route('anggaran_penelitian.create') }}" class="btn btn-primary">+ Tambah Laporan</a>
       <a href="{{ route('anggaran_penelitian.metadata') }}" class="btn btn-success">📄 Cetak Metadata</a>

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
        <form class="d-flex" method="GET" action="{{ route('anggaran_penelitian.index') }}">
            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Cari anggaran penelitian..."
                value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel Data Anggaran Penelitian --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Klasifikasi</th>
                    <th>Kegiatan</th>
                    <th>Volume Usulan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggaran as $item)
                    <tr class="text-center">
                        <td>{{ ($anggaran->currentPage() - 1) * $anggaran->perPage() + $loop->iteration }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">{{ $item->kode }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 300px;">{{ $item->kegiatan }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 100px;">{{ $item->volume_usulan }}</td>
                        <td class="text-center">
                            <a href="{{ route('anggaran_penelitian.download', $item->id) }}" class="btn btn-sm btn-success">Unduh</a>
                            <a href="{{ route('anggaran_penelitian.show', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                            <a href="{{ route('anggaran_penelitian.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('anggaran_penelitian.destroy',  $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data laporan keuangan penelitian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end">
        {{ $anggaran->withQueryString()->links() }}
    </div>
</div>

@endsection
