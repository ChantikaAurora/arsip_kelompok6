@extends('tampilan.navbar')
@section('page-title', 'Jurusan')
@section('navJurusan', 'active')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-diagram-3-fill text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Manajemen Jurusan</h3>
                <p class="text-muted mb-0">Kelola data jurusan yang tersedia pada institusi Anda.</p>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah --}}
    <div class="mb-4">
        <a href="{{ route('jurusan.create') }}" class="btn btn-primary d-inline-flex align-items-center">
            <i class="icon-plus me-1 align-middle mr-1"></i> Tambah
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
        <form class="d-flex" method="GET" action="{{ route('jurusan.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari jurusan..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel --}}
    <table class="table table-bordered table-hover">
        <thead class="table-light text-center">
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Kode Jurusan</th>
                <th style="width: 45%;">Nama Jurusan</th>
                <th style="width: 20%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jurusans as $jurusan)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $jurusan->kode_jurusan }}</td>
                    <td>{{ $jurusan->jurusan }}</td>
                    <td class="text-center">
                        <a href="{{ route('jurusan.edit', $jurusan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form id="delete-form-{{ $jurusan->id }}" action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $jurusan->id }})">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data jurusan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- SweetAlert2 Hapus --}}
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data jurusan akan dihapus permanen!",
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
