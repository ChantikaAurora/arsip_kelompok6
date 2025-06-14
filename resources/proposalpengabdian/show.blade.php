@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Detail Proposal Pengabdian</h3>

    <table class="table table-bordered">
        <tr><th>Kode Seri</th><td>{{ $proposal_pengabdian->kode_seri }}</td></tr>
        <tr><th>Judul</th><td>{{ $proposal_pengabdian->judul }}</td></tr>
        <tr><th>Peneliti</th><td>{{ $proposal_pengabdian->peneliti }}</td></tr>
        <tr><th>Skema</th><td>{{ $proposal_pengabdian->skema }}</td></tr>
        <tr><th>Anggota</th><td>{{ $proposal_pengabdian->anggota }}</td></tr>
        <tr><th>Jurusan</th><td>{{ $proposal_pengabdian->jurusan->nama ?? '-' }}</td></tr>
        <tr><th>Program Studi</th><td>{{ $proposal_pengabdian->prodi->nama ?? '-' }}</td></tr>
        <tr><th>Tanggal Pengajuan</th><td>{{ \Carbon\Carbon::parse($proposal_pengabdian->tanggal_pengajuan)->format('Y-m-d') }}</td></tr>
        <tr><th>Keterangan</th><td>{{ $proposal_pengabdian->keterangan }}</td></tr>
        <tr>
            <th>File</th>
            <td>
                @if($proposal_pengabdian->file)
                    <a href="{{ route('proposal_pengabdian.download', $proposal_pengabdian->id) }}" target="_blank">{{ basename($proposal_pengabdian->file) }}</a>
                @else
                    <span class="text-muted">Tidak ada file</span>
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('proposal_pengabdian.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
