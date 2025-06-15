<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Laravel News</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Navigation for authenticated users -->
    @auth
        <!-- Heading -->
        <div class="sidebar-heading text-uppercase">
            Menu Utama
        </div>

        <!-- Berita -->
        <li class="nav-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('berita.index') }}">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>Berita</span>
            </a>
        </li>

        <!-- Role-based menus -->
        @if (Auth::user()->role === 'editor')
            <li class="nav-item {{ request()->routeIs('berita.approval') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('berita.approval') }}">
                    <i class="fas fa-fw fa-check-circle"></i>
                    <span>Approval Berita</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->role === 'admin')
            <!-- Divider -->
            <hr class="sidebar-divider">
            
            <!-- Heading -->
            <div class="sidebar-heading text-uppercase">
                Administrator
            </div>
            
            <li class="nav-item {{ request()->is('dashboard/admin*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/dashboard/admin') }}">
                    <i class="fas fa-fw fa-user-shield"></i>
                    <span>Dashboard Admin</span>
                </a>
            </li>
            
            <!-- User Management -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                   aria-expanded="false" aria-controls="collapseUsers">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Manajemen User</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User Management:</h6>
                        <a class="collapse-item" href="#">Daftar User</a>
                        <a class="collapse-item" href="#">Role & Permission</a>
                    </div>
                </div>
            </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider">
        
        <!-- Profile Section -->
        <div class="sidebar-heading text-uppercase">
            Akun
        </div>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profil.edit') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Profil Saya</span>
            </a>
        </li>

    @else
        <!-- For guests -->
        <div class="sidebar-heading text-uppercase">
            Akses
        </div>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
                <i class="fas fa-fw fa-sign-in-alt"></i>
                <span>Masuk</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">
                <i class="fas fa-fw fa-user-plus"></i>
                <span>Daftar</span>
            </a>
        </li>
    @endauth

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Logout for authenticated users -->
    @auth
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-fw fa-sign-out-alt text-danger"></i>
                <span class="text-danger">Keluar</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    @endauth

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>