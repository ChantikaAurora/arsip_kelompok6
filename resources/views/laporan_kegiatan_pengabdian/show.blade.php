@extends('tampilan.main')

@section('title')
   Detail Laporan Kegiatan Pengabdian
@endsection

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <main>
        {{-- Tombol Kembali --}}
        <a href="{{ route('laporan_kegiatan_pengabdian.index', $laporan_kegiatan_pengabdian->id) }}" class="btn btn-secondary mb-3" >← Kembali </a>

        <div class="row">
            {{-- detail laporan pengabdian --}}
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Laporan Kegiatan Pengabdian</h5>
                    @if($laporan_kegiatan_pengabdian->file)
                        <!-- Tombol download di header bisa diaktifkan kalau mau -->
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                            {{-- <tr><th>ID</th><td>{{ $laporan_kegiatan_pengabdian->id }}</td></tr> --}}
                            <tr><th>Kode Seri</th><td>{{ $laporan_kegiatan_pengabdian->kode_seri }}</td></tr>
                            <tr><th>Judul pengabdian</th><td>{{ $laporan_kegiatan_pengabdian->judul }}</td></tr>
                            <tr><th>Peneliti</th><td>{{ $laporan_kegiatan_pengabdian->peneliti }}</td></tr>
                            <tr><th>Skema</th><td>{{ $laporan_kegiatan_pengabdian->skema }}</td></tr>
                            <tr><th>Anggota</th><td>{{ $laporan_kegiatan_pengabdian->anggota }}</td></tr>
                            <tr><th>Jurusan</th><td>{{ $laporan_kegiatan_pengabdian->jurusan }}</td></tr>
                            <tr><th>Prodi</th><td>{{ $laporan_kegiatan_pengabdian->prodi }}</td></tr>
                            <tr><th>Tanggal Laporan Diterima</th><td>{{ $laporan_kegiatan_pengabdian->tanggal_laporan_diterima }}</td></tr>
                            <tr><th>Keterangan</th><td>{{ $laporan_kegiatan_pengabdian->keterangan }}</td></tr>
                            <tr><th> File Laporan Akhir pengabdian</th><td>
                                @if($laporan_kegiatan_pengabdian->file)
                                    <a href="{{ route('laporan_kegiatan_pengabdian.download', [$laporan_kegiatan_pengabdian->id, 'preview' => 1]) }}" target="_blank" class="text-primary">
                                        {{ basename($laporan_kegiatan_pengabdian->file) }}
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td></tr>
                    </table>

                    @if($laporan_kegiatan_pengabdian->file)
                            <!-- <iframe src="{{ route('laporan_kegiatan_pengabdian.download', ['id' => $laporan_kegiatan_pengabdian->id]) }}?preview=1"
                                width="100%" height="100%" style="border: none;"></iframe> -->
                    @else
                            <p class="text-muted">Tidak ada file yang diunggah.</p>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
