@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('navAnggaranPenelitian', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Laporan Keuangan Penelitian</h3>
        <p class="text-muted mb-0">Perbarui data laporan keuangan penelitian dengan lengkap dan benar.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data. Silakan periksa kembali.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form action="{{ route('anggaran_penelitian.update', $anggaran) }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror"
                                           value="{{ old('kode', $anggaran->kode) }}" placeholder="Contoh: 345123">
                                </div>
                                @error('kode')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kegiatan</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-journal-text"></i></span>
                                    <input type="text" name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror"
                                           value="{{ old('kegiatan', $anggaran->kegiatan) }}" placeholder="Contoh: Penelitian Teknologi Tepat Guna">
                                </div>
                                @error('kegiatan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 2 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Volume Usulan</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-plus-slash-minus"></i></span>
                                    <input type="number" name="volume_usulan" class="form-control @error('volume_usulan') is-invalid @enderror"
                                           value="{{ old('volume_usulan', $anggaran->volume_usulan) }}" placeholder="Contoh: 3">
                                </div>
                                @error('volume_usulan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Skema</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-diagram-3"></i></span>
                                    <select name="skema" class="form-control @error('skema') is-invalid @enderror" required>
                                        <option value="">-- Pilih Skema --</option>
                                        @foreach ($skemas as $skema)
                                            <option value="{{ $skema->id }}" {{ old('skema', $anggaran->skema) == $skema->id ? 'selected' : '' }}>
                                                {{ $skema->skema_penelitian }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('skema')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 3 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Total Anggaran</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
                                    <input type="number" step="0.01" name="total_anggaran" class="form-control @error('total_anggaran') is-invalid @enderror"
                                           value="{{ old('total_anggaran', $anggaran->total_anggaran) }}" placeholder="Contoh: 15000000">
                                </div>
                                @error('total_anggaran')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Upload File</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-upload"></i></span>
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                </div>
                                @if ($anggaran->file)
                                    <div class="mt-2">
                                        <a href="{{ route('anggaran_penelitian.preview', $anggaran->id) }}" target="_blank">
                                            <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                        </a>
                                    </div>
                                @endif

                                @error('file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="form-group row mt-4">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('anggaran_penelitian.index') }}" class="btn btn-secondary">
                            <i class="icon-action-undo me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-2"  style="margin-left: 0.5rem;">
                            <i class="bi bi-save me-1"></i> Perbarui
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
