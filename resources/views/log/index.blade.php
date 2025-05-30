@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Log Aktivitas</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Aktivitas</th>
                    <th>Aksi</th>
                    <th>Modul</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($log as $l)
                <tr>
                    <td>{{ $l->user->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $l->aktivitas }}</td>
                    <td>{{ ucfirst($l->aksi) }}</td>
                    <td>{{ $l->modul }}</td>
                    <td>{{ \Carbon\Carbon::parse($l->waktu)->translatedFormat('d F Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada log aktivitas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $log->links() }}
    </div>
</div>
@endsection
