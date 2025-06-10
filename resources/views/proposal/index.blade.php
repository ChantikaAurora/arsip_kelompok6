@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    {{-- Judul --}}
    <h3 class="mb-4">Daftar Proposal Penelitian</h3>

    {{-- Tombol Tambah Proposal --}}
    <a href="{{ route('proposal.create') }}" class="btn btn-primary mb-3">+ Tambah Proposal</a>



    {{-- Form Pencarian --}}
    <form action="{{ route('proposal.index') }}" method="GET" class="mb-3 d-flex justify-content-end">
        <input type="text" name="search" class="form-control w-25 me-2" placeholder="Cari judul / peneliti / tanggal
    ..." value="{{ request('search') }}">
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
                                        <th>Tanggal Pengajuan</th>
                    <th>Judul</th>
                    <th>Peneliti</th>
                    <th>Jurusan</th>
                    <th>Jenis</th>
                    <!-- <th>Tahun Pengajuan</th>
                    <th>Status</th>
                    <th>Dana yang Diajukan</th>
                    <th>Keterangan</th> -->
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proposal as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                                                <!-- <td class="text-center">{{ $item->tanggal_pengajuan }}</td> -->
                                                 <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('Y-m-d') }}</td>


                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->peneliti }}</td>
                        <td>{{ $item->jurusan }}</td>
                        <td>{{ $item->jenisArsip->jenis ?? '-' }}</td>
                        <!-- <td class="text-center">{{ $item->tahun_pengajuan }}</td>
                        <td class="text-center">{{ $item->status }}</td>
                        <td class="text-end">Rp {{ number_format($item->dana_diajukan, 0, ',', '.') }}</td>
                        <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $item->keterangan }}">
                            {{ Str::limit($item->keterangan, 50) }} -->
                        </td>
                        <td class="text-center">
                            @if($item->file_proposal)
                                <a href="{{ route('proposal.download', [$item->id, 'preview' => 1]) }}" target="_blank" class="text-primary">
                                    {{ basename($item->file_proposal) }}
                                </a>
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('proposal.show', $item->id) }}" class="btn btn-info btn-sm mb-1">Detail</a>
                            <a href="{{ route('proposal.edit', $item->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            <form action="{{ route('proposal.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus proposal ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">Belum ada data proposal.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Navigasi halaman (aktif jika pakai paginate di controller) --}}
    {{-- {{ $proposal->links() }} --}}
</div>
@endsection
