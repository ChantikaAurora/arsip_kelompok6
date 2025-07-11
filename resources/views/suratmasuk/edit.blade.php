@extends('tampilan.navbar')
@section('page-title', 'Surat Masuk')
@section('title', 'Edit Surat Masuk')
@section('navSuratMasuk', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Surat Masuk</h3>
        <p class="text-muted mb-0">Silakan perbarui data surat masuk sesuai kebutuhan.</p>
    </div>

   {{-- Notifikasi Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data. Silakan coba lagi.
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form action="{{ route('suratmasuk.update', $suratmasuk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Row 1 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nomor Surat</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-hash"></i></span>
                                    <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" value="{{ old('nomor_surat', $suratmasuk->nomor_surat) }}">
                                </div>
                                @error('nomor_surat')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kode Klasifikasi</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tags"></i></span>
                                    <input type="text" name="kode_klasifikasi" class="form-control @error('kode_klasifikasi') is-invalid @enderror" value="{{ old('kode_klasifikasi', $suratmasuk->kode_klasifikasi) }}">
                                </div>
                                @error('kode_klasifikasi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 2 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Surat</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                    <input type="date" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror" value="{{ old('tanggal_surat', $suratmasuk->tanggal_surat) }}">
                                </div>
                                @error('tanggal_surat')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Terima</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                                    <input type="date" name="tanggal_terima" class="form-control @error('tanggal_terima') is-invalid @enderror" value="{{ old('tanggal_terima', $suratmasuk->tanggal_terima) }}">
                                </div>
                                @error('tanggal_terima')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 3 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Asal Surat</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-building"></i></span>
                                    <input type="text" name="asal_surat" class="form-control @error('asal_surat') is-invalid @enderror" value="{{ old('asal_surat', $suratmasuk->asal_surat) }}">
                                </div>
                                @error('asal_surat')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Pengirim</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-lines-fill"></i></span>
                                    <input type="text" name="pengirim" class="form-control @error('pengirim') is-invalid @enderror" value="{{ old('pengirim', $suratmasuk->pengirim) }}">
                                </div>
                                @error('pengirim')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 4 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Perihal</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-chat-text"></i></span>
                                    <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal', $suratmasuk->perihal) }}">
                                </div>
                                @error('perihal')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Lampiran</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-paperclip"></i></span>
                                    <input type="text" name="lampiran" class="form-control @error('lampiran') is-invalid @enderror" value="{{ old('lampiran', $suratmasuk->lampiran) }}">
                                </div>
                                @error('lampiran')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 5 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis Surat</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-folder2-open"></i></span>
                                    <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                        <option value="">-- Pilih Jenis Arsip --</option>
                                        @foreach ($jenisarsips as $jenis)
                                            <option value="{{ $jenis->id }}" {{ old('jenis', $suratmasuk->jenis) == $jenis->id ? 'selected' : '' }}>{{ $jenis->jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('jenis')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Upload File</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-file-earmark-arrow-up"></i></span>
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                </div>
                                @error('file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                               @if ($suratmasuk->file && file_exists(public_path('storage/' . $suratmasuk->file)))
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $suratmasuk->file) }}" target="_blank">
                                        <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                    </a>
                                </div>
                            @else
                                <div class="mt-2 text-muted">
                                    <i class="bi bi-exclamation-circle"></i> File tidak ditemukan atau tidak bisa diakses.
                                </div>
                            @endif

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $suratmasuk->keterangan) }}</textarea>
                                </div>
                                @error('keterangan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="form-group row mt-4">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('suratmasuk.index') }}" class="btn btn-secondary">
                            <i class="icon-action-undo me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-2"  style="margin-left: 0.5rem;">
                            <i class="bi bi-save me-1"></i> Update
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
