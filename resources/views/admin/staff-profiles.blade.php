<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Petugas - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        :root { --bg:#b9cbd9; --panel:#fff; --soft:#eef6ff; --blue:#006dff; --navy:#123e7a; --ink:#16202a; --muted:rgba(22,32,42,.62); --shadow:0 22px 40px rgba(69,102,130,.14); }
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
        .panel { border-radius:28px; background:var(--panel); box-shadow:var(--shadow); padding:30px; }
        .panel-header { display:flex; justify-content:space-between; align-items:center; gap:18px; margin-bottom:24px; }
        .panel-title h1 { color:var(--navy); font-size:clamp(28px,3vw,42px); font-weight:800; margin-bottom:6px; }
        .panel-title p { color:var(--muted); font-weight:600; line-height:1.6; }
        .btn { min-height:46px; border-radius:999px; display:inline-flex; align-items:center; justify-content:center; padding:10px 20px; background:var(--blue); color:#fff; text-decoration:none; font-size:14px; font-weight:800; box-shadow:0 14px 24px rgba(0,109,255,.18); }
        .summary-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:14px; margin-bottom:22px; }
        .summary-card { border-radius:18px; background:var(--soft); padding:18px; }
        .summary-value { color:var(--blue); font-size:30px; line-height:1; font-weight:800; margin-bottom:8px; }
        .summary-label { color:var(--muted); font-size:12px; font-weight:800; text-transform:uppercase; }
        .profile-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:18px; }
        .profile-card { border-radius:22px; background:var(--soft); padding:22px; min-height:260px; }
        .profile-top { display:flex; align-items:center; gap:14px; margin-bottom:18px; }
        .avatar { width:66px; height:66px; border-radius:20px; background:var(--blue); color:#fff; display:inline-flex; align-items:center; justify-content:center; font-size:25px; font-weight:800; overflow:hidden; flex:0 0 auto; }
        .avatar img { width:100%; height:100%; object-fit:cover; display:block; }
        .name { color:var(--navy); font-size:20px; line-height:1.3; font-weight:800; word-break:break-word; }
        .role { color:var(--blue); font-size:12px; font-weight:800; text-transform:uppercase; margin-top:4px; }
        .info-list { display:grid; gap:10px; }
        .info-item { border-radius:16px; background:rgba(255,255,255,.72); padding:13px 14px; }
        .info-label { color:var(--muted); font-size:11px; font-weight:800; text-transform:uppercase; margin-bottom:4px; }
        .info-value { color:var(--ink); font-size:13px; font-weight:700; line-height:1.55; word-break:break-word; }
        .empty-state { padding:34px 24px; border-radius:20px; background:var(--soft); text-align:center; font-weight:700; color:var(--muted); }
        @media (max-width:1280px){ .layout{grid-template-columns:320px 1fr;} .profile-grid{grid-template-columns:repeat(2,minmax(0,1fr));} }
        @media (max-width:900px){ .layout{grid-template-columns:1fr;} .sidebar{gap:18px;} .sidebar-nav{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;} .sidebar-footer{margin-top:0;} .nav-item{margin:0; font-size:18px;} .panel-header{align-items:flex-start; flex-direction:column;} }
        @media (max-width:640px){ .content{padding:20px 16px;} .panel{padding:24px;} .summary-grid,.profile-grid,.sidebar-nav{grid-template-columns:1fr;} .btn{width:100%;} }
    </style>
</head>
<body>
    <div class="layout">
        @include('partials.admin-sidebar', ['activeMenu' => 'staff'])

        <main class="content">
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <h1>Profil Petugas</h1>
                        <p>Admin dapat melihat detail akun petugas yang terdaftar di Pustakara.</p>
                    </div>
                    <a href="{{ route('admin.staff') }}" class="btn">Manajemen Petugas</a>
                </div>

                <div class="summary-grid">
                    <article class="summary-card"><div class="summary-value">{{ $stats['totalStaff'] }}</div><div class="summary-label">Total petugas</div></article>
                    <article class="summary-card"><div class="summary-value">{{ $stats['withPhoto'] }}</div><div class="summary-label">Foto terisi</div></article>
                    <article class="summary-card"><div class="summary-value">{{ $stats['withAddress'] }}</div><div class="summary-label">Alamat terisi</div></article>
                </div>

                @if ($staffUsers->isNotEmpty())
                    <div class="profile-grid">
                        @foreach ($staffUsers as $staff)
                            <article class="profile-card">
                                <div class="profile-top">
                                    <div class="avatar">
                                        @if ($staff->profile_photo)
                                            <img src="{{ asset('storage/' . $staff->profile_photo) }}" alt="{{ $staff->name }}">
                                        @else
                                            {{ strtoupper(substr($staff->name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <h2 class="name">{{ $staff->name }}</h2>
                                        <div class="role">Petugas</div>
                                    </div>
                                </div>
                                <div class="info-list">
                                    <div class="info-item"><div class="info-label">Nama Pengguna</div><div class="info-value">{{ $staff->username }}</div></div>
                                    <div class="info-item"><div class="info-label">Surel</div><div class="info-value">{{ $staff->email }}</div></div>
                                    <div class="info-item"><div class="info-label">Alamat</div><div class="info-value">{{ $staff->alamat ?: 'Alamat belum diisi' }}</div></div>
                                    <div class="info-item"><div class="info-label">Terdaftar</div><div class="info-value">{{ optional($staff->created_at)->format('d M Y') ?: '-' }}</div></div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">Belum ada petugas terdaftar.</div>
                @endif
            </section>
        </main>
    </div>
</body>
</html>
