<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
</head>
<body>
  @extends('tampilan.main')
   @yield('scripts')

@section('content')
 <!-- partial -->
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome Aamir</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
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
                        <!-- <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2> -->
                         <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i><span id="temperature">--</span><sup>°C</sup></h2>
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
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <!-- <p class="mb-4">Pengguna</p> -->
                         <p class="mb-4"><i class="mdi mdi-account mr-2"></i>Pengguna</p>

                       <p class="fs-30 mb-2">{{ $totalPengguna }}</p>
                      <!-- <p class="fs-30 mb-2">4006</p> -->
                      <!-- <p>10.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <!-- <p class="mb-4">Surat Masuk</p> -->
                      <p class="mb-4"><i class="mdi mdi-email-receive mr-2"></i>Surat Masuk</p>
                      <!-- <p class="fs-30 mb-2">61344</p> -->
                       <p class="fs-30 mb-2">{{ number_format($totalSuratMasuk) }}</p>

                      <!-- <p>22.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">

                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">

                      <!-- <p class="mb-4">Surat Keluar</p>
                      <p class="fs-30 mb-2">34040</p>
                      <p>2.00% (30 days)</p> -->

                      <!-- AGAR REALTIME KE DASHBOARD -->
                      <!-- <p class="mb-4">Surat Keluar</p> -->
                           <p class="mb-4"><i class="mdi mdi-email-send mr-2"></i>Surat Keluar</p>
                      <p class="fs-30 mb-2">{{ number_format($totalSuratKeluar) }}</p>
                      <!-- <p>{{ $growthPercent }}% (30 days)</p> -->
                     </a>
                     

                    </div>
                  </div>
                </div>
                
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <!-- <p class="mb-4">Dokumen Lainnya</p> -->
                           <p class="mb-4"><i class="mdi mdi-file-document mdi-30px mr-2"></i>Dokumen Lainnya</p>  
                           <!-- mdi-37px -->   <!-- untuk memperbesar ICON  -->
                      <!-- <p class="fs-30 mb-2">47033</p> -->
                       <!-- <p class="fs-30 mb-2">{{ number_format($totalDokumenLainnya) }}</p> -->
                        <p class="fs-30 mb-2">{{ number_format($totalDokumenLainnya) }}</p>

                      <!-- <p>0.22% (30 days)</p> -->
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Log Aktivitas</p>
                  <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Pengguna</p>
                      <h3 class="text-primary fs-30 font-weight-medium">{{ $totalPengguna }}</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Surat MAsuk</p>
                      <h3 class="text-primary fs-30 font-weight-medium">{{ number_format($totalSuratMasuk) }}</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Surat Keluar</p>
                      <h3 class="text-primary fs-30 font-weight-medium">{{ number_format($totalSuratKeluar) }}</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Dokumen Lainnya</p>
                      <h3 class="text-primary fs-30 font-weight-medium">{{ number_format($totalDokumenLainnya) }}</h3>
                    </div> 
                  </div>
                  <canvas id="order-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 <div class="d-flex justify-content-between">
                  <p class="card-title">Sales Report</p>
                  <a href="#" class="text-info">View all</a>
                 </div>
                  <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
<!-- <script>
    const ctx = document.getElementById('order-chart').getContext('2d');

    const orderChart = new Chart(ctx, {
        type: 'bar',  // bisa juga 'line', 'pie', dll
        data: {
            labels: ['Pengguna', 'Surat Masuk', 'Surat Keluar', 'Dokumen Lainnya'],
            datasets: [{
                label: 'Jumlah',
                data: [
                    {{ $totalPengguna ?? 0 }}, 
                    {{ $totalSuratMasuk ?? 0 }}, 
                    {{ $totalSuratKeluar ?? 0 }}, 
                    {{ $totalDokumenLainnya ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',  // warna bar Pengguna
                    'rgba(255, 206, 86, 0.7)',  // warna bar Surat Masuk
                    'rgba(75, 192, 192, 0.7)',  // warna bar Surat Keluar
                    'rgba(255, 99, 132, 0.7)'   // warna bar Dokumen Lainnya
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)', 
                    'rgba(255, 206, 86, 1)', 
                    'rgba(75, 192, 192, 1)', 
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    });
</script> -->

</body>
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
      const apiKey = "c593bbc2d36cfc1645eb7ba4e35e2e95"; // Ganti dengan API key kamu

      const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

      fetch(url)
        .then(response => response.json())
        .then(data => {
          document.getElementById("temperature").innerText = Math.round(data.main.temp);
          document.getElementById("city").innerText = data.name;
          document.getElementById("country").innerText = data.sys.country;
        })
        .catch(error => {
          document.getElementById("city").innerText = "Gagal memuat";
          document.getElementById("country").innerText = "-";
        });
    }

    function errorCallback(error) {
      document.getElementById("city").innerText = "Izin lokasi ditolak";
      document.getElementById("country").innerText = "-";
    }
  });
</script>

</html>
