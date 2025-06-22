@extends('tampilan.main')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Pengguna</h3>
        <p class="text-muted">Silakan lengkapi data pengguna dengan benar untuk ditambahkan ke sistem arsip.</p>
    </div>

    {{-- Notifikasi Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
        </div>
    @endif

    {{-- Form Tambah Pengguna --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('pengguna.store') }}">
                @csrf

                {{-- Username --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label font-weight-normal">Username :</label>
                    <div class="col-sm-10">
                        <input
                            type="text"
                            name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username"
                        >
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label font-weight-normal">Email :</label>
                    <div class="col-sm-10">
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email pengguna"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label font-weight-normal">Password :</label>
                    <div class="col-sm-10">
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password"
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Role --}}
                <div class="mb-4 row">
                    <label class="col-sm-2 col-form-label font-weight-normal">Role :</label>
                    <div class="col-sm-10">
                        <select
                            name="role"
                            class="form-control @error('role') is-invalid @enderror"
                        >
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Pilih Role --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="p3m" {{ old('role') == 'p3m' ? 'selected' : '' }}>P3M</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
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
