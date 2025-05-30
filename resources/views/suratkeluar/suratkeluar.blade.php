@extends('tampilan.main')
@section('title', 'Manajemen Surat Keluar')
@section('content')

    <h2>Daftar Surat Keluar</h2>
    <a href="{{ route('suratkeluar.create') }}" class="btn btn-primary mb-3">+ Tambah Surat Keluar</a>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Tanggal Surat</th>
            <th>Tujuan Surat</th>
            <th>Perihal</th>
            <th>Pengirim</th>
            <th>Penerima</th>
            <th>Jenis</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>

        @foreach ($suratkeluars as $index => $surat)
            <tr>
                <td>{{ $index + $suratkeluars->firstItem() }}</td>
                <td>{{ $surat->nomor_surat }}</td>
                <td>{{ $surat->tanggal_surat }}</td>
                <td>{{ $surat->tujuan_surat }}</td>
                <td>{{ $surat->perihal }}</td>
                <td>{{ $surat->pengirim }}</td>
                <td>{{ $surat->penerima }}</td>
                <td>{{ $surat->jenisArsip->jenis ?? '-' }}</td>
                <td>
                    {{-- @if ($surat->file)
                        <a href="{{ route('suratkeluar.download', $surat->no) }}">Download</a>
                    @else
                        -
                    @endif --}}
                </td>
                <td class="text-center">
                    <a href="{{ route('suratkeluar.edit', $surat->no) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('suratkeluar.destroy', $surat->no) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {{ $suratkeluars->links('pagination::bootstrap-5') }}
    </div>

@endsection
