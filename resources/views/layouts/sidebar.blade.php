<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Dashboard</div>
                <a class="nav-link" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
            </div>
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Modul Peminjaman</div>
                <a class="nav-link" href="{{ route('admin.peminjamanlaptop.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Peminjaman Laptop
                </a>
                <a class="nav-link"
                    href="{{ Auth::user()->role == 1 ? route('admin.peminjaman-kendaraan.index') : route('pegawai.peminjaman-kendaraan.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Peminjaman Kendaraan
                </a>
            </div>
            @if (Auth::user()->role == 1)
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Master Data</div>
                    <a class="nav-link" href="{{ route('admin.laptop.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Laptop
                    </a>
                    <a class="nav-link" href="{{ route('admin.kendaraans.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Kendaraan
                    </a>
                </div>
            @endif
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::check() ? Auth::user()->name : '' }}
        </div>
    </nav>
</div>
