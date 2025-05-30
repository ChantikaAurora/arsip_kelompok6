@extends('tampilan.main')

@section('title')
   Detail Laporan Penelitian
@endsection

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <main>
        {{-- Tombol Kembali --}}
        <a href="{{ route('laporan_penelitian.index', $laporan_penelitian->id) }}" class="btn btn-secondary my-4">
            <i class="bi bi-arrow-left-circle"></i>Kembali</a>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header">Detail Laporan Penelitian</div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            {{-- <tr><th>ID</th><td>{{ $laporan_penelitian->id }}</td></tr> --}}
                            <tr><th>Judul Penelitian</th><td>{{ $laporan_penelitian->judul_penelitian }}</td></tr>
                            <tr><th>Peneliti</th><td>{{ $laporan_penelitian->peneliti }}</td></tr>
                            <tr><th>Jenis</th><td>{{ $laporan_penelitian->jenisArsip->jenis }}</td></tr>
                            <tr><th>Jurusan</th><td>{{ $laporan_penelitian->jurusan }}</td></tr>
                            <tr><th>Tahun Penelitian</th><td>{{ $laporan_penelitian->tahun_penelitian }}</td></tr>
                            <tr><th>Tanggal Laporan Diterima</th><td>{{ $laporan_penelitian->tanggal_laporan_diterima }}</td></tr>
                            <tr><th>Status Laporan</th><td>{{ $laporan_penelitian->status_laporan }}</td></tr>
                            <tr><th>Keterangan</th><td>{{ $laporan_penelitian->keterangan }}</td></tr>
                        </tbody>
                    </table>

                    {{-- Tombol Download --}}
                    <a href="{{ route('laporan_penelitian.download', $laporan_penelitian->id) }}" class="btn btn-success mb-3">Download Dokumen</a>

                    {{-- Preview PDF --}}
                    <div class="card body">
                        <table class="table">
                            @php
                                $ext = pathinfo($laporan_penelitian->file, PATHINFO_EXTENSION);
                            @endphp

                            @if ($ext === 'pdf')
                                <embed src="{{ asset('storage/' . $laporan_penelitian->file) }}" type="application/pdf" width="100%" height="600px">
                            @else
                                <p>File tidak dapat ditampilkan langsung. Silakan unduh file untuk melihat isinya.</p>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
