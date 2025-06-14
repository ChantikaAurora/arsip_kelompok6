@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-4">Daftar Proposal Pengabdian</h3>

    {{-- Tombol Tambah Proposal --}}
    <a href="{{ route('proposalpengabdian.create') }}" class="btn btn-primary mb-3">+ Tambah Proposal</a>

    {{-- Form Pencarian --}}
    <form action="{{ route('proposalpengabdian.index') }}" method="GET" class="mb-3 d-flex justify-content-end">
        <input type="text" name="search" class="form-control w-25 me-2" placeholder="Cari judul / peneliti / tanggal..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Proposal --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Kode Seri</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Judul</th>
                    <th>Peneliti</th>
                    <th>Skema</th>
                    <th>Jurusan</th>
                    <th>Prodi</th>
                    <th>File</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proposal as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $item->kode_seri }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('Y-m-d') }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->peneliti }}</td>
                        <td>{{ $item->skema }}</td>
                        <td>{{ $item->jurusan->nama ?? '-' }}</td>
                        <td>{{ $item->prodi->nama ?? '-' }}</td>
                        <td class="text-center">
                            @if($item->file)
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-primary">
                                    {{ basename($item->file) }}
                                </a>
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>{{ $item->keterangan }}</td>
                        <td class="text-center">
                            <a href="{{ route('proposalpengabdian.show', $item->id) }}" class="btn btn-info btn-sm mb-1">Detail</a>
                            <a href="{{ route('proposalpengabdian.edit', $item->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            <form action="{{ route('proposalpengabdian.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus proposal ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Belum ada data proposal pengabdian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Navigasi halaman (jika menggunakan paginate) --}}
    {{-- {{ $proposal->links() }} --}}
</div>
@endsection
