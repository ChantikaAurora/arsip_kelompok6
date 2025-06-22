@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Metadata Surat Masuk</h4>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('suratmasuk.index') }}" class="btn btn-secondary">← Kembali</a>
        <a href="{{ route('suratmasuk.metadata.download', ['search' => request('search')]) }}" class="btn btn-success">
            📁 Download Excel
        </a>
    </div>

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('suratmasuk.metadata') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari surat masuk..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Diterima</th>
                    <th>Asal Surat</th>
                    <th>Perihal</th>
                    <th>Pengirim</th>
                    <th>Jenis Arsip</th>
                    <th>Tanggal Upload</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nomor_surat }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_terima)->format('d-m-Y') }}</td>
                    <td>{{ $item->asal_surat }}</td>
                    <td>{{ $item->perihal }}</td>
                    <td>{{ $item->pengirim }}</td>
                    <td>{{ $item->jenisArsip->jenis ?? '-' }}</td>
                    <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @endforeach

                @if ($data->isEmpty())
                <tr>
                    <td colspan="9" class="text-center text-muted">Tidak ada data surat masuk.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
