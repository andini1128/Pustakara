<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sky: #a7d2f5;
            --sky-soft: #b0d8f9;
            --white: #ffffff;
            --blue: #1f6ce0;
            --line: rgba(255, 255, 255, 0.85);
            --dark: #1d1d1f;
            --card: rgba(255, 255, 255, 0.5);
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, var(--sky) 0%, var(--sky-soft) 100%);
            color: var(--dark);
        }

        .page {
            min-height: 100vh;
            padding: 32px 24px;
        }

        .shell {
            max-width: 1120px;
            margin: 0 auto;
        }

        .topbar {
            margin: 0 auto 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .brand img {
            width: 118px;
            height: auto;
            display: block;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 12px 22px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.72);
            color: var(--blue);
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 14px 24px rgba(52, 94, 148, 0.12);
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .back-link:hover {
            background: rgba(255, 255, 255, 0.88);
        }

        .edit-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 12px 22px;
            border-radius: 999px;
            background: var(--blue);
            color: var(--white);
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 14px 24px rgba(31, 108, 224, 0.18);
        }

        .flash-message {
            margin-bottom: 20px;
            padding: 14px 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.76);
            color: #123e7a;
            font-weight: 700;
            text-align: center;
        }

        .profile-card {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 28px;
            align-items: stretch;
        }

        .profile-hero,
        .profile-details {
            border-radius: 28px;
            background: var(--card);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 40px rgba(52, 94, 148, 0.14);
        }

        .profile-hero {
            padding: 34px 26px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .avatar {
            width: 118px;
            height: 118px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            background: rgba(255, 255, 255, 0.78);
            color: var(--blue);
            overflow: hidden;
        }

        .avatar svg {
            width: 72px;
            height: 72px;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .profile-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .profile-subtitle {
            font-size: 15px;
            color: rgba(29, 29, 31, 0.7);
        }

        .profile-summary {
            width: 100%;
            margin-top: 24px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .summary-item {
            padding: 14px 12px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.68);
        }

        .summary-value {
            font-size: 22px;
            font-weight: 800;
            color: #123e7a;
            line-height: 1;
            margin-bottom: 6px;
        }

        .summary-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: rgba(29, 29, 31, 0.58);
        }

        .profile-details {
            padding: 34px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 24px;
            color: #123e7a;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .detail-item {
            padding: 18px 20px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.7);
        }

        .detail-label {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(29, 29, 31, 0.55);
            margin-bottom: 8px;
        }

        .detail-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            word-break: break-word;
        }

        .collection-section {
            margin: 28px auto 0;
            padding: 34px;
            border-radius: 28px;
            background: var(--card);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 40px rgba(52, 94, 148, 0.14);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .section-meta {
            font-size: 14px;
            font-weight: 600;
            color: rgba(29, 29, 31, 0.62);
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .book-card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.72);
            box-shadow: 0 12px 24px rgba(52, 94, 148, 0.08);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .book-cover {
            width: 100%;
            aspect-ratio: 4 / 3;
            background: rgba(255, 255, 255, 0.72);
            overflow: hidden;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .book-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .book-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .book-category {
            display: inline-flex;
            align-items: center;
            min-height: 32px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(31, 108, 224, 0.12);
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .book-stock-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 32px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(18, 62, 122, 0.08);
            color: #123e7a;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .book-title {
            font-size: 20px;
            font-weight: 800;
            color: #123e7a;
            margin-bottom: 8px;
        }

        .book-author {
            font-size: 15px;
            font-weight: 600;
            color: rgba(29, 29, 31, 0.78);
            margin-bottom: 14px;
        }

        .book-desc {
            font-size: 14px;
            line-height: 1.6;
            color: rgba(29, 29, 31, 0.72);
            margin-bottom: 18px;
            flex: 1;
        }

        .book-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            font-size: 13px;
            color: rgba(29, 29, 31, 0.68);
        }

        .book-actions {
            margin-top: 18px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .borrow-btn {
            border: 0;
            min-height: 44px;
            padding: 10px 18px;
            border-radius: 999px;
            background: var(--blue);
            color: var(--white);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(31, 108, 224, 0.2);
        }

        .borrow-btn[disabled] {
            background: rgba(29, 29, 31, 0.18);
            color: rgba(29, 29, 31, 0.55);
            cursor: not-allowed;
            box-shadow: none;
        }

        .borrow-btn.is-disabled {
            background: rgba(29, 29, 31, 0.18);
            color: rgba(29, 29, 31, 0.55);
            cursor: not-allowed;
            box-shadow: none;
        }

        .borrow-note {
            font-size: 12px;
            line-height: 1.5;
            color: rgba(29, 29, 31, 0.58);
        }

        .empty-state {
            padding: 26px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.72);
            font-size: 16px;
            font-weight: 600;
            color: rgba(29, 29, 31, 0.7);
            text-align: center;
        }

        @media (max-width: 860px) {
            .page {
                padding: 24px 16px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile-card {
                grid-template-columns: 1fr;
            }

            .profile-summary {
                grid-template-columns: 1fr 1fr;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .collection-section {
                padding: 24px;
            }

            .section-header {
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
    <div class="page">
        <div class="shell">
            <header class="topbar">
                <a href="{{ route('landing') }}" class="brand" aria-label="Pustakara">
                    <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
                </a>

                <div class="top-actions">
                    <a href="{{ route('profile.user.edit') }}" class="edit-link">Ubah Profil</a>
                    <a href="{{ route('dashboard.user') }}" class="back-link">Kembali ke Dasbor</a>
                </div>
            </header>

            @if (session('success'))
                <div class="flash-message">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="flash-message">{{ session('error') }}</div>
            @endif

            <main class="profile-card">
                <section class="profile-hero">
                    <div class="avatar" aria-hidden="true">
                        @if (auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Foto profil {{ auth()->user()->name }}">
                        @else
                            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="32" cy="32" r="24" stroke="currentColor" stroke-width="3.5" opacity="0.9"/>
                                <circle cx="32" cy="25" r="8" stroke="currentColor" stroke-width="3.5"/>
                                <path d="M20 46C20 39.373 25.373 34 32 34C38.627 34 44 39.373 44 46" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        @endif
                    </div>
                    <h1 class="profile-title">{{ auth()->user()->name }}</h1>
                    <p class="profile-subtitle">Profil pengguna Pustakara</p>
                    <div class="profile-summary">
                        <div class="summary-item">
                            <div class="summary-value">{{ $books->count() }}</div>
                            <div class="summary-label">Total Buku</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value">{{ $books->sum('stok') }}</div>
                            <div class="summary-label">Total Stok</div>
                        </div>
                    </div>
                </section>

                <section class="profile-details">
                    <h2 class="section-title">Informasi Akun</h2>

                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Nama</div>
                            <div class="detail-value">{{ auth()->user()->name }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Nama Pengguna</div>
                            <div class="detail-value">{{ auth()->user()->username }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Surel</div>
                            <div class="detail-value">{{ auth()->user()->email }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Alamat</div>
                            <div class="detail-value">{{ auth()->user()->alamat ?: 'Belum diisi' }}</div>
                        </div>
                    </div>
                </section>
            </main>

            <section class="collection-section">
                <div class="section-header">
                    <h2 class="section-title">Koleksi Buku</h2>
                    <div class="section-meta">Total koleksi: {{ $books->count() }} buku</div>
                </div>

                @forelse ($books as $book)
                    @if ($loop->first)<div class="book-grid">@endif
                        <article class="book-card">
                            <div class="book-cover">
                                <img src="{{ $book->cover ?: asset('asset/tumpukanbuku.png') }}" alt="{{ $book->judul }}">
                            </div>
                            <div class="book-body">
                                <div class="book-top">
                                    <div class="book-category">{{ $book->kategori ?: 'Umum' }}</div>
                                    <div class="book-stock-badge">Stok {{ $book->stok }}</div>
                                </div>
                                <h3 class="book-title">{{ $book->judul }}</h3>
                                <p class="book-author">Penulis: {{ $book->penulis }}</p>
                                <p class="book-desc">{{ $book->deskripsi ?: 'Deskripsi buku belum ditambahkan.' }}</p>
                                <div class="book-footer">
                                    <span>{{ $book->tahun_terbit ?: 'Tahun belum ada' }}</span>
                                    <span>{{ $book->penerbit ?: 'Penerbit belum ada' }}</span>
                                </div>
                                <div class="book-actions">
                                    @php($isBorrowed = in_array($book->id, $activeLoanBookIds ?? []))
                                    @if ($isBorrowed)
                                        <span class="borrow-btn is-disabled">Sedang Diproses</span>
                                    @elseif ($book->stok < 1)
                                        <span class="borrow-btn is-disabled">Stok Habis</span>
                                    @else
                                        <a href="{{ route('loans.create', $book) }}" class="borrow-btn">Pinjam</a>
                                    @endif
                                    <span class="borrow-note">
                                        {{ $isBorrowed ? 'Buku ini sedang menunggu persetujuan atau masih kamu pinjam.' : ($book->stok < 1 ? 'Buku ini belum bisa dipinjam karena stok habis.' : 'Pinjaman aktif setelah disetujui admin atau petugas.') }}
                                    </span>
                                </div>
                            </div>
                        </article>
                    @if ($loop->last)</div>@endif
                @empty
                    <div class="empty-state">Belum ada buku di database. Tambahkan buku dulu dari dashboard admin.</div>
                @endforelse
            </section>
        </div>
    </div>h@\
</body>
</html>
