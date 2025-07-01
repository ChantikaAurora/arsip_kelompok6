@extends('tampilan.main')

@section('title', 'Edit Jenis Arsip')
@section('navJenisArsip', 'active')

{{-- Bootstrap Icons --}}
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endpush

@section('content')
<div class="container mt-4">
    {{-- Header --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Edit Jenis Arsip</h3>
        <p class="text-muted">Silakan perbarui data jenis arsip sesuai kebutuhan.</p>
    </div>

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
        </div>
    @endif

    {{-- Form --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('jenisarsip.update', $jenisarsip->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Jenis Arsip --}}
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Arsip</label>
                    <input
                        type="text"
                        name="jenis"
                        id="jenis"
                        class="form-control @error('jenis') is-invalid @enderror"
                        value="{{ old('jenis', $jenisarsip->jenis) }}"
                        required
                    >
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea
                        name="keterangan"
                        id="keterangan"
                        rows="3"
                        class="form-control @error('keterangan') is-invalid @enderror"
                    >{{ old('keterangan', $jenisarsip->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
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
</div>
@endsection
