@extends('tampilan.navbar')
@section('page-title', 'Prodi')
@section('navProdi', 'active')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-building text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Manajemen Program Studi</h3>
                <p class="text-muted mb-0">Kelola data program studi berdasarkan jurusan yang tersedia.</p>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah --}}
    <div class="mb-4">
        <a href="{{ route('prodi.create') }}" class="btn btn-primary d-inline-flex align-items-center">
           <i class="icon-plus me-1 align-middle mr-1"></i> Tambah</a>
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success col-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validasi Pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">
            {{ session('search_error') }}
        </div>
    @endif

    {{-- Pencarian --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('prodi.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari prodi..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel --}}
    <table class="table table-bordered table-hover">
        <thead class="table-light text-center">
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Jurusan</th>
                <th style="width: 20%;">Kode Prodi</th>
                <th style="width: 25%;">Prodi</th>
                <th style="width: 20%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($prodis as $prodi)
                <tr>
                    <td class="text-center">{{ ($prodis->currentPage() - 1) * $prodis->perPage() + $loop->iteration }}</td>
                    <td>{{ $prodi->jurusan->jurusan }}</td>
                    <td class="text-center">{{ $prodi->kode_prodi }}</td>
                    <td>{{ $prodi->prodi }}</td>
                    <td class="text-center">
                        <a href="{{ route('prodi.edit', $prodi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form id="delete-form-{{ $prodi->id }}" action="{{ route('prodi.destroy', $prodi->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $prodi->id }})">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data prodi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $prodis->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- SweetAlert2 Hapus --}}
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data prodi akan dihapus permanen!",
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
