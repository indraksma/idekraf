<nav class="main-header navbar navbar-expand navbar-teal navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link text-white" data-toggle="dropdown" href="#">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                <a class="dropdown-item text-center dropdown-header">
                    Hello, {{ Auth::user()->name }}!
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.chpass') }}" class="dropdown-item text-center">Ubah Password</a>
                <div class="dropdown-divider"></div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item dropdown-footer bg-danger">Logout</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
