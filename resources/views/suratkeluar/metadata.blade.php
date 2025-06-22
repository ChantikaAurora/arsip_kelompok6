@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Daftar Metadata Surat Keluar</h4>

    {{-- Tombol kembali & export --}}
    <div class="d-flex justify-content-between align-items-center mb-2">
        <a href="{{ route('suratkeluar.index') }}" class="btn btn-secondary">← Kembali</a>
        <a href="{{ route('suratkeluar.metadata.export', ['search' => request('search')]) }}" class="btn btn-success">
            📁 Download Excel
        </a>
    </div>

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('suratkeluar.metadata') }}" class="d-flex justify-content-end">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari surat keluar..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Nomor Agenda</th>
                    <th>Kode Klasifikasi</th>
                    <th>Tanggal</th>
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
                @foreach ($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nomor_surat }}</td>
                    <td>{{ $item->nomor_agenda ?? '-' }}</td>
                    <td>{{ $item->kode_klasifikasi }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y') }}</td>
                    <td>{{ $item->tujuan_surat }}</td>
                    <td>{{ $item->penerima }}</td>
                    <td>{{ $item->perihal }}</td>
                    <td>{{ $item->lampiran ?? '-' }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td>{{ $item->jenisArsip->jenis ?? '-' }}</td>
                    <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
