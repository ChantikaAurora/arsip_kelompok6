@extends('tampilan.main')

@section('navSuratMasuk', 'active') {{-- Sesuaikan nama nav jika berbeda --}}
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Surat Masuk</h3>
        <p class="text-muted">Isi data surat masuk dengan lengkap dan benar.</p>
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
            <form action="{{ route('suratmasuk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nomor Surat --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nomor Surat</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" value="{{ old('nomor_surat') }}">
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kode Klasifikasi --}}
                <div class="mb-3 row"> {{-- FIELD BARU --}}
                    <label class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_klasifikasi" class="form-control @error('kode_klasifikasi') is-invalid @enderror" value="{{ old('kode_klasifikasi') }}">
                        @error('kode_klasifikasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Surat --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror" value="{{ old('tanggal_surat') }}">
                        @error('tanggal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Terima --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Terima</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_terima" class="form-control @error('tanggal_terima') is-invalid @enderror" value="{{ old('tanggal_terima') }}">
                        @error('tanggal_terima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Asal Surat --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Asal Surat</label>
                    <div class="col-sm-10">
                        <input type="text" name="asal_surat" class="form-control @error('asal_surat') is-invalid @enderror" value="{{ old('asal_surat') }}">
                        @error('asal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Pengirim --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Pengirim</label>
                    <div class="col-sm-10">
                        <input type="text" name="pengirim" class="form-control @error('pengirim') is-invalid @enderror" value="{{ old('pengirim') }}">
                        @error('pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Perihal --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Perihal</label>
                    <div class="col-sm-10">
                        <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal') }}">
                        @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Lampiran --}}
                <div class="mb-3 row"> {{-- FIELD BARU --}}
                    <label class="col-sm-2 col-form-label">Lampiran</label>
                    <div class="col-sm-10">
                        <input type="text" name="lampiran" class="form-control @error('lampiran') is-invalid @enderror" value="{{ old('lampiran') }}">
                        @error('lampiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Jenis (Dropdown dari tabel jenis) --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Arsip --</option>
                            @foreach ($jenisarsips as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('jenis') == $jenis->jenis ? 'selected' : '' }}>
                                    {{ $jenis->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="mb-3 row"> {{-- FIELD BARU --}}
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Upload File --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Upload File</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('suratmasuk.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
