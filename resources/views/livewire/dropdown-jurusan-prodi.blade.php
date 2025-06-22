{{-- <div>
    <div class="mb-3">
        <label>Jurusan</label>
        <select wire:model="jurusan_id" class="form-control">
            <option value="">-- Pilih Jurusan --</option>
            @foreach ($jurusans as $jurusan)
                <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Program Studi</label>
        <select wire:model="prodi_id" class="form-control">
            <option value="">-- Pilih Prodi --</option>
            @foreach ($prodis as $prodi)
                <option value="{{ $prodi->id }}">
                    {{ $prodi->prodi }} (jurusan_id: {{ $prodi->jurusan_id }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="text-muted">
        jurusan_id = {{ $jurusan_id }} <br>
        Jumlah Prodi = {{ $prodis->count() }} <br>
        prodis: {{ $prodis->pluck('prodi') }}
    </div>
</div> --}}
