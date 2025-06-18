@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h4>Daftar Metadata Surat Keluar</h4>
    <a href="{{ route('suratkeluar.metadata.export') }}" class="btn btn-outline-success mb-3">⬇ Export ke Excel</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tanggal</th>
                <th>Tujuan</th>
                <th>Perihal</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Jenis Arsip</th>
                <th>Waktu Upload</th>
                <th>Diunggah oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nomor_surat }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y') }}</td>
                <td>{{ $item->tujuan_surat }}</td>
                <td>{{ $item->perihal }}</td>
                <td>{{ $item->pengirim }}</td>
                <td>{{ $item->penerima }}</td>
                <td>{{ $item->jenisArsip->jenis ?? '-' }}</td>
                <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                <td>{{ $item->user->name ?? '-' }}</td> <!-- asumsi relasi ke User -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
