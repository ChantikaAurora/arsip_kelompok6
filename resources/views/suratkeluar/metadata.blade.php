@extends('tampilan.navbar')
@section('page-title', 'Surat Keluar')
@section('content')

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-journal-arrow-up text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Metadata Surat Keluar</h3>
                <p class="text-muted mb-0">Rekapitulasi data dari surat keluar yang tercatat.</p>
            </div>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex gap-2">
            {{-- Tombol Kembali --}}
            <a href="{{ route('suratkeluar.index') }}" class="btn btn-secondary shadow-sm d-inline-flex align-items-center">
                <i class="icon-action-undo align-middle mr-1"></i>Kembali
            </a>

            {{-- Tombol Unduh --}}
            <a href="{{ route('suratkeluar.metadata.export', ['search' => request('search')]) }}" class="btn btn-success shadow-sm d-inline-flex align-items-center" style="margin-left: 0.5rem;">
                <i class="icon-cloud-download me-1 align-middle mr-1"></i>Unduh Excel
            </a>
        </div>
    </div>

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('suratkeluar.metadata') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="filter data surat keluar..." value="{{ request('search') }}">
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
                    <th>Nomor Surat</th>
                    <th>Nomor Agenda</th>
                    <th>Kode Klasifikasi</th>
                    <th>Tanggal Surat</th>
                    <th>Tujuan</th>
                    <th>Penerima</th>
                    <th>Perihal</th>
                    <th>Lampiran</th>
                    <th>Keterangan</th>
                    <th>Jenis Arsip</th>
                    <th>Waktu Upload</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $i => $item)
                    <tr class="text-center align-middle">
                        <td>{{ $i + 1 }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 180px;">{{ $item->nomor_surat }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $item->nomor_agenda ?? '-' }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 120px;">{{ $item->kode_klasifikasi }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 110px;">{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y') }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 160px;">{{ $item->tujuan_surat }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 160px;">{{ $item->penerima }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">{{ $item->perihal }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $item->lampiran ?? '-' }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 180px;">{{ $item->keterangan ?? '-' }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 130px;">{{ $item->jenisArsip->jenis ?? '-' }}</td>
                        <td style="white-space: normal; word-wrap: break-word; max-width: 140px;">{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted">Tidak ada data surat keluar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
