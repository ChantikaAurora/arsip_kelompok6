@extends('tampilan.navbar')
@section('page-title', 'Proposal')
@section('content')

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-journal-text text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Metadata Proposal Mandiri Penelitian</h3>
                <p class="text-muted mb-0">Rekapitulasi data dari proposal mandiri penelitian yang tercatat.</p>
            </div>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex gap-2">
            {{-- Tombol Kembali --}}
            <a href="{{ route('proposal_mandiri_penelitian.index') }}" class="btn btn-secondary shadow-sm d-inline-flex align-items-center">
                 <i class="icon-action-undo align-middle mr-1"></i>Kembali
            </a>

            {{-- Tombol Unduh --}}
            <a href="{{ route('proposal_mandiri_penelitian.metadata.download', ['search' => request('search')]) }}" class="btn btn-success shadow-sm d-inline-flex align-items-center ms-2" style="margin-left: 0.5rem;">
               <i class="icon-cloud-download me-1 align-middle mr-1"></i>Unduh Excel
            </a>
        </div>
    </div>

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('proposal_mandiri_penelitian.metadata') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Filter data proposal..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>

    {{-- Tabel Metadata --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr class="text-center align-middle">
                    <th>No</th>
                    <th>Kode Klasifikasi</th>
                    <th>Judul</th>
                    <th>Peneliti</th>
                    <th>Skema</th>
                    <th>Anggota</th>
                    <th>Jurusan</th>
                    <th>Prodi</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Upload</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $i => $item)
                    <tr class="text-center align-middle">
                        <td>{{ $i + 1 }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 120px;">{{ $item->kode_klasifikasi }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 180px;">{{ $item->judul }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $item->peneliti }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">{{ $item->skemaPenelitian->skema_penelitian ?? '-' }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $item->anggota ?? '-' }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $item->jurusan->jurusan ?? '-' }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $item->prodi->prodi ?? '-' }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted">Tidak ada data proposal ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
