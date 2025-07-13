@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('title', 'Edit Laporan Kemajuan Pengabdian')
@section('navLaporanKemajuanPengabdian', 'active')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('content')
<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-2">Formulir Edit Laporan Kemajuan Pengabdian</h3>
        <p class="text-muted mb-0">Silakan perbarui data laporan kemajuan sesuai kebutuhan.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong> Terjadi kesalahan dalam pengisian data. Silakan coba lagi.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body px-4 py-4">
            <form action="{{ route('laporan_kemajuan_pengabdian.update', $laporan_kemajuan_pengabdian->id_laporan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Row 1 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kode Klasifikasi</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-hash"></i></span>
                                    <input type="text" name="id_laporan" class="form-control @error('id_laporan') is-invalid @enderror" value="{{ old('id_laporan', $laporan_kemajuan_pengabdian->id_laporan) }}">
                                </div>
                                @error('id_laporan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Judul Kegiatan</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-journal-text"></i></span>
                                    <input type="text" name="judul_kegiatan" class="form-control @error('judul_kegiatan') is-invalid @enderror" value="{{ old('judul_kegiatan', $laporan_kemajuan_pengabdian->judul_kegiatan) }}">
                                </div>
                                @error('judul_kegiatan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 2 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Ketua</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <input type="text" name="nama_ketua" class="form-control @error('nama_ketua') is-invalid @enderror" value="{{ old('nama_ketua', $laporan_kemajuan_pengabdian->nama_ketua) }}">
                                </div>
                                @error('nama_ketua')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Anggota</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                                    <input type="text" name="nama_anggota" class="form-control @error('nama_anggota') is-invalid @enderror" value="{{ old('nama_anggota', $laporan_kemajuan_pengabdian->nama_anggota) }}">
                                </div>
                                @error('nama_anggota')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
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
                                    <select name="skema" class="form-control @error('skema') is-invalid @enderror">
                                        <option value="">-- Pilih Skema --</option>
                                        @foreach ($skemas as $skema)
                                            <option value="{{ $skema->id }}" {{ old('skema', $laporan_kemajuan_pengabdian->skema_id) == $skema->id ? 'selected' : '' }}>{{ $skema->skema_pengabdian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('skema')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tahun Pelaksanaan</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                    <input type="text" name="tahun_pelaksanaan" class="form-control @error('tahun_pelaksanaan') is-invalid @enderror" value="{{ old('tahun_pelaksanaan', $laporan_kemajuan_pengabdian->tahun_pelaksanaan) }}">
                                </div>
                                @error('tahun_pelaksanaan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
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
                                    <select name="jurusan" class="form-control @error('jurusan') is-invalid @enderror">
                                        <option value="">-- Pilih Jurusan --</option>
                                        @foreach ($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}" {{ old('jurusan', $laporan_kemajuan_pengabdian->jurusan_id) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('jurusan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Prodi</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-mortarboard"></i></span>
                                    <select name="prodi" class="form-control @error('prodi') is-invalid @enderror">
                                        <option value="">-- Pilih Prodi --</option>
                                        @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}" {{ old('prodi', $laporan_kemajuan_pengabdian->prodi_id) == $prodi->id ? 'selected' : '' }}>{{ $prodi->prodi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('prodi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 5 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Periode Laporan</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-clock-history"></i></span>
                                    <select name="periode_laporan" class="form-control @error('periode_laporan') is-invalid @enderror">
                                        <option value="">-- Pilih Periode --</option>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="semester {{ $i }}" {{ old('periode_laporan', $laporan_kemajuan_pengabdian->periode_laporan) == 'semester '.$i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                @error('periode_laporan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
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
                                @if ($laporan_kemajuan_pengabdian->file)
                                    <div class="mt-2">
                                        <a href="{{ route('laporan_kemajuan_pengabdian.preview', $laporan_kemajuan_pengabdian->id_laporan) }}" target="_blank">
                                            <i class="bi bi-file-earmark-text"></i> Lihat File Saat Ini
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ringkasan --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ringkasan</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                    <textarea name="ringkasan" class="form-control @error('ringkasan') is-invalid @enderror" rows="3">{{ old('ringkasan', $laporan_kemajuan_pengabdian->ringkasan) }}</textarea>
                                </div>
                                @error('ringkasan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="form-group row mt-4">
                    <div class="col-sm-10 offset-sm-2 d-flex">
                        <a href="{{ route('laporan_kemajuan_pengabdian.index') }}" class="btn btn-secondary">
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
{{-- AJAX: Load Prodi --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('select[name="jurusan"]').on('change', function () {
            let jurusanId = $(this).val();
            let $prodiSelect = $('select[name="prodi"]');
            $prodiSelect.html('<option value="">-- Pilih Prodi --</option>');

            if (jurusanId) {
                $.ajax({
                    url: '/get-prodi/' + jurusanId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (index, prodi) {
                            $prodiSelect.append('<option value="' + prodi.id + '">' + prodi.prodi + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        alert("Gagal memuat Prodi: " + error);
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

@endsection
