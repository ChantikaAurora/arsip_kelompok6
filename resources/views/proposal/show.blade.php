@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <a href="{{ route('proposal.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Proposal</a>

    <div class="row">
        <!-- Detail Proposal + File Proposal -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Proposal</h5>
                    @if($proposal->file_proposal)
                        <!-- Tombol download di header bisa diaktifkan kalau mau -->
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>Judul</th><td>{{ $proposal->judul }}</td></tr>
                        <tr><th>Peneliti</th><td>{{ $proposal->peneliti }}</td></tr>
                        <tr><th>Jurusan</th><td>{{ $proposal->jurusan }}</td></tr>
                        <tr><th>Jenis</th><td>{{ $proposal->jenisArsip->jenis }}</td></tr>
                        <tr><th>Tahun Pengajuan</th><td>{{ $proposal->tahun_pengajuan }}</td></tr>
                        <tr><th>Status</th><td>{{ $proposal->status }}</td></tr>
                        <tr><th>Tanggal Pengajuan</th><td>{{ $proposal->tanggal_pengajuan->format('d-m-Y') }}</td></tr>
                        <tr><th>Dana Diajukan</th><td>Rp {{ number_format($proposal->dana_diajukan, 0, ',', '.') }}</td></tr>
                        <tr><th>Keterangan</th><td>{{ $proposal->keterangan ?? '-' }}</td></tr>
                    </table>

                    {{-- File Proposal (dalam 1 card) --}}
                    <div class="mt-4" style="height: 900px;">
                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('proposal.download', $proposal->id) }}" class="btn btn-success px-4 py-2" target="_blank">
                                Download
                            </a>
                        </div>

                        @if($proposal->file_proposal)
                            <iframe src="{{ route('proposal.download', ['id' => $proposal->id]) }}?preview=1"
                                width="100%" height="100%" style="border: none;"></iframe>
                        @else
                            <p class="text-muted">Tidak ada file yang diunggah.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
