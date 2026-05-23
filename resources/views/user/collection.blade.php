<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Buku - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sky: #a7d2f5;
            --sky-soft: #dceef8;
            --white: #ffffff;
            --blue: #1f6ce0;
            --navy: #123e7a;
            --dark: #1d1d1f;
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, var(--sky) 0%, var(--sky-soft) 100%);
            color: var(--dark);
        }

        .page {
            width: min(1180px, calc(100% - 48px));
            margin: 0 auto;
            padding: 30px 0 48px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 30px;
        }

        .brand img {
            width: 116px;
            height: auto;
            display: block;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 10px 20px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.78);
            color: var(--blue);
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 12px 24px rgba(52, 94, 148, 0.12);
        }

        .page-title {
            margin-bottom: 24px;
            text-align: center;
        }

        .page-title h1 {
            font-size: clamp(30px, 4vw, 44px);
            color: var(--navy);
            font-weight: 800;
            margin-bottom: 8px;
        }

        .page-title p {
            color: rgba(29, 29, 31, 0.68);
            font-weight: 500;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .book-card {
            overflow: hidden;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.78);
            box-shadow: 0 16px 32px rgba(52, 94, 148, 0.12);
            display: flex;
            flex-direction: column;
        }

        .book-cover {
            width: 100%;
            aspect-ratio: 4 / 3;
            background: rgba(255, 255, 255, 0.74);
            overflow: hidden;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
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

        .book-category,
        .book-stock {
            display: inline-flex;
            align-items: center;
            min-height: 30px;
            padding: 6px 11px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .book-category {
            background: rgba(31, 108, 224, 0.12);
            color: var(--blue);
        }

        .book-stock {
            background: rgba(18, 62, 122, 0.08);
            color: var(--navy);
            white-space: nowrap;
        }

        .book-title {
            font-size: 20px;
            line-height: 1.35;
            color: var(--navy);
            font-weight: 800;
            margin-bottom: 8px;
        }

        .book-author,
        .book-desc,
        .book-footer {
            color: rgba(29, 29, 31, 0.72);
        }

        .book-author {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .book-desc {
            font-size: 13px;
            line-height: 1.65;
            margin-bottom: 16px;
            flex: 1;
        }

        .book-footer {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 12px;
            margin-bottom: 16px;
        }

        .book-action {
            margin-top: auto;
            display: grid;
            gap: 10px;
        }

        .favorite-form,
        .borrow-form {
            margin: 0;
        }

        .borrow-btn,
        .favorite-btn,
        .login-favorite,
        .login-borrow {
            width: 100%;
            min-height: 44px;
            border: 0;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
        }

        .borrow-btn {
            background: var(--navy);
            color: var(--white);
        }

        .borrow-btn[disabled] {
            background: rgba(18, 62, 122, 0.18);
            color: rgba(18, 62, 122, 0.55);
            cursor: not-allowed;
        }

        .borrow-btn.is-disabled {
            background: rgba(18, 62, 122, 0.18);
            color: rgba(18, 62, 122, 0.55);
            cursor: not-allowed;
        }

        .favorite-btn {
            background: var(--blue);
            color: var(--white);
        }

        .favorite-btn.is-active {
            background: var(--navy);
        }

        .login-favorite {
            background: rgba(31, 108, 224, 0.12);
            color: var(--blue);
        }

        .login-borrow {
            background: var(--navy);
            color: var(--white);
        }

        .flash-message,
        .error-message {
            margin: 0 auto 20px;
            width: min(720px, 100%);
            padding: 14px 18px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.82);
            color: var(--navy);
            text-align: center;
            font-weight: 700;
        }

        .error-message {
            background: #fff1f0;
            color: #b42318;
        }

        .empty-state {
            padding: 26px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.78);
            text-align: center;
            font-weight: 700;
            color: rgba(29, 29, 31, 0.7);
        }

        @media (max-width: 900px) {
            .book-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 620px) {
            .page {
                width: min(100% - 32px, 1180px);
                padding-top: 22px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .book-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <header class="topbar">
            <a href="{{ route('dashboard.user') }}" class="brand" aria-label="Pustakara">
                <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
            </a>

            <a href="{{ route('dashboard.user') }}" class="back-link">Kembali ke Dasbor</a>
        </header>

        <section class="page-title">
            <h1>Koleksi Buku</h1>
            <p>Total koleksi: {{ $books->count() }} buku</p>
        </section>

        @if (session('success'))
            <div class="flash-message">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        @forelse ($books as $book)
            @if ($loop->first)<section class="book-grid">@endif
                <article class="book-card">
                    <div class="book-cover">
                        <img src="{{ $book->cover ?: asset('asset/tumpukanbuku.png') }}" alt="{{ $book->judul }}">
                    </div>
                    <div class="book-body">
                        <div class="book-top">
                            <span class="book-category">{{ $book->kategori ?: 'Umum' }}</span>
                            <span class="book-stock">Stok {{ $book->stok }}</span>
                        </div>
                        <h2 class="book-title">{{ $book->judul }}</h2>
                        <p class="book-author">Penulis: {{ $book->penulis }}</p>
                        <p class="book-desc">{{ $book->deskripsi ?: 'Deskripsi buku belum ditambahkan.' }}</p>
                        <div class="book-footer">
                            <span>{{ $book->tahun_terbit ?: 'Tahun belum ada' }}</span>
                            <span>{{ $book->penerbit ?: 'Penerbit belum ada' }}</span>
                        </div>
                        <div class="book-action">
                            @auth
                                @php($isBorrowed = in_array($book->id, $activeLoanBookIds ?? []))
                                @if ($isBorrowed)
                                    <span class="borrow-btn is-disabled">Sedang Diproses</span>
                                @elseif ($book->stok < 1)
                                    <span class="borrow-btn is-disabled">Stok Habis</span>
                                @else
                                    <a href="{{ route('loans.create', $book) }}" class="borrow-btn">Pinjam Buku</a>
                                @endif

                                @php($isFavorite = in_array($book->id, $favoriteBookIds ?? []))
                                <form method="POST" action="{{ route('favorites.toggle', $book) }}" class="favorite-form">
                                    @csrf
                                    <button type="submit" class="favorite-btn {{ $isFavorite ? 'is-active' : '' }}">
                                        {{ $isFavorite ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login.user') }}" class="login-borrow">Masuk untuk Pinjam</a>
                                <a href="{{ route('login.user') }}" class="login-favorite">Masuk untuk Favorit</a>
                            @endauth
                        </div>
                    </div>
                </article>
            @if ($loop->last)</section>@endif
        @empty
            <div class="empty-state">Belum ada buku di database.</div>
        @endforelse
    </main>
</body>
</html>
