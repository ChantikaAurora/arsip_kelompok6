@extends('tampilan.main')

@section('navJenisArsip', 'active')
@section('content')

<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Jenis Arsip</h3>

    {{-- Tombol Tambah Jenis Arsip --}}
    <div class="mb-4">
        <a href="{{ route('jenisarsip.create') }}" class="btn btn-primary">+ Tambah Jenis Arsip</a>
    </div>

    {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    {{-- Pencarian di kanan atas --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('jenisarsip.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari jenis arsip..." value="{{ request('search') }}">
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
                <th>No</th>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jenisarsips as $jenisarsip)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $jenisarsip->jenis }}</td>
                <td>{{ $jenisarsip->keterangan }}</td>
                <td class="text-center">
                    <a href="{{ route('jenisarsip.edit', $jenisarsip->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('jenisarsip.destroy', $jenisarsip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data jenis arsip.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    {{-- <div class="d-flex justify-content-center">
        {{ $jenisarsips->links('pagination::bootstrap-5') }}
    </div> --}}
</div>
@endsection
