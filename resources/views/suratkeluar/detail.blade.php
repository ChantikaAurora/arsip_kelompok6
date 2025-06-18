@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <a href="{{ route('suratkeluar.index') }}" class="btn btn-secondary mb-3" id="suratkeluar"> ← Kembali</a>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Detail Surat Keluar</h5>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Kolom Kiri: Informasi Surat --}}
                <div class="col-md-7">
                    <table class="table table-borderless mb-4">
                        <tr><th>No</th><td>{{ $no }}</td></tr>
                        <tr><th>Nomor Surat</th><td>{{ $data->nomor_surat }}</td></tr>
                        <tr><th>Tanggal Surat</th><td>{{ \Carbon\Carbon::parse($data->tanggal_surat)->format('d-m-Y') }}</td></tr>
                        <tr><th>Tujuan Surat</th><td>{{ $data->tujuan_surat }}</td></tr>
                        <tr><th>Perihal</th><td>{{ $data->perihal }}</td></tr>
                        <tr><th>Pengirim</th><td>{{ $data->pengirim }}</td></tr>
                        <tr><th>Penerima</th><td>{{ $data->penerima }}</td></tr>
                        <tr><th>Jenis Arsip</th><td>{{ $data->jenisArsip->jenis ?? '-' }}</td></tr>
                    </table>
                </div>

                {{-- Kolom Kanan: Preview File --}}
                <div class="col-md-5">
                    @if($data->file)
                        <div class="mb-3 text-end">
                            <a href="{{ route('suratkeluar.download', $data->id) }}" class="btn btn-success btn-sm" target="_blank">Download</a>
                            <a href="{{ route('suratkeluar.download', ['id' => $data->id, 'preview' => 1]) }}" class="btn btn-primary btn-sm" target="_blank">Lihat Lebih Besar</a>
                        </div>
                        <div class="border rounded shadow-sm" style="height: 400px; overflow: hidden;">
                            <iframe
                                src="{{ route('suratkeluar.download', ['id' => $data->id, 'preview' => 1]) }}"
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
