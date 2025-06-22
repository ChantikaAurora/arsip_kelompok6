@extends('tampilan.main')
@section('title', 'Manajemen Surat Keluar')
@section('content')

<h2>Daftar Surat Keluar</h2>
<a href="{{ route('suratkeluar.create') }}" class="btn btn-primary mb-3">+ Tambah Surat Keluar</a>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr class="text-center">
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Nomor Agenda</th>
            <th>Kode Klasifikasi</th>
            <th>Tanggal Surat</th>
            <th>Tujuan Surat</th>
            <th>Penerima</th>
            <th>Perihal</th>
            <th>Jenis</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suratkeluars as $index => $surat)
            <tr>
                <td class="text-center">{{ $index + $suratkeluars->firstItem() }}</td>
                <td>{{ $surat->nomor_surat }}</td>
                <td>{{ $surat->nomor_agenda }}</td>
                <td>{{ $surat->kode_klasifikasi }}</td>
                <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</td>
                <td>{{ $surat->tujuan_surat }}</td>
                <td>{{ $surat->penerima }}</td>
                <td>{{ $surat->perihal }}</td>
                <td>{{ $surat->jenisArsip->jenis ?? '-' }}</td>
                <td>
                    @if ($surat->file)
                        <a href="{{ Storage::url($surat->file) }}" target="_blank">Lihat</a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('suratkeluar.edit', $surat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('suratkeluar.destroy', $surat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $suratkeluars->links('pagination::bootstrap-5') }}
</div>

@endsection
