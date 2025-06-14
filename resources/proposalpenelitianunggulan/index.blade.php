@extends('tampilan.main')

@section('content')
<div class="container">
  <h4>Proposal Penelitian Unggulan</h4>
  <a href="{{ route('proposal_unggulan.create') }}" class="btn btn-primary mb-3">+ Tambah Proposal</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode Seri</th>
        <th>Judul</th>
        <th>Peneliti</th>
        <th>Skema</th>
        <th>Tanggal Pengajuan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($proposal_unggulan as $item)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->kode_seri }}</td>
        <td>{{ $item->judul }}</td>
        <td>{{ $item->peneliti }}</td>
        <td>{{ $item->skema }}</td>
        <td>{{ $item->tanggal_pengajuan }}</td>
        <td>
          <a href="{{ route('proposal_unggulan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
          <a href="{{ route('proposal_unggulan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('proposal_unggulan.destroy', $item->id) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
