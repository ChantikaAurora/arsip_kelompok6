@extends('tampilan.main')

@section('navJurusan', 'active')
@section('content')

<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Jurusan</h3>

    {{-- Tombol Tambah --}}
    <div class="mb-4">
        <a href="{{ route('jurusan.create') }}" class="btn btn-primary">+ Tambah Jurusan</a>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('jurusan.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari jurusan..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Validasi pencarian kosong --}}
    @if (session('search_error'))
        <div class="alert alert-danger">{{ session('search_error') }}</div>
    @endif

    {{-- Tabel --}}
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Kode Jurusan</th>
                <th>Nama Jurusan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jurusans as $jurusan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jurusan->kode_jurusan }}</td>
                    <td>{{ $jurusan->jurusan }}</td>
                    <td class="text-center">
                        <a href="{{ route('jurusan.edit', $jurusan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jurusan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data jurusan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination (jika diperlukan) --}}
    {{-- <div class="d-flex justify-content-center">
        {{ $jurusans->links('pagination::bootstrap-5') }}
    </div> --}}
</div>
@endsection
