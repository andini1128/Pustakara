@php
    $activeMenu = $activeMenu ?? 'dashboard';
    $dashboardRoute = $dashboardRoute ?? 'dashboard.admin';
    $sidebarLabel = $sidebarLabel ?? 'Menu admin';
    $profileRoute = $profileRoute ?? 'admin.profiles';
    $profileLabel = $profileLabel ?? 'Profil Admin';
    $reportRoute = $reportRoute ?? 'admin.reports';
    $reportShowRoute = $reportShowRoute ?? 'admin.reports.show';
    $reportPrintRoute = $reportPrintRoute ?? 'admin.reports.print';
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
    <a href="{{ route($dashboardRoute) }}" class="brand" aria-label="Pustakara">
        <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
    </a>

    <div class="sidebar-divider"></div>

    <nav class="sidebar-nav" aria-label="{{ $sidebarLabel }}">
        <a href="{{ route($dashboardRoute) }}" class="nav-item {{ $activeMenu === 'dashboard' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="3" width="7" height="7" rx="1.5" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1.5" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1.5" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1.5" stroke-width="2"/></svg>
            <span>Dasbor</span>
        </a>
        <a href="{{ route('books.index') }}" class="nav-item {{ $activeMenu === 'books' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 4.5H18C18.8284 4.5 19.5 5.17157 19.5 6V18C19.5 18.8284 18.8284 19.5 18 19.5H6C5.17157 19.5 4.5 18.8284 4.5 18V6C4.5 5.17157 5.17157 4.5 6 4.5Z" stroke-width="2"/><path d="M8 4.5V19.5" stroke-width="2"/><path d="M11 8H16" stroke-width="2"/></svg>
            <span>Buku</span>
        </a>
        <a href="{{ route('books.categories') }}" class="nav-item {{ $activeMenu === 'categories' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 4H6C4.89543 4 4 4.89543 4 6V10L14 20H18C19.1046 20 20 19.1046 20 18V14L10 4Z" stroke-width="2"/><circle cx="8" cy="8" r="1.5" stroke-width="2"/></svg>
            <span>Kategori</span>
        </a>
        <a href="{{ route('admin.loans') }}" class="nav-item {{ $activeMenu === 'loans' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12H20" stroke-width="2"/><path d="M14 6L20 12L14 18" stroke-width="2"/><path d="M4 7V17" stroke-width="2"/></svg>
            <span>Peminjaman</span>
        </a>
        <a href="{{ route('admin.users') }}" class="nav-item {{ $activeMenu === 'users' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 19C16 16.7909 14.2091 15 12 15H8C5.79086 15 4 16.7909 4 19" stroke-width="2"/><circle cx="10" cy="8" r="3" stroke-width="2"/><path d="M20 19C20 17.3431 18.6569 16 17 16H15.5" stroke-width="2"/><path d="M15 5.5C16.6569 5.5 18 6.84315 18 8.5C18 10.1569 16.6569 11.5 15 11.5" stroke-width="2"/></svg>
            <span>Pengguna</span>
        </a>
        <a href="{{ route('admin.staff') }}" class="nav-item {{ $activeMenu === 'staff' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="5" y="4" width="14" height="16" rx="2" stroke-width="2"/><circle cx="12" cy="10" r="2.5" stroke-width="2"/><path d="M8.5 16C9.16667 14.6667 10.3333 14 12 14C13.6667 14 14.8333 14.6667 15.5 16" stroke-width="2"/></svg>
            <span>Petugas</span>
        </a>
        <a href="{{ route($profileRoute) }}" class="nav-item {{ $activeMenu === 'profiles' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="5" y="4" width="14" height="16" rx="2" stroke-width="2"/><circle cx="12" cy="10" r="2.5" stroke-width="2"/><path d="M8.5 16C9.16667 14.6667 10.3333 14 12 14C13.6667 14 14.8333 14.6667 15.5 16" stroke-width="2"/></svg>
            <span>{{ $profileLabel }}</span>
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
        <a href="{{ route('admin.reviews') }}" class="nav-item {{ $activeMenu === 'reviews' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 5.5C4 4.67157 4.67157 4 5.5 4H15.5L20 8.5V18.5C20 19.3284 19.3284 20 18.5 20H5.5C4.67157 20 4 19.3284 4 18.5V5.5Z" stroke-width="2"/><path d="M15.5 4V8.5H20" stroke-width="2"/><path d="M7 15C7.83333 13.6667 9.16667 13 11 13C12.8333 13 14.1667 13.6667 15 15" stroke-width="2"/><circle cx="11" cy="9.5" r="2" stroke-width="2"/><path d="M17 11H21" stroke-width="2"/><path d="M19 9V13" stroke-width="2"/></svg>
            <span>Ulasan</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 7L19 12L14 17" stroke-width="2"/><path d="M9 12H19" stroke-width="2"/><path d="M10 4H6C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H10" stroke-width="2"/></svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
