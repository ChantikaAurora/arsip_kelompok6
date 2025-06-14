@extends('tampilan.main')

@section('content')
<div class="container mt-4">
    <a href="{{ route('proposal.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="row">
        <!-- Detail Proposal + File Proposal -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Proposal Penelitian</h5>
                    @if($proposal->file)
                        <a href="{{ route('proposal.download', $proposal->id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">Kode Seri</th>
                            <td>{{ $proposal->kode_seri ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $proposal->judul }}</td>
                        </tr>
                        <tr>
                            <th>Peneliti</th>
                            <td>{{ $proposal->peneliti }}</td>
                        </tr>
                        <tr>
                            <th>Skema</th>
                            <td>{{ $proposal->skema ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Anggota</th>
                            <td>{{ $proposal->anggota ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $proposal->jurusan->nama_jurusan ?? $proposal->jurusan->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td>{{ $proposal->prodi->nama_prodi ?? $proposal->prodi->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>{{ $proposal->tanggal_pengajuan ? \Carbon\Carbon::parse($proposal->tanggal_pengajuan)->format('d-m-Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $proposal->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>File Proposal</th>
                            <td>
                                @if($proposal->file)
                                    <span class="badge bg-success">File tersedia</span>
                                    <a href="{{ route('proposal.download', $proposal->id) }}" class="btn btn-outline-primary btn-sm ms-2">
                                        <i class="fas fa-eye"></i> Lihat File
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Tidak ada file</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    {{-- Preview File Proposal (opsional) --}}
                    @if($proposal->file)
                        <div class="mt-4">
                            <h6>Preview File Proposal:</h6>
                            <div class="border rounded p-3" style="height: 500px; overflow: auto;">
                                @php
                                    $extension = pathinfo($proposal->file, PATHINFO_EXTENSION);
                                @endphp
                                
                                @if(in_array(strtolower($extension), ['pdf']))
                                    <iframe src="{{ route('proposal.download', ['id' => $proposal->id]) }}?preview=1"
                                        width="100%" height="100%" style="border: none;">
                                        <p>Browser Anda tidak mendukung preview PDF. 
                                        <a href="{{ route('proposal.download', $proposal->id) }}">Klik di sini untuk mendownload file</a>.</p>
                                    </iframe>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-file fa-5x text-muted mb-3"></i>
                                        <p class="text-muted">Preview tidak tersedia untuk file {{ strtoupper($extension) }}</p>
                                        <a href="{{ route('proposal.download', $proposal->id) }}" class="btn btn-primary">
                                            <i class="fas fa-download"></i> Download File
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Aksi --}}
                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('proposal.edit', $proposal->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('proposal.destroy', $proposal->id) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus proposal ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                        @if($proposal->file)
                            <a href="{{ route('proposal.download', $proposal->id) }}" class="btn btn-success" target="_blank">
                                <i class="fas fa-download"></i> Download File
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection