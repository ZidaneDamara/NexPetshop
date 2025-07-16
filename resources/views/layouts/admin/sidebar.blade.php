<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo"> {{-- Mengubah link logo ke dashboard --}}
                <img src="{{ URL::asset('assets/admin/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                    class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        {{-- <span class="badge badge-success">4</span> --}} {{-- Hapus badge jika tidak digunakan --}}
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('kategori.*', 'hewan.*', 'rekening-pembayaran.*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#masterdata">
                        <i class="far fa-chart-bar"></i>
                        <p>Master Data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('kategori.*', 'hewan.*', 'rekening-pembayaran.*') ? 'show' : '' }}"
                        id="masterdata">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                                <a href="{{ route('kategori.index') }}">
                                    <span class="sub-item">Kategori Hewan</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('hewan.*') ? 'active' : '' }}">
                                <a href="{{ route('hewan.index') }}">
                                    <span class="sub-item">Hewan</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('rekening-pembayaran.*') ? 'active' : '' }}">
                                <a href="{{ route('rekening-pembayaran.index') }}">
                                    <span class="sub-item">Daftar Rekening</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}">
                        <i class="fas fa-shopping-cart"></i> {{-- Icon keranjang atau pesanan --}}
                        <p>Manajemen Pesanan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
