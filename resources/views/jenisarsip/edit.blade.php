@extends('tampilan.main')

@section('title', 'Edit Jenis Arsip')
@section('navJenisArsip', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda! Coba periksa kembali.
        </div>
    @endif

    <div class=" container mt-4">
        <div class="border-bottom mb-4 pb-2">
            <h3 class="mb-3">Formulir Edit Jenis Arsip</h3>
            <p class="text-muted">Silakan perbarui data jenis arsip sesuai kebutuhan.</p>
        </div>
        <div class="card-body">
            <form action="{{ route('jenisarsip.update', $jenisarsip->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Arsip</label>
                    <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror"
                        value="{{ old('jenis', $jenisarsip->jenis) }}" required>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                        rows="3">{{ old('keterangan', $jenisarsip->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-save"></i> Update
                        </button>
                        <a href="{{ route('jenisarsip.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                    </div>
            </form>
        </div>
    </div>
@endsection
