<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - E-Arsip P3M</title>

  {{-- CSS Plugins --}}
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">

  {{-- Main CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">

  {{-- Favicon --}}
  <link rel="shortcut icon" href="{{ asset('images/logopnp.png') }}" type="image/png" />

  {{-- Feather Icons --}}
  <script src="https://unpkg.com/feather-icons"></script>

  <style>
    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      height: 1.5em;
      width: 1.5em;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #6c757d;
    }

    .form-control-lg {
      padding-right: 3rem;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">

              {{-- Logo --}}
              <div class="brand-logo mb-3">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo" style="width: 200px; height: 50px; object-fit: cover;">
              </div>

              {{-- Header --}}
              <h4 class="mb-2">Selamat datang di Sistem E-Arsip P3M!</h4>
              <h6 class="font-weight-light mb-2">Silakan login untuk mengakses sistem.</h6>

              {{-- Pesan Error --}}
              @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
              @endif

              {{-- Form Login --}}
              <form method="POST" action="{{ route('login.post') }}" class="pt-3">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                         placeholder="Email" value="{{ old('email') }}" required autofocus>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Password --}}
                <div class="form-group position-relative">
                  <input type="password" name="password" id="password"
                         class="form-control form-control-lg pe-5 @error('password') is-invalid @enderror"
                         placeholder="Password" required>
                  <span class="toggle-password" onclick="togglePassword()">
                    <i data-feather="eye-off" id="toggleIcon"></i>
                  </span>
                  @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Remember Me --}}
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" name="remember" class="form-check-input">
                    Ingat saya
                  </label>
                </div>

                {{-- Tombol Login --}}
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    SIGN IN
                  </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- JS Plugins --}}
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

  {{-- Custom JS --}}
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>

  {{-- Feather + Show/Hide Password --}}
  <script>
    feather.replace();

    function togglePassword() {
      const password = document.getElementById('password');
      const icon = document.getElementById('toggleIcon');

      if (password.type === 'password') {
        password.type = 'text';
        icon.setAttribute('data-feather', 'eye');
      } else {
        password.type = 'password';
        icon.setAttribute('data-feather', 'eye-off');
      }

      feather.replace();
    }
  </script>
</body>
</html>
