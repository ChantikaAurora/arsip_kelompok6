@extends('tampilan.main')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Edit Laporan Penelitian</h3>
        <p class="text-muted">Isi data laporan penelitian dengan lengkap dan benar.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan input:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('laporan_penelitian.update', $laporan_penelitian->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Kode Seri  --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode Seri</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_seri" class="form-control" value="{{ $laporan_penelitian->kode_seri }}" required>
                    </div>
                </div>

                {{-- Judul Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul Penelitian</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul_penelitian" class="form-control" value="{{ $laporan_penelitian->judul_penelitian }}" required>
                    </div>
                </div>

                {{-- Peneliti --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Peneliti</label>
                    <div class="col-sm-10">
                        <input type="text" name="peneliti" class="form-control" value="{{ $laporan_penelitian->peneliti }}" required>
                    </div>
                </div>

                {{-- Skema --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Skema</label>
                    <div class="col-sm-10">
                        <input type="text" name="skema" class="form-control" value="{{ $laporan_penelitian->skema }}" required>
                    </div>
                </div>

                {{-- Anggota --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" name="anggota" class="form-control" value="{{ $laporan_penelitian->anggota }}" required>
                    </div>
                </div>

                {{-- Jenis Arsip
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis Arsip</label>
                    <div class="col-sm-10">
                        <input type="number" name="jenis_arsip_laporan" class="form-control" value="{{ $laporan_penelitian->jenis_arsip_laporan }}" required>
                    </div>
                </div> --}}

                {{-- Jurusan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jurusan" class="form-control" value="{{ $laporan_penelitian->jurusan }}" required>
                    </div>
                </div>

                {{-- Prodi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Prodi</label>
                    <div class="col-sm-10">
                        <input type="text" name="prodi" class="form-control" value="{{ $laporan_penelitian->prodi }}" required>
                    </div>
                </div>

                {{-- Tanggal Laporan Diterima --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Laporan Diterima</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_laporan_diterima" class="form-control" value="{{ $laporan_penelitian->tanggal_laporan_diterima }}" required>
                    </div>
                </div>

                {{-- File --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="file">File</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control" value="{{ $laporan_penelitian->file }}"required>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control">{{ $laporan_penelitian->keterangan }}</textarea>
                    </div>
                </div> 

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('laporan_penelitian.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
