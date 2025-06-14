@extends('tampilan.main')

@section('title')
   Detail Laporan Penelitian
@endsection

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <main>
        {{-- Tombol Kembali --}}
        <a href="{{ route('laporan_penelitian.index', $laporan_penelitian->id) }}" class="btn btn-secondary mb-3" >← Kembali </a>

        <div class="row">
            {{-- detail laporan penelitian --}}
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Laporan Akhir Penelitian</h5>
                    @if($laporan_penelitian->file)
                        <!-- Tombol download di header bisa diaktifkan kalau mau -->
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                            {{-- <tr><th>ID</th><td>{{ $laporan_penelitian->id }}</td></tr> --}}
                            <tr><th>Kode Seri</th><td>{{ $laporan_penelitian->kode_seri }}</td></tr>
                            <tr><th>Judul Penelitian</th><td>{{ $laporan_penelitian->judul_penelitian }}</td></tr>
                            <tr><th>Peneliti</th><td>{{ $laporan_penelitian->peneliti }}</td></tr>
                            <tr><th>Skema</th><td>{{ $laporan_penelitian->skema }}</td></tr>
                            <tr><th>Anggota</th><td>{{ $laporan_penelitian->anggota }}</td></tr>
                            <tr><th>Jurusan</th><td>{{ $laporan_penelitian->jurusan }}</td></tr>
                            <tr><th>Prodi</th><td>{{ $laporan_penelitian->prodi }}</td></tr>
                            <tr><th>Tanggal Laporan Diterima</th><td>{{ $laporan_penelitian->tanggal_laporan_diterima }}</td></tr>
                            <tr><th>Keterangan</th><td>{{ $laporan_penelitian->keterangan }}</td></tr>
                            <tr><th> File Laporan Akhir Penelitian</th><td>
                                @if($laporan_penelitian->file)
                                    <a href="{{ route('laporan_penelitian.download', [$laporan_penelitian->id, 'preview' => 1]) }}" target="_blank" class="text-primary">
                                        {{ basename($laporan_penelitian->file) }}
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td></tr>
                    </table>

                    @if($laporan_penelitian->file)
                            <!-- <iframe src="{{ route('laporan_penelitian.download', ['id' => $laporan_penelitian->id]) }}?preview=1"
                                width="100%" height="100%" style="border: none;"></iframe> -->
                    @else
                            <p class="text-muted">Tidak ada file yang diunggah.</p>
                    @endif

                    {{-- Preview PDF
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
                    </div> --}}
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
