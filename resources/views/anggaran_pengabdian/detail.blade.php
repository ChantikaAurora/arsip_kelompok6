@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('content')
<div class="container">

    {{-- Tombol Kembali --}}
    <a href="{{ route('anggaran_pengabdian.index') }}" class="btn btn-secondary shadow-sm mb-3">
        <i class="icon-action-undo mr-1"></i> Kembali
    </a>

    {{-- Card Detail --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white rounded-top-4"
             style="background: linear-gradient(135deg, #4B49AC, #4B49AC);
                    padding: 1rem 1.5rem;
                    box-shadow: inset 0 -2px 4px rgba(0,0,0,0.1);">
            <div class="d-flex align-items-center">
                <div class="me-2">
                    <i class="bi bi-journal-text" style="font-size: 1.5rem;"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-semibold">Detail Laporan Keuangan Pengabdian</h5>
                    <small class="text-light fst-italic">Informasi lengkap laporan keuangan pengabdian yang tercatat dalam sistem.</small>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">

                {{-- Kolom Kiri: Detail --}}
                <div class="col-md-7">
                    <table class="table table-striped table-hover table-bordered mb-0" style="table-layout: fixed; width: 100%;">
                        <tbody>
                            <tr>
                                <th class="bg-light" style="width: 40%;">Kode Klasifikasi</th>
                                <td style="word-break: break-word;">{{ $anggaran->kode }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Kegiatan</th>
                                <td style="white-space: normal; word-break: break-word;">{{ $anggaran->kegiatan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Volume Usulan</th>
                                <td>{{ $anggaran->volume_usulan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Skema</th>
                                <td>{{ $anggaran->skemaRelasi->skema_pengabdian ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Total Anggaran</th>
                                <td>Rp {{ number_format($anggaran->total_anggaran, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">File Anggaran</th>
                                <td style="white-space: normal; word-break: break-word; max-width: 300px;">
                                    @if($anggaran->file)
                                        <a href="{{ route('anggaran_pengabdian.preview', [$anggaran->id, 'preview' => 1]) }}"
                                           target="_blank" class="text-decoration-none text-primary">
                                            <i class="bi bi-file-earmark-text"></i> {{ basename($anggaran->file) }}
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
                    @if($anggaran->file)
                        <div class="mb-3 text-end">
                            <a href="{{ route('anggaran_pengabdian.download', $anggaran->id) }}"
                               class="btn btn-inverse-success btn-sm shadow-sm rounded-pill me-1 d-inline-flex align-items-center"
                               target="_blank">
                                <i class="icon-cloud-download me-1 align-middle mr-1"></i> Download
                            </a>
                            <a href="{{ route('anggaran_pengabdian.preview', ['id' => $anggaran->id, 'preview' => 1]) }}"
                               class="btn btn-inverse-primary btn-sm shadow-sm rounded-pill d-inline-flex align-items-center"
                               target="_blank">
                                <i class="icon-eye me-1 align-middle mr-1"></i> Lihat Lebih Besar
                            </a>
                        </div>

                        <div class="border rounded-4 shadow overflow-hidden" style="height: 547px;">
                            <iframe
                                src="{{ route('anggaran_pengabdian.preview', ['id' => $anggaran->id, 'preview' => 1]) }}"
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
