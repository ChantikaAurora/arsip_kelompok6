@extends('tampilan.main')

@section('navProposal', 'active') {{-- Sesuaikan jika pakai navbar dinamis --}}
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Proposal</h3>
        <p class="text-muted">Isi data proposal dengan lengkap dan benar.</p>
    </div>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
            <ul class="mb-0 mt-2">
                @foreach ($errors as $error)
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

                {{-- Jurusan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan') }}">
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Jenis --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Arsip --</option>
                            @foreach ($jenisarsips as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('jenis') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tahun Pengajuan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tahun Pengajuan</label>
                    <div class="col-sm-10">
                        <input type="number" name="tahun_pengajuan" class="form-control @error('tahun_pengajuan') is-invalid @enderror" value="{{ old('tahun_pengajuan') }}">
                        @error('tahun_pengajuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status') }}">
                        @error('status')
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

                {{-- Dana Diajukan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Dana Diajukan (Rp)</label>
                    <div class="col-sm-10">
                        <input type="number" name="dana_diajukan" class="form-control @error('dana_diajukan') is-invalid @enderror" value="{{ old('dana_diajukan') }}">
                        @error('dana_diajukan')
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
                        <input type="file" name="file_proposal" class="form-control @error('file_proposal') is-invalid @enderror" accept=".pdf,.doc,.docx">
                        @error('file_proposal')
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
