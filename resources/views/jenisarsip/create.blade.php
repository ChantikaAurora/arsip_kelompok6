@extends('tampilan.main')

@section('navJenisArsip', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <div class="container mt-4">
        {{-- Judul Halaman --}}
        <div class="border-bottom mb-4 pb-2">
            <h3 class="mb-3">Formulir Tambah Jenis Arsip</h3>
            <p class="text-muted">Tambahkan data jenis arsip dengan benar agar dapat disimpan ke dalam sistem.</p>
        </div>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Kartu Form --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('jenisarsip.store') }}" method="POST">
                    @csrf

                    {{-- Jenis Arsip --}}
                    <div class="mb-3">
                        <label for="jenis" class="form-label fw-semibold">Jenis Arsip</label>
                        <input 
                            type="text" 
                            id="jenis"
                            name="jenis" 
                            class="form-control @error('jenis') is-invalid @enderror" 
                            value="{{ old('jenis') }}" 
                            placeholder="Contoh: Pendidikan, Keuangan, dll"
                        >
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-4">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                        <textarea 
                            id="keterangan"
                            name="keterangan" 
                            class="form-control @error('keterangan') is-invalid @enderror" 
                            rows="3"
                            placeholder="Tambahkan deskripsi atau penjelasan singkat terkait jenis arsip ini"
                        >{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-save"></i> Simpan
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
