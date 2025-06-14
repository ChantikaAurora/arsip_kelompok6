@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Proposal Pengabdian</h3>

    <form action="{{ route('proposal_pengabdian.update', $proposal_pengabdian->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('proposal_pengabdian.form', ['mode' => 'edit'])

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('proposal_pengabdian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
