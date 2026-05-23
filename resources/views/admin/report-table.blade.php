<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        :root { --bg:#b9cbd9; --panel:#fff; --soft:#eef6ff; --blue:#006dff; --navy:#123e7a; --ink:#16202a; --muted:rgba(22,32,42,.62); --line:rgba(18,62,122,.16); --shadow:0 22px 40px rgba(69,102,130,.14); }
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
        .sidebar-footer { margin-top:auto; padding:28px 18px 4px; }
        .logout-btn { width:100%; min-height:58px; border:0; border-radius:16px; background:#7a6da4; color:#fff; font-family:'Poppins',sans-serif; font-size:21px; display:inline-flex; align-items:center; justify-content:center; gap:10px; cursor:pointer; box-shadow:0 16px 24px rgba(76,62,112,.18); }
        .logout-btn svg { width:26px; height:26px; stroke:currentColor; }
        .content { padding:32px; min-width:0; }
        .panel { overflow:hidden; border-radius:24px; background:var(--panel); box-shadow:var(--shadow); }
        .panel-header { display:flex; justify-content:space-between; align-items:center; gap:18px; padding:20px 24px; background:linear-gradient(135deg,#dceeff 0%,#eef6ff 100%); border-bottom:1px solid rgba(18,62,122,.08); }
        .panel-title h1 { color:var(--navy); font-size:clamp(26px,3vw,40px); font-weight:800; margin-bottom:6px; }
        .panel-title p { color:var(--muted); font-weight:600; line-height:1.6; }
        .header-actions { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
        .btn { display:inline-flex; align-items:center; justify-content:center; min-height:42px; border:0; border-radius:999px; padding:10px 16px; font-family:'Poppins',sans-serif; font-size:13px; font-weight:800; text-decoration:none; cursor:pointer; white-space:nowrap; }
        .btn-primary { background:var(--blue); color:#fff; box-shadow:0 14px 24px rgba(0,109,255,.16); }
        .btn-soft { background:#fff; color:var(--blue); }
        .panel-body { padding:24px; }
        .type-tabs { display:flex; gap:10px; flex-wrap:wrap; margin-bottom:18px; }
        .type-tab { display:inline-flex; align-items:center; min-height:38px; padding:8px 13px; border-radius:999px; background:#fff; border:1px solid var(--line); color:var(--navy); text-decoration:none; font-size:12px; font-weight:800; }
        .type-tab.active { background:var(--blue); border-color:var(--blue); color:#fff; }
        .table-meta { display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:14px; color:var(--muted); font-size:13px; font-weight:700; }
        .count-pill { display:inline-flex; min-height:34px; align-items:center; padding:7px 12px; border-radius:999px; background:var(--soft); color:var(--navy); font-weight:800; }
        .table-wrap { padding:16px; overflow-x:auto; border-radius:20px; background:var(--soft); }
        table { width:100%; min-width:920px; border-collapse:collapse; border:1px solid var(--line); background:#fff; }
        th, td { border:1px solid var(--line); padding:12px 14px; text-align:left; vertical-align:top; }
        th { background:#eef2f5; color:var(--navy); font-size:12px; font-weight:800; text-align:center; }
        td { color:var(--ink); font-size:13px; font-weight:700; line-height:1.5; }
        td:first-child { text-align:center; width:64px; }
        .empty-state { padding:42px 24px; border-radius:20px; background:var(--soft); text-align:center; color:var(--muted); font-weight:700; }
        .empty-state h3 { color:var(--navy); font-size:22px; margin-bottom:8px; }
        @media (max-width:1280px){ .layout{grid-template-columns:320px 1fr;} }
        @media (max-width:900px){ .layout{grid-template-columns:1fr;} .sidebar{gap:18px;} .sidebar-nav{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;} .sidebar-footer{margin-top:0;} .nav-item{margin:0; font-size:18px;} .panel-header{align-items:flex-start; flex-direction:column;} .header-actions{width:100%;} }
        @media (max-width:640px){ .content{padding:20px 16px;} .panel-body{padding:18px;} .sidebar-nav{grid-template-columns:1fr;} .btn{width:100%;} .table-meta{align-items:flex-start; flex-direction:column;} .type-tab{width:100%; justify-content:center;} }
    </style>
</head>
<body>
    <div class="layout">
        @include($sidebarView, ['activeMenu' => 'reports'])

        <main class="content">
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <h1>{{ $title }}</h1>
                        <p>{{ $description }}</p>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route($reportIndexRoute) }}" class="btn btn-soft">Halaman Laporan</a>
                        <a href="{{ route($dashboardRoute) }}" class="btn btn-soft">Dashboard</a>
                        <a href="{{ route($reportPrintRoute, $type) }}" class="btn btn-primary">Cetak PDF</a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="type-tabs" aria-label="Jenis laporan">
                        @foreach ($reportTypes as $reportType => $label)
                            <a class="type-tab {{ $type === $reportType ? 'active' : '' }}" href="{{ route(str_replace('.print', '.show', $reportPrintRoute), $reportType) }}">{{ $label }}</a>
                        @endforeach
                    </div>

                    <div class="table-meta">
                        <span>Data laporan ditampilkan dulu di halaman ini. Gunakan tombol cetak saat sudah sesuai.</span>
                        <span class="count-pill">{{ count($rows) }} data</span>
                    </div>

                    @if (count($rows))
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        @foreach ($columns as $column)
                                            <th>{{ $column }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $row)
                                        <tr>
                                            @foreach ($row as $cell)
                                                <td>{{ $cell }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <h3>Belum ada data</h3>
                            <p>Data untuk laporan ini akan tampil setelah ada transaksi atau data terkait.</p>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>
</body>
</html>
