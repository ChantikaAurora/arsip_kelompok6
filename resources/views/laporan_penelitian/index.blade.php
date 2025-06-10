@extends('tampilan.main')

@section('content')
<div class="container">
    <h2>Daftar Laporan Penelitian</h2>
    {{-- Tombol Tambah --}}
    <a href="{{ route('laporan_penelitian.create') }}" class="btn btn-primary mb-3">+ Tambah Laporan</a>

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('laporan_penelitian.index') }}">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2 @if(session('search_error')) is-invalid @endif" 
                placeholder="Cari laporan penelitian..." 
                value="{{ request('search') }}"
            >
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel  --}}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Penelitian</th>
                    <th>Peneliti</th>
                    <th>Jenis</th>
                    <th>Jurusan</th>
                     <th>file</th> 
                    <th>Aksi</th>
                 
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan_penelitians as $index => $laporan_penelitian)
                <tr>
                    {{-- <td>{{ $laporan_penelitians->firstItem() + $loop->index }}</td> --}}
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $laporan_penelitian->judul_penelitian }}</td>
                    <td>{{ $laporan_penelitian->peneliti }}</td>
                    <td>{{ $laporan_penelitian->jenisArsip->jenis }}</td>
                    <td>{{ $laporan_penelitian->jurusan }}</td>
                    <td>
                        {{-- Tombol Aksi --}}
                        <a href="{{ route('laporan_penelitian.show', $laporan_penelitian->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        <a href="{{ route('laporan_penelitian.edit', $laporan_penelitian->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('laporan_penelitian.destroy', $laporan_penelitian->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Link pagination --}}
    <div class="d-flex justify-content-center">
        {{ $laporan_penelitians->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
