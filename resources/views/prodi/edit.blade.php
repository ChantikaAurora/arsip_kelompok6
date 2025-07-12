@extends('tampilan.navbar')
@section('page-title', 'Prodi')
@section('navProdi', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Prodi</h3>
        <p class="text-muted mb-0">Silakan lengkapi data program studi dengan benar untuk diperbarui ke sistem arsip.</p>
    </div>

    {{-- Notifikasi Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data.
            <ul class="mb-0 mt-2">
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit --}}
    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form method="POST" action="{{ route('prodi.update', $prodi->id) }}">
                @csrf
                @method('PUT')

                {{-- Jurusan --}}
                <div class="form-group row mb-4">
                    <label for="jurusan_id" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-diagram-3-fill me-1"></i> Jurusan
                    </label>
                    <div class="col-sm-10">
                        <select name="jurusan_id" id="jurusan_id"
                            class="form-control rounded-3 shadow-sm @error('jurusan_id') is-invalid @enderror">
                            <option value="" disabled>-- Pilih Jurusan --</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}"
                                    {{ old('jurusan_id', $prodi->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kode Prodi --}}
                <div class="form-group row mb-4">
                    <label for="kode_prodi" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-code-slash me-1"></i> Kode Prodi
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_prodi" id="kode_prodi"
                            class="form-control rounded-3 shadow-sm @error('kode_prodi') is-invalid @enderror"
                            value="{{ old('kode_prodi', $prodi->kode_prodi) }}"
                            placeholder="Contoh: 1.1">
                        @error('kode_prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Nama Prodi --}}
                <div class="form-group row mb-4">
                    <label for="prodi" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-mortarboard-fill me-1"></i> Nama Prodi
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="prodi" id="prodi"
                            class="form-control rounded-3 shadow-sm @error('prodi') is-invalid @enderror"
                            value="{{ old('prodi', $prodi->prodi) }}"
                            placeholder="Contoh: Teknologi Rekayasa Perangkat Lunak">
                        @error('prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('prodi.index') }}" class="btn btn-secondary">
                            <i class="icon-action-undo mr-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-2" style="margin-left: 0.5rem;">
                            <i class="bi bi-save"></i> Update
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
