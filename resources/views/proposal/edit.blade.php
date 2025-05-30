@extends('tampilan.main')

@section('title', 'Edit Proposal')
@section('navProposal', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
    <div class="container mt-4">
        <div class="border-bottom mb-4 pb-2">
            <h3 class="mb-3">Formulir Edit Proposal</h3>
            <p class="text-muted">Silakan perbarui data proposal sesuai kebutuhan.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda! Coba periksa kembali.
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('proposal.update', $proposal->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $proposal->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Peneliti</label>
                        <div class="col-sm-10">
                            <input type="text" name="peneliti" class="form-control @error('peneliti') is-invalid @enderror"
                                value="{{ old('peneliti', $proposal->peneliti) }}" required>
                            @error('peneliti')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Jurusan</label>
                        <div class="col-sm-10">
                            <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror"
                                value="{{ old('jurusan', $proposal->jurusan) }}" required>
                            @error('jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Jenis Proposal</label>
                        <div class="col-sm-10">
                            <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Proposal --</option>
                                @foreach ($jenisarsips as $jenis)
                                    <option value="{{ $jenis->id }}" {{ old('jenis', $proposal->jenis) == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Tahun Pengajuan</label>
                        <div class="col-sm-10">
                            <input type="number" name="tahun_pengajuan" class="form-control @error('tahun_pengajuan') is-invalid @enderror"
                                value="{{ old('tahun_pengajuan', $proposal->tahun_pengajuan) }}" required>
                            @error('tahun_pengajuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Status</label>
                        <div class="col-sm-10">
                            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror"
                                value="{{ old('status', $proposal->status) }}" required>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Tanggal Pengajuan</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror"
                                value="{{ old('tanggal_pengajuan', $proposal->tanggal_pengajuan) }}" required>
                            @error('tanggal_pengajuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Dana Diajukan (Rp)</label>
                        <div class="col-sm-10">
                            <input type="number" name="dana_diajukan" class="form-control @error('dana_diajukan') is-invalid @enderror"
                                value="{{ old('dana_diajukan', $proposal->dana_diajukan) }}" required>
                            @error('dana_diajukan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                rows="3">{{ old('keterangan', $proposal->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- File Proposal --}}
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label font-weight-normal">File Proposal</label>
                        <div class="col-sm-10">
                            @if ($proposal->file_proposal)
                                <p class="mb-2">
                                    File saat ini:
                                    <a href="{{ route('proposal.download', $proposal->id) }}" target="_blank">
                                        <i class="bi bi-file-earmark-text"></i> {{ $proposal->file_proposal }}
                                    </a>
                                </p>
                            @else
                                <p class="text-muted mb-2">Belum ada file</p>
                            @endif

                            <input type="file" name="file_proposal"
                                class="form-control @error('file_proposal') is-invalid @enderror"
                                accept=".pdf,.doc,.docx">
                            @error('file_proposal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="text-end">
                        <a href="{{ route('proposal.index') }}" class="btn btn-secondary">
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
