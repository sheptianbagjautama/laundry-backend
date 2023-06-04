<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('lte/dist/img/AdminLTELogo.png') }} " alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PT. Anjatama</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                <img src="{{ asset('lte/dist/img/user2-160x160.jpg') }} " class="img-circle elevation-2"
                    alt="User Image">
            </div> --}}
            <div class="info">
                <a href="#" class="d-block">{{ $user->name }}</a>
                <b><a href="#" class="d-block">{{ $user->email }}</a></b>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                <li class="nav-item">
                    <a href="{{ route('groups.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Grup
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('types.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-list-ul"></i>
                        <p>
                            Tipe
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Akun Pengguna
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sales.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-male"></i>
                        <p>
                            Sales
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-cubes"></i>
                        <p>
                            Barang
                        </p>
                    </a>
                </li>
                <li class="nav-header">PEMASUKAN/PENGELUARAN</li>
                <li class="nav-item">
                    <a href="{{ route('item-receives.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-share"></i>
                        <p>
                            Masuk Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                            Penjualan
                        </p>
                    </a>
                </li>


                <li class="nav-header">PENGATURAN</li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa fa-plug"></i>
                        <p>
                            Keluar
                        </p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
