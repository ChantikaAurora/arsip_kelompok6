@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <a href="{{ route('anggaran_pengabdian.index') }}" class="btn btn-secondary mb-3" id="anggaran_pengabdian">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>

    <div class="row">
        <!-- Detail Anggaran Pengabdian -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>Detail Anggaran Pengabdian</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Kode</th>
                            <td>{{ $anggaran->kode }}</td>
                        </tr>
                        <tr>
                            <th>Kegiatan</th>
                            <td>{{ $anggaran->kegiatan }}</td>
                        </tr>
                        <tr>
                            <th>Volume Usulan</th>
                            <td>{{ $anggaran->volume_usulan }}</td>
                        </tr>
                        <tr>
                            <th>Skema</th>
                            <td>{{ $anggaran->skema }}</td>
                        </tr>
                        <tr>
                            <th>Total Anggaran</th>
                            <td>Rp {{ number_format($anggaran->total_anggaran, 2, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
