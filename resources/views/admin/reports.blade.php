<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Laporan Admin' }} - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        :root { --bg:#b9cbd9; --panel:#fff; --soft:#eef6ff; --blue:#006dff; --navy:#123e7a; --ink:#16202a; --muted:rgba(22,32,42,.62); --line:rgba(18,62,122,.16); --green:#178248; --orange:#b85014; --shadow:0 22px 40px rgba(69,102,130,.14); }
        body { min-height:100vh; font-family:'Poppins',sans-serif; background:var(--bg); color:var(--ink); }
        .layout { min-height:100vh; display:grid; grid-template-columns:395px 1fr; }
        .sidebar { background:linear-gradient(180deg,#9fd0f7 0%,#94c9f4 100%); padding:30px 24px 26px; display:flex; flex-direction:column; box-shadow:inset -1px 0 0 rgba(255,255,255,.2); }
        .brand { display:flex; justify-content:center; padding-top:6px; margin-bottom:30px; }
        .brand img { width:128px; height:auto; display:block; }
        .sidebar-divider { height:2px; background:rgba(255,255,255,.65); margin:0 6px 34px; }
        .sidebar-nav { display:flex; flex-direction:column; gap:10px; }
        .nav-item { display:inline-flex; align-items:center; gap:18px; min-height:58px; margin:0 18px; padding:14px 18px; border-radius:18px; color:#fff; text-decoration:none; font-size:20px; font-weight:500; }
        .nav-item svg { width:30px; height:30px; stroke:currentColor; flex:0 0 auto; }
        .nav-item.active { background:#c8b597; box-shadow:0 14px 26px rgba(126,104,73,.18); }
        .nav-item:hover { background:rgba(255,255,255,.2); }
        .nav-dropdown { margin:0 18px; }
        .nav-dropdown summary { list-style:none; cursor:pointer; margin:0; }
        .nav-dropdown summary::-webkit-details-marker { display:none; }
        .nav-dropdown .nav-item { width:100%; }
        .nav-submenu { display:grid; gap:6px; padding:8px 0 0 48px; }
        .nav-submenu a { color:#fff; text-decoration:none; font-size:14px; font-weight:700; padding:8px 10px; border-radius:12px; background:rgba(255,255,255,.14); }
        .nav-submenu a:hover { background:rgba(255,255,255,.25); }
        .sidebar-footer { margin-top:auto; padding:28px 18px 4px; }
        .logout-btn { width:100%; min-height:58px; border:0; border-radius:16px; background:#7a6da4; color:#fff; font-family:'Poppins',sans-serif; font-size:21px; display:inline-flex; align-items:center; justify-content:center; gap:10px; cursor:pointer; box-shadow:0 16px 24px rgba(76,62,112,.18); }
        .logout-btn svg { width:26px; height:26px; stroke:currentColor; }
        .content { padding:32px; min-width:0; }
        .panel { overflow:hidden; border-radius:24px; background:var(--panel); box-shadow:var(--shadow); }
        .panel-header { display:flex; justify-content:space-between; align-items:center; gap:18px; padding:18px 24px; background:linear-gradient(135deg,#dceeff 0%,#eef6ff 100%); border-bottom:1px solid rgba(18,62,122,.08); }
        .panel-title h1 { color:var(--navy); font-size:clamp(28px,3vw,42px); font-weight:800; margin-bottom:6px; }
        .panel-title p { color:var(--muted); font-weight:600; line-height:1.6; }
        .header-actions { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
        .btn { border:0; min-height:42px; border-radius:999px; padding:10px 16px; font-family:'Poppins',sans-serif; font-size:13px; font-weight:800; text-decoration:none; cursor:pointer; white-space:nowrap; }
        .btn-primary { background:var(--blue); color:#fff; box-shadow:0 14px 24px rgba(0,109,255,.16); }
        .btn-soft { background:#fff; color:var(--blue); }
        .panel-body { padding:24px; }
        .report-menu { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:12px; margin-bottom:22px; }
        .report-card { display:flex; flex-direction:column; gap:8px; min-height:118px; border-radius:18px; padding:16px; background:#fff; border:1px solid var(--line); text-decoration:none; box-shadow:0 10px 24px rgba(69,102,130,.08); }
        .report-card strong { color:var(--navy); font-size:16px; font-weight:800; }
        .report-card span { color:var(--muted); font-size:12px; line-height:1.5; font-weight:700; }
        .report-card em { margin-top:auto; color:var(--blue); font-style:normal; font-size:12px; font-weight:800; }
        .stats-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:14px; margin-bottom:22px; }
        .stat-card { border-radius:18px; background:var(--soft); padding:18px; }
        .stat-value { color:var(--blue); font-size:30px; line-height:1; font-weight:800; margin-bottom:8px; }
        .stat-label { color:var(--muted); font-size:12px; font-weight:800; text-transform:uppercase; }
        .table-wrap { padding:16px; overflow-x:auto; border-radius:20px; background:var(--soft); }
        table { width:100%; min-width:1080px; border-collapse:collapse; border:1px solid var(--line); background:#fff; }
        th, td { border:1px solid var(--line); padding:12px 14px; text-align:center; vertical-align:middle; }
        th { background:#eef2f5; color:var(--navy); font-size:12px; font-weight:800; }
        td { color:var(--ink); font-size:13px; font-weight:700; }
        .book-title { color:var(--navy); font-weight:800; text-align:left; }
        .detail-cell { text-align:left; color:var(--muted); font-weight:700; }
        .action-link { display:inline-flex; align-items:center; justify-content:center; min-height:32px; padding:6px 12px; border-radius:999px; background:#eef3ff; color:#2459c9; font-size:12px; font-weight:800; text-decoration:none; white-space:nowrap; }
        .badge { display:inline-flex; min-height:32px; align-items:center; justify-content:center; padding:6px 12px; border-radius:999px; background:#eef3ff; color:#2459c9; font-size:12px; font-weight:800; white-space:nowrap; }
        .badge.pending { background:#fff7df; color:#a26400; }
        .badge.active { background:#e8f7ee; color:var(--green); }
        .badge.returned { background:#eef3ff; color:#2459c9; }
        .badge.rejected { background:#ffecec; color:#c03333; }
        .badge.overdue { background:#fff0e6; color:var(--orange); }
        .empty-state { padding:42px 24px; border-radius:20px; background:var(--soft); text-align:center; color:var(--muted); font-weight:700; }
        .empty-state h3 { color:var(--navy); font-size:22px; margin-bottom:8px; }
        .print-brand, .print-meta, .print-signature { display:none; }
        @media (max-width:1280px){ .layout{grid-template-columns:320px 1fr;} }
        @media (max-width:900px){ .layout{grid-template-columns:1fr;} .sidebar{gap:18px;} .sidebar-nav{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;} .sidebar-footer{margin-top:0;} .nav-item{margin:0; font-size:18px;} .nav-dropdown{margin:0;} .nav-submenu{padding-left:18px;} .panel-header{align-items:flex-start; flex-direction:column;} .stats-grid,.report-menu{grid-template-columns:repeat(2,minmax(0,1fr));} }
        @media (max-width:640px){ .content{padding:20px 16px;} .panel-body{padding:18px;} .sidebar-nav,.stats-grid,.report-menu{grid-template-columns:1fr;} .btn{width:100%; text-align:center;} .header-actions{width:100%;} }
        @media print {
            @page { size:A4 landscape; margin:12mm; }
            * { -webkit-print-color-adjust:exact; print-color-adjust:exact; }
            body { background:#fff; color:#111; font-family:Arial,sans-serif; }
            .sidebar, .panel-header, .header-actions, .stats-grid, .print-meta, .print-signature { display:none !important; }
            .layout { display:block; }
            .content { padding:0; }
            .panel { box-shadow:none; border-radius:0; overflow:visible; }
            .panel-header { background:#fff; padding:0; border-bottom:0; }
            .print-brand { display:flex; align-items:center; gap:12px; margin-bottom:10px; }
            .print-brand img { width:62px; height:auto; display:block; }
            .print-brand strong { display:block; color:#123e7a; font-size:18px; line-height:1.2; }
            .print-brand span { display:block; color:#555; font-size:11px; font-weight:700; margin-top:3px; }
            .panel-title h1 { font-size:22px; color:#111; margin-bottom:4px; }
            .panel-title p { color:#555; font-size:12px; line-height:1.5; }
            .print-meta { grid-template-columns:repeat(3,1fr); gap:8px; margin:14px 0; }
            .meta-item { border:1px solid #d7dde8; padding:8px 10px; border-radius:8px; }
            .meta-label { display:block; color:#666; font-size:9px; font-weight:700; text-transform:uppercase; margin-bottom:3px; }
            .meta-value { color:#111; font-size:12px; font-weight:800; }
            .panel-body { padding:0; }
            .table-wrap { padding:0; overflow:visible; background:#fff; border-radius:0; }
            table { min-width:0; border-color:#aeb8c6; }
            th, td { border-color:#aeb8c6; padding:7px 8px; font-size:10.5px; }
            th { background:#eaf2fb; color:#123e7a; }
            .badge { min-height:0; padding:4px 8px; border:1px solid #c9d5e4; }
            .print-signature { justify-content:flex-end; margin-top:28px; page-break-inside:avoid; }
            .signature-box { width:210px; text-align:center; color:#111; font-size:12px; font-weight:700; }
            .signature-space { height:58px; }
        }
    </style>
</head>
<body>
    <div class="layout">
        @include($sidebarView ?? 'partials.admin-sidebar', ['activeMenu' => 'reports'])

        <main class="content">
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <div class="print-brand">
                            <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
                            <div>
                                <strong>Pustakara</strong>
                                <span>Laporan data perpustakaan</span>
                            </div>
                        </div>
                        <h1>{{ $pageTitle ?? 'Laporan Admin' }}</h1>
                        <p>{{ $pageDescription ?? 'Pilih data laporan admin Pustakara yang ingin dicetak.' }}</p>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route($dashboardRoute ?? 'dashboard.admin') }}" class="btn btn-soft">Dashboard</a>
                        <a href="{{ route($reportPrintRoute ?? 'admin.reports.print', 'ringkasan') }}" target="_blank" rel="noopener" class="btn btn-primary">Cetak PDF</a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="print-meta">
                        <div class="meta-item">
                            <span class="meta-label">Tanggal Cetak</span>
                            <span class="meta-value">{{ now()->format('d M Y') }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Jumlah Data</span>
                            <span class="meta-value">{{ $reports->count() }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Dicetak Oleh</span>
                            <span class="meta-value">{{ auth()->user()->name ?? 'Admin' }}</span>
                        </div>
                    </div>

                    <div class="stats-grid">
                        <article class="stat-card"><div class="stat-value">{{ $stats['totalUsers'] ?? 0 }}</div><div class="stat-label">Total pengguna</div></article>
                        <article class="stat-card"><div class="stat-value">{{ $stats['totalBooks'] ?? 0 }}</div><div class="stat-label">Total buku</div></article>
                        <article class="stat-card"><div class="stat-value">{{ $stats['totalCategories'] ?? 0 }}</div><div class="stat-label">Total kategori</div></article>
                        <article class="stat-card"><div class="stat-value">{{ $stats['totalLoans'] ?? 0 }}</div><div class="stat-label">Total peminjaman</div></article>
                    </div>

                    <div class="report-menu" aria-label="Pilihan generate laporan">
                        <a class="report-card" href="{{ route($reportShowRoute ?? 'admin.reports.show', 'buku') }}">
                            <strong>Kelola Buku</strong>
                            <span>Buka halaman tabel koleksi buku dan stok.</span>
                            <em>Lihat data</em>
                        </a>
                        <a class="report-card" href="{{ route($reportShowRoute ?? 'admin.reports.show', 'pengguna') }}">
                            <strong>Kelola User</strong>
                            <span>Buka halaman tabel akun anggota perpustakaan.</span>
                            <em>Lihat data</em>
                        </a>
                        <a class="report-card" href="{{ route($reportShowRoute ?? 'admin.reports.show', 'peminjaman') }}">
                            <strong>Kelola Peminjaman</strong>
                            <span>Buka halaman tabel seluruh transaksi peminjaman.</span>
                            <em>Lihat data</em>
                        </a>
                        <a class="report-card" href="{{ route($reportShowRoute ?? 'admin.reports.show', 'pengembalian') }}">
                            <strong>Kelola Pengembalian</strong>
                            <span>Buka halaman tabel buku yang sudah dikembalikan.</span>
                            <em>Lihat data</em>
                        </a>
                    </div>

                    <div class="print-signature">
                        <div class="signature-box">
                            Bogor, {{ now()->format('d M Y') }}
                            <div class="signature-space"></div>
                            {{ auth()->user()->name ?? 'Admin' }}
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
