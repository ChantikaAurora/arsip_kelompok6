@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <a href="{{ route('suratmasuk.index') }}" class="btn btn-secondary mb-3" id="suratmasuk">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Detail Surat Masuk</h5>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Kolom Kiri: Informasi Surat --}}
                <div class="col-md-7">
                    <table class="table table-borderless mb-4">
                        <tr>
                            <th>Nomor Surat</th>
                            <td>{{ $suratmasuk->nomor_surat }}</td>
                        </tr>
                        <tr>
                            <th>Kode Klasifikasi</th>
                            <td>{{ $suratmasuk->kode_klasifikasi }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Surat</th>
                            <td>{{ \Carbon\Carbon::parse($suratmasuk->tanggal_surat)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Diterima</th>
                            <td>{{ \Carbon\Carbon::parse($suratmasuk->tanggal_terima)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Asal Surat</th>
                            <td>{{ $suratmasuk->asal_surat }}</td>
                        </tr>
                        <tr>
                            <th>Pengirim</th>
                            <td>{{ $suratmasuk->pengirim }}</td>
                        </tr>
                        <tr>
                            <th>Perihal</th>
                            <td>{{ $suratmasuk->perihal }}</td>
                        </tr>
                        <tr>
                            <th>Lampiran</th>
                            <td>{{ $suratmasuk->lampiran ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Surat</th>
                            <td>{{ $suratmasuk->jenisArsip->jenis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $suratmasuk->keterangan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                {{-- Kolom Kanan: Preview File --}}
                <div class="col-md-5">
                    @if ($suratmasuk->file)
                        <div class="mb-3 text-end">
                            <a href="{{ route('suratmasuk.download', $suratmasuk->id) }}" class="btn btn-success btn-sm" target="_blank">
                                <i class="bi bi-download"></i> Download
                            </a>
                            <a href="{{ route('suratmasuk.download', ['id' => $suratmasuk->id, 'preview' => 1]) }}" class="btn btn-primary btn-sm" target="_blank">
                                <i class="bi bi-eye"></i> Lihat Lebih Besar
                            </a>
                        </div>
                        <div class="border rounded shadow-sm" style="height: 400px; overflow: hidden;">
                            <iframe
                                src="{{ route('suratmasuk.download', ['id' => $suratmasuk->id, 'preview' => 1]) }}"
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
