@extends('tampilan.navbar')
@section('page-title', 'Proposal')
@section('content')
<div class="container">

    {{-- Tombol Kembali --}}
    <a href="{{ route('proposal_dipa_pengabdian.index') }}" class="btn btn-secondary shadow-sm mb-3">
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
                    <h5 class="mb-0 fw-semibold">Detail Proposal DIPA Pengabdian</h5>
                    <small class="text-light fst-italic">Informasi lengkap proposal DIPA Pengabdian yang tercatat dalam sistem.</small>
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
                                <th class="bg-light" style="width: 40%;">No</th>
                                <td style="word-break: break-word;">{{ $proposal->no }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Kode Klasifikasi</th>
                                <td>{{ $proposal->kode_klasifikasi }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Judul</th>
                                <td>{{ $proposal->judul }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Peneliti</th>
                                <td>{{ $proposal->peneliti }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Skema</th>
                                <td>{{ $proposal->skemaPengabdian->skema_pengabdian ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Anggota</th>
                                <td>{{ $proposal->anggota ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Jurusan</th>
                                <td>{{ $proposal->jurusan->jurusan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Prodi</th>
                                <td>{{ $proposal->prodi->prodi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Tanggal Pengajuan</th>
                                <td>{{ \Carbon\Carbon::parse($proposal->tanggal_pengajuan)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Keterangan</th>
                                <td style="white-space: normal;">{{ $proposal->keterangan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">File Proposal</th>
                                <td style="white-space: normal; word-break: break-word; max-width: 300px;">
                                    @if ($proposal->file)
                                        <a href="{{ route('proposal_dipa_pengabdian.download', ['id' => $proposal->id, 'preview' => 1]) }}"
                                        target="_blank" class="text-decoration-none text-primary">
                                            <i class="bi bi-file-earmark-text"></i> {{ basename($proposal->file) }}
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
                    @if ($proposal->file)
                        <div class="mb-3 text-end">
                            <a href="{{ route('proposal_dipa_pengabdian.download', $proposal->id) }}"
                               class="btn btn-inverse-success btn-sm shadow-sm rounded-pill me-1 d-inline-flex align-items-center"
                               target="_blank">
                                <i class="icon-cloud-download me-1 align-middle mr-1"></i> Download
                            </a>
                            <a href="{{ route('proposal_dipa_pengabdian.download', ['id' => $proposal->id, 'preview' => 1]) }}"
                               class="btn btn-inverse-primary btn-sm shadow-sm rounded-pill d-inline-flex align-items-center"
                               target="_blank">
                               <i class="icon-eye me-1 align-middle mr-1"></i> Lihat Lebih Besar
                            </a>
                        </div>

                        <div class="border rounded-4 shadow overflow-hidden" style="height: 547px;">
                            <iframe
                                src="{{ route('proposal_dipa_pengabdian.download', ['id' => $proposal->id, 'preview' => 1]) }}"
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
