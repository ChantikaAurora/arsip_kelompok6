@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('content')
<div class="container">

    {{-- Tombol Kembali --}}
    <a href="{{ route('laporan_kemajuan_penelitian.index') }}" class="btn btn-secondary shadow-sm mb-3">
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
                    <h5 class="mb-0 fw-semibold">Detail Laporan Kemajuan Penelitian</h5>
                    <small class="text-light fst-italic">Informasi lengkap laporan kemajuan penelitian yang tercatat dalam sistem.</small>
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
                                <td style="word-break: break-word;">{{ $laporan->id_laporan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Judul Kegiatan</th>
                                <td style="white-space: normal;">{{ $laporan->judul_kegiatan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Nama Ketua</th>
                                <td>{{ $laporan->nama_ketua }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Nama Anggota</th>
                                <td style="white-space: normal;">{{ $laporan->nama_anggota }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Skema</th>
                                <td>{{ optional($laporan->skemaRelasi)->skema_penelitian ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Tahun Pelaksanaan</th>
                                <td>{{ $laporan->tahun_pelaksanaan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Jurusan</th>
                                <td>{{ optional($laporan->jurusanRelasi)->jurusan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Prodi</th>
                                <td>{{ optional($laporan->prodiRelasi)->prodi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Periode Laporan</th>
                                <td>{{ $laporan->periode_laporan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Ringkasan</th>
                                <td style="white-space: normal;">{{ $laporan->ringkasan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">File Laporan</th>
                                <td style="white-space: normal; word-break: break-word; max-width: 300px;">
                                    @if ($laporan->file)
                                        <a href="{{ route('laporan_kemajuan_penelitian.preview', ['id' => $laporan->id_laporan, 'preview' => 1]) }}"
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
                    @if ($laporan->file)
                        <div class="mb-3 text-end">
                            <a href="{{ route('laporan_kemajuan_penelitian.download', $laporan->id_laporan) }}"
                               class="btn btn-inverse-success btn-sm shadow-sm rounded-pill me-1 d-inline-flex align-items-center"
                               target="_blank">
                                <i class="icon-cloud-download me-1 align-middle mr-1"></i> Download
                            </a>
                            <a href="{{ route('laporan_kemajuan_penelitian.preview', ['id' => $laporan->id_laporan, 'preview' => 1]) }}"
                               class="btn btn-inverse-primary btn-sm shadow-sm rounded-pill d-inline-flex align-items-center"
                               target="_blank">
                                <i class="icon-eye me-1 align-middle mr-1"></i> Lihat Lebih Besar
                            </a>
                        </div>

                        <div class="border rounded-4 shadow overflow-hidden" style="height: 547px;">
                            <iframe
                                src="{{ route('laporan_kemajuan_penelitian.preview', ['id' => $laporan->id_laporan, 'preview' => 1]) }}"
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
