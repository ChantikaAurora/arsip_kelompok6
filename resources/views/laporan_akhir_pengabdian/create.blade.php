@extends('tampilan.main')

@section('navLaporanAkhirPenelitian', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Laporan Akhir Pengabdian</h3>
        <p class="text-muted">Isi data laporan akhir pengabdian dengan lengkap dan benar.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
        </div>
    @endif

    <div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('laporan_akhir_pengabdian.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ID Laporan Akhir --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                <div class="col-sm-10">
                    <input type="text" name="id_laporan_akhir" class="form-control @error('id_laporan_akhir') is-invalid @enderror" value="{{ old('id_laporan_akhir') }}" placeholder="Contoh: 123e4567-e89b-12d3-a456-426614174000">
                    @error('id_laporan_akhir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Judul Kegiatan --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Judul Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" name="judul_kegiatan" class="form-control @error('judul_kegiatan') is-invalid @enderror" value="{{ old('judul_kegiatan') }}" placeholder="Contoh: Pengabdian XYZ">
                    @error('judul_kegiatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Skema --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Skema</label>
                <div class="col-sm-10">
                    <select name="skema" class="form-control @error('skema') is-invalid @enderror" required>
                        <option value="">-- Pilih Skema --</option>
                        @foreach ($skemas as $skema)
                            <option value="{{ $skema->id }}" {{ old('skema') == $skema->id ? 'selected' : '' }}>
                                {{ $skema->skema_penelitian }}
                            </option>
                        @endforeach
                    </select>
                    @error('skema')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Tahun Pelaksanaan --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Tahun Pelaksanaan</label>
                <div class="col-sm-10">
                    <input type="text" name="tahun_pelaksanaan" class="form-control @error('tahun_pelaksanaan') is-invalid @enderror" value="{{ old('tahun_pelaksanaan') }}" placeholder="Contoh: 2025">
                    @error('tahun_pelaksanaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Upload File --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Upload File</label>
                <div class="col-sm-10">
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Tombol --}}
            <div class="text-end">
                <a href="{{ route('laporan_akhir_pengabdian.index') }}" class="btn btn-secondary">
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
