@extends('tampilan.main')

@section('title', 'Edit Surat Keluar')
@section('navSuratKeluar', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Edit Surat Keluar</h3>
        <p class="text-muted">Silakan perbarui data surat keluar sesuai kebutuhan.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda! Coba periksa kembali.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('suratkeluar.update', $suratkeluar->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nomor Surat --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nomor Surat</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror"
                            value="{{ old('nomor_surat', $suratkeluar->nomor_surat) }}" required>
                        @error('nomor_surat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Nomor Agenda --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nomor Agenda</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_agenda" class="form-control @error('nomor_agenda') is-invalid @enderror"
                            value="{{ old('nomor_agenda', $suratkeluar->nomor_agenda) }}">
                        @error('nomor_agenda')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Kode Klasifikasi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_klasifikasi" class="form-control @error('kode_klasifikasi') is-invalid @enderror"
                            value="{{ old('kode_klasifikasi', $suratkeluar->kode_klasifikasi) }}" required>
                        @error('kode_klasifikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Tanggal Surat --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror"
                            value="{{ old('tanggal_surat', $suratkeluar->tanggal_surat) }}" required>
                        @error('tanggal_surat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Tujuan Surat --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-10">
                        <input type="text" name="tujuan_surat" class="form-control @error('tujuan_surat') is-invalid @enderror"
                            value="{{ old('tujuan_surat', $suratkeluar->tujuan_surat) }}" required>
                        @error('tujuan_surat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Penerima --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Penerima</label>
                    <div class="col-sm-10">
                        <input type="text" name="penerima" class="form-control @error('penerima') is-invalid @enderror"
                            value="{{ old('penerima', $suratkeluar->penerima) }}">
                        @error('penerima')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Perihal --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Perihal</label>
                    <div class="col-sm-10">
                        <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror"
                            value="{{ old('perihal', $suratkeluar->perihal) }}" required>
                        @error('perihal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Lampiran --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Lampiran</label>
                    <div class="col-sm-10">
                        <input type="text" name="lampiran" class="form-control @error('lampiran') is-invalid @enderror"
                            value="{{ old('lampiran', $suratkeluar->lampiran) }}">
                        @error('lampiran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Jenis Arsip --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis Arsip</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Arsip --</option>
                            @foreach ($jenisarsips as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('jenis', $suratkeluar->jenis) == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" rows="2" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $suratkeluar->keterangan) }}</textarea>
                        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- File --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">File</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @if ($suratkeluar->file)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $suratkeluar->file) }}" target="_blank">
                                    <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('suratkeluar.index') }}" class="btn btn-secondary">
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
