@extends('tampilan.main')
@section('content')

<div class="container mt-4">
    <h3 class="mb-3">Edit Data Penggguna</h3>
    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama:</label>
            <input type="text" name="name" class="form-control" value="{{ $pengguna->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $pengguna->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role:</label>
            <input type="text" name="role" class="form-control" value="{{ $pengguna->role }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
