@extends('tampilan.main')

@section('navProposalDIPA', 'active')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container mt-4">
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Proposal DIPA Penelitian</h3>
        <p class="text-muted">Silakan lengkapi data proposal dengan benar untuk ditambahkan ke sistem.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan input. Silakan periksa kembali.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('proposal_dipa_penelitian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- No --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">No</label>
                    <div class="col-sm-10">
                        <input type="text" name="no" class="form-control @error('no') is-invalid @enderror" value="{{ old('no') }}" placeholder="Masukkan nomor proposal">
                        @error('no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Kode Klasifikasi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_klasifikasi" class="form-control @error('kode_klasifikasi') is-invalid @enderror" value="{{ old('kode_klasifikasi') }}" placeholder="Contoh: 123/DIPA">
                        @error('kode_klasifikasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Judul --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Masukkan judul proposal">
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Peneliti --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Peneliti</label>
                    <div class="col-sm-10">
                        <input type="text" name="peneliti" class="form-control @error('peneliti') is-invalid @enderror" value="{{ old('peneliti') }}" placeholder="Masukkan nama peneliti">
                        @error('peneliti') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Skema Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Skema Penelitian</label>
                    <div class="col-sm-10">
                        <select name="skema_penelitian_id" class="form-control @error('skema_penelitian_id') is-invalid @enderror">
                            <option value="">-- Pilih Skema --</option>
                            @foreach($skemaPenelitians as $skema)
                                <option value="{{ $skema->id }}" {{ old('skema_penelitian_id') == $skema->id ? 'selected' : '' }}>
                                    {{ $skema->skema_penelitian }}
                                </option>
                            @endforeach
                        </select>
                        @error('skema_penelitian_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Anggota --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" name="anggota" class="form-control @error('anggota') is-invalid @enderror" value="{{ old('anggota') }}" placeholder="Masukkan nama anggota (jika ada)">
                        @error('anggota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Jurusan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <select name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
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
                        </select>
                        @error('prodi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>


                {{-- Tanggal Pengajuan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Pengajuan</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" value="{{ old('tanggal_pengajuan') }}">
                        @error('tanggal_pengajuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Tambahan keterangan jika ada">{{ old('keterangan') }}</textarea>
                        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- File Proposal --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Upload File</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('proposal_dipa_penelitian.index') }}" class="btn btn-secondary">
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

{{-- AJAX Script --}}
<script>
    $(document).ready(function () {
        // Pakai name, bukan id
        $('select[name="jurusan_id"]').on('change', function () {
            let jurusanId = $(this).val();

            // Targetkan dropdown Prodi juga pakai name, bukan id
            let $prodiSelect = $('select[name="prodi_id"]');
            $prodiSelect.html('<option value="">-- Pilih Prodi --</option>');

            if (jurusanId) {
                $.ajax({
                    url: '/get-prodi/' + jurusanId, // pastikan route kamu pakai path ini
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (index, prodi) {
                            $prodiSelect.append('<option value="' + prodi.id + '">' + prodi.prodi + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        alert("Gagal load Prodi: " + error);
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

@endsection
