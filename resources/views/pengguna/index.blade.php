@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Pengguna</h3>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol Tambah Pengguna --}}
    <div class="mb-4">
        <a href="{{ route('pengguna.create') }}" class="btn btn-primary">+ Tambah Pengguna</a>
    </div>

    {{-- Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('pengguna.index') }}">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2 @if(session('search_error')) is-invalid @endif" 
                placeholder="Cari pengguna..." 
                value="{{ request('search') }}"
            >
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">
            {{ session('search_error') }}
        </div>
    @endif

    {{-- Tabel --}}
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengguna as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role }}</td>
                    <td class="text-center">
                        <a href="{{ route('pengguna.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ route('pengguna.destroy', $item->id) }}" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Pengguna tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $pengguna->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
