@extends('tampilan.main')

@section('navProdi', 'active')
@section('content')

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Prodi</h3>
        <p class="text-muted">Silakan masukkan data prodi baru ke sistem.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan input:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('prodi.store') }}" method="POST">
                @csrf

                {{-- Pilih Jurusan --}}
                <div class="mb-3 row">
                    <label for="jurusan_id" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <select id="jurusan_id" name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kode Prodi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode Prodi</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_prodi" class="form-control @error('kode_prodi') is-invalid @enderror" value="{{ old('kode_prodi') }}" placeholder="Contoh: 1.1">
                        @error('kode_prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Nama Prodi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nama Prodi</label>
                    <div class="col-sm-10">
                        <input type="text" name="prodi" class="form-control @error('prodi') is-invalid @enderror" value="{{ old('prodi') }}" placeholder="Contoh: Teknologi Rekayasa Perangkat Lunak">
                        @error('prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('prodi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
