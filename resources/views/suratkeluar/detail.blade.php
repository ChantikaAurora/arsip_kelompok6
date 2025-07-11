@extends('tampilan.navbar')
@section('page-title', 'Surat Keluar')
@section('content')
<div class="container">

    {{-- Tombol Kembali --}}
    <a href="{{ route('suratkeluar.index') }}" class="btn btn-secondary shadow-sm mb-3">
        <i class="icon-action-undo mr-1"></i>Kembali
    </a>

    {{-- Card Detail --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white rounded-top-4"
              style="background: linear-gradient(135deg, #4B49AC, #4B49AC);
                    padding: 1rem 1.5rem;
                    box-shadow: inset 0 -2px 4px rgba(0,0,0,0.1);">
            <div class="d-flex align-items-center">
                <div class="me-2">
                    <i class="bi bi-send-check-fill" style="font-size: 1.5rem;"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-semibold">Detail Surat Keluar</h5>
                    <small class="text-light fst-italic">Informasi lengkap surat keluar yang tercatat dalam sistem.</small>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">

                {{-- Kolom Kiri --}}
                <div class="col-md-7">
                    <table class="table table-striped table-hover table-bordered mb-0" style="table-layout: fixed; width: 100%;">
                        <tbody>
                            <tr><th class="bg-light">Nomor Surat</th><td style="word-break: break-word;">{{ $data->nomor_surat }}</td></tr>
                            <tr><th class="bg-light">Nomor Agenda</th><td>{{ $data->nomor_agenda ?? '-' }}</td></tr>
                            <tr><th class="bg-light">Kode Klasifikasi</th><td>{{ $data->kode_klasifikasi }}</td></tr>
                            <tr><th class="bg-light">Tanggal Surat</th><td>{{ \Carbon\Carbon::parse($data->tanggal_surat)->format('d-m-Y') }}</td></tr>
                            <tr><th class="bg-light">Tujuan Surat</th><td>{{ $data->tujuan_surat }}</td></tr>
                            <tr><th class="bg-light">Penerima</th><td>{{ $data->penerima }}</td></tr>
                            <tr><th class="bg-light">Perihal</th><td style="white-space: normal;">{{ $data->perihal }}</td></tr>
                            <tr><th class="bg-light">Lampiran</th><td>{{ $data->lampiran ?? '-' }}</td></tr>
                            <tr><th class="bg-light">Jenis Arsip</th><td>{{ $data->jenisArsip->jenis ?? '-' }}</td></tr>
                            <tr><th class="bg-light">Keterangan</th><td style="white-space: normal;">{{ $data->keterangan ?? '-' }}</td></tr>
                            <tr>
                                <th class="bg-light">File Surat Keluar</th>
                                <td style="white-space: normal; word-break: break-word; max-width: 300px;">
                                    @if ($data->file)
                                        <a href="{{ route('suratkeluar.download', ['id' => $data->id, 'preview' => 1]) }}"
                                           target="_blank" class="text-decoration-none text-primary">
                                            <i class="bi bi-file-earmark-text"></i> {{ basename($data->file) }}
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
                    @if ($data->file)
                        <div class="mb-3 text-end">
                            <a href="{{ route('suratkeluar.download', $data->id) }}"
                               class="btn btn-inverse-success btn-sm shadow-sm rounded-pill me-1 d-inline-flex align-items-center"
                               target="_blank">
                                <i class="icon-cloud-download me-1 mr-1"></i> Download
                            </a>

                            <a href="{{ route('suratkeluar.download', ['id' => $data->id, 'preview' => 1]) }}"
                               class="btn btn-inverse-primary btn-sm shadow-sm rounded-pill d-inline-flex align-items-center"
                               target="_blank">
                                <i class="icon-eye me-1 mr-1"></i> Lihat Lebih Besar
                            </a>
                        </div>

                        <div class="border rounded-4 shadow overflow-hidden" style="height: 547px;">
                            <iframe
                                src="{{ route('suratkeluar.download', ['id' => $data->id, 'preview' => 1]) }}"
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
