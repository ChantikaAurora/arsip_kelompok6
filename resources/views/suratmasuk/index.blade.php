@extends('tampilan.main')

@section('content')

<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Surat Masuk</h3>

        {{-- Tombol Tambah Surat Masuk dan Cetak Metadata --}}
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex gap-2">
            <a href="{{ route('suratmasuk.create') }}" class="btn btn-primary">+ Tambah Surat Masuk</a>
            <a href="{{ route('suratmasuk.metadata') }}" class="btn btn-success">📄 Cetak Metadata</a>
        </div>
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
            <tr class="text-center">
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Kode Klasifikasi</th>
                <th>Perihal</th>
                <th>Lampiran</th>
                <th>Jenis Arsip</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suratmasuks as $suratmasuk)
                <tr>
                    <td>{{ $loop->iteration + $suratmasuks->firstItem() - 1 }}</td>
                    <td>{{ $suratmasuk->nomor_surat }}</td>
                    <td>{{ $suratmasuk->kode_klasifikasi }}</td>
                    <td>{{ $suratmasuk->perihal }}</td>
                    <td>{{ $suratmasuk->lampiran ?? '-' }}</td>
                    <td>{{ $suratmasuk->jenisArsip->jenis ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('suratmasuk.download', $suratmasuk->id) }}" class="btn btn-success btn-sm">Unduh</a>
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
                    <td colspan="13" class="text-center">Belum ada data surat masuk.</td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $suratmasuks->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
