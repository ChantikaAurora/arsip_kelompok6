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
                    {{-- File Proposal (dalam 1 card) --}}
                    <div class="mt-4">
                        @if($suratmasuk->file)
                            {{-- Tombol Download di sisi kanan --}}
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('suratmasuk.download', $suratmasuk->id) }}" class="btn btn-success" target="_blank">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        @endif

                        @php
                            $ext = pathinfo($suratmasuk->file, PATHINFO_EXTENSION);
                        @endphp

                        @if($suratmasuk->file && $ext === 'pdf')
                            <embed src="{{ route('suratmasuk.download', [$suratmasuk->id, 'preview' => 1]) }}"
                                type="application/pdf" width="100%" height="900px" style="border: none;">
                        @elseif($suratmasuk->file)
                            <p class="text-muted">File tidak dapat ditampilkan langsung. Silakan unduh file untuk melihat isinya.</p>
                        @else
                            <p class="text-muted">Tidak ada file yang diunggah.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
