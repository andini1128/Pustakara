<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        :root { --bg:#b9cbd9; --panel:#fff; --soft:#eef6ff; --blue:#006dff; --navy:#123e7a; --ink:#16202a; --muted:rgba(22,32,42,.62); --line:rgba(18,62,122,.12); --danger:#c0392b; --success:#18794e; --shadow:0 22px 40px rgba(69,102,130,.14); }
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
        .panel + .panel { margin-top:24px; }
        .panel-header { display:flex; justify-content:space-between; align-items:center; gap:18px; margin-bottom:24px; }
        .panel-title h1, .panel-title h2 { color:var(--navy); font-weight:800; margin-bottom:6px; }
        .panel-title h1 { font-size:clamp(28px,3vw,42px); }
        .panel-title h2 { font-size:26px; }
        .panel-title p { color:var(--muted); font-weight:600; line-height:1.6; }
        .summary-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:14px; margin-bottom:22px; }
        .summary-card { border-radius:18px; background:var(--soft); padding:18px; }
        .summary-value { color:var(--blue); font-size:30px; line-height:1; font-weight:800; margin-bottom:8px; }
        .summary-label { color:var(--muted); font-size:12px; font-weight:800; text-transform:uppercase; }
        .popular-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:18px; }
        .book-card { border-radius:20px; background:var(--soft); padding:18px; min-height:145px; }
        .book-title { color:var(--navy); font-size:18px; line-height:1.35; font-weight:800; margin-bottom:8px; word-break:break-word; }
        .book-meta { color:var(--muted); font-size:12px; font-weight:700; line-height:1.6; }
        .badge { display:inline-flex; min-height:30px; align-items:center; padding:6px 12px; border-radius:999px; background:#fff; color:var(--blue); font-size:12px; font-weight:800; margin-top:14px; }
        .table-wrap { padding:16px; overflow-x:auto; border-radius:20px; background:var(--soft); }
        table { width:100%; min-width:980px; border-collapse:collapse; border:1px solid var(--line); background:#fff; }
        th, td { border:1px solid var(--line); padding:12px 14px; text-align:center; vertical-align:middle; }
        th { background:#eef2f5; color:var(--navy); font-size:12px; font-weight:800; }
        td { color:var(--ink); font-size:13px; font-weight:600; }
        .comment { max-width:260px; text-align:left; line-height:1.6; }
        .rating { color:#a26400; font-weight:800; white-space:nowrap; }
        .alert { margin-bottom:18px; border-radius:16px; padding:13px 15px; background:#eafaf1; color:var(--success); font-size:13px; font-weight:800; }
        .delete-btn { display:inline-flex; align-items:center; justify-content:center; min-height:34px; border:0; border-radius:999px; padding:8px 13px; background:#fdecea; color:var(--danger); font-family:'Poppins',sans-serif; font-size:12px; font-weight:800; cursor:pointer; }
        .empty-state { padding:34px 24px; border-radius:20px; background:var(--soft); text-align:center; font-weight:700; color:var(--muted); line-height:1.7; }
        @media (max-width:1280px){ .layout{grid-template-columns:320px 1fr;} .popular-grid{grid-template-columns:repeat(2,minmax(0,1fr));} }
        @media (max-width:900px){ .layout{grid-template-columns:1fr;} .sidebar{gap:18px;} .sidebar-nav{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;} .sidebar-footer{margin-top:0;} .nav-item{margin:0; font-size:18px;} .panel-header{align-items:flex-start; flex-direction:column;} }
        @media (max-width:640px){ .content{padding:20px 16px;} .panel{padding:24px;} .summary-grid,.popular-grid,.sidebar-nav{grid-template-columns:1fr;} }
    </style>
</head>
<body>
    <div class="layout">
        @include('partials.admin-sidebar', ['activeMenu' => 'reviews'])

        <main class="content">
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <h1>Ulasan Pembaca</h1>
                        <p>Pantau respons pembaca dari aktivitas buku favorit di Pustakara.</p>
                    </div>
                </div>

                <div class="summary-grid">
                    <article class="summary-card"><div class="summary-value">{{ $stats['totalReviews'] }}</div><div class="summary-label">Total ulasan</div></article>
                    <article class="summary-card"><div class="summary-value">{{ $stats['reviewedBooks'] }}</div><div class="summary-label">Buku diulas</div></article>
                    <article class="summary-card"><div class="summary-value">{{ $stats['activeReaders'] }}</div><div class="summary-label">Pembaca aktif</div></article>
                </div>

                @if ($popularBooks->isNotEmpty())
                    <div class="popular-grid">
                        @foreach ($popularBooks as $book)
                            <article class="book-card">
                                <h2 class="book-title">{{ $book->judul }}</h2>
                                <div class="book-meta">{{ $book->penulis }} | {{ $book->kategori ?: 'Umum' }}</div>
                                <span class="badge">{{ $book->reviews_count }} ulasan</span>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">Belum ada buku untuk ditampilkan.</div>
                @endif
            </section>

            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <h2>Aktivitas Ulasan</h2>
                        <p>Daftar ulasan dari pengguna setelah buku dikembalikan. Admin dapat menghapus data dari tabel ini.</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert">{{ session('success') }}</div>
                @endif

                @if ($reviews->isNotEmpty())
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Pembaca</th>
                                    <th>Surel</th>
                                    <th>Buku</th>
                                    <th>Kategori</th>
                                    <th>Rating</th>
                                    <th>Ulasan</th>
                                    <th>Dikembalikan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $review->user_name }}</td>
                                        <td>{{ $review->user_email }}</td>
                                        <td>{{ $review->book_title }}<br><span class="book-meta">{{ $review->book_author }}</span></td>
                                        <td>{{ $review->book_category ?: 'Umum' }}</td>
                                        <td class="rating">{{ $review->rating }}/5</td>
                                        <td class="comment">{{ $review->comment }}</td>
                                        <td>{{ $review->returned_at ? \Carbon\Carbon::parse($review->returned_at)->format('d M Y') : '-' }}</td>
                                        <td>{{ $review->created_at ? \Carbon\Carbon::parse($review->created_at)->format('d M Y') : '-' }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" onsubmit="return confirm('Hapus ulasan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">Belum ada ulasan. Data akan tampil setelah pengguna mengembalikan buku dan mengirim ulasan.</div>
                @endif
            </section>
        </main>
    </div>
</body>
</html>
