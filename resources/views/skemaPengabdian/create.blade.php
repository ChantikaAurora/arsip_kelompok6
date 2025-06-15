@extends('tampilan.main')

@section('navSkema', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <div class="container mt-4">
        {{-- Judul Halaman --}}
        <div class="border-bottom mb-4 pb-2">
            <h3 class="mb-3">Formulir Tambah Skema Penelitian</h3>
            <p class="text-muted">Tambahkan data skema penelitian dengan benar agar dapat disimpan ke dalam sistem.</p>
        </div>

        {{-- Notifikasi Error --}}
         @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
            </div>
        @endif

        {{-- Kartu Form --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('skemaPengabdian.store') }}" method="POST">
                    @csrf

                    {{-- Nama Skema --}}
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Skema</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                id="skema_pengabdian"
                                name="skema_pengabdian"
                                class="form-control @error('skema_pengabdian') is-invalid @enderror"
                                value="{{ old('skema_pengabdian') }}"
                                placeholder="Contoh: Pengabdian Dosen Pemula, Riset Unggulan, dll"
                            >
                            @error('skema_pengabdian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="text-end">
                        <a href="{{ route('skemaPengabdian.index') }}" class="btn btn-secondary">
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
