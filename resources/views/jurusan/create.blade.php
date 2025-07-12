@extends('tampilan.navbar')
@section('page-title', 'Jurusan')
@section('navJurusan', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Tambah Jurusan</h3>
        <p class="text-muted mb-0">Silakan masukkan data jurusan baru ke sistem dengan lengkap dan benar.</p>
    </div>

    {{-- Notifikasi Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data. Silakan coba lagi.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Jurusan --}}
    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form action="{{ route('jurusan.store') }}" method="POST">
                @csrf

                {{-- Kode Jurusan --}}
                <div class="form-group row mb-4">
                    <label for="kode_jurusan" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-upc-scan me-1"></i> Kode Jurusan
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_jurusan" id="kode_jurusan"
                            class="form-control rounded-3 shadow-sm @error('kode_jurusan') is-invalid @enderror"
                            value="{{ old('kode_jurusan') }}"
                            placeholder="Contoh: 001">
                        @error('kode_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Nama Jurusan --}}
                <div class="form-group row mb-4">
                    <label for="jurusan" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-journal-text me-1"></i> Nama Jurusan
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="jurusan" id="jurusan"
                            class="form-control rounded-3 shadow-sm @error('jurusan') is-invalid @enderror"
                            value="{{ old('jurusan') }}"
                            placeholder="Contoh: Teknologi Informasi">
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">
                             <i class="icon-action-undo mr-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-2" style="margin-left: 0.5rem;">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
