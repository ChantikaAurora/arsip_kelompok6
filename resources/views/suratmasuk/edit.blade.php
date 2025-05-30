@extends('tampilan.main')

@section('title', 'Edit Surat Masuk')
@section('navSuratMasuk', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
    <div class="container mt-4">
        <div class="border-bottom mb-4 pb-2">
            <h3 class="mb-3">Formulir Edit Surat Masuk</h3>
            <p class="text-muted">Silakan perbarui data surat masuk sesuai kebutuhan.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda! Coba periksa kembali.
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('suratmasuk.update', $suratmasuk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal ">Nomor Surat </label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror"
                            value="{{ old('nomor_surat', $suratmasuk->nomor_surat) }}" required>
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal ">Tanggal Surat </label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror"
                            value="{{ old('tanggal_surat', $suratmasuk->tanggal_surat) }}" required>
                        @error('tanggal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal ">Tanggal Terima </label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_terima" class="form-control @error('tanggal_terima') is-invalid @enderror"
                            value="{{ old('tanggal_terima', $suratmasuk->tanggal_terima) }}" required>
                        @error('tanggal_terima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal ">Asal Surat </label>
                        <div class="col-sm-10">
                            <input type="text" name="asal_surat" class="form-control @error('asal_surat') is-invalid @enderror"
                            value="{{ old('asal_surat', $suratmasuk->asal_surat) }}" required>
                        @error('asal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal ">Perihal</label>
                        <div class="col-sm-10">
                            <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror"
                            value="{{ old('perihal', $suratmasuk->perihal) }}" required>
                        @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal ">Pengirim</label>
                        <div class="col-sm-10">
                            <input type="text" name="pengirim" class="form-control @error('pengirim') is-invalid @enderror"
                            value="{{ old('pengirim', $suratmasuk->pengirim) }}" required>
                        @error('pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal ">Jenis Surat</label>
                        <div class="col-sm-10">
                            <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Surat --</option>
                            @foreach ($jenisarsips as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('jenis', $suratmasuk->jenis) == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal ">File</label>
                        <div class="col-sm-10">
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($suratmasuk->file)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $suratmasuk->file) }}" target="_blank">
                                    <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                </a>
                            </div>
                        @endif
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="text-end">
                        <a href="{{ route('suratmasuk.index') }}" class="btn btn-secondary">
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
