@extends('tampilan.main')

@section('title', 'Edit Skema Pengabdian')
@section('navSkema', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda! Coba periksa kembali.
        </div>
    @endif

    <div class="container mt-4">
        <div class="border-bottom mb-4 pb-2">
            <h3 class="mb-3">Formulir Edit Skema Pengabdian</h3>
            <p class="text-muted">Silakan perbarui data skema sesuai kebutuhan.</p>
        </div>
        <div class="card-body">
            <form action="{{ route('skemaPengabdian.update', $skema->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="skema" class="form-label">Nama Skema</label>
                    <input type="text" name="skema_pengabdian" class="form-control @error('skema_pengabdian') is-invalid @enderror"
                        value="{{ old('skema_pengabdian', $skema->skema_pengabdian) }}" required>
                    @error('skema_pengabdian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('skemaPengabdian.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
