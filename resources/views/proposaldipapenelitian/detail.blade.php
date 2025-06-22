@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <a href="{{ route('proposal_dipa_penelitian.index') }}" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Detail Proposal DIPA Penelitian</h5>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Kolom Kiri: Informasi Proposal --}}
                <div class="col-md-7">
                    <table class="table table-borderless mb-4">
                        <tr>
                            <th>No</th>
                            <td>{{ $proposal->no }}</td>
                        </tr>
                        <tr>
                            <th>Kode Klasifikasi</th>
                            <td>{{ $proposal->kode_klasifikasi }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $proposal->judul }}</td>
                        </tr>
                        <tr>
                            <th>Peneliti</th>
                            <td>{{ $proposal->peneliti }}</td>
                        </tr>
                        <tr>
                            <th>Skema</th>
                            <td>{{ $proposal->skemaPenelitian->skema_penelitian ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Anggota</th>
                            <td>{{ $proposal->anggota ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $proposal->jurusan->jurusan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Prodi</th>
                            <td>{{ $proposal->prodi->prodi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>{{ \Carbon\Carbon::parse($proposal->tanggal_pengajuan)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $proposal->keterangan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                {{-- Kolom Kanan: Preview File --}}
                <div class="col-md-5">
                    @if ($proposal->file)
                        <div class="mb-3 text-end">
                            <a href="{{ route('proposal_dipa_penelitian.download', $proposal->id) }}" class="btn btn-success btn-sm" target="_blank">
                                <i class="bi bi-download"></i> Download
                            </a>
                            <a href="{{ route('proposal_dipa_penelitian.download', ['id' => $proposal->id, 'preview' => 1]) }}" class="btn btn-primary btn-sm" target="_blank">
                                <i class="bi bi-eye"></i> Lihat Lebih Besar
                            </a>
                        </div>
                        <div class="border rounded shadow-sm" style="height: 400px; overflow: hidden;">
                            <iframe
                                src="{{ route('proposal_dipa_penelitian.download', ['id' => $proposal->id, 'preview' => 1]) }}"
                                width="100%"
                                height="100%"
                                style="border: none;">
                            </iframe>
                        </div>
                    @else
                        <p class="text-muted">Tidak ada file yang diunggah.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
