@php
    $activeMenu = $activeMenu ?? 'dashboard';
    $reportRoute = $reportRoute ?? 'staff.reports';
    $reportShowRoute = $reportShowRoute ?? 'staff.reports.show';
    $reportPrintRoute = $reportPrintRoute ?? 'staff.reports.print';
@endphp

<style>
    .nav-dropdown { margin:0 18px; }
    .nav-dropdown summary { list-style:none; cursor:pointer; margin:0; }
    .nav-dropdown summary::-webkit-details-marker { display:none; }
    .nav-dropdown .nav-item { width:100%; margin:0; }
    .nav-submenu { display:grid; gap:6px; padding:8px 0 0 48px; }
    .nav-submenu a { color:#fff; text-decoration:none; font-size:14px; font-weight:700; padding:8px 10px; border-radius:12px; background:rgba(255,255,255,.14); }
    .nav-submenu a:hover { background:rgba(255,255,255,.25); }
    @media (max-width:900px) {
        .nav-dropdown { margin:0; }
        .nav-submenu { padding-left:18px; }
    }
</style>

<aside class="sidebar">
    <a href="{{ route('dashboard.petugas') }}" class="brand" aria-label="Pustakara">
        <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
    </a>

    <div class="sidebar-divider"></div>

    <nav class="sidebar-nav" aria-label="Menu petugas">
        <a href="{{ route('dashboard.petugas') }}" class="nav-item {{ $activeMenu === 'dashboard' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="3" width="7" height="7" rx="1.5" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1.5" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1.5" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1.5" stroke-width="2"/></svg>
            <span>Dasbor</span>
        </a>
        <a href="{{ route('staff.books') }}" class="nav-item {{ $activeMenu === 'books' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 4.5H18C18.8284 4.5 19.5 5.17157 19.5 6V18C19.5 18.8284 18.8284 19.5 18 19.5H6C5.17157 19.5 4.5 18.8284 4.5 18V6C4.5 5.17157 5.17157 4.5 6 4.5Z" stroke-width="2"/><path d="M8 4.5V19.5" stroke-width="2"/><path d="M11 8H16" stroke-width="2"/></svg>
            <span>Buku</span>
        </a>
        <a href="{{ route('staff.loans') }}" class="nav-item {{ $activeMenu === 'loans' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12H20" stroke-width="2"/><path d="M14 6L20 12L14 18" stroke-width="2"/><path d="M4 7V17" stroke-width="2"/></svg>
            <span>Peminjaman</span>
        </a>
        <details class="nav-dropdown" {{ $activeMenu === 'reports' ? 'open' : '' }}>
            <summary class="nav-item {{ $activeMenu === 'reports' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 3.5H14L18.5 8V20C18.5 20.8284 17.8284 21.5 17 21.5H7C6.17157 21.5 5.5 20.8284 5.5 20V5C5.5 4.17157 6.17157 3.5 7 3.5Z" stroke-width="2"/><path d="M14 3.5V8H18.5" stroke-width="2"/><path d="M8.5 12H15.5" stroke-width="2"/><path d="M8.5 16H15.5" stroke-width="2"/></svg>
                <span>Laporan</span>
            </summary>
            <div class="nav-submenu">
                <a href="{{ route($reportRoute) }}">Halaman Laporan</a>
                <a href="{{ route($reportShowRoute, 'pengguna') }}">Kelola User</a>
                <a href="{{ route($reportShowRoute, 'buku') }}">Kelola Buku</a>
                <a href="{{ route($reportShowRoute, 'peminjaman') }}">Kelola Peminjaman</a>
                <a href="{{ route($reportShowRoute, 'pengembalian') }}">Kelola Pengembalian</a>
            </div>
        </details>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="hidden" name="redirect_to" value="login.petugas">
            <button type="submit" class="logout-btn">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 7L19 12L14 17" stroke-width="2"/><path d="M9 12H19" stroke-width="2"/><path d="M10 4H6C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H10" stroke-width="2"/></svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
