@extends('tampilan.main')

@section('title', 'Edit Proposal Pusat Pengabdian')
@section('navProposalPusat', 'active')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Edit Proposal Pusat Pengabdian</h3>
        <p class="text-muted">Silakan perbarui data proposal sesuai kebutuhan.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda! Coba periksa kembali.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('proposal_pusat_pengabdian.update', $proposal->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- No --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">No</label>
                    <div class="col-sm-10">
                        <input type="text" name="no" class="form-control @error('no') is-invalid @enderror"
                            value="{{ old('no', $proposal->no) }}" required>
                        @error('no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Kode Klasifikasi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_klasifikasi" class="form-control @error('kode_klasifikasi') is-invalid @enderror"
                            value="{{ old('kode_klasifikasi', $proposal->kode_klasifikasi) }}" required>
                        @error('kode_klasifikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Judul --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $proposal->judul) }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Peneliti --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Peneliti</label>
                    <div class="col-sm-10">
                        <input type="text" name="peneliti" class="form-control @error('peneliti') is-invalid @enderror"
                            value="{{ old('peneliti', $proposal->peneliti) }}" required>
                        @error('peneliti')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Skema Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Skema</label>
                    <div class="col-sm-10">
                        <select name="skema_pengabdian_id" class="form-control @error('skema_pengabdian_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Skema --</option>
                            @foreach ($skemaPengabdians as $skema)
                                <option value="{{ $skema->id }}" {{ old('skema_pengabdian_id', $proposal->skema_pengabdian_id) == $skema->id ? 'selected' : '' }}>
                                    {{ $skema->skema_pengabdian }}
                                </option>
                            @endforeach
                        </select>
                        @error('skema_pengabdian_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Anggota --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" name="anggota" class="form-control @error('anggota') is-invalid @enderror"
                            value="{{ old('anggota', $proposal->anggota) }}">
                        @error('anggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>


                {{-- Jurusan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <select name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $proposal->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Prodi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Prodi</label>
                    <div class="col-sm-10">
                        <select name="prodi_id" class="form-control @error('prodi_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Prodi --</option>
                            {{-- Prodi akan di-load melalui AJAX --}}
                        </select>
                        @error('prodi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>


                {{-- Tanggal Pengajuan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Pengajuan</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror"
                            value="{{ old('tanggal_pengajuan', $proposal->tanggal_pengajuan) }}" required>
                        @error('tanggal_pengajuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $proposal->keterangan) }}</textarea>
                        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- File Proposal --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">File</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @if ($proposal->file)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $proposal->file) }}" target="_blank">
                                    <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('proposal_pusat_pengabdian.index') }}" class="btn btn-secondary">
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
                    }
                });
            }
        }

        // Load awal untuk form edit
        if (selectedJurusan) {
            loadProdi(selectedJurusan, selectedProdi);
        }

        // Saat jurusan diganti
        $('select[name="jurusan_id"]').on('change', function () {
            loadProdi($(this).val());
        });
    });
</script>
@endsection
