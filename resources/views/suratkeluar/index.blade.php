@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Surat Keluar</h3>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol Tambah Surat Keluar dan Cetak Metadata --}}
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex gap-2">
            <a href="{{ route('suratkeluar.create') }}" class="btn btn-primary">+ Tambah Surat</a>
            <a href="{{ route('suratkeluar.metadata') }}" class="btn btn-success">📄 Cetak Metadata</a>
        </div>
    </div>

    {{-- Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('suratkeluar.index') }}">
            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Cari judul surat..."
                value="{{ request('search') }}"
            >
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    {{-- <th>Tanggal Surat</th>
                    <th>Tujuan Surat</th> --}}
                    <th>Perihal</th>
                    {{-- <th>Pengirim</th>
                    <th>Penerima</th> --}}
                    <th>Jenis</th>
                    <th>File</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + $data->firstItem() }}</td>
                        <td>{{ $item->nomor_surat }}</td>
                        <td>{{ $item->perihal }}</td>
                        <td>{{ $item->jenisArsip->jenis ?? '-' }}</td>
                        <td>
                            @if ($item->file)
                                <a href="{{ route('suratkeluar.download', $item->id) }}" target="_blank">
                                    {{ basename($item->file) }}
                                </a>
                            @else
                                <em>Tidak ada file</em>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('suratkeluar.show', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            <a href="{{ route('suratkeluar.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('suratkeluar.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if ($data->isEmpty())
                    <tr>
                        <td colspan="10" class="text-center">Surat keluar tidak ditemukan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    {{-- <div class="d-flex justify-content-end">
        {{ $suratmasuks->withQueryString()->links() }}
    </div> --}}
</div>
@endsection
