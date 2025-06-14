@extends('tampilan.main')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Laporan Penelitian</h3>
        <p class="text-muted">Isi data laporan penelitian dengan lengkap dan benar.</p>
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
            <form action="{{ route('laporan_penelitian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul Penelitian</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul_penelitian" class="form-control @error('judul_penelitian') is-invalid @enderror" value="{{ old('judul_penelitian') }}" required>
                        @error('judul_penelitian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Peneliti --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Peneliti</label>
                    <div class="col-sm-10">
                        <input type="text" name="peneliti" class="form-control @error('peneliti') is-invalid @enderror" value="{{ old('peneliti') }}" required>
                        @error('peneliti')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Jenis Arsip --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis Arsip</label>
                    <div class="col-sm-10">
                        <select name="jenis_arsip_laporan" class="form-control @error('jenis_arsip_laporan') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Arsip --</option>
                            @foreach ($jenisarsips as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('jenis_arsip_laporan') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_arsip_laporan')
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
                            <option value="TI" {{ old('jurusan') == 'TI' ? 'selected' : '' }}>Teknologi Informasi</option>
                            <option value="AN" {{ old('jurusan') == 'AN' ? 'selected' : '' }}>Administrasi Niaga</option>
                        </select>
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tahun Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tahun Penelitian</label>
                    <div class="col-sm-10">
                        <input type="number" name="tahun_penelitian" class="form-control @error('tahun_penelitian') is-invalid @enderror" min="1900" max="{{ date('Y')+5 }}" value="{{ old('tahun_penelitian') }}" required>
                        @error('tahun_penelitian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Laporan Diterima --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Laporan Diterima</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_laporan_diterima" class="form-control @error('tanggal_laporan_diterima') is-invalid @enderror" value="{{ old('tanggal_laporan_diterima') }}" required>
                        @error('tanggal_laporan_diterima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Status Laporan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status Laporan</label>
                    <div class="col-sm-10">
                        <select name="status_laporan" class="form-control @error('status_laporan') is-invalid @enderror" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="proses" {{ old('status_laporan') == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ old('status_laporan') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status_laporan')
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

                <!-- {{-- Keterangan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> -->

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('laporan_penelitian.index') }}" class="btn btn-secondary">
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
