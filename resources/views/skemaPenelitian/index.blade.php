@extends('tampilan.navbar')
@section('page-title', 'Skema')
@section('navSkema', 'active')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="bi bi-diagram-3-fill text-primary fs-3 me-2"></i>
            <div>
                <h3 class="mb-0 fw-semibold">Manajemen Skema Penelitian</h3>
                <p class="text-muted mb-0">Kelola daftar skema penelitian yang tersedia dalam sistem arsip.</p>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah Skema --}}
    <div class="mb-4">
        <a href="{{ route('skemaPenelitian.create') }}" class="btn btn-primary d-inline-flex align-items-center">
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
        <form class="d-flex" method="GET" action="{{ route('skemaPenelitian.index') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari skema..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- Tabel Skema --}}
    <table class="table table-bordered table-hover">
        <thead class="table-light text-center">
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 70%;">Skema Penelitian</th>
                <th style="width: 25%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($skemas as $skema)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $skema->skema_penelitian }}</td>
                <td class="text-center">
                    <a href="{{ route('skemaPenelitian.edit', $skema->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form id="delete-form-{{ $skema->id }}" action="{{ route('skemaPenelitian.destroy', $skema->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $skema->id }})">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada data skema.</td>
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
            text: "Data skema akan dihapus permanen!",
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
