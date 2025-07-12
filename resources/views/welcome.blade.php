@extends('tampilan.navbar')

@section('content')
<div class="row">
  <!-- Selamat Datang -->
  <div class="col-md-12 grid-margin">
    <div class="card tale-bg shadow-sm">
      <div class="row align-items-center">
        <!-- Bagian Teks -->
        <div class="col-md-7 pl-5">
          <h2 class="font-weight-bold mb-3">
            Selamat Datang, {{ Auth::user()->username ?? 'Guest' }} !
          </h2>
          <h5 class="font-weight-normal mb-1">Senang melihat anda kembali,</h5>
          <h5 class="font-weight-normal mb-1">
            Sistem E-Arsip P3M Politeknik Negeri Padang siap membantu Anda mengelola dan mencari dokumen dengan efisien dan aman.
          </h5>
        </div>

        <!-- Bagian Gambar -->
        <div class="col-md-5 text-center">
          <img src="{{ asset('images/dashboard/book.png') }}" alt="book" class="img-fluid" style="max-height: 220px;">
        </div>
      </div>
    </div>
  </div>

  <!-- Report Section -->
  <div class="col-md-12 grid-margin transparent">
    <div class="row">
      <div class="col-md-12 mb-2">
        <h3 class="font-weight-bold pl-3">Report</h3>
      </div>

      @php
        $cards = [];

        if (Auth::user()->role === 'admin') {
            $cards[] = ['title' => 'Total Pengguna', 'icon' => 'mdi-account', 'count' => $totalPengguna, 'class' => 'card-tale'];
        }

        $cards[] = ['title' => 'Total Surat Masuk', 'icon' => 'mdi-email-receive', 'count' => $totalSuratMasuk, 'class' => 'card-dark-blue'];
        $cards[] = ['title' => 'Total Surat Keluar', 'icon' => 'mdi-email-send', 'count' => $totalSuratKeluar, 'class' => 'card-light-danger'];
        $cards[] = ['title' => 'Total Proposal', 'icon' => 'mdi-book-open', 'count' => $totalProposal, 'class' => 'card-tale'];
        $cards[] = ['title' => 'Total Laporan', 'icon' => 'mdi-file-document', 'count' => $totalLaporan, 'class' => 'card-light-blue'];
      @endphp


      @foreach ($cards as $item)
        <div class="col-md-3 mb-4 stretch-card transparent">
          <div class="card {{ $item['class'] }}">
            <div class="card-body">
              <h4 class="mb-4">
                <i class="mdi {{ $item['icon'] }} mr-2"></i>{{ $item['title'] }}
              </h4>
              <p class="fs-30 mb-1 " style="margin-left: 30px;">{{ $item['count'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Diagram -->
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <p class="card-title">Diagram Jumlah Arsip Proposal dan Laporan</p>
        </div>
        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
        <canvas id="sales-chart" width="300" height="100"></canvas>
      </div>
    </div>
  </div>
</div>

@include('api.diagram')
@endsection
