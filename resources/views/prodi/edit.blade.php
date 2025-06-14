@extends('tampilan.main')

@section('navProdi', 'active')
@section('content')

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Edit Prodi</h3>
        <p class="text-muted">Silakan perbarui data prodi sesuai kebutuhan.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda!
        </div>
    @endif

    <div class="card-body">
        <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Jurusan --}}
            <div class="mb-3 row">
                <label for="jurusan_id" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <select id="jurusan_id" name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" required>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ $jurusan->id == $prodi->jurusan_id ? 'selected' : '' }}>
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
                    <input type="text" name="kode_prodi" class="form-control @error('kode_prodi') is-invalid @enderror" value="{{ old('kode_prodi', $prodi->kode_prodi) }}">
                    @error('kode_prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Nama Prodi --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nama Prodi</label>
                <div class="col-sm-10">
                    <input type="text" name="prodi" class="form-control @error('prodi') is-invalid @enderror" value="{{ old('prodi', $prodi->prodi) }}">
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
                    <i class="bi bi-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
