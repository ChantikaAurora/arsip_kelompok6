@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <a href="{{ route('suratmasuk.index') }}" class="btn btn-secondary mb-3">  <i class="bi bi-arrow-left-circle"></i> Kembali</a>

    <div class="row">
        <!-- Detail Surat Masuk -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>Detail Surat Masuk</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>Nomor Surat</th><td>{{ $suratmasuk->nomor_surat }}</td></tr>
                        <tr><th>Tanggal Surat</th><td>{{ $suratmasuk->tanggal_surat }}</td></tr>
                        <tr><th>Tanggal Diterima</th><td>{{ $suratmasuk->tanggal_terima}}</td></tr>
                        <tr><th>Asal Surat</th><td>{{ $suratmasuk->asal_surat }}</td></tr>
                        <tr><th>Perihal</th><td>{{ $suratmasuk->perihal }}</td></tr>
                        <tr><th>Pengirim</th><td>{{ $suratmasuk->pengirim }}</td></tr>
                        <tr><th>Jenis Surat</th><td>{{ $suratmasuk->jenisArsip->jenis }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
