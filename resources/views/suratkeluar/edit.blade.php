@extends('tampilan.main')
@section('content')

<div class="container mt-4">
    <h3 class="mb-3">Edit Surat Keluar</h3>

    <form action="{{ route('suratkeluar.update', $suratkeluar->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nomor Surat:</label>
            <input type="text" name="nomor_surat" class="form-control" value="{{ $suratkeluar->nomor_surat }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Surat:</label>
            <input type="date" name="tanggal_surat" class="form-control" value="{{ $suratkeluar->tanggal_surat }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tujuan Surat:</label>
            <input type="text" name="tujuan_surat" class="form-control" value="{{ $suratkeluar->tujuan_surat }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Perihal:</label>
            <input type="text" name="perihal" class="form-control" value="{{ $suratkeluar->perihal }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pengirim:</label>
            <input type="text" name="pengirim" class="form-control" value="{{ $suratkeluar->pengirim }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Penerima:</label>
            <input type="text" name="penerima" class="form-control" value="{{ $suratkeluar->penerima }}">
        </div>

        <div class="mb-3 ">
                    <label class="form-label">Jenis</label>
                        <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Arsip --</option>
                            @foreach ($jenisarsips as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('jenis') == $jenis->jenis ? 'selected' : '' }}>
                                    {{ $jenis->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>

        <div class="mb-3">
            <label class="form-label">File:</label>
            <input type="file" name="file" class="form-control">
            @if ($suratkeluar->file)
                <p class="mt-2">File saat ini: <a href="{{ asset('storage/' . $suratkeluar->file) }}" target="_blank">{{ basename($suratkeluar->file) }}</a></p>
            @endif
        </div>

        <div class="d-flex justify-content-start gap-2 mb-3">
            <a href="{{ route('suratkeluar.index') }}" class="btn btn-outline-secondary">← Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>
</div>
@endsection
