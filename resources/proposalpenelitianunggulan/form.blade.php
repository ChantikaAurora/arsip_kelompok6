<div class="mb-3">
  <label>Kode Seri</label>
  <input type="text" name="kode_seri" class="form-control" value="{{ old('kode_seri', $proposal_unggulan->kode_seri ?? '') }}">
</div>
<div class="mb-3">
  <label>Judul</label>
  <input type="text" name="judul" class="form-control" value="{{ old('judul', $proposal_unggulan->judul ?? '') }}">
</div>
<div class="mb-3">
  <label>Peneliti</label>
  <input type="text" name="peneliti" class="form-control" value="{{ old('peneliti', $proposal_unggulan->peneliti ?? '') }}">
</div>
<div class="mb-3">
  <label>Skema</label>
  <input type="text" name="skema" class="form-control" value="{{ old('skema', $proposal_unggulan->skema ?? '') }}">
</div>
<div class="mb-3">
  <label>Anggota</label>
  <input type="text" name="anggota" class="form-control" value="{{ old('anggota', $proposal_unggulan->anggota ?? '') }}">
</div>
<div class="mb-3">
  <label>Jurusan</label>
  <select name="jurusan_id" class="form-control">
    @foreach ($jurusan as $item)
      <option value="{{ $item->id }}" {{ (old('jurusan_id', $proposal_unggulan->jurusan_id ?? '') == $item->id) ? 'selected' : '' }}>
        {{ $item->nama }}
      </option>
    @endforeach
  </select>
</div>
<div class="mb-3">
  <label>Prodi</label>
  <select name="prodi_id" class="form-control">
    @foreach ($prodi as $item)
      <option value="{{ $item->id }}" {{ (old('prodi_id', $proposal_unggulan->prodi_id ?? '') == $item->id) ? 'selected' : '' }}>
        {{ $item->nama }}
      </option>
    @endforeach
  </select>
</div>
<div class="mb-3">
  <label>Tanggal Pengajuan</label>
  <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ old('tanggal_pengajuan', $proposal_unggulan->tanggal_pengajuan ?? '') }}">
</div>
<div class="mb-3">
  <label>File</label>
  <input type="file" name="file" class="form-control">
</div>
<div class="mb-3">
  <label>Keterangan</label>
  <textarea name="keterangan" class="form-control">{{ old('keterangan', $proposal_unggulan->keterangan ?? '') }}</textarea>
</div>
<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('proposal_unggulan.index') }}" class="btn btn-secondary">Kembali</a>
