<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ config('app.name', 'IDEKRAF') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/ionicons.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js"></script>

    @livewireStyles

    @stack('headscript')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-teal">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <img src="{{ asset('logo_mini.png') }}" alt="IDEKRAF Logo" class="brand-image" style="opacity: .8">
                    <span class="brand-text text-white font-weight-bold">IDEKRAF</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Right navbar links -->
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="order-1 order-md-3 navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link text-white">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ekraf') }}" class="nav-link text-white">Pelaku Ekraf</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/contact') }}" class="nav-link text-white">Hubungi Kami</a>
                        </li>
                        @if (!Auth::user())
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link text-white">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">
                                    <button class=" btn btn-warning btn-sm font-weight-bold"
                                        style="border-radius: 20px;">
                                        Daftarkan Sekarang
                                    </button>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    href="#" class="nav-link text-white">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin') }}" class="nav-link">
                                    <button class=" btn btn-warning btn-sm font-weight-bold"
                                        style="border-radius: 20px;">
                                        Dashboard Admin
                                    </button>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content-header')
            <!-- Main content -->
            <div class="content p-0">
                @yield('content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        {{-- <footer class="main-footer text-center">
            <strong>Copyright &copy; 2024 <a href="https://baperlitbang.banjarnegarakab.go.id"
                    class="text-teal">BAPERLITBANG</a>.</strong>
        </footer> --}}

        <footer class="footer-04">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 mb-md-0 mb-4">
                        <h2 class="footer-heading"><a href="#" class="logo">IDEKRAF</a></h2>
                        <p>IDEKRAF adalah sistem informasi yang dikembangkan oleh Badan Perencanaa, Penelitian dan
                            Pengembangan Kabupaten Banjarnegara untuk mengelola informasi terkait pelaku usaha kreatif
                            atau sering disebut sebagai "Ekraf".
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-md-0 mb-4 text-right">
                        <h2 class="footer-heading">Follow us</h2>
                        <ul class="ftco-footer-social p-0">
                            <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top"
                                    title="Twitter"><span class="ion-logo-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top"
                                    title="Facebook"><span class="ion-logo-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top"
                                    title="Instagram"><span class="ion-logo-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="w-100 mt-3 border-top py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 text-center">
                            <p class="copyright mb-0">
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> <a href="https://baperlitbang.banjarnegarakab.go.id"
                                    target="_blank">BAPERLITBANG</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <form form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <x-livewire-alert::flash />

    @stack('bodyscript')
</body>

</html>
