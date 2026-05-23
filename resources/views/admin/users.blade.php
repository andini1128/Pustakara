<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --bg:#b9cbd9; --panel:#fff; --soft:#eef6ff; --blue:#006dff; --navy:#123e7a; --ink:#16202a; --muted:rgba(22,32,42,.62); --danger:#c0392b; --success:#18794e; --shadow:0 22px 40px rgba(69,102,130,.14); }
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
        .panel { border-radius:28px; background:var(--panel); box-shadow:var(--shadow); padding:30px; overflow:hidden; }
        .panel-header { display:flex; align-items:center; justify-content:space-between; gap:18px; margin-bottom:24px; }
        .panel-title h1 { font-size:clamp(28px,3vw,42px); color:var(--navy); font-weight:800; margin-bottom:6px; }
        .panel-title p { color:var(--muted); font-weight:600; line-height:1.6; }
        .btn-print { display:inline-flex; align-items:center; justify-content:center; gap:8px; min-height:42px; padding:10px 16px; border-radius:999px; background:var(--blue); color:#fff; text-decoration:none; font-size:13px; font-weight:800; box-shadow:0 14px 24px rgba(0,109,255,.18); white-space:nowrap; }
        .btn-print svg { width:17px; height:17px; stroke:currentColor; }
        .alert { margin-bottom:18px; border-radius:14px; padding:13px 15px; font-size:13px; font-weight:700; line-height:1.6; }
        .alert-success { background:#eafaf1; color:var(--success); }
        .alert-error { background:#fdecea; color:var(--danger); }
        .stats-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:16px; margin-bottom:24px; }
        .stat-card { border-radius:20px; background:var(--soft); padding:20px; }
        .stat-value { color:var(--blue); font-size:34px; line-height:1; font-weight:800; margin-bottom:8px; }
        .stat-label { color:var(--muted); font-size:13px; font-weight:800; text-transform:uppercase; }
        .avatar { width:44px; height:44px; border-radius:14px; background:linear-gradient(135deg,var(--blue),#4a9bff); color:#fff; display:inline-flex; align-items:center; justify-content:center; font-size:18px; font-weight:800; overflow:hidden; box-shadow:0 10px 18px rgba(0,109,255,.14); flex:0 0 auto; }
        .avatar img { width:100%; height:100%; object-fit:cover; display:block; }
        .table-shell { border-radius:24px; background:linear-gradient(180deg,#eef6ff 0%,#f8fbff 100%); border:1px solid rgba(18,62,122,.08); padding:16px; }
        .table-top { display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:14px; }
        .table-heading { color:var(--navy); font-size:18px; font-weight:800; }
        .table-note { color:var(--muted); font-size:12px; font-weight:700; margin-top:4px; }
        .table-count { display:inline-flex; min-height:36px; align-items:center; padding:8px 13px; border-radius:999px; background:#fff; color:var(--blue); font-size:12px; font-weight:800; box-shadow:0 10px 18px rgba(69,102,130,.08); white-space:nowrap; }
        .table-wrap { overflow-x:auto; border-radius:18px; background:#fff; box-shadow:0 16px 30px rgba(69,102,130,.1); }
        table { width:100%; min-width:1020px; border-collapse:separate; border-spacing:0; background:#fff; }
        th, td { border-bottom:1px solid rgba(18,62,122,.09); padding:15px 16px; text-align:left; vertical-align:middle; }
        th { background:#eaf2fb; color:var(--navy); font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0; white-space:nowrap; }
        th:first-child { border-top-left-radius:18px; }
        th:last-child { border-top-right-radius:18px; }
        td { color:var(--ink); font-size:13px; font-weight:700; }
        tbody tr { transition:background .15s ease, transform .15s ease; }
        tbody tr:hover { background:#f7fbff; }
        tbody tr:last-child td { border-bottom:0; }
        .col-no { width:64px; text-align:center; color:var(--muted); font-weight:800; }
        .number-badge { width:30px; height:30px; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; background:#f4f7fb; color:var(--navy); font-size:12px; font-weight:800; }
        .user-cell { display:flex; align-items:center; gap:12px; min-width:240px; }
        .user-name { color:var(--navy); font-size:15px; line-height:1.3; font-weight:800; word-break:break-word; }
        .user-meta { color:var(--muted); font-size:12px; line-height:1.55; font-weight:700; word-break:break-word; }
        .username-pill { display:inline-flex; min-height:30px; align-items:center; padding:6px 11px; border-radius:999px; background:#f1f6ff; color:var(--navy); font-size:12px; font-weight:800; }
        .email-link { color:var(--blue); text-decoration:none; font-weight:800; }
        .email-link:hover { text-decoration:underline; }
        .address-text { max-width:280px; color:var(--muted); line-height:1.5; }
        .role { display:inline-flex; min-height:30px; align-items:center; padding:6px 12px; border-radius:999px; background:#eef6ff; color:var(--blue); font-size:12px; font-weight:800; }
        .date-chip { display:inline-flex; min-height:30px; align-items:center; padding:6px 10px; border-radius:10px; background:#f4f7fb; color:var(--navy); font-size:12px; font-weight:800; white-space:nowrap; }
        .col-action { width:110px; text-align:center; }
        .delete-btn { display:inline-flex; align-items:center; justify-content:center; gap:5px; border:0; background:transparent; color:var(--danger); font-family:'Poppins',sans-serif; font-size:12px; font-weight:800; cursor:pointer; }
        .delete-btn svg { width:15px; height:15px; stroke:currentColor; }
        .empty-state { padding:42px 24px; border-radius:22px; background:linear-gradient(180deg,#eef6ff,#f8fbff); text-align:center; color:var(--muted); font-weight:700; border:1px solid rgba(18,62,122,.08); }
        .empty-state strong { display:block; color:var(--navy); font-size:20px; margin-bottom:6px; }
        @media (max-width:1280px){ .layout{grid-template-columns:320px 1fr;} .stats-grid{grid-template-columns:repeat(2,minmax(0,1fr));} }
        @media (max-width:900px){ .layout{grid-template-columns:1fr;} .sidebar{gap:18px;} .sidebar-nav{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;} .sidebar-footer{margin-top:0;} .nav-item{margin:0; font-size:18px;} }
        @media (max-width:640px){ .content{padding:20px 16px;} .panel{padding:24px;} .panel-header,.table-top{align-items:flex-start; flex-direction:column;} .stats-grid,.sidebar-nav{grid-template-columns:1fr;} .table-count,.btn-print{width:100%; justify-content:center;} }
    </style>
</head>
<body>
    <div class="layout">
        @include('partials.admin-sidebar', ['activeMenu' => 'users'])

        <main class="content">
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <h1>Data Pengguna</h1>
                        <p>Lihat akun pengguna atau anggota yang sudah terdaftar.</p>
                    </div>
                    <a class="btn-print" href="{{ route('admin.reports.print', 'pengguna') }}" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M7 8V4H17V8" stroke-width="2"/><path d="M7 17H5C3.9 17 3 16.1 3 15V10C3 8.9 3.9 8 5 8H19C20.1 8 21 8.9 21 10V15C21 16.1 20.1 17 19 17H17" stroke-width="2"/><path d="M7 14H17V20H7V14Z" stroke-width="2"/><path d="M17 11H17.01" stroke-width="2"/></svg>
                        <span>Cetak Data</span>
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">{{ $errors->first() }}</div>
                @endif

                <div class="stats-grid">
                    <article class="stat-card"><div class="stat-value">{{ $stats['totalUsers'] }}</div><div class="stat-label">Akun pengguna</div></article>
                    <article class="stat-card"><div class="stat-value">{{ $stats['withAddress'] }}</div><div class="stat-label">Alamat terisi</div></article>
                    <article class="stat-card"><div class="stat-value">{{ $stats['withoutAddress'] }}</div><div class="stat-label">Alamat kosong</div></article>
                </div>

                @if ($users->isNotEmpty())
                    <div class="table-shell">
                        <div class="table-top">
                            <div>
                                <div class="table-heading">Daftar Akun Pengguna</div>
                                <div class="table-note">Akun yang tampil hanya pengguna dengan role anggota.</div>
                            </div>
                            <span class="table-count">{{ $users->count() }} akun</span>
                        </div>

                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="col-no">No</th>
                                        <th>Pengguna</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Tanggal Daftar</th>
                                        <th class="col-action">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="col-no"><span class="number-badge">{{ $loop->iteration }}</span></td>
                                            <td>
                                                <div class="user-cell">
                                                    <span class="avatar">
                                                        @if ($user->profile_photo)
                                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                                                        @else
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        @endif
                                                    </span>
                                                    <div>
                                                        <div class="user-name">{{ $user->name }}</div>
                                                        <div class="user-meta">ID #{{ str_pad((string) $user->id, 4, '0', STR_PAD_LEFT) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="username-pill">{{ $user->username }}</span></td>
                                            <td><a class="email-link" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td><div class="address-text">{{ $user->alamat ?: 'Alamat belum diisi' }}</div></td>
                                            <td><span class="role">Anggota</span></td>
                                            <td><span class="date-chip">{{ optional($user->created_at)->format('d M Y') }}</span></td>
                                            <td class="col-action">
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus pengguna ini? Semua data peminjaman, favorit, dan ulasannya juga akan terhapus.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-btn">
                                                        <svg viewBox="0 0 24 24" fill="none"><path d="M5 7H19" stroke-width="2"/><path d="M10 11V17" stroke-width="2"/><path d="M14 11V17" stroke-width="2"/><path d="M8 7L9 20H15L16 7" stroke-width="2"/><path d="M9 7V4H15V7" stroke-width="2"/></svg>
                                                        <span>Hapus</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="empty-state">
                        <strong>Belum ada akun pengguna</strong>
                        Akun anggota yang mendaftar akan tampil di tabel ini.
                    </div>
                @endif
            </section>
        </main>
    </div>
</body>
</html>
