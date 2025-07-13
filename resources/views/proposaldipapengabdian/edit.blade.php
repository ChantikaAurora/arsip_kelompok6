@extends('tampilan.navbar')
@section('page-title', 'Proposal')
@section('title', 'Edit Proposal Dipa Pengabdian')
@section('navProposalDipa', 'active')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Proposal DIPA Pengabdian</h3>
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
            <form method="POST" action="{{ route('proposal_dipa_pengabdian.update', $proposal->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Row 1 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No Proposal</label>
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
                                    <span class="input-group-text"><i class="bi bi-journal-text"></i></span>
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
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
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
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-diagram-3"></i></span>
                                    <select name="skema_pengabdian_id" class="form-control @error('skema_pengabdian_id') is-invalid @enderror">
                                        <option value="">-- Pilih Skema --</option>
                                        @foreach($skemaPengabdians as $skema)
                                            <option value="{{ $skema->id }}" {{ old('skema_pengabdian_id', $proposal->skema_pengabdian_id) == $skema->id ? 'selected' : '' }}>{{ $skema->skema_pengabdian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('skema_pengabdian_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Anggota</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                                    <input type="text" name="anggota" class="form-control @error('anggota') is-invalid @enderror" value="{{ old('anggota', $proposal->anggota) }}">
                                </div>
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
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-building"></i></span>
                                    <select name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror">
                                        <option value="">-- Pilih Jurusan --</option>
                                        @foreach($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $proposal->jurusan_id) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('jurusan_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Program Studi</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-mortarboard"></i></span>
                                    <select name="prodi_id" class="form-control @error('prodi_id') is-invalid @enderror">
                                        <option value="">-- Pilih Prodi --</option>
                                    </select>
                                </div>
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
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                    <input type="date" name="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" value="{{ old('tanggal_pengajuan', $proposal->tanggal_pengajuan) }}">
                                </div>
                                @error('tanggal_pengajuan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Upload File</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-upload"></i></span>
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                </div>
                                @error('file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                @if ($proposal->file && file_exists(public_path('storage/' . $proposal->file)))
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $proposal->file) }}" target="_blank">
                                            <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                        </a>
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
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $proposal->keterangan) }}</textarea>
                                </div>
                                @error('keterangan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="form-group row mt-4">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('proposal_dipa_pengabdian.index') }}" class="btn btn-secondary">
                            <i class="icon-action-undo me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-2">
                            <i class="bi bi-save me-1"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- AJAX Script --}}
<script>
    $(document).ready(function () {
        let selectedJurusan = $('select[name="jurusan_id"]').val();
        let selectedProdi = "{{ old('prodi_id', $proposal->prodi_id) }}";

        function loadProdi(jurusanId, selectedProdiId = null) {
            let $prodiSelect = $('select[name="prodi_id"]');
            $prodiSelect.html('<option value="">-- Pilih Prodi --</option>');

            if (jurusanId) {
                $.ajax({
                    url: '/get-prodi/' + jurusanId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (index, prodi) {
                            let selected = prodi.id == selectedProdiId ? 'selected' : '';
                            $prodiSelect.append('<option value="' + prodi.id + '" ' + selected + '>' + prodi.prodi + '</option>');
                        });
                    },
                    error: function () {
                        alert("Gagal memuat data prodi.");
                    }
                });
            }
        }

        // Load data prodi saat edit
        if (selectedJurusan) {
            loadProdi(selectedJurusan, selectedProdi);
        }

        // Saat jurusan berubah
        $('select[name="jurusan_id"]').on('change', function () {
            loadProdi($(this).val());
        });
    });
</script>
@endsection
