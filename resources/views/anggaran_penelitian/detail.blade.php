@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <a href="{{ route('anggaran_penelitian.index') }}" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>

    <div class="row">
        <!-- Detail Anggaran Penelitian -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5>Detail Anggaran Penelitian</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Kode</th>
                            <td>{{ $anggaran->kode }}</td>
                        </tr>
                        <tr>
                            <th>Kegiatan</th>
                            <td style="white-space: normal; word-wrap: break-word; max-width: 300px;">{{ $anggaran->kegiatan }}</td>
                        </tr>
                        <tr>
                            <th>Volume Usulan</th>
                            <td>{{ $anggaran->volume_usulan }}</td>
                        </tr>
                        <tr>
                            <th>Skema</th>
                            <td>{{ $anggaran->skemaRelasi->skema_penelitian ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Total Anggaran</th>
                            <td>Rp {{ number_format($anggaran->total_anggaran, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>File Anggaran Penelitian</th>
                            <td>
                                @if($anggaran->file)
                                    <a href="{{ route('anggaran_penelitian.preview', [$anggaran->id, 'preview' => 1]) }}" target="_blank" class="text-primary">
                                        {{ basename($anggaran->file) }}
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
