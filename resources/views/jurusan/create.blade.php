@extends('tampilan.main')

@section('navJurusan', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Jurusan</h3>
        <p class="text-muted">Tambahkan data jurusan baru ke dalam sistem dengan lengkap dan benar.</p>
    </div>

    {{-- Error --}}
     @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
        </div>
    @endif

    {{-- Form --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('jurusan.store') }}" method="POST">
                @csrf

                {{-- Kode Jurusan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_jurusan" class="form-control @error('kode_jurusan') is-invalid @enderror" value="{{ old('kode_jurusan') }}" placeholder="Contoh: 001" required>
                        @error('kode_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Nama Jurusan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nama Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan') }}" placeholder="Contoh: Teknologi Informasi" required>
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">
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
