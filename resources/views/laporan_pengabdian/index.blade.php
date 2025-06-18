@extends('tampilan.main')

@section('content')
<div class="container">
    <h3>Daftar Laporan Akhir Pengabdian</h3>
    {{-- Tombol Tambah --}}
    <a href="{{ route('laporan_pengabdian.create') }}" class="btn btn-primary mb-3">+ Tambah Laporan</a>

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('laporan_pengabdian.index') }}">
            <input
                type="text"
                name="search"
                class="form-control me-2 @if(session('search_error')) is-invalid @endif"
                placeholder="Cari laporan pengabdian..."
                value="{{ request('search') }}"
            >
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel  --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode seri</th>
                    <th>Judul</th>
                    <th>Nama Peneliti</th>
                    <th>Jurusan </th>
                    <th>Skema</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($laporan_pengabdians as $index => $laporan_pengabdian)
                <tr>
                    {{-- <td>{{ $laporan_penelitians->firstItem() + $loop->index }}</td> --}}
                    <td>{{ $loop->iteration}}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 100px;">{{ $laporan_pengabdian->kode_seri }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">{{ $laporan_pengabdian->judul }}</td>
                    <td style="white-space: normal; max-width: 100px;">{{ $laporan_pengabdian->peneliti }}</td>
                    <td style="white-space: normal; max-width: 100px;">{{ $laporan_pengabdian->jurusan }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">{{ $laporan_pengabdian->skema }}</td>
                    <td>
                        {{-- Tombol Aksi --}}
                        <a href="{{ route('laporan_pengabdian.download', ['id' => $laporan_pengabdian->id, 'preview' => 1]) }}" target="_blank" class="btn btn-sm btn-secondary">Lihat</a>
                        <a href="{{ route('laporan_pengabdian.download', $laporan_pengabdian->id) }}" class="btn btn-sm btn-success">Unduh</a>
                        <a href="{{ route('laporan_pengabdian.show', $laporan_pengabdian->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        <a href="{{ route('laporan_pengabdian.edit', $laporan_pengabdian->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('laporan_pengabdian.destroy', $laporan_pengabdian->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">Belum ada data laporan akhir pengabdian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Link pagination --}}
    <div class="d-flex justify-content-center">
        {{ $laporan_pengabdians->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
