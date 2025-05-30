@extends('tampilan.main')

@section('content')
<div class="container">
    <h2>Daftar Anggaran Penelitian</h2>
    <a href="{{ route('anggaran_penelitian.create') }}" class="btn btn-primary mb-3">+ Tambah Penelitian</a>

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('anggaran_penelitian.index') }}">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2 @if(session('search_error')) is-invalid @endif" 
                placeholder="Cari anggaran penelitian..." 
                value="{{ request('search') }}"
            >
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Penelitian</th>
                    <th>Peneliti</th>
                    <th>Tahun</th>
                    <th>Jenis Arsip</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $item->judul_penelitian }}</td>
                    <td>{{ $item->peneliti }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->jenisArsip->jenis}}</td>
                    <td>
                        {{-- Tombol Aksi --}}
                        <a href="{{ route('anggaran_penelitian.show', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        <a href="{{ route('anggaran_penelitian.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('anggaran_penelitian.destroy', $item->id) }}" method="POST" style="display:inline;">
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
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
