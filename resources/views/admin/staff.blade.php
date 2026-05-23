<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Petugas - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --bg:#b9cbd9; --panel:#fff; --soft:#eef6ff; --blue:#006dff; --navy:#123e7a; --ink:#16202a; --muted:rgba(22,32,42,.62); --line:rgba(18,62,122,.18); --danger:#c0392b; --success:#18794e; --shadow:0 22px 40px rgba(69,102,130,.14); }
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
        .topbar { min-height:86px; display:flex; justify-content:space-between; align-items:center; gap:20px; padding:0 4px 26px; }
        .page-title { color:var(--navy); font-size:clamp(28px,3vw,42px); font-weight:800; }
        .admin-chip { display:inline-flex; align-items:center; gap:12px; padding:10px 14px; border-radius:18px; background:rgba(255,255,255,.72); color:var(--navy); font-weight:800; white-space:nowrap; box-shadow:0 14px 28px rgba(69,102,130,.12); }
        .admin-avatar { width:44px; height:44px; border-radius:50%; background:var(--blue); color:#fff; display:inline-flex; align-items:center; justify-content:center; font-weight:800; }
        .panel { overflow:hidden; border-radius:24px; background:var(--panel); box-shadow:var(--shadow); }
        .panel + .panel { margin-top:24px; }
        .panel-head { display:flex; justify-content:space-between; align-items:center; gap:16px; min-height:66px; padding:16px 22px; background:linear-gradient(135deg,#dceeff 0%,#eef6ff 100%); border-bottom:1px solid rgba(18,62,122,.08); }
        .panel-title { color:var(--navy); font-size:21px; font-weight:800; }
        .btn-add { display:inline-flex; align-items:center; justify-content:center; min-height:40px; padding:10px 16px; border-radius:999px; background:var(--blue); color:#fff; text-decoration:none; font-size:13px; font-weight:800; box-shadow:0 14px 24px rgba(0,109,255,.18); white-space:nowrap; }
        .alert { margin:18px 22px 0; border-radius:14px; padding:13px 15px; font-size:13px; font-weight:700; line-height:1.6; }
        .alert-success { background:#eafaf1; color:var(--success); }
        .alert-error { background:#fdecea; color:var(--danger); }
        .table-wrap { padding:16px; overflow-x:auto; }
        table { width:100%; min-width:860px; border-collapse:collapse; border:1px solid var(--line); background:#fff; }
        th, td { border:1px solid var(--line); padding:10px 12px; text-align:center; vertical-align:middle; }
        th { background:#eef2f5; color:var(--navy); font-size:12px; font-weight:800; }
        td { color:var(--ink); font-size:12px; font-weight:600; }
        .col-no { width:56px; }
        .col-address { text-align:center; min-width:150px; }
        .col-action { width:140px; }
        .empty-row td { height:54px; color:var(--muted); font-weight:700; }
        .password-note { color:var(--muted); font-size:11px; font-weight:800; }
        .action-group { display:flex; justify-content:center; align-items:center; gap:8px; flex-wrap:wrap; }
        .edit-link { display:inline-flex; align-items:center; justify-content:center; gap:5px; color:var(--blue); text-decoration:none; font-size:11px; font-weight:800; }
        .edit-link svg { width:14px; height:14px; stroke:currentColor; }
        .delete-btn { display:inline-flex; align-items:center; justify-content:center; gap:5px; border:0; background:transparent; color:var(--danger); font-family:'Poppins',sans-serif; font-size:11px; font-weight:800; cursor:pointer; }
        .delete-btn svg { width:14px; height:14px; stroke:currentColor; }
        @media (max-width:1280px){ .layout{grid-template-columns:320px 1fr;} }
        @media (max-width:900px){ .layout{grid-template-columns:1fr;} .sidebar{gap:18px;} .sidebar-nav{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;} .sidebar-footer{margin-top:0;} .nav-item{margin:0; font-size:18px;} .topbar{align-items:flex-start; flex-direction:column;} }
        @media (max-width:640px){ .content{padding:20px 16px;} .panel-head{align-items:flex-start; flex-direction:column;} .sidebar-nav{grid-template-columns:1fr;} .admin-chip{width:100%; justify-content:flex-start;} .btn-add{width:100%;} }
    </style>
</head>
<body>
    <div class="layout">
        @include('partials.admin-sidebar', ['activeMenu' => 'staff'])

        <main class="content">
            <header class="topbar">
                <h1 class="page-title">Manajemen Petugas</h1>
                <div class="admin-chip">
                    <span class="admin-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                    <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>
            </header>

            <section class="panel">
                <div class="panel-head">
                    <h2 class="panel-title">Daftar Petugas</h2>
                    <a class="btn-add" href="{{ route('admin.staff.create') }}">Tambah Petugas</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">{{ $errors->first() }}</div>
                @endif

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-no">Nomor</th>
                                <th>Nama Petugas</th>
                                <th>Nama Pengguna</th>
                                <th>Surel</th>
                                <th class="col-address">Alamat</th>
                                <th>Kata Sandi</th>
                                <th class="col-action">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($staffUsers as $staff)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ $staff->username }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td class="col-address">{{ $staff->alamat ?: 'Alamat belum diisi' }}</td>
                                    <td><span class="password-note">Tersimpan aman</span></td>
                                    <td>
                                        <div class="action-group">
                                            <a href="{{ route('admin.staff.edit', $staff) }}" class="edit-link">
                                                <svg viewBox="0 0 24 24" fill="none"><path d="M4 20H8L18.5 9.5L14.5 5.5L4 16V20Z" stroke-width="2"/><path d="M13.5 6.5L17.5 10.5" stroke-width="2"/></svg>
                                                <span>Ubah</span>
                                            </a>
                                            <form method="POST" action="{{ route('admin.staff.destroy', $staff) }}" onsubmit="return confirm('Hapus petugas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <svg viewBox="0 0 24 24" fill="none"><path d="M5 7H19" stroke-width="2"/><path d="M10 11V17" stroke-width="2"/><path d="M14 11V17" stroke-width="2"/><path d="M8 7L9 20H15L16 7" stroke-width="2"/><path d="M9 7V4H15V7" stroke-width="2"/></svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-row">
                                    <td colspan="7">Belum ada petugas terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

        </main>
    </div>
</body>
</html>
