@extends('tampilan.main')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    {{-- Judul Halaman --}}
    <div class="border-bottom mb-4 pb-2">
        <h3 class="mb-3">Formulir Tambah Surat Keluar</h3>
        <p class="text-muted">Silakan lengkapi data surat keluar dengan benar untuk ditambahkan ke sistem.</p>
    </div>

    {{-- Notifikasi Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa kesalahan pada input Anda. Silakan periksa kembali.
        </div>
    @endif

    {{-- Form Tambah Surat Keluar --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('suratkeluar.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Nomor Surat --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nomor Surat</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" value="{{ old('nomor_surat') }}" placeholder="Masukkan nomor surat">
                        @error('nomor_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Nomor Agenda --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nomor Agenda</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_agenda" class="form-control @error('nomor_agenda') is-invalid @enderror" value="{{ old('nomor_agenda') }}" placeholder="Opsional, jika ada">
                        @error('nomor_agenda') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Kode Klasifikasi --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_klasifikasi" class="form-control @error('kode_klasifikasi') is-invalid @enderror" value="{{ old('kode_klasifikasi') }}" placeholder="Contoh: 123/ABC">
                        @error('kode_klasifikasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Tanggal Surat --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror" value="{{ old('tanggal_surat') }}">
                        @error('tanggal_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Tujuan Surat --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-10">
                        <input type="text" name="tujuan_surat" class="form-control @error('tujuan_surat') is-invalid @enderror" value="{{ old('tujuan_surat') }}" placeholder="Masukkan tujuan surat">
                        @error('tujuan_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Penerima --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Penerima</label>
                    <div class="col-sm-10">
                        <input type="text" name="penerima" class="form-control @error('penerima') is-invalid @enderror" value="{{ old('penerima') }}" placeholder="Masukkan nama penerima">
                        @error('penerima') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Perihal --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Perihal</label>
                    <div class="col-sm-10">
                        <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal') }}" placeholder="Masukkan perihal surat">
                        @error('perihal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Lampiran --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Lampiran</label>
                    <div class="col-sm-10">
                        <input type="text" name="lampiran" class="form-control @error('lampiran') is-invalid @enderror" value="{{ old('lampiran') }}" placeholder="Contoh: 2 lembar">
                        @error('lampiran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="2" placeholder="Opsional...">{{ old('keterangan') }}</textarea>
                        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Jenis Arsip --}}
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Arsip --</option>
                            @foreach ($jenisarsips as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('jenis') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- File --}}
                <div class="mb-4 row">
                    <label class="col-sm-2 col-form-label">File Surat</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <a href="{{ route('suratkeluar.index') }}" class="btn btn-secondary">
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
@endsection
