@extends('tampilan.main')

@section('content')
<div class="container">
  <h4>Tambah Proposal Penelitian Unggulan</h4>

  <form action="{{ route('proposal_unggulan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('proposal_unggulan.form')
  </form>
</div>
@endsection
