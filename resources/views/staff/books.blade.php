<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku Petugas - Pustakara</title>
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
            --danger: #b42318;
            --shadow: 0 22px 40px rgba(69, 102, 130, 0.14);
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--ink);
        }

        .layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 395px 1fr;
        }

        .sidebar {
            background: linear-gradient(180deg, #9fd0f7 0%, #94c9f4 100%);
            padding: 30px 24px 26px;
            display: flex;
            flex-direction: column;
            box-shadow: inset -1px 0 0 rgba(255, 255, 255, 0.2);
        }

        .brand {
            display: flex;
            justify-content: center;
            padding-top: 6px;
            margin-bottom: 30px;
        }

        .brand img {
            width: 128px;
            height: auto;
            display: block;
        }

        .sidebar-divider {
            height: 2px;
            background: rgba(255, 255, 255, 0.65);
            margin: 0 6px 34px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .nav-item {
            display: inline-flex;
            align-items: center;
            gap: 18px;
            min-height: 58px;
            margin: 0 18px;
            padding: 14px 18px;
            border-radius: 18px;
            color: #fff;
            text-decoration: none;
            font-size: 20px;
            font-weight: 500;
        }

        .nav-item svg {
            width: 30px;
            height: 30px;
            stroke: currentColor;
            flex: 0 0 auto;
        }

        .nav-item.active {
            background: #c8b597;
            color: #fff;
            box-shadow: 0 14px 26px rgba(126, 104, 73, 0.18);
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 28px 18px 4px;
        }

        .logout-btn {
            width: 100%;
            min-height: 58px;
            border: none;
            border-radius: 16px;
            background: #7a6da4;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 21px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 16px 24px rgba(76, 62, 112, 0.18);
        }

        .logout-btn svg {
            width: 26px;
            height: 26px;
            stroke: currentColor;
        }

        .content {
            padding: 32px;
            min-width: 0;
        }

        .topbar {
            display: none;
        }

        .btn {
            border: 0;
            min-height: 46px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--blue);
            color: #fff;
            box-shadow: 0 14px 24px rgba(0, 109, 255, 0.18);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.8);
            color: var(--blue);
        }

        .panel {
            border-radius: 28px;
            background: var(--panel);
            box-shadow: var(--shadow);
            padding: 30px;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .panel-title h1 {
            font-size: clamp(28px, 3vw, 42px);
            color: var(--navy);
            font-weight: 800;
            margin-bottom: 6px;
        }

        .panel-title p {
            color: var(--muted);
            font-weight: 600;
        }

        .flash-message {
            margin-bottom: 20px;
            padding: 14px 18px;
            border-radius: 16px;
            background: #eaf7ef;
            color: #1f7a3a;
            font-weight: 700;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 22px;
        }

        .summary-card {
            border-radius: 18px;
            background: var(--soft);
            padding: 18px;
        }

        .summary-value {
            color: var(--blue);
            font-size: 30px;
            line-height: 1;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .summary-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(255px, 1fr));
            gap: 22px;
        }

        .book-card {
            border: 1px solid rgba(18, 62, 122, 0.08);
            border-radius: 22px;
            background: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100%;
            overflow: hidden;
            box-shadow: 0 16px 30px rgba(69, 102, 130, 0.1);
        }

        .cover-frame {
            margin: 16px 16px 0;
            border-radius: 18px;
            background: linear-gradient(180deg, #f7fbff 0%, #eaf4ff 100%);
            border: 1px solid rgba(18, 62, 122, 0.08);
            min-height: 275px;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cover {
            width: min(170px, 78%);
            aspect-ratio: 2 / 3;
            object-fit: contain;
            display: block;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.72);
            box-shadow: 0 18px 28px rgba(18, 62, 122, 0.16);
        }

        .book-body {
            padding: 18px;
            display: flex;
            flex: 1;
            flex-direction: column;
        }

        .book-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 12px;
        }

        .badge,
        .stock-badge {
            display: inline-flex;
            align-items: center;
            min-height: 30px;
            padding: 6px 11px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .badge {
            background: rgba(0, 109, 255, 0.1);
            color: var(--blue);
        }

        .stock-badge {
            background: rgba(18, 62, 122, 0.08);
            color: var(--navy);
        }

        .book-title {
            font-size: 19px;
            line-height: 1.32;
            color: var(--navy);
            font-weight: 800;
            margin-bottom: 8px;
        }

        .book-meta {
            color: rgba(22, 32, 42, 0.72);
            font-size: 14px;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 14px;
        }

        .book-footer {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-top: auto;
            margin-bottom: 16px;
        }

        .meta-box {
            border-radius: 14px;
            background: var(--soft);
            padding: 12px;
        }

        .meta-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .meta-value {
            color: var(--navy);
            font-size: 13px;
            font-weight: 800;
            word-break: break-word;
        }

        .row-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-small {
            min-height: 36px;
            padding: 8px 14px;
            font-size: 12px;
        }

        .btn-danger {
            background: #fff1f0;
            color: var(--danger);
        }

        .empty-state {
            padding: 34px 24px;
            border-radius: 20px;
            background: var(--soft);
            text-align: center;
            font-weight: 700;
            color: var(--muted);
        }

        @media (max-width: 720px) {
            .content { padding: 20px 16px; }

            .topbar,
            .panel-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .panel { padding: 24px; }
        }

        @media (max-width: 1100px) {
            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .book-grid,
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 1280px) {
            .layout {
                grid-template-columns: 320px 1fr;
            }
        }

        @media (max-width: 900px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                gap: 18px;
            }

            .sidebar-nav {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .sidebar-footer {
                margin-top: 0;
            }

            .nav-item {
                margin: 0;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        @include('partials.staff-sidebar', ['activeMenu' => 'books'])

        <main class="content">
        <section class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <h1>Data Buku Petugas</h1>
                    <p>Total buku tersimpan: {{ $books->count() }}</p>
                </div>

                <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku</a>
            </div>

            @if (session('success'))
                <div class="flash-message">{{ session('success') }}</div>
            @endif

            <div class="summary-grid">
                <article class="summary-card">
                    <div class="summary-value">{{ $stats['totalBooks'] }}</div>
                    <div class="summary-label">Total buku</div>
                </article>
                <article class="summary-card">
                    <div class="summary-value">{{ $stats['totalStock'] }}</div>
                    <div class="summary-label">Total stok</div>
                </article>
                <article class="summary-card">
                    <div class="summary-value">{{ $stats['totalCategories'] }}</div>
                    <div class="summary-label">Kategori buku</div>
                </article>
                <article class="summary-card">
                    <div class="summary-value">{{ $stats['emptyStock'] }}</div>
                    <div class="summary-label">Stok habis</div>
                </article>
            </div>

            @if ($books->isNotEmpty())
                <div class="book-grid">
                    @foreach ($books as $book)
                        <article class="book-card">
                            <div class="cover-frame">
                                <img src="{{ $book->cover ?: asset('asset/tumpukanbuku.png') }}" alt="{{ $book->judul }}" class="cover">
                            </div>

                            <div class="book-body">
                                <div class="book-top">
                                    <span class="badge">{{ $book->kategori ?: 'Umum' }}</span>
                                    <span class="stock-badge">Stok {{ $book->stok }}</span>
                                </div>

                                <h2 class="book-title">{{ $book->judul }}</h2>
                                <p class="book-meta">Penulis: {{ $book->penulis }}</p>

                                <div class="book-footer">
                                    <div class="meta-box">
                                        <div class="meta-label">Penerbit</div>
                                        <div class="meta-value">{{ $book->penerbit ?: '-' }}</div>
                                    </div>
                                    <div class="meta-box">
                                        <div class="meta-label">Tahun</div>
                                        <div class="meta-value">{{ $book->tahun_terbit ?: '-' }}</div>
                                    </div>
                                </div>

                                <div class="row-actions">
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-secondary btn-small">Ubah</a>
                                    <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Hapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-small">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">Belum ada buku. Klik tombol Tambah Buku untuk memasukkan data baru.</div>
            @endif
        </section>
        </main>
    </div>
</body>
</html>
