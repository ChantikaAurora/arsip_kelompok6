@extends('tampilan.main')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Edit Laporan Akhir Pengabdian</h3>
        <p class="text-muted">Isi data laporan akhir pengabdian dengan lengkap dan benar.</p>
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
            <form action="{{ route('laporan_pengabdian.update', $laporan_pengabdian->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Kode Seri  --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode Seri</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_seri" class="form-control" value="{{ $laporan_pengabdian->kode_seri }}" required>
                    </div>
                </div>

                {{-- Judul Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul Pengabdian</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul" class="form-control" value="{{ $laporan_pengabdian->judul }}" required>
                    </div>
                </div>

                {{-- Peneliti --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Peneliti</label>
                    <div class="col-sm-10">
                        <input type="text" name="peneliti" class="form-control" value="{{ $laporan_pengabdian->peneliti }}" required>
                    </div>
                </div>

                {{-- Skema --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Skema</label>
                    <div class="col-sm-10">
                        <input type="text" name="skema" class="form-control" value="{{ $laporan_pengabdian->skema }}" required>
                    </div>
                </div>

                {{-- Anggota --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" name="anggota" class="form-control" value="{{ $laporan_pengabdian->anggota }}" required>
                    </div>
                </div>

                {{-- Jurusan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jurusan" class="form-control" value="{{ $laporan_pengabdian->jurusan }}" required>
                    </div>
                </div>

                {{-- Prodi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Prodi</label>
                    <div class="col-sm-10">
                        <input type="text" name="prodi" class="form-control" value="{{ $laporan_pengabdian->prodi }}" required>
                    </div>
                </div>

                {{-- Tanggal Laporan Diterima --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Laporan Diterima</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_laporan_diterima" class="form-control" value="{{ $laporan_pengabdian->tanggal_laporan_diterima }}" required>
                    </div>
                </div>

                {{-- File --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="file">File</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control" value="{{ $laporan_pengabdian->file }}"required>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control" required>{{ $laporan_pengabdian->keterangan }}</textarea>
                    </div>
                </div> 

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('laporan_pengabdian.index') }}" class="btn btn-secondary">
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
