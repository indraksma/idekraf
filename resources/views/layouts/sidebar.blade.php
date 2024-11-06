<aside class="main-sidebar sidebar-light-teal elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('logo_mini.png') }}" alt="IDEKRAF Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ config('app.name', 'IDEKRAF') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin') }}"
                        class="{{ request()->routeIs('admin') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (Auth::user()->hasRole('admin'))
                    <li class="nav-item {{ request()->routeIs(['admin.usaha', 'admin.verusaha']) ? 'menu-open' : '' }}">
                        <a href="#"
                            class="{{ request()->routeIs(['admin.usaha', 'admin.verusaha']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Ekraf
                                <i class="right fas fa-angle-left"></i>
                                @if (getUnverifiedCount() != 0)
                                    <span class="right badge badge-danger">{{ getUnverifiedCount() }}</span>
                                @endif
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.usaha') }}"
                                    class="{{ request()->routeIs('admin.usaha') ? 'nav-link active' : 'nav-link' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Data Ekraf
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.verusaha') }}"
                                    class="{{ request()->routeIs('admin.verusaha') ? 'nav-link active' : 'nav-link' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Verifikasi Ekraf
                                        @if (getUnverifiedCount() != 0)
                                            <span class="right badge badge-danger">{{ getUnverifiedCount() }}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('admin.usaha') }}"
                            class="{{ request()->routeIs('admin.usaha') ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Data Ekraf
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('admin.produk') }}"
                        class="{{ request()->routeIs('admin.produk') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                @if (Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('admin.setting') }}"
                            class="{{ request()->routeIs('admin.setting') ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Setting
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.user') }}"
                            class="{{ request()->routeIs('admin.user') ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
