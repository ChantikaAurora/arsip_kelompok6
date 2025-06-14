@extends('tampilan.main')

@section('content')

<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Anggaran Pengabdian</h3>

    {{-- Tombol Tambah Anggaran Pengabdian --}}
    <div class="mb-4">
        <a href="{{ route('anggaran_pengabdian.create') }}" class="btn btn-primary">+ Tambah Anggaran Pengabdian</a>
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
        <form class="d-flex" method="GET" action="{{ route('anggaran_pengabdian.index') }}">
            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Cari anggaran pengabdian..."
                value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel Data Anggaran Pengabdian --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode</th>
                    <th>Kegiatan</th>
                    <th>Volume Usulan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggaran as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->kegiatan }}</td>
                        <td>{{ $item->volume_usulan }}</td>
                        <td class="text-center">
                            <a href="" class="btn btn-sm btn-secondary">Lihat</a>
                            <a href="" class="btn btn-sm btn-success">Unduh</a>
                            <a href="{{ route('anggaran_pengabdian.show', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                            <a href="{{ route('anggaran_pengabdian.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('anggaran_pengabdian.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data anggaran pengabdian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    {{-- <div class="d-flex justify-content-center">
        {{ $anggaran->links('pagination::bootstrap-5') }}
    </div> --}}
</div>

@endsection
