@extends('tampilan.navbar')
@section('page-title', 'Pengguna')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

    {{-- Judul --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-people-fill text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Manajemen Pengguna</h3>
                <p class="text-muted mb-0">Kelola akun pengguna yang memiliki akses ke sistem arsip.</p>
            </div>
        </div>
    </div>
    {{-- Tombol Tambah Pengguna --}}
    <div class="mb-4">
        <a href="{{ route('pengguna.create') }}" class="btn btn-primary d-inline-flex align-items-center">
                <i class="icon-plus me-1 align-middle mr-1"></i> Tambah</a>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success col-4">
            {{ session('success') }}
        </div>
    @endif


    {{-- Pencarian di kanan atas --}}
    <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" method="GET" action="{{ route('pengguna.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari username..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Validasi input pencarian --}}
    @if (session('search_error'))
        <div class="alert alert-danger">
            {{ session('search_error') }}
        </div>
    @endif

    {{-- Tabel --}}
    <table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr class="text-center">
            <th style="width: 5%;">No</th>
            <th style="width: 25%;">Username</th>
            <th style="width: 30%;">Email</th>
            <th style="width: 15%;">Role</th>
            <th style="width: 25%;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pengguna as $item)
        <tr>
            <td class="text-center">{{ $loop->iteration + ($pengguna->firstItem() - 1) }}</td>
            <td>{{ $item->username }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ strtoupper($item->role) }}</td>

            <td class="text-center">
                <a href="{{ route('pengguna.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form id="delete-form-{{ $item->id }}" action="{{ route('pengguna.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">Hapus</button>
                </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Belum ada data pengguna.</td>
        </tr>
        @endforelse
    </tbody>
</table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $pengguna->links('pagination::bootstrap-5') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data pengguna akan dihapus permanen!",
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
