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

                {{-- Jenis Arsip --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis Arsip</label>
                    <div class="col-sm-10">
                        <input type="number" name="jenis_arsip_laporan" class="form-control" value="{{ $laporan_penelitian->jenis_arsip_laporan }}" required>
                    </div>
                </div>

                {{-- Jurusan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jurusan" class="form-control" value="{{ $laporan_penelitian->jurusan }}" required>
                    </div>
                </div>

                {{-- Tahun Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tahun Penelitian</label>
                    <div class="col-sm-10">
                        <input type="number" name="tahun_penelitian" class="form-control" min="1900" max="{{ date('Y')+5 }}" value="{{ $laporan_penelitian->tahun_penelitian }}"required>
                    </div>
                </div>

                {{-- Tanggal Laporan Diterima --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Laporan Diterima</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_laporan_diterima" class="form-control" value="{{ $laporan_penelitian->tanggal_laporan_diterima }}" required>
                    </div>
                </div>

                {{-- Status Laporan  --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status Laporan</label>
                    <div class="col-sm-10">
                        <select name="status_laporan" class="form-control" value="{{ $laporan_penelitian->status_laporan }}" required>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
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
