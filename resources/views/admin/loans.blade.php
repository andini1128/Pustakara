<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --bg:#b9cbd9; --panel:#fff; --soft:#eef6ff; --blue:#006dff; --navy:#123e7a; --ink:#16202a; --muted:rgba(22,32,42,.62); --line:rgba(18,62,122,.18); --danger:#c0392b; --shadow:0 22px 40px rgba(69,102,130,.14); }
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
        .panel-inner { padding:24px; }
        .panel-header { display:flex; align-items:center; justify-content:space-between; gap:18px; padding:18px 24px; background:linear-gradient(135deg,#dceeff 0%,#eef6ff 100%); border-bottom:1px solid rgba(18,62,122,.08); }
        .panel-title h1 { font-size:clamp(28px,3vw,42px); color:var(--navy); font-weight:800; margin-bottom:6px; }
        .panel-title p { color:var(--muted); font-weight:600; line-height:1.6; }
        .stats-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; margin-bottom:24px; }
        .stat-card { border-radius:20px; background:var(--soft); padding:20px; }
        .stat-value { color:var(--blue); font-size:34px; line-height:1; font-weight:800; margin-bottom:8px; }
        .stat-label { color:var(--muted); font-size:13px; font-weight:800; text-transform:uppercase; }
        .table-wrap { padding:16px; overflow-x:auto; border-radius:20px; background:var(--soft); }
        table { width:100%; border-collapse:collapse; min-width:1120px; border:1px solid var(--line); background:#fff; }
        th, td { border:1px solid var(--line); padding:10px 12px; text-align:center; vertical-align:middle; }
        th { background:#eef2f5; color:var(--navy); font-size:12px; font-weight:800; }
        td { color:var(--ink); font-size:12px; font-weight:600; }
        .col-no { width:58px; }
        .col-address { min-width:160px; }
        .col-action { width:240px; }
        .badge { display:inline-flex; min-height:30px; align-items:center; padding:6px 12px; border-radius:999px; background:#fff; color:var(--blue); font-size:12px; font-weight:800; white-space:nowrap; }
        .badge.pending { background:#fff7df; color:#a26400; }
        .badge.active { background:#e8f7ee; color:#178248; }
        .badge.returned { background:#eef3ff; color:#2459c9; }
        .badge.rejected { background:#ffecec; color:#c03333; }
        .badge.late { background:#fff0e6; color:#b85014; }
        .action-group { display:flex; justify-content:center; align-items:center; gap:8px; flex-wrap:wrap; }
        .action-btn { border:0; min-height:34px; padding:8px 12px; border-radius:10px; color:#fff; font-family:'Poppins',sans-serif; font-size:12px; font-weight:800; cursor:pointer; }
        .action-btn.approve { background:#178248; }
        .action-btn.reject { background:#c03333; }
        .delete-btn { border:0; min-height:34px; padding:8px 12px; border-radius:10px; background:#fdecea; color:var(--danger); font-family:'Poppins',sans-serif; font-size:12px; font-weight:800; cursor:pointer; }
        .action-muted { color:var(--muted); font-size:12px; font-weight:800; }
        .flash-message { margin-bottom:18px; padding:14px 18px; border-radius:16px; background:#eef6ff; color:var(--navy); font-weight:800; }
        .flash-message.error { background:#ffecec; color:#a82020; }
        .empty-state { padding:34px 24px; border-radius:20px; background:var(--soft); text-align:center; color:var(--muted); font-weight:700; line-height:1.7; }
        .section-title { color:var(--navy); font-size:22px; font-weight:800; margin:28px 0 14px; }
        .flow-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:14px; }
        .flow-card { border-radius:18px; background:var(--soft); padding:18px; min-height:132px; }
        .flow-number { width:34px; height:34px; border-radius:12px; background:#fff; color:var(--blue); display:inline-flex; align-items:center; justify-content:center; font-weight:800; margin-bottom:12px; }
        .flow-title { color:var(--navy); font-size:16px; font-weight:800; margin-bottom:6px; }
        .flow-text { color:var(--muted); font-size:12px; font-weight:700; line-height:1.6; }
        @media (max-width:1280px){ .layout{grid-template-columns:320px 1fr;} }
        @media (max-width:1100px){ .flow-grid{grid-template-columns:repeat(2,minmax(0,1fr));} }
        @media (max-width:900px){ .layout{grid-template-columns:1fr;} .sidebar{gap:18px;} .sidebar-nav{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;} .sidebar-footer{margin-top:0;} .nav-item{margin:0; font-size:18px;} .stats-grid{grid-template-columns:repeat(2,minmax(0,1fr));} }
        @media (max-width:640px){ .content{padding:20px 16px;} .panel-inner{padding:18px;} .panel-header{align-items:flex-start; flex-direction:column;} .sidebar-nav,.flow-grid{grid-template-columns:1fr;} }
    </style>
</head>
<body>
    <div class="layout">
        @include($sidebarView ?? 'partials.admin-sidebar', ['activeMenu' => 'loans'])

        <main class="content">
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <h1>Data Peminjaman</h1>
                        <p>Pantau transaksi pinjam dan pengembalian buku perpustakaan.</p>
                    </div>
                </div>

                <div class="panel-inner">
                <div class="stats-grid">
                    <article class="stat-card"><div class="stat-value">{{ $stats['pendingLoans'] }}</div><div class="stat-label">Menunggu persetujuan</div></article>
                    <article class="stat-card"><div class="stat-value">{{ $stats['activeLoans'] }}</div><div class="stat-label">Sedang dipinjam</div></article>
                    <article class="stat-card"><div class="stat-value">{{ $stats['returnedLoans'] }}</div><div class="stat-label">Sudah kembali</div></article>
                    <article class="stat-card"><div class="stat-value">{{ $stats['lateLoans'] }}</div><div class="stat-label">Terlambat</div></article>
                </div>

                @if (session('success'))
                    <div class="flash-message">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="flash-message error">{{ session('error') }}</div>
                @endif

                @if ($loans->isNotEmpty())
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th class="col-no">Nomor</th>
                                    <th>Nama Peminjam</th>
                                    <th class="col-address">Alamat</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Status</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $loan)
                                    @php
                                        $status = data_get($loan, 'status', 'Aktif');
                                        $isLate = $status === 'Dipinjam' && data_get($loan, 'due_at') && data_get($loan, 'due_at')->lt(today());
                                        $badgeClass = match ($status) {
                                            'Menunggu Persetujuan' => 'pending',
                                            'Dipinjam' => $isLate ? 'late' : 'active',
                                            'Dikembalikan' => 'returned',
                                            'Ditolak' => 'rejected',
                                            default => '',
                                        };
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ data_get($loan, 'user.name') ?: '-' }}</td>
                                        <td class="col-address">{{ data_get($loan, 'user.alamat') ?: 'Belum diisi' }}</td>
                                        <td>{{ data_get($loan, 'book.judul') ?: '-' }}</td>
                                        <td>{{ optional(data_get($loan, 'borrowed_at'))->format('d M Y') ?? '-' }}</td>
                                        <td>{{ optional(data_get($loan, 'due_at'))->format('d M Y') ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $badgeClass }}">
                                                {{ $isLate ? 'Terlambat' : $status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-group">
                                                @if ($status === 'Menunggu Persetujuan')
                                                    <form method="POST" action="{{ route('admin.loans.approve', $loan) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="action-btn approve">Setujui</button>
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.loans.reject', $loan) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="action-btn reject">Tolak</button>
                                                    </form>
                                                @else
                                                    <span class="action-muted">Sudah diproses</span>
                                                @endif

                                                <form method="POST" action="{{ route('admin.loans.destroy', $loan) }}" onsubmit="return confirm('Hapus data peminjaman ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-btn">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        Belum ada transaksi peminjaman yang tercatat. Saat fitur transaksi sudah dipakai, data peminjam, buku, tanggal pinjam, jatuh tempo, dan status akan tampil di tabel ini.
                    </div>
                @endif

                <h2 class="section-title">Alur Peminjaman</h2>
                <div class="flow-grid">
                    <article class="flow-card">
                        <div class="flow-number">1</div>
                        <div class="flow-title">Pilih buku</div>
                        <p class="flow-text">Petugas mencari buku yang tersedia dan memastikan stok masih aman.</p>
                    </article>
                    <article class="flow-card">
                        <div class="flow-number">2</div>
                        <div class="flow-title">Catat peminjam</div>
                        <p class="flow-text">User mengajukan peminjaman dengan tanggal pinjam dan tanggal kembali.</p>
                    </article>
                    <article class="flow-card">
                        <div class="flow-number">3</div>
                        <div class="flow-title">Setujui pengajuan</div>
                        <p class="flow-text">Admin atau petugas menyetujui pengajuan sebelum buku resmi dipinjam.</p>
                    </article>
                    <article class="flow-card">
                        <div class="flow-number">4</div>
                        <div class="flow-title">Pengembalian</div>
                        <p class="flow-text">Stok buku diperbarui setelah buku dikembalikan oleh anggota.</p>
                    </article>
                </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
