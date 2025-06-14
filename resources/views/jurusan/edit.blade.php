@extends('tampilan.main')

@section('title', 'Edit Jurusan')
@section('navJurusan', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda! Coba periksa kembali.
    </div>
@endif

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Edit Jurusan</h3>
        <p class="text-muted">Silakan perbarui data jurusan sesuai kebutuhan.</p>
    </div>
    <div class="card-body">
        <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Kode Jurusan --}}
            <div class="mb-3">
                <label for="kode_jurusan" class="form-label">Kode Jurusan</label>
                <input type="text" name="kode_jurusan" class="form-control @error('kode_jurusan') is-invalid @enderror" value="{{ old('kode_jurusan', $jurusan->kode_jurusan) }}" required>
                @error('kode_jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nama Jurusan --}}
            <div class="mb-3">
                <label for="jurusan" class="form-label">Nama Jurusan</label>
                <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan', $jurusan->jurusan) }}" required>
                @error('jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
