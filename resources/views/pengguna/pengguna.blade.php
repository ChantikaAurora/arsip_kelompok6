@extends('tampilan.main')
@section('title', 'Manajemen Pengguna')
@section('content')

    <h2>Daftar Pengguna</h2>
    <a href="{{ route('pengguna.create') }}" class="btn btn-primary mb-3">+ Tambah Pengguna</a>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

        @foreach ($penggunas as $index => $pengguna)
            <tr>
                <td>{{ $index + $penggunas->firstItem() }}</td>
                <td>{{ $pengguna->name }}</td>
                <td>{{ $pengguna->email }}</td>
                <td>{{ $pengguna->role }}</td>
                <td class="text-center">
                    <a href="{{ route('pengguna.edit', $pengguna->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('pengguna.destroy', $pengguna->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {{ $penggunas->links('pagination::bootstrap-5') }}
    </div>

@endsection
