<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Skydash Admin</title>

  {{-- Plugin CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">

  {{-- Main CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">

  {{-- Favicon --}}
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
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
                <img src="{{ asset('images/logo2.png') }}" alt="Logo" width="100">
              </div>

              {{-- Header --}}
              <h4 class="mb-1">Hello! Let's get started</h4>
              <h6 class="font-weight-light mb-4">Sign in to continue.</h6>

              {{-- Flash Error --}}
              @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif

              {{-- Form Login --}}
              <form method="POST" action="{{ route('login.post') }}" class="pt-3">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                  <input
                    type="email"
                    name="email"
                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                  >
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                  <input
                    type="password"
                    name="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                    placeholder="Password"
                    required
                  >
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Remember Me --}}
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="remember">
                      Keep me signed in
                    </label>
                  </div>
                </div>

                {{-- Button --}}
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

  {{-- Plugin JS --}}
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

  {{-- Custom JS --}}
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>
</body>

</html>
