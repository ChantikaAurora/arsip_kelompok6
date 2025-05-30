@extends('tampilan.main')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Edit Anggaran Penelitian</h3>
        <p class="text-muted">Edit data anggaran penelitian dengan lengkap dan benar.</p>
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
            <form action="{{ route('anggaran_penelitian.update', $anggaran_penelitian->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul Penelitian</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul_penelitian" class="form-control" value="{{ $anggaran_penelitian->judul_penelitian }}" required>
                    </div>
                </div>

                {{-- Peneliti --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Peneliti</label>
                    <div class="col-sm-10">
                        <input type="text" name="peneliti" class="form-control" value="{{ $anggaran_penelitian->peneliti }}" required>
                    </div>
                </div>

                {{-- Tahun --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                        <input type="number" name="tahun" class="form-control" value="{{ $anggaran_penelitian->tahun }}" required>
                    </div>
                </div>

                {{-- Total Anggaran --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Total Anggaran</label>
                    <div class="col-sm-10">
                        <input type="text" name="total_anggaran" class="form-control" value="{{ $anggaran_penelitian->total_anggaran }}" required>
                    </div>
                </div>

                {{-- Jenis Arsip --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis Arsip</label>
                    <div class="col-sm-10">
                        <input type="number" name="jenis_arsip_id" class="form-control" value="{{ $anggaran_penelitian->jenis_arsip_id }}" required>
                    </div>
                </div>

                {{-- Rincian Anggaran  --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Rincian Anggaran</label>
                    <div class="col-sm-10">
                    <textarea name="rincian_anggaran" class="form-control @error('rincian_anggaran') is-invalid @enderror" rows="3" value="{{ $anggaran_penelitian->rincian_anggaran }}" placeholder="Contoh: Honor peneliti: 10.000.000, Alat: 1.000.000">{{ old('rincian_anggaran') }} </textarea>
                        @error('rincian_anggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror                    
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control @error('status') is-invalid @enderror" value="{{ $anggaran_penelitian->status }}" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- File --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="file">File</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control" value="{{ $anggaran_penelitian->file }}"required>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control">{{ $anggaran_penelitian->keterangan }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('anggaran_penelitian.index') }}" class="btn btn-secondary">
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
