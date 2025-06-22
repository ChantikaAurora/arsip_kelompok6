@extends('tampilan.main')

@section('content')

<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-3">Manajemen Proposal Mandiri pengabdian</h3>

    {{-- Tombol Tambah Proposal dan Cetak Metadata --}}
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex gap-2">
            <a href="{{ route('proposal_mandiri_pengabdian.create') }}" class="btn btn-primary">+ Tambah Proposal</a>
            <a href="{{ route('proposal_mandiri_pengabdian.metadata') }}" class="btn btn-success">📄 Cetak Metadata</a>
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
        <form class="d-flex" method="GET" action="{{ route('proposal_mandiri_pengabdian.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari proposal..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel Data Proposal --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr class="text-center">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Peneliti</th>
                    <th>Skema</th>
                    <th>Jurusan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proposals as $proposal)
                    <tr>
                        <td>{{ $loop->iteration + $proposals->firstItem() - 1 }}</td>
                        <td style="max-width: 250px; white-space: normal; word-wrap: break-word;">{{ $proposal->judul }}</td>
                        <td>{{ $proposal->peneliti }}</td>
                        <td>{{ $proposal->skemaPengabdian->skema_pengabdian ?? '-' }}</td>
                        <td>{{ $proposal->jurusan->jurusan ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('proposal_mandiri_pengabdian.download', $proposal->id) }}" class="btn btn-success btn-sm">Unduh</a>
                            <a href="{{ route('proposal_mandiri_pengabdian.show', $proposal->id) }}" class="btn btn-sm btn-primary">Detail</a>
                            <a href="{{ route('proposal_mandiri_pengabdian.edit', $proposal->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('proposal_mandiri_pengabdian.destroy', $proposal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data proposal.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $proposals->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
