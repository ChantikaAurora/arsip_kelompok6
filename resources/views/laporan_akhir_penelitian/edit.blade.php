@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('navLaporanAkhirPenelitian', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Laporan Akhir Penelitian</h3>
        <p class="text-muted mb-0">Silakan perbarui data laporan akhir penelitian dengan benar.</p>
    </div>

    {{-- Notifikasi Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data. Silakan periksa kembali.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form action="{{ route('laporan_akhir_penelitian.update', $laporan_akhir_penelitian->id_laporan_akhir) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Row 1 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kode Klasifikasi</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tags"></i></span>
                                    <input type="text" name="id_laporan_akhir" class="form-control @error('id_laporan_akhir') is-invalid @enderror" value="{{ old('id_laporan_akhir', $laporan_akhir_penelitian->id_laporan_akhir) }}">
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
                                    <span class="input-group-text"><i class="bi bi-journal-richtext"></i></span>
                                    <input type="text" name="judul_kegiatan" class="form-control @error('judul_kegiatan') is-invalid @enderror" value="{{ old('judul_kegiatan', $laporan_akhir_penelitian->judul_kegiatan) }}">
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
                                <select name="skema" class="form-control @error('skema') is-invalid @enderror">
                                    <option value="">-- Pilih Skema --</option>
                                    @foreach ($skemas as $skema)
                                        <option value="{{ $skema->id }}" {{ old('skema', $laporan_akhir_penelitian->skema_id) == $skema->id ? 'selected' : '' }}>{{ $skema->skema_penelitian }}</option>
                                    @endforeach
                                </select>
                                @error('skema')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tahun Pelaksanaan</label>
                            <div class="col-sm-8">
                                <input type="text" name="tahun_pelaksanaan" class="form-control @error('tahun_pelaksanaan') is-invalid @enderror" value="{{ old('tahun_pelaksanaan', $laporan_akhir_penelitian->tahun_pelaksanaan) }}">
                                @error('tahun_pelaksanaan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 3: Upload File --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Upload File</label>
                            <div class="col-sm-10">
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                @error('file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                @if ($laporan_akhir_penelitian->file)
                                    <div class="mt-2">
                                        <a href="{{ route('laporan_akhir_penelitian.preview', $laporan_akhir_penelitian->id_laporan_akhir) }}" target="_blank">
                                            <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-group row mt-4">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('laporan_akhir_penelitian.index') }}" class="btn btn-secondary">
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
