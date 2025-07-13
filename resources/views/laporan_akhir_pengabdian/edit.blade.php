@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('navLaporanAkhirPengabdian', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Laporan Akhir Pengabdian</h3>
        <p class="text-muted mb-0">Silakan perbarui data laporan akhir pengabdian dengan benar.</p>
    </div>

    {{-- Alert Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data. Silakan periksa kembali.
        </div>
    @endif

    {{-- Card Form --}}
    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form method="POST" action="{{ route('laporan_akhir_pengabdian.update', $laporan_akhir_pengabdian->id_laporan_akhir) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Row 1 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ID Laporan</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-hash"></i></span>
                                    <input type="text" name="id_laporan_akhir" class="form-control @error('id_laporan_akhir') is-invalid @enderror" value="{{ old('id_laporan_akhir', $laporan_akhir_pengabdian->id_laporan_akhir) }}">
                                </div>
                                @error('id_laporan_akhir')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Judul Kegiatan</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-journal-text"></i></span>
                                    <input type="text" name="judul_kegiatan" class="form-control @error('judul_kegiatan') is-invalid @enderror" value="{{ old('judul_kegiatan', $laporan_akhir_pengabdian->judul_kegiatan) }}">
                                </div>
                                @error('judul_kegiatan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 2 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Skema</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-diagram-3"></i></span>
                                    <select name="skema" class="form-control @error('skema') is-invalid @enderror">
                                        <option value="">-- Pilih Skema --</option>
                                        @foreach ($skemas as $skema)
                                            <option value="{{ $skema->id }}" {{ old('skema', $laporan_akhir_pengabdian->skema_id) == $skema->id ? 'selected' : '' }}>
                                                {{ $skema->skema_pengabdian }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('skema')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tahun Pelaksanaan</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                    <input type="text" name="tahun_pelaksanaan" class="form-control @error('tahun_pelaksanaan') is-invalid @enderror" value="{{ old('tahun_pelaksanaan', $laporan_akhir_pengabdian->tahun_pelaksanaan) }}" placeholder="Contoh: 2025">
                                </div>
                                @error('tahun_pelaksanaan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 3 --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Upload File</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-upload"></i></span>
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                </div>
                                @error('file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror

                                @if ($laporan_akhir_pengabdian->file)
                                    <div class="mt-2">
                                        <a href="{{ route('laporan_akhir_pengabdian.preview', $laporan_akhir_pengabdian->id_laporan_akhir) }}" target="_blank">
                                            <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="form-group row mt-4">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('laporan_akhir_pengabdian.index') }}" class="btn btn-secondary">
                            <i class="icon-action-undo me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-2" style="margin-left: 0.5rem;">
                            <i class="bi bi-save me-1"></i> Update
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
