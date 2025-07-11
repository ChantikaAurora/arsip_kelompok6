@extends('tampilan.navbar')
@section('page-title', 'Laporan')
@section('content')

    {{-- Judul --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-file-earmark-text-fill text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Manajemen Laporan Kemajuan Pengabdian</h3>
                <p class="text-muted mb-0">Kelola data laporan kemajuan dari kegiatan pengabdian masyarakat.</p>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah dan Metadata --}}
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex gap-2">
            <a href="{{ route('laporan_kemajuan_pengabdian.create') }}" class="btn btn-primary d-inline-flex align-items-center">
                <i class="icon-plus me-1 mr-1"></i> Tambah
            </a>
            <a href="{{ route('laporan_kemajuan_pengabdian.metadata') }}" class="btn btn-success d-inline-flex align-items-center ms-2" style="margin-left: 0.5rem;">
                <i class="icon-doc me-1 mr-1"></i> Metadata
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
        <form class="d-flex" method="GET" action="{{ route('laporan_kemajuan_pengabdian.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari judul/nama/skema..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel Data --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light text-center">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Judul Kegiatan</th>
                    <th style="width: 15%;">Nama Ketua</th>
                    <th style="width: 15%;">Skema</th>
                    <th style="width: 10%;">Tahun</th>
                    <th style="width: 10%;">Periode</th>
                    <th style="width: 20%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                    <tr>
                        <td class="text-center">
                            {{ $laporan->firstItem() + $loop->index }}
                        </td>
                        <td style="white-space: normal;">{{ $item->judul_kegiatan }}</td>
                        <td>{{ $item->nama_ketua }}</td>
                        <td>{{ $item->skemaRelasi->skema_pengabdian ?? '-' }}</td>
                        <td>{{ $item->tahun_pelaksanaan }}</td>
                        <td>{{ $item->periode_laporan }}</td>
                        <td class="text-center align-middle">
                            <a href="{{ route('laporan_kemajuan_pengabdian.show', $item->id_laporan) }}" class="btn btn-sm btn-primary me-1 mb-1">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('laporan_kemajuan_pengabdian.edit', $item->id_laporan) }}" class="btn btn-sm btn-warning me-1 mb-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form id="deleteForm-{{ $item->id_laporan }}" action="{{ route('laporan_kemajuan_pengabdian.destroy', $item->id_laporan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger mb-1" onclick="confirmDelete('{{ $item->id_laporan }}')">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data laporan kemajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $laporan->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

    {{-- SweetAlert Hapus --}}
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
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
