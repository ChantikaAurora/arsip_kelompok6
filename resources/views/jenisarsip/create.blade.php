@extends('tampilan.navbar')
@section('page-title', 'Jenis Arsip')
@section('navJenisArsip', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
<div class="container mt-4">

    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Tambah Jenis Arsip</h3>
        <p class="text-muted mb-0">Lengkapi data jenis arsip yang ingin ditambahkan ke dalam sistem.</p>
    </div>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data. Silakan coba lagi.
        </div>
    @endif

    {{-- Kartu Form --}}
    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form method="POST" action="{{ route('jenisarsip.store') }}">
                @csrf

                {{-- Jenis Arsip --}}
                <div class="form-group row mb-4">
                    <label for="jenis" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-archive-fill me-1"></i> Jenis
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="jenis" id="jenis"
                            class="form-control rounded-3 shadow-sm @error('jenis') is-invalid @enderror"
                            value="{{ old('jenis') }}"
                            placeholder="Contoh: Keuangan, Pendidikan, dll">
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="form-group row mb-4">
                    <label for="keterangan" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-info-circle-fill me-1"></i> Keterangan
                    </label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" id="keterangan"
                            class="form-control rounded-3 shadow-sm @error('keterangan') is-invalid @enderror"
                            rows="3"
                            placeholder="Masukkan keterangan tambahan terkait jenis arsip">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('jenisarsip.index') }}" class="btn btn-secondary">
                           <i class="icon-action-undo mr-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-2" style="margin-left: 0.5rem;">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
