<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - E-Arsip BRMP Mektan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('admin/assets/img/logo-kementan.png') }}" rel="icon">
  <link href="{{ asset('admin/assets/img/logo-kementan.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
  <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <main>
        <div class="container">
            <section class="section register d-flex flex-column align-items-center justify-content-center py-3">
                <div class="container">
                    <div class="d-flex flex-column justify-content-center text-center align-items-center pb-4 gap-1">
                        <a href="{{ route('login')}}" class="d-flex align-items-center">
                            <img src="{{ asset('admin/assets/img/logo-kementan.png') }}" alt="Logo-Kementan" width="200" height="200">
                        </a>
                        <span class="d-lg-block fs-2 fw-semibold">E-Arsip BRMP Mektan</span>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            @if (session()->has('loginError'))
                                <div class="col-12 alert alert-danger alert-dismissible fade show text-center" role="alert">
                                    {{ session('loginError') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif (session()->has('status'))
                            <div class="col-12 alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-2 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Silahkan Login ke Akun Anda</h5>
                                    </div>
                                    <form class="row g-3" action="{{ route('submit-login') }}" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0"><a href="{{ route('password.request') }}">Lupa Password ?</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Footer --}}
                <div class="row d-flex flex-column align-items-center justify-content-center">
                    @include('components.admin.footer')
                </div>
                </div>
            </section>
        </div>
        </main>

        <!-- Vendor JS Files -->
        <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/quill/quill.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('admin/assets/js/main.js') }}"></script>

</body>

</html>