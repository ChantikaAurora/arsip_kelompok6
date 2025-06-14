@extends('tampilan.main')

@section('content')
<div class="container">
  <h4>Edit Proposal Penelitian Unggulan</h4>

  <form action="{{ route('proposal_unggulan.update', $proposal_unggulan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('proposal_unggulan.form')
  </form>
</div>
@endsection
