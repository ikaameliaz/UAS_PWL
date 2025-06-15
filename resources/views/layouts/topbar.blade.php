<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Page Title (Optional - can be populated from views) -->
    <div class="d-none d-sm-inline-block">
        <h1 class="h3 mb-0 text-gray-800">@yield('page-title', 'Dashboard')</h1>
    </div>

    <!-- Topbar Search (Optional) -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari berita..."
                   aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                 aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                               placeholder="Cari berita..." aria-label="Search"
                               aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Notifications (Optional) -->
        @auth
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <!-- Dropdown - Notifications -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Notifikasi
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ date('F d, Y') }}</div>
                            <span class="font-weight-bold">Berita baru telah dipublikasi!</span>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Lihat Semua Notifikasi</a>
                </div>
            </li>
        @endauth

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                @auth
                    @php
                        $userName = Auth::user()->name;
                        $userRole = Auth::user()->role;
                    @endphp
                    
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                        {{ $userName }}
                        <div class="text-xs text-muted">{{ ucfirst($userRole) }}</div>
                    </span>
                    <img class="img-profile rounded-circle"
                         src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&background=4e73df&color=ffffff&size=60"
                         alt="User Avatar">
                @else
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Guest</span>
                    <img class="img-profile rounded-circle"
                         src="https://ui-avatars.com/api/?name=Guest&background=6c757d&color=ffffff&size=60"
                         alt="Guest Avatar">
                @endauth
            </a>

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">

                @auth
                    <!-- User Info Header -->
                    <div class="dropdown-header">
                        <strong>{{ Auth::user()->name }}</strong>
                        <div class="text-muted small">{{ Auth::user()->email }}</div>
                    </div>
                    
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profil Saya
                    </a>

                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Pengaturan
                    </a>

                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Aktivitas
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- Logout -->
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Keluar
                    </a>
                @else
                    <a class="dropdown-item" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Masuk
                    </a>
                    
                    <a class="dropdown-item" href="{{ route('register') }}">
                        <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                        Daftar
                    </a>
                @endauth
            </div>
        </li>
    </ul>
</nav>

<!-- Logout Modal -->
@auth
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Pilih "Keluar" jika Anda siap untuk mengakhiri sesi saat ini.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-primary" type="submit">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth