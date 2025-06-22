@extends('tampilan.main')

@section('navLaporanKemajuanPengabdian', 'active')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Laporan Kemajuan Pengabdian</h3>
        <p class="text-muted">Isi data laporan kemajuan pengabdian dengan lengkap dan benar.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
        </div>
    @endif

    <div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('laporan_kemajuan_pengabdian.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Kode --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                <div class="col-sm-10">
                    <input type="text" name="id_laporan" class="form-control @error('id_laporan') is-invalid @enderror" value="{{ old('id_laporan') }}" placeholder="Contoh: 987654">
                    @error('id_laporan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Judul Kegiatan --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Judul Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" name="judul_kegiatan" class="form-control @error('judul_kegiatan') is-invalid @enderror" value="{{ old('judul_kegiatan') }}" placeholder="Contoh: Pengabdian ABC">
                    @error('judul_kegiatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Nama Ketua --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nama Ketua</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_ketua" class="form-control @error('nama_ketua') is-invalid @enderror" value="{{ old('nama_ketua') }}" placeholder="Contoh: Ibu Sari">
                    @error('nama_ketua')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Nama Anggota --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nama Anggota</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_anggota" class="form-control @error('nama_anggota') is-invalid @enderror" value="{{ old('nama_anggota') }}" placeholder="Contoh: Rudi, Lestari">
                    @error('nama_anggota')
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
                                {{ $skema->skema_pengabdian }}
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

            {{-- Jurusan --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <select name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ old('jurusan') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Prodi --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Prodi</label>
                <div class="col-sm-10">
                    <select name="prodi" class="form-control @error('prodi') is-invalid @enderror" required>
                        <option value="">-- Pilih Prodi --</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ old('prodi') == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->prodi }}
                            </option>
                        @endforeach
                    </select>
                    @error('prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Periode Laporan --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Periode Laporan</label>
                <div class="col-sm-10">
                    <select name="periode_laporan" class="form-control @error('periode_laporan') is-invalid @enderror" required>
                        <option value="">-- Pilih Periode --</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="Semester {{ $i }}" {{ old('periode_laporan') == 'Semester ' . $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('periode_laporan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Ringkasan</label>
                <div class="col-sm-10">
                    <textarea name="ringkasan" class="form-control @error('ringkasan') is-invalid @enderror" rows="4" placeholder="Ringkasan laporan...">{{ old('ringkasan') }}</textarea>
                    @error('ringkasan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- File --}}
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
                <a href="{{ route('laporan_kemajuan_pengabdian.index') }}" class="btn btn-secondary">
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
