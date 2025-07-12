<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>E-Arsip P3M</title>

  {{-- ===== PLUGIN CSS ===== --}}
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/js/select.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">

  {{-- ===== ICON ===== --}}
  <link rel="icon" href="{{ asset('images/logopnp.png') }}" type="image/png" />
  <link rel="apple-touch-icon" href="{{ asset('images/logopnp.png') }}">

  {{-- ===== SWEETALERT2 ===== --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="container-scroller">

  {{-- ========== NAVBAR START ========== --}}
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    {{-- Logo Brand --}}
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo mr-5 pl-4">
        <img src="{{ asset('images/logo2.png') }}" alt="logo" style="width: 300px; height: 45px; object-fit: cover;" />
      </a>
      <a class="navbar-brand brand-logo-mini">
        <img src="{{ asset('images/logopnp.png') }}" alt="logo mini" style="width: 40px; height: 40px; object-fit: cover;" />
      </a>
    </div>

    {{-- Navbar Content --}}
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end px-2">

      {{-- Sidebar Toggle --}}
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>

      {{-- Page Title + Tanggal --}}
      <ul class="navbar-nav mr-lg-2">
        <li class="nav-item d-none d-lg-block align-self-center">
          <div class="d-flex justify-content-between align-items-center px-2 pb-2">
            <div style="line-height: 1; margin-bottom: -4px;">
              <h4 class="font-weight-bold mb-0 text-black">@yield('page-title', 'Dashboard')</h4>
              <small id="tanggal-navbar" class="text-black font-weight-bold" style="font-size: 13px;"></small>
            </div>
          </div>
        </li>
      </ul>

      {{-- Profile Dropdown --}}
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown d-flex align-items-center px-4">
          <div class="d-flex align-items-center">
            <span class="mr-2 font-weight-bold text-black">{{ Auth::user()->username ?? 'Guest' }}</span>
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ asset('images/faces/operator.jpg') }}" alt="profile" style="width: 35px; height: 35px; border-radius: 50%;" />
            </a>

            {{-- Dropdown Menu --}}
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="#" class="dropdown-item" onclick="confirmLogout(event)">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>

              {{-- Hidden Logout Form --}}
              <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
              </form>
            </div>
          </div>
        </li>
      </ul>

    </div>
  </nav>
  {{-- ========== NAVBAR END ========== --}}

  {{-- ========== PAGE BODY ========== --}}
  <div class="container-scroller page-body-wrapper">

    {{-- Sidebar --}}
    @include('tampilan.sidebar')

    {{-- Main Content --}}
    <div class="main-panel">
      <div class="content-wrapper">
        @yield('content')
      </div>
    </div>

  </div>
</div>

{{-- ===== PAGE SCRIPTS ===== --}}
<script>
  // Tanggal Lokal Indonesia di Navbar
  document.addEventListener("DOMContentLoaded", function () {
    const formatter = new Intl.DateTimeFormat('id-ID', {
      weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
    const tanggalElement = document.getElementById('tanggal-navbar');
    if (tanggalElement) {
      tanggalElement.textContent = formatter.format(new Date());
    }
  });

  // Konfirmasi Logout
  function confirmLogout(event) {
    event.preventDefault();
    Swal.fire({
      title: 'Yakin ingin Logout?',
      text: "Aksi ini akan mengakhiri sesi Anda.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Logout',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
      }
    });
  }
</script>

{{-- ===== VENDOR JS ===== --}}
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

{{-- ===== TEMPLATE JS ===== --}}
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>

{{-- ===== CUSTOM JS ===== --}}
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>

</body>
</html>
