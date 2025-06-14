@extends('tampilan.main')

@section('navProdi', 'active')
@section('content')

<div class="container mt-4">
    <h3 class="mb-3">Manajemen Program Studi</h3>

    {{-- Tombol Tambah --}}
    <div class="mb-4">
        <a href="{{ route('prodi.create') }}" class="btn btn-primary">+ Tambah Prodi</a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('prodi.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari prodi..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel Prodi --}}
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Jurusan</th>
                <th>Kode Prodi</th>
                <th>Prodi</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($prodis as $prodi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $prodi->jurusan->jurusan }}</td>
                    <td>{{ $prodi->kode_prodi }}</td>
                    <td>{{ $prodi->prodi }}</td>
                    <td class="text-center">
                        <a href="{{ route('prodi.edit', $prodi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('prodi.destroy', $prodi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada data prodi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
