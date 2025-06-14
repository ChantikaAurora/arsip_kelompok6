<div class="mb-3">
    <label>Kode Seri</label>
    <input type="text" name="kode_seri" class="form-control" value="{{ old('kode_seri', $proposal_pengabdian->kode_seri ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Judul</label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $proposal_pengabdian->judul ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Peneliti</label>
    <input type="text" name="peneliti" class="form-control" value="{{ old('peneliti', $proposal_pengabdian->peneliti ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Skema</label>
    <input type="text" name="skema" class="form-control" value="{{ old('skema', $proposal_pengabdian->skema ?? '') }}">
</div>

<div class="mb-3">
    <label>Anggota</label>
    <input type="text" name="anggota" class="form-control" value="{{ old('anggota', $proposal_pengabdian->anggota ?? '') }}">
</div>

<div class="mb-3">
    <label>Jurusan</label>
    <select name="jurusan_id" class="form-control" required>
        <option value="">-- Pilih Jurusan --</option>
        @foreach($jurusan as $item)
            <option value="{{ $item->id }}" {{ old('jurusan_id', $proposal_pengabdian->jurusan_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->nama }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Program Studi</label>
    <select name="prodi_id" class="form-control" required>
        <option value="">-- Pilih Prodi --</option>
        @foreach($prodi as $item)
            <option value="{{ $item->id }}" {{ old('prodi_id', $proposal_pengabdian->prodi_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->nama }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tanggal Pengajuan</label>
    <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ old('tanggal_pengajuan', isset($proposal_pengabdian->tanggal_pengajuan) ? $proposal_pengabdian->tanggal_pengajuan->format('Y-m-d') : '') }}" required>
</div>

<div class="mb-3">
    <label>Keterangan</label>
    <textarea name="keterangan" class="form-control">{{ old('keterangan', $proposal_pengabdian->keterangan ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>File Proposal (PDF)</label>
    <input type="file" name="file" class="form-control">
    @if(isset($proposal_pengabdian) && $proposal_pengabdian->file)
        <p class="mt-2">File lama: <a href="{{ route('proposal_pengabdian.download', $proposal_pengabdian->id) }}">{{ basename($proposal_pengabdian->file) }}</a></p>
    @endif
</div>
