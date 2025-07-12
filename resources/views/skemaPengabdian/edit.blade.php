@extends('tampilan.navbar')
@section('page-title', 'Skema')
@section('navSkema', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Skema Pengabdian</h3>
        <p class="text-muted mb-0">Silakan perbarui data skema pengabdian dengan benar untuk diperbarui ke sistem arsip.</p>
    </div>

    {{-- Notifikasi Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit --}}
    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form method="POST" action="{{ route('skemaPengabdian.update', $skema->id) }}">
                @csrf
                @method('PUT')

                {{-- Nama Skema --}}
                <div class="form-group row mb-4">
                    <label for="skema_pengabdian" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-journal-text me-1"></i> Nama Skema
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="skema_pengabdian" id="skema_pengabdian"
                            class="form-control rounded-3 shadow-sm @error('skema_pengabdian') is-invalid @enderror"
                            value="{{ old('skema_pengabdian', $skema->skema_pengabdian) }}"
                            placeholder="Contoh: Pengabdian Kepada Masyarakat, Riset Unggulan, dll">
                        @error('skema_pengabdian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('skemaPengabdian.index') }}" class="btn btn-secondary">
                           <i class="icon-action-undo mr-1"></i> Kembali
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
