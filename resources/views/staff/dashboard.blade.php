<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Petugas - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #b9cbd9;
            --panel: #ffffff;
            --soft: #eef6ff;
            --blue: #006dff;
            --navy: #123e7a;
            --ink: #16202a;
            --muted: rgba(22, 32, 42, 0.62);
            --shadow: 0 22px 40px rgba(69, 102, 130, 0.14);
        }
        body { min-height: 100vh; font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--ink); }
        .layout { min-height: 100vh; display: grid; grid-template-columns: 395px 1fr; }
        .sidebar { background: linear-gradient(180deg, #9fd0f7 0%, #94c9f4 100%); padding: 30px 24px 26px; display: flex; flex-direction: column; box-shadow: inset -1px 0 0 rgba(255,255,255,.2); }
        .brand { display: flex; justify-content: center; padding-top: 6px; margin-bottom: 30px; }
        .brand img { width: 128px; height: auto; display: block; }
        .sidebar-divider { height: 2px; background: rgba(255,255,255,.65); margin: 0 6px 34px; }
        .sidebar-nav { display: flex; flex-direction: column; gap: 10px; }
        .nav-item { display: inline-flex; align-items: center; gap: 18px; min-height: 58px; margin: 0 18px; padding: 14px 18px; border-radius: 18px; color: #fff; text-decoration: none; font-size: 20px; font-weight: 500; transition: background .15s ease, transform .15s ease; }
        .nav-item svg { width: 30px; height: 30px; stroke: currentColor; flex: 0 0 auto; }
        .nav-item.active { background: #c8b597; box-shadow: 0 14px 26px rgba(126,104,73,.18); }
        .nav-item:hover { background: rgba(255,255,255,.2); transform: translateX(4px); }
        .sidebar-footer { margin-top: auto; padding: 28px 18px 4px; }
        .logout-btn { width: 100%; min-height: 58px; border: 0; border-radius: 16px; background: #7a6da4; color: #fff; font-family: 'Poppins', sans-serif; font-size: 21px; display: inline-flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; box-shadow: 0 16px 24px rgba(76,62,112,.18); }
        .logout-btn svg { width: 26px; height: 26px; stroke: currentColor; }
        .content { padding: 34px; min-width: 0; }
        .hero-card { display: grid; grid-template-columns: 1fr auto; gap: 26px; align-items: center; border-radius: 28px; background: linear-gradient(135deg, #9fd0f7 0%, #ffffff 100%); padding: 30px; box-shadow: var(--shadow); }
        .hero-chip { display: inline-flex; min-height: 32px; align-items: center; padding: 6px 14px; border-radius: 999px; background: rgba(255,255,255,.7); color: var(--blue); font-size: 13px; font-weight: 800; margin-bottom: 12px; }
        .hero-title { color: var(--navy); font-size: clamp(30px, 3vw, 46px); line-height: 1.15; font-weight: 800; margin-bottom: 10px; }
        .hero-text { color: rgba(18,62,122,.72); font-size: 15px; font-weight: 600; line-height: 1.7; max-width: 760px; }
        .staff-pill { display: inline-flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 18px; background: rgba(255,255,255,.72); color: var(--navy); font-weight: 800; white-space: nowrap; }
        .staff-avatar { width: 48px; height: 48px; border-radius: 50%; background: var(--blue); color: #fff; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; overflow: hidden; }
        .staff-avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; margin-top: 24px; }
        .stat-card { background: var(--panel); border-radius: 22px; padding: 22px; display: flex; align-items: center; gap: 15px; min-height: 120px; box-shadow: 0 18px 30px rgba(70,97,119,.08); }
        .stat-icon { width: 50px; height: 50px; border-radius: 16px; background: var(--soft); color: var(--blue); display: inline-flex; align-items: center; justify-content: center; flex: 0 0 auto; }
        .stat-icon svg { width: 27px; height: 27px; stroke: currentColor; }
        .stat-label { color: var(--muted); font-size: 13px; font-weight: 800; text-transform: uppercase; margin-bottom: 6px; }
        .stat-value { color: var(--navy); font-size: 38px; line-height: 1; font-weight: 800; }
        .module-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; margin-top: 24px; }
        .module-card { min-height: 238px; border-radius: 22px; background: var(--panel); color: var(--ink); text-decoration: none; padding: 22px; display: flex; flex-direction: column; box-shadow: var(--shadow); transition: transform .15s ease, box-shadow .15s ease; }
        .module-card:hover { transform: translateY(-4px); box-shadow: 0 24px 42px rgba(69,102,130,.18); }
        .module-top { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 18px; }
        .module-icon { width: 48px; height: 48px; border-radius: 16px; background: var(--soft); color: var(--blue); display: inline-flex; align-items: center; justify-content: center; }
        .module-icon svg { width: 26px; height: 26px; stroke: currentColor; }
        .module-count { color: var(--navy); font-size: 32px; font-weight: 800; }
        .module-title { color: var(--navy); font-size: 21px; font-weight: 800; margin-bottom: 8px; }
        .module-desc { color: var(--muted); font-size: 13px; line-height: 1.65; font-weight: 600; }
        .module-link { margin-top: auto; color: var(--blue); font-weight: 800; font-size: 13px; }
        .overview-grid { display: grid; grid-template-columns: 1.15fr .85fr; gap: 18px; margin-top: 24px; }
        .panel { background: var(--panel); border-radius: 24px; padding: 24px; box-shadow: var(--shadow); }
        .panel-header { display: flex; justify-content: space-between; align-items: center; gap: 14px; margin-bottom: 18px; }
        .panel-title { color: var(--navy); font-size: 22px; font-weight: 800; }
        .panel-link { color: var(--blue); text-decoration: none; font-size: 13px; font-weight: 800; }
        .list { display: grid; gap: 12px; }
        .list-item { display: grid; grid-template-columns: 46px 1fr auto; align-items: center; gap: 12px; padding: 12px; border-radius: 16px; background: var(--soft); }
        .thumb { width: 46px; height: 46px; border-radius: 12px; object-fit: cover; background: #fff; }
        .item-title { color: var(--navy); font-weight: 800; line-height: 1.3; }
        .item-meta { color: var(--muted); font-size: 12px; font-weight: 700; margin-top: 3px; }
        .badge { display: inline-flex; min-height: 28px; align-items: center; padding: 5px 10px; border-radius: 999px; background: #fff; color: var(--blue); font-size: 12px; font-weight: 800; white-space: nowrap; }
        .empty-state { padding: 24px; border-radius: 18px; background: var(--soft); color: var(--muted); text-align: center; font-weight: 700; }
        @media (max-width: 1280px) { .layout { grid-template-columns: 320px 1fr; } .stats-grid, .module-grid { grid-template-columns: repeat(2, minmax(0,1fr)); } .overview-grid { grid-template-columns: 1fr; } }
        @media (max-width: 900px) { .layout { grid-template-columns: 1fr; } .sidebar { gap: 18px; } .sidebar-nav { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 12px; } .sidebar-footer { margin-top: 0; } .nav-item { margin: 0; font-size: 18px; } .hero-card { grid-template-columns: 1fr; } }
        @media (max-width: 620px) { .content { padding: 20px 16px 28px; } .stats-grid, .module-grid { grid-template-columns: 1fr; } .sidebar-nav { grid-template-columns: 1fr; } .list-item { grid-template-columns: 46px 1fr; } .badge { grid-column: 2; width: fit-content; } }
    </style>
</head>
<body>
    <div class="layout">
        @include('partials.staff-sidebar', ['activeMenu' => 'dashboard'])

        <main class="content">
            <section class="hero-card">
                <div>
                    <span class="hero-chip">Dasbor Petugas</span>
                    <h1 class="hero-title">Pusat kendali Pustakara</h1>
                    <p class="hero-text">Kelola data buku, kategori, peminjaman, dan laporan dari satu halaman yang ringkas.</p>
                </div>
                <div class="staff-pill">
                    <span class="staff-avatar">
                        @if (auth()->user()?->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}">
                        @else
                            {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
                        @endif
                    </span>
                    <span>{{ auth()->user()->name ?? 'Petugas' }}</span>
                </div>
            </section>

            <section class="stats-grid" aria-label="Statistik utama">
                <article class="stat-card">
                    <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 5H19V19H5V5Z" stroke-width="2"/><path d="M9 5V19" stroke-width="2"/><path d="M12 9H16" stroke-width="2"/></svg></div>
                    <div><div class="stat-label">Buku</div><div class="stat-value">{{ $stats['totalBooks'] }}</div></div>
                </article>
                <article class="stat-card">
                    <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M10 4H6C4.9 4 4 4.9 4 6V10L14 20H18C19.1 20 20 19.1 20 18V14L10 4Z" stroke-width="2"/><circle cx="8" cy="8" r="1.5" stroke-width="2"/></svg></div>
                    <div><div class="stat-label">Kategori</div><div class="stat-value">{{ $stats['totalCategories'] }}</div></div>
                </article>
                <article class="stat-card">
                    <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 12H20" stroke-width="2"/><path d="M14 6L20 12L14 18" stroke-width="2"/><path d="M4 7V17" stroke-width="2"/></svg></div>
                    <div><div class="stat-label">Peminjaman</div><div class="stat-value">{{ $stats['totalLoans'] }}</div></div>
                </article>
                <article class="stat-card">
                    <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M16 19C16 16.8 14.2 15 12 15H8C5.8 15 4 16.8 4 19" stroke-width="2"/><circle cx="10" cy="8" r="3" stroke-width="2"/><path d="M20 19C20 17.3 18.7 16 17 16H15.5" stroke-width="2"/></svg></div>
                    <div><div class="stat-label">Pengguna</div><div class="stat-value">{{ $stats['totalUsers'] }}</div></div>
                </article>
            </section>

            <section class="module-grid" aria-label="Menu utama petugas">
                <a class="module-card" href="{{ route('staff.books') }}">
                    <div class="module-top"><span class="module-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 5H19V19H5V5Z" stroke-width="2"/><path d="M9 5V19" stroke-width="2"/></svg></span><span class="module-count">{{ $stats['totalBooks'] }}</span></div>
                    <h2 class="module-title">Buku</h2>
                    <p class="module-desc">Tambah, edit, dan pantau stok koleksi buku perpustakaan.</p>
                    <span class="module-link">Kelola buku</span>
                </a>
                <a class="module-card" href="{{ route('staff.reports') }}">
                    <div class="module-top"><span class="module-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M10 4H6C4.9 4 4 4.9 4 6V10L14 20H18C19.1 20 20 19.1 20 18V14L10 4Z" stroke-width="2"/></svg></span><span class="module-count">{{ $stats['totalCategories'] }}</span></div>
                    <h2 class="module-title">Kategori</h2>
                    <p class="module-desc">Lihat kelompok buku agar koleksi mudah dicari dan dibaca.</p>
                    <span class="module-link">Lihat kategori</span>
                </a>
                <a class="module-card" href="{{ route('staff.loans') }}">
                    <div class="module-top"><span class="module-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 12H20" stroke-width="2"/><path d="M14 6L20 12L14 18" stroke-width="2"/></svg></span><span class="module-count">{{ $stats['totalLoans'] }}</span></div>
                    <h2 class="module-title">Peminjaman</h2>
                    <p class="module-desc">Pantau transaksi pinjam, pengembalian, dan keterlambatan.</p>
                    <span class="module-link">Lihat peminjaman</span>
                </a>
                <a class="module-card" href="{{ route('staff.reports') }}">
                    <div class="module-top"><span class="module-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M7 3.5H14L18.5 8V20.5H7V3.5Z" stroke-width="2"/><path d="M14 3.5V8H18.5" stroke-width="2"/><path d="M9 13H16" stroke-width="2"/></svg></span><span class="module-count">{{ $stats['totalUsers'] }}</span></div>
                    <h2 class="module-title">Laporan</h2>
                    <p class="module-desc">Buka ringkasan data perpustakaan dan cetak laporan bila diperlukan.</p>
                    <span class="module-link">Lihat laporan</span>
                </a>
            </section>

            <section class="overview-grid">
                <div class="panel">
                    <div class="panel-header">
                        <h2 class="panel-title">Buku Terbaru</h2>
                        <a class="panel-link" href="{{ route('staff.books') }}">Lihat semua</a>
                    </div>
                    @if ($books->isNotEmpty())
                        <div class="list">
                            @foreach ($books->take(4) as $book)
                                <div class="list-item">
                                    <img class="thumb" src="{{ $book->cover ?: asset('asset/tumpukanbuku.png') }}" alt="{{ $book->judul }}">
                                    <div>
                                        <div class="item-title">{{ $book->judul }}</div>
                                        <div class="item-meta">{{ $book->penulis }} | {{ $book->kategori ?: 'Umum' }}</div>
                                    </div>
                                    <span class="badge">Stok {{ $book->stok }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">Belum ada buku yang ditambahkan.</div>
                    @endif
                </div>

                <div class="panel">
                    <div class="panel-header">
                        <h2 class="panel-title">Pengguna Terbaru</h2>
                        <a class="panel-link" href="{{ route('staff.reports') }}">Lihat laporan</a>
                    </div>
                    @if ($users->isNotEmpty())
                        <div class="list">
                            @foreach ($users->take(4) as $user)
                                <div class="list-item">
                                    <span class="thumb staff-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    <div>
                                        <div class="item-title">{{ $user->name }}</div>
                                        <div class="item-meta">{{ $user->email }}</div>
                                    </div>
                                    <span class="badge">{{ ucfirst($user->role) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">Belum ada pengguna terdaftar.</div>
                    @endif
                </div>
            </section>
        </main>
    </div>
</body>
</html>
