@extends('tampilan.main')

@section('navProposal', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Proposal Penelitian</h3>
        <p class="text-muted">Isi data proposal penelitian dengan lengkap dan benar.</p>
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
            <form action="{{ route('proposal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Kode Seri --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode Seri</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_seri" class="form-control @error('kode_seri') is-invalid @enderror" value="{{ old('kode_seri') }}">
                        @error('kode_seri')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Judul --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Peneliti --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Peneliti</label>
                    <div class="col-sm-10">
                        <input type="text" name="peneliti" class="form-control @error('peneliti') is-invalid @enderror" value="{{ old('peneliti') }}">
                        @error('peneliti')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Skema --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Skema</label>
                    <div class="col-sm-10">
                        <input type="text" name="skema" class="form-control @error('skema') is-invalid @enderror" value="{{ old('skema') }}">
                        @error('skema')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Anggota --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" name="anggota" class="form-control @error('anggota') is-invalid @enderror" value="{{ old('anggota') }}">
                        @error('anggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Jurusan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <select name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Prodi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-10">
                        <select name="prodi_id" class="form-control @error('prodi_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Pengajuan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Pengajuan</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" value="{{ old('tanggal_pengajuan') }}">
                        @error('tanggal_pengajuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Upload File --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Upload File Proposal</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.doc,.docx">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('proposal.index') }}" class="btn btn-secondary">
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