@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Metadata Proposal Pusat Penelitian</h4>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('proposal_pusat_penelitian.index') }}" class="btn btn-secondary">← Kembali</a>
        <a href="{{ route('proposal_pusat_penelitian.export', ['search' => request('search')]) }}" class="btn btn-success">
            📁 Download Excel
        </a>
    </div>

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('proposal_pusat_penelitian.metadata') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari proposal..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Klasifikasi</th>
                        <th>Judul</th>
                        <th>Peneliti</th>
                        <th>Skema</th>
                        <th>Anggota</th>
                        <th>Jurusan</th>
                        <th>Prodi</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Keterangan</th>
                        <th>File</th>
                        <th>Tanggal Upload</th>
                    </tr>
                </thead>
                <tbody>
    @foreach ($data as $i => $item)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $item->kode_klasifikasi }}</td>
        <td>{{ $item->judul }}</td>
        <td>{{ $item->peneliti }}</td>
        <td>{{ $item->skemaPenelitian->skema_penelitian ?? '-' }}</td>
        <td>{{ $item->anggota ?? '-' }}</td>
        <td>{{ $item->jurusan->jurusan ?? '-' }}</td>
        <td>{{ $item->prodi->prodi ?? '-' }}</td>
        <td>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }}</td>
        <td>{{ $item->keterangan ?? '-' }}</td>
        <td>
            @if($item->file)
                <a href="{{ route('proposal_pusat_penelitian.download', $item->id) }}" target="_blank">📄 Lihat</a>
            @else
                -
            @endif
        </td>
        <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
    </tr>
    @endforeach

    @if ($data->isEmpty())
    <tr>
        <td colspan="12" class="text-center text-muted">Tidak ada data proposal ditemukan.</td>
    </tr>
    @endif
</tbody>

        </table>
    </div>
</div>
@endsection
