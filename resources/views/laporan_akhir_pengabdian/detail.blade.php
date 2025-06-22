@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <a href="{{ route('laporan_akhir_pengabdian.index') }}" class="btn btn-secondary rounded-pill shadow-sm mb-3">Kembali</a>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white rounded-top-4"
             style="background: linear-gradient(135deg, #4B49AC, #4B49AC);
                    padding: 1rem 1.5rem;
                    box-shadow: inset 0 -2px 4px rgba(0,0,0,0.1);">
            <div class="d-flex align-items-center">
                <div class="me-2">
                    <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-semibold">Detail Laporan Akhir Pengabdian</h5>
                    <small class="text-light fst-italic">Informasi lengkap Laporan Akhir Pengabdian</small>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                {{-- Kolom Kiri: Informasi Laporan --}}
                <div class="col-md-7">
                    <table class="table table-striped table-hover table-bordered mb-0" style="table-layout: fixed; width: 100%;">
                        <tbody>
                            <tr>
                                <th class="bg-light" style="width: 40%;">Kode Klasifikasi</th>
                                <td style="word-break: break-word;">{{ $laporan->id_laporan_akhir }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Judul Kegiatan</th>
                                <td style="white-space: normal; word-break: break-word;">{{ $laporan->judul_kegiatan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Skema</th>
                                <td>{{ optional($laporan->skemaRelasi)->skema_pengabdian ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Tahun Pelaksanaan</th>
                                <td>{{ $laporan->tahun_pelaksanaan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">File Laporan</th>
                                <td style="white-space: normal; word-break: break-word; max-width: 300px;">
                                    @if($laporan->file)
                                        <a href="{{ route('laporan_akhir_pengabdian.preview', [$laporan->id_laporan_akhir, 'preview' => 1]) }}"
                                           target="_blank" class="text-decoration-none text-primary">
                                            <i class="bi bi-file-earmark-text"></i> {{ basename($laporan->file) }}
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Kolom Kanan: Preview File --}}
                <div class="col-md-5">
                    @if($laporan->file)
                        <div class="mb-3 text-end">
                            <a href="{{ route('laporan_akhir_pengabdian.download', $laporan->id_laporan_akhir) }}"
                               class="btn btn-outline-success btn-sm shadow-sm rounded-pill me-1"
                               target="_blank">
                                <i class="bi bi-download"></i> Download
                            </a>
                            <a href="{{ route('laporan_akhir_pengabdian.preview', ['id' => $laporan->id_laporan_akhir, 'preview' => 1]) }}"
                               class="btn btn-outline-primary btn-sm shadow-sm rounded-pill"
                               target="_blank">
                                <i class="bi bi-arrows-fullscreen"></i> Lihat Lebih Besar
                            </a>
                        </div>

                        <div class="border rounded-4 shadow overflow-hidden" style="height: 550px;">
                            <iframe
                                src="{{ route('laporan_akhir_pengabdian.preview', ['id' => $laporan->id_laporan_akhir, 'preview' => 1]) }}"
                                width="100%"
                                height="100%"
                                style="border: none;"
                                loading="lazy">
                            </iframe>
                        </div>
                    @else
                        <div class="alert alert-warning text-center shadow-sm rounded-3">
                            <i class="bi bi-file-earmark-excel"></i> Tidak ada file yang diunggah.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
