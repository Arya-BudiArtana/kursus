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
                <div class="sb-sidenav-menu-heading">Modul</div>
                <a class="nav-link" href="{{ route('admin.peminjamanlaptop.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Peminjaman Laptop
                </a>
            </div>
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Master Data</div>
                <a class="nav-link" href="{{ route('admin.laptop.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Laptop
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::check() ? Auth::user()->name : '' }}
        </div>
    </nav>
</div>
