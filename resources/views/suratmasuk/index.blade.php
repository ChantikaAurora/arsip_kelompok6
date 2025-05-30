@extends('tampilan.main')

@section('content')

<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Surat Masuk</h3>

    {{-- Tombol Tambah Surat Masuk --}}
    <div class="mb-4">
        <a href="{{ route('suratmasuk.create') }}" class="btn btn-primary">+ Tambah Surat Masuk</a>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">
            {{ session('search_error') }}
        </div>
    @endif

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('suratmasuk.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari surat masuk..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel Data Surat Masuk --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover ">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Perihal</th>
                    <th>Jenis Arsip</th>
                    <th>File</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suratmasuks as $suratmasuk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $suratmasuk->nomor_surat }}</td>
                        <td>{{ $suratmasuk->perihal }}</td>
                        <td>{{ $suratmasuk->jenisArsip->jenis }}</td>
                        <td>
                            @if ($suratmasuk->file)
                                <a href="{{ Storage::url($suratmasuk->file) }}" target="_blank">
                                    {{ basename($suratmasuk->file) }}
                                </a>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('suratmasuk.detail', $suratmasuk->id) }}" class="btn btn-sm btn-primary">Detail</a>
                            <a href="{{ route('suratmasuk.edit', $suratmasuk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('suratmasuk.destroy', $suratmasuk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Belum ada data surat masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $suratmasuks->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
