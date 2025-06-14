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
                <form action="{{ route('skemaPenelitian.store') }}" method="POST">
                    @csrf

                    {{-- Nama Skema --}}
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Skema</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                id="skema_penelitian"
                                name="skema_penelitian"
                                class="form-control @error('skema_penelitian') is-invalid @enderror"
                                value="{{ old('skema_penelitian') }}"
                                placeholder="Contoh: Penelitian Dosen Pemula, Riset Unggulan, dll"
                            >
                            @error('skema_penelitian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="text-end">
                        <a href="{{ route('skemaPenelitian.index') }}" class="btn btn-secondary">
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
