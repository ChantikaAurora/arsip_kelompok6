@extends('tampilan.navbar')
@section('page-title', 'Jenis Arsip')
@section('navJenisArsip', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Jenis Arsip</h3>
        <p class="text-muted mb-0">Silakan perbarui data jenis arsip dengan benar agar tetap konsisten di sistem.</p>
    </div>

    {{-- Notifikasi Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data. Silakan periksa kembali.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Horizontal --}}
    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form method="POST" action="{{ route('jenisarsip.update', $jenisarsip->id) }}">
                @csrf
                @method('PUT')

                {{-- Jenis --}}
                <div class="form-group row mb-4">
                    <label for="jenis" class="col-sm-2 col-form-label fw-semibold">
                        <i class="bi bi-archive-fill me-1"></i> Jenis
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="jenis" id="jenis"
                            class="form-control rounded-3 shadow-sm @error('jenis') is-invalid @enderror"
                            value="{{ old('jenis', $jenisarsip->jenis) }}"
                            placeholder="Contoh: Keuangan, Akademik, dst.">
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
                        <textarea name="keterangan" id="keterangan" rows="3"
                            class="form-control rounded-3 shadow-sm @error('keterangan') is-invalid @enderror"
                            placeholder="Opsional: Tambahkan deskripsi jika perlu.">{{ old('keterangan', $jenisarsip->keterangan) }}</textarea>
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
                            <i class="bi bi-save me-1"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
