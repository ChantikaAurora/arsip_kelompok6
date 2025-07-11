@extends('tampilan.navbar')
@section('page-title', 'Proposal')
@section('title', 'Edit Proposal Mandiri Penelitian')
@section('navProposalMandiri', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Proposal Mandiri Penelitian</h3>
        <p class="text-muted mb-0">Silakan perbarui data proposal sesuai kebutuhan.</p>
    </div>

    {{-- Notifikasi Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data. Silakan coba lagi.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form action="{{ route('proposal_mandiri_penelitian.update', $proposal->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Row 1 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No </label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-hash"></i></span>
                                    <input type="text" name="no" class="form-control @error('no') is-invalid @enderror" value="{{ old('no', $proposal->no) }}">
                                </div>
                                @error('no')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kode Klasifikasi</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tags"></i></span>
                                    <input type="text" name="kode_klasifikasi" class="form-control @error('kode_klasifikasi') is-invalid @enderror" value="{{ old('kode_klasifikasi', $proposal->kode_klasifikasi) }}">
                                </div>
                                @error('kode_klasifikasi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 2 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Judul</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-journal-richtext"></i></span>
                                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $proposal->judul) }}">
                                </div>
                                @error('judul')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Peneliti</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <input type="text" name="peneliti" class="form-control @error('peneliti') is-invalid @enderror" value="{{ old('peneliti', $proposal->peneliti) }}">
                                </div>
                                @error('peneliti')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 3 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Skema</label>
                            <div class="col-sm-8">
                                <select name="skema_penelitian_id" class="form-control @error('skema_penelitian_id') is-invalid @enderror">
                                    <option value="">-- Pilih Skema --</option>
                                    @foreach ($skemaPenelitians as $skema)
                                        <option value="{{ $skema->id }}" {{ old('skema_penelitian_id', $proposal->skema_penelitian_id) == $skema->id ? 'selected' : '' }}>{{ $skema->skema_penelitian }}</option>
                                    @endforeach
                                </select>
                                @error('skema_penelitian_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Anggota</label>
                            <div class="col-sm-8">
                                <input type="text" name="anggota" class="form-control @error('anggota') is-invalid @enderror" value="{{ old('anggota', $proposal->anggota) }}">
                                @error('anggota')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 4 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jurusan</label>
                            <div class="col-sm-8">
                                <select name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach ($jurusans as $jurusan)
                                        <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $proposal->jurusan_id) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->jurusan }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Prodi</label>
                            <div class="col-sm-8">
                                <select name="prodi_id" class="form-control @error('prodi_id') is-invalid @enderror">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}" {{ old('prodi_id', $proposal->prodi_id) == $prodi->id ? 'selected' : '' }}>{{ $prodi->prodi }}</option>
                                    @endforeach
                                </select>
                                @error('prodi_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 5 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Pengajuan</label>
                            <div class="col-sm-8">
                                <input type="date" name="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" value="{{ old('tanggal_pengajuan', $proposal->tanggal_pengajuan) }}">
                                @error('tanggal_pengajuan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Upload File</label>
                            <div class="col-sm-8">
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                @error('file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                @if ($proposal->file && file_exists(public_path('storage/' . $proposal->file)))
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $proposal->file) }}" target="_blank">
                                            <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                        </a>
                                    </div>
                                @else
                                    <div class="mt-2 text-muted">
                                        <i class="bi bi-exclamation-circle"></i> File tidak ditemukan atau tidak bisa diakses.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $proposal->keterangan) }}</textarea>
                                @error('keterangan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="form-group row mt-4">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('proposal_mandiri_penelitian.index') }}" class="btn btn-secondary">
                              <i class="icon-action-undo me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-2" style="margin-left: 0.5rem;">
                            <i class="bi bi-save me-1"></i> Update
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
