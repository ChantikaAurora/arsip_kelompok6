@extends('tampilan.navbar')
@section('page-title', 'Jenis Arsip')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

    {{-- Judul --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-archive-fill text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Manajemen Jenis Arsip</h3>
                <p class="text-muted mb-0">Kelola kategori atau jenis arsip yang digunakan dalam sistem.</p>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah --}}
    <div class="mb-4">
        <a href="{{ route('jenisarsip.create') }}" class="btn btn-primary d-inline-flex align-items-center">
            <i class="icon-plus me-1 align-middle mr-1"></i> Tambah
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success col-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger col-4">
            {{ session('search_error') }}
        </div>
    @endif

    {{-- Form Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('jenisarsip.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari jenis arsip..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel --}}
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr class="text-center">
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Jenis</th>
                <th style="width: 45%;">Keterangan</th>
                <th style="width: 20%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jenisarsips as $jenisarsip)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $jenisarsip->jenis }}</td>
                    <td>{{ $jenisarsip->keterangan ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('jenisarsip.edit', $jenisarsip->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form id="delete-form-{{ $jenisarsip->id }}" action="{{ route('jenisarsip.destroy', $jenisarsip->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $jenisarsip->id }})">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data jenis arsip.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination (aktifkan jika diperlukan) --}}
    {{-- <div class="d-flex justify-content-center">
        {{ $jenisarsips->links('pagination::bootstrap-5') }}
    </div> --}}
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data jenis arsip akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>

@endsection
