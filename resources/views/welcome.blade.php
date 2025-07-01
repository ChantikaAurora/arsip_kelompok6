@extends('tampilan.main')

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Welcome {{ Auth::user()->username ?? 'Guest' }}</h3>
        <h6 class="font-weight-normal mb-0">
          Senang melihat anda kembali! <br>
          Sistem E-Arsip P3M siap membantu Anda mengelola dan mencari dokumen dengan efisien dan aman
        </h6>
      </div>
      <div class="col-12 col-xl-4">
        <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <i class="mdi mdi-calendar"></i> Today ({{ now()->format('d M Y') }})
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
              <a class="dropdown-item" href="#">January - March</a>
              <a class="dropdown-item" href="#">March - June</a>
              <a class="dropdown-item" href="#">June - August</a>
              <a class="dropdown-item" href="#">August - November</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card tale-bg">
      <div class="card-people mt-auto">
        <img src="images/dashboard/people.svg" alt="people">
        <div class="weather-info">
          <div class="d-flex">
            <div>
              <h2 class="mb-0 font-weight-normal">
                <i class="icon-sun mr-2"></i><span id="temperature">--</span><sup>°C</sup>
              </h2>
            </div>
            <div class="ml-2">
              <h4 class="location font-weight-normal" id="city">Memuat...</h4>
              <h6 class="font-weight-normal" id="country">Memuat...</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin transparent">
    <div class="row">
      @foreach([
        ['title' => 'Pengguna', 'icon' => 'mdi-account', 'count' => $totalPengguna, 'class' => 'card-tale'],
        ['title' => 'Surat Masuk', 'icon' => 'mdi-email-receive', 'count' => number_format($totalSuratMasuk), 'class' => 'card-dark-blue'],
        ['title' => 'Surat Keluar', 'icon' => 'mdi-email-send', 'count' => number_format($totalSuratKeluar), 'class' => 'card-light-blue'],
        ['title' => 'Dokumen Lainnya', 'icon' => 'mdi-file-document', 'count' => '', 'class' => 'card-light-danger']
      ] as $item)
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card {{ $item['class'] }}">
          <div class="card-body">
            <h4 class="mb-4"><i class="mdi {{ $item['icon'] }} mr-2"></i>{{ $item['title'] }}</h4>
            <p class="fs-30 mb-2">{{ $item['count'] }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div class="row">
  <div class="col grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <p class="card-title">Diagram Total Arsip Proposal dan Laporan</p>
      </div>
      <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
      <canvas id="sales-chart" width="300" height="100"></canvas>
    </div>
  </div>
</div>
@include('api.diagram')
</div>

@endsection

@push('scripts')

<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
  } else {
    document.getElementById("city").innerText = "Lokasi tidak didukung";
  }

  function successCallback(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;
    const apiKey = "c593bbc2d36cfc1645eb7ba4e35e2e95";

    fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`)
      .then(response => response.json())
      .then(data => {
        document.getElementById("temperature").innerText = Math.round(data.main.temp);
        document.getElementById("city").innerText = data.name;
        document.getElementById("country").innerText = data.sys.country;
      })
      .catch(() => {
        document.getElementById("city").innerText = "Gagal memuat";
        document.getElementById("country").innerText = "-";
      });
  }

  function errorCallback() {
    document.getElementById("city").innerText = "Izin lokasi ditolak";
    document.getElementById("country").innerText = "-";
  }
});
</script>
@endpush
