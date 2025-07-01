@extends('tampilan.main')

@section('title', 'Manajemen Surat Keluar')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Surat Keluar</h3>
        <a href="{{ route('suratkeluar.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Surat Keluar
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Nomor Agenda</th>
                    <th>Kode Klasifikasi</th>
                    <th>Tanggal Surat</th>
                    <th>Tujuan Surat</th>
                    <th>Penerima</th>
                    <th>Perihal</th>
                    <th>Jenis Arsip</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suratkeluars as $index => $surat)
                    <tr>
                        <td class="text-center">{{ $index + $suratkeluars->firstItem() }}</td>
                        <td>{{ $surat->nomor_surat }}</td>
                        <td>{{ $surat->nomor_agenda }}</td>
                        <td>{{ $surat->kode_klasifikasi }}</td>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</td>
                        <td>{{ $surat->tujuan_surat }}</td>
                        <td>{{ $surat->penerima }}</td>
                        <td>{{ $surat->perihal }}</td>
                        <td>{{ $surat->jenisArsip->jenis ?? '-' }}</td>
                        <td class="text-center">
                            @if ($surat->file)
                                <a href="{{ Storage::url($surat->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    Lihat
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('suratkeluar.edit', $surat->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('suratkeluar.destroy', $surat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">Tidak ada data surat keluar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $suratkeluars->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
