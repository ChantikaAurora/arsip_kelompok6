@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <a href="{{ route('suratkeluar.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Surat Keluar</a>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Detail Surat Keluar</h5>
        </div>
        <div class="card-body">
            {{-- Informasi Surat --}}
            <table class="table table-borderless mb-4">
                <tr><th>No</th><td>{{ $no }}</td></tr>
                <tr><th>Nomor Surat</th><td>{{ $data->nomor_surat }}</td></tr>
                <tr><th>Tanggal Surat</th><td>{{ \Carbon\Carbon::parse($data->tanggal_surat)->format('d-m-Y') }}</td></tr>
                <tr><th>Tujuan Surat</th><td>{{ $data->tujuan_surat }}</td></tr>
                <tr><th>Perihal</th><td>{{ $data->perihal }}</td></tr>
                <tr><th>Pengirim</th><td>{{ $data->pengirim }}</td></tr>
                <tr><th>Penerima</th><td>{{ $data->penerima }}</td></tr>
                <tr><th>Jenis Arsip</th><td>{{ $data->jenisArsip->jenis ?? '-' }}</td></tr>
            </table>

            {{-- File Surat --}}
            <div class="d-flex justify-content-end align-items-center mb-3">
                @if($data->file)
                    <a href="{{ route('suratkeluar.download', $data->id) }}" class="btn btn-success btn-sm" target="_blank">
                        Download
                    </a>
                @endif
            </div>
            <div style="height: 900px 900py; ">
                @if($data->file)
                    <iframe src="{{ route('suratkeluar.download', ['id' => $data->id, 'preview' => 1]) }}" width="100%" height="600px"></iframe>
                @else
                    <p class="text-muted">Tidak ada file yang diunggah.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
