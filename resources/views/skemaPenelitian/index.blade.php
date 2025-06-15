@extends('tampilan.main')

@section('navSkema', 'active')
@section('content')

<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Skema Penelitian</h3>

    {{-- Tombol Tambah --}}
    <div class="mb-4">
        <a href="{{ route('skemaPenelitian.create') }}" class="btn btn-primary">+ Tambah Skema</a>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('skemaPenelitian.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari skema..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Validasi pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">
            {{ session('search_error') }}
        </div>
    @endif

    {{-- Tabel --}}
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Skema Penelitian</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($skemas as $skema)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td >{{ $skema->skema_penelitian }}</td>
                <td class="text-center">
                    <a href="{{ route('skemaPenelitian.edit', $skema->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('skemaPenelitian.destroy', $skema->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus skema ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada data skema.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
