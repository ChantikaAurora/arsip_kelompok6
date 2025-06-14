@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Proposal Pengabdian</h3>

    <form action="{{ route('proposal_pengabdian.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('proposal_pengabdian.form', ['mode' => 'create'])

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('proposal_pengabdian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
