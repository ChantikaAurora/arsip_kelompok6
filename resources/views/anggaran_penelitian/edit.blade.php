@extends('tampilan.main')

@section('navAnggaranPenelitian', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Edit Anggaran Penelitian</h3>
        <p class="text-muted">Perbarui data anggaran penelitian dengan lengkap dan benar.</p>
    </div>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
        </div>
    @endif

    {{-- Kartu Form --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('anggaran_penelitian.update', $anggaran_penelitian) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Kode --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode', $anggaran_penelitian->kode) }}">
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kegiatan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kegiatan</label>
                    <div class="col-sm-10">
                        <input type="text" name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror" value="{{ old('kegiatan', $anggaran_penelitian->kegiatan) }}">
                        @error('kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Volume Usulan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Volume Usulan</label>
                    <div class="col-sm-10">
                        <input type="number" name="volume_usulan" class="form-control @error('volume_usulan') is-invalid @enderror" value="{{ old('volume_usulan', $anggaran_penelitian->volume_usulan) }}">
                        @error('volume_usulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Skema --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Skema</label>
                    <div class="col-sm-10">
                        <input type="text" name="skema" class="form-control @error('skema') is-invalid @enderror" value="{{ old('skema', $anggaran_penelitian->skema) }}">
                        @error('skema')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Total Anggaran --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Total Anggaran</label>
                    <div class="col-sm-10">
                        <input type="number" step="0.01" name="total_anggaran" class="form-control @error('total_anggaran') is-invalid @enderror" value="{{ old('total_anggaran', $anggaran_penelitian->total_anggaran) }}">
                        @error('total_anggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- File --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Upload File</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($anggaran_penelitian->file)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $anggaran_penelitian->file) }}" target="_blank">
                                    <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('anggaran_penelitian.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
