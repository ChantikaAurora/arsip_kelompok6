@extends('tampilan.main')

@section('title')
   Detail Anggaran Penelitian
@endsection

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <main>
        {{-- Tombol Kembali --}}
        <a href="{{ route('anggaran_penelitian.index', $item->id) }}" class="btn btn-secondary my-4">
            <i class="bi bi-arrow-left-circle"></i>Kembali</a>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header">Detail Anggaran Penelitian</div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            {{-- <tr><th>ID</th><td>{{ $item->id }}</td></tr> --}}
                            <tr><th>Judul Penelitian</th><td>{{ $item->judul_penelitian }}</td></tr>
                            <tr><th>Peneliti</th><td>{{ $item->peneliti }}</td></tr>
                            <tr><th>Tahun</th><td>{{ $item->tahun }}</td></tr>
                            <tr><th>Total Anggaran</th><td>{{ $item->total_anggaran }}</td></tr>
                            <tr><th>Jenis Arsip</th><td>{{ $item->jenisArsip->jenis ?? $item->jenis_arsip_id }}</td></tr>
                            <tr><th>Rincian Anggaran</th><td>{{ $item->rincian_anggaran }}</td></tr>
                            <tr><th>Status</th><td>{{ $item->status }}</td></tr>
                            <tr><th>Keterangan</th><td>{{ $item->keterangan }}</td></tr>
                        </tbody>
                    </table>

                    {{-- Tombol Download --}}
                    <a href="{{ route('anggaran_penelitian.download', $item->id) }}" class="btn btn-success my-4">Download Dokumen</a>

                    {{-- Preview PDF --}}
                    @php
                        $ext = strtolower(pathinfo($item->file, PATHINFO_EXTENSION));
                    @endphp

                    @if ($ext === 'pdf')
                        <embed src="{{ asset('storage/' . $item->file) }}" type="application/pdf" width="100%" height="600px">
                    @else
                        <p class="mt-3">File tidak dapat ditampilkan langsung. Silakan unduh file untuk melihat isinya.</p>
                    @endif


                </div>
            </div>
        </div>
    </main>
@endsection
