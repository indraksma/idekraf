<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | {{ config('app.name') }}</title>

    <!-- Google Font: DM Sans -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <style type="text/css">
        .bg {
            /* The image used */
            background-image: url('{{ asset('bg.jpg') }}');

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="hold-transition login-page bg">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-success">
            <div class="card-header text-center">
                <img src="{{ asset('logo_idekraf.png') }}" class="img-fluid" style="max-width: 50px" />
                <br />
                <a href="{{ route('home') }}" class="h2"><b>{{ config('app.name') }}</b></a>
                <br />
                Registrasi Akun
            </div>
            <div class="card-body">

                <form action="{{ route('register') }}" method="post" class="mb-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="input-group mb-3">
                        <input name="name" type="text" class="form-control" placeholder="Nama">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="no_hp" type="text" class="form-control" placeholder="No HP">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        @error('no_hp')
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="password_confirmation" type="password" class="form-control"
                            placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-success">
                        Daftar
                    </button>
                </form>

                <p class="text-center mb-0">
                    Sudah memiliki akun ? <a href="{{ route('login') }}" class="text-center text-success">Login</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
