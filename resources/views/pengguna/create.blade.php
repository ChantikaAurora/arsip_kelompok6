@extends('tampilan.navbar')
@section('page-title', 'Pengguna')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://unpkg.com/feather-icons"></script>

<style>
  .toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    height: 1.5em;
    width: 1.5em;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #6c757d;
  }

  .form-control {
    padding-right: 3rem;
  }
</style>

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Tambah Pengguna</h3>
        <p class="text-muted mb-0">Silakan lengkapi data pengguna dengan benar untuk ditambahkan ke sistem arsip.</p>
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

    {{-- Form Horizontal --}}
    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form class="forms-sample" method="POST" action="{{ route('pengguna.store') }}">
                @csrf

                {{-- Username --}}
                <div class="form-group row mb-4">
                    <label for="username" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-person-circle me-1"></i> Username
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="username" id="username"
                            class="form-control rounded-3 shadow-sm @error('username') is-invalid @enderror"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group row mb-4">
                    <label for="email" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-envelope-at-fill me-1"></i> Email
                    </label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email"
                            class="form-control rounded-3 shadow-sm @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email pengguna">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group row mb-4">
                    <label for="password" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-lock-fill me-1"></i> Password
                    </label>
                        <div class="col-sm-10">
                            <div class="position-relative">
                            <input type="password" name="password" id="password"
                                    class="form-control rounded-3 shadow-sm @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password minimal 8 karakter">
                            <span class="toggle-password" onclick="togglePassword()">
                                <i data-feather="eye-off" id="toggleIcon"></i>
                            </span>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                </div>


                {{-- Role --}}
                <div class="form-group row mb-4">
                    <label for="role" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-person-gear me-1"></i> Role
                    </label>
                    <div class="col-sm-10">
                        <select name="role" id="role"
                            class="form-control rounded-3 shadow-sm @error('role') is-invalid @enderror">
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
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2 d-flex ">
                        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
                            <i class="icon-action-undo mr-1"></i>Kembali
                         </a>
                        <button type="submit" class="btn btn-primary" style="margin-left: 0.5rem;"><i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

{{-- Script Feather dan Toggle Password --}}
<script>
    feather.replace();

    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');

        if (password.type === 'password') {
            password.type = 'text';
            icon.setAttribute('data-feather', 'eye');
        } else {
            password.type = 'password';
            icon.setAttribute('data-feather', 'eye-off');
        }

        feather.replace(); // refresh icon
    }
</script>
@endsection
