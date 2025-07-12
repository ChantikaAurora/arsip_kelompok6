@extends('tampilan.navbar')
@section('page-title', 'Surat Masuk')
@section('content')


    {{-- Judul --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-people-fill text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Manajemen Surat Masuk</h3>
                <p class="text-muted mb-0">Kelola data surat masuk yang tercatat dalam sistem arsip.</p>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah Surat Masuk dan Cetak Metadata --}}
   <div class="d-flex justify-content-between mb-3">
        <div class="d-flex gap-2">
            {{-- Tombol Tambah --}}
            <a href="{{ route('suratmasuk.create') }}"
            class="btn btn-primary d-inline-flex align-items-center">
                <i class="icon-plus me-1 align-middle mr-1"></i> Tambah
            </a>

            {{-- Tombol Metadata --}}
            <a href="{{ route('suratmasuk.metadata') }}"
            class="btn btn-success d-inline-flex align-items-center ms-2 " style="margin-left: 0.5rem;">
                <i class="icon-doc me-1 align-middle mr-1 " ></i> Metadata
            </a>
        </div>
    </div>


    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success col-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">
            {{ session('search_error') }}
        </div>
    @endif

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('suratmasuk.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari nomor/perihal surat..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel Data Surat Masuk --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover ">
            <thead class="table-light">
            <tr class="text-center">
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Nomor Surat</th>
                    <th style="width: 15%;">Kode Klasifikasi</th>
                    <th style="width: 20%;">Perihal</th>
                    <th style="width: 10%;">Lampiran</th>
                    <th style="width: 15%;">Jenis Arsip</th>
                    <th style="width: 20%;">Aksi</th>
                </tr>
        </thead>
        <tbody>
            @forelse ($suratmasuks as $suratmasuk)
                <tr>
                    <td>{{ ($suratmasuks->currentPage() - 1) * $suratmasuks->perPage() + $loop->iteration }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">{{ $suratmasuk->nomor_surat }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $suratmasuk->kode_klasifikasi }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 250px;">{{ $suratmasuk->perihal }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 100px;">{{ $suratmasuk->lampiran ?? '-' }}</td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 150px;">{{ $suratmasuk->jenisArsip->jenis ?? '-' }}</td>
                    <td class="text-center align-middle" style="white-space: normal; word-wrap: break-word; max-width: 250px;">
                        <a href="{{ route('suratmasuk.show', $suratmasuk->id) }}" class="btn btn-sm btn-primary me-1 mb-1">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                        <a href="{{ route('suratmasuk.edit', $suratmasuk->id) }}" class="btn btn-sm btn-warning me-1 mb-1">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form id="deleteForm-{{ $suratmasuk->id }}" action="{{ route('suratmasuk.destroy', $suratmasuk->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger mb-1" onclick="confirmDelete('{{ $suratmasuk->id }}')">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="text-center">Belum ada data surat masuk.</td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $suratmasuks->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`deleteForm-${id}`).submit();
            }
        });
    }
</script>


@endsection
