<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Pengguna - Pustakara</title>
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
            --navy: #123e7a;
            --line: rgba(255, 255, 255, 0.85);
            --dark: #1d1d1f;
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, var(--sky) 0%, var(--sky-soft) 100%);
            color: var(--white);
            overflow-x: hidden;
        }

        .page {
            min-height: 100vh;
            position: relative;
        }

        .topbar {
            height: 122px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 46px 18px 34px;
            border-bottom: 2px solid var(--line);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .brand img {
            width: 118px;
            height: auto;
            display: block;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-left: auto;
            margin-right: 42px;
            font-size: clamp(16px, 1.5vw, 24px);
            font-weight: 600;
        }

        .nav-links a {
            color: var(--white);
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-links span {
            opacity: 0.8;
        }

        .profile-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: var(--dark);
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.42);
            backdrop-filter: blur(8px);
        }

        .profile-actions {
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .profile-link svg {
            width: 56px;
            height: 56px;
        }

        .profile-photo {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        .profile-name {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .profile-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(29, 29, 31, 0.7);
        }

        .profile-username {
            max-width: 160px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
        }

        .profile-address {
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 12px;
            font-weight: 600;
            color: rgba(29, 29, 31, 0.62);
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            border: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 18px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.7);
            color: var(--dark);
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            backdrop-filter: blur(8px);
        }

        .logout-btn svg {
            width: 20px;
            height: 20px;
        }

        .hero {
            min-height: calc(100vh - 122px);
            display: grid;
            grid-template-columns: 1.02fr 0.98fr;
            align-items: center;
            gap: 24px;
            padding: 48px 72px 72px;
        }

        .hero-copy {
            max-width: 660px;
        }

        .hero-title {
            font-size: clamp(44px, 5vw, 66px);
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: 0.01em;
            margin-bottom: 24px;
        }

        .hero-text {
            max-width: 590px;
            font-size: clamp(18px, 1.55vw, 25px);
            line-height: 1.7;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .hero-tagline {
            font-size: clamp(17px, 1.35vw, 22px);
            line-height: 1.55;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .hero-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 302px;
            min-height: 60px;
            padding: 14px 34px;
            border-radius: 999px;
            background: var(--white);
            color: var(--blue);
            text-decoration: none;
            font-size: clamp(18px, 1.55vw, 25px);
            font-weight: 700;
            box-shadow: 0 18px 28px rgba(52, 94, 148, 0.14);
        }

        .hero-art {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 520px;
        }

        .hero-art img {
            width: min(92%, 620px);
            height: auto;
            display: block;
            filter: drop-shadow(0 22px 36px rgba(58, 100, 153, 0.2));
        }

        .meta {
            position: absolute;
            left: 72px;
            bottom: 26px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.82);
        }

        @media (max-width: 1100px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center;
                padding: 42px 28px 60px;
            }

            .hero-copy {
                margin: 0 auto;
            }

            .hero-text,
            .hero-tagline {
                margin-left: auto;
                margin-right: auto;
            }

            .topbar {
                padding: 18px 24px;
            }

            .nav-links {
                margin-right: 24px;
                font-size: 16px;
            }

            .meta {
                position: static;
                text-align: center;
                padding-bottom: 24px;
            }
        }

        @media (max-width: 720px) {
            .topbar {
                height: auto;
                flex-wrap: wrap;
                justify-content: center;
                gap: 16px;
            }

            .nav-links {
                width: 100%;
                margin: 0;
                justify-content: center;
                font-size: 18px;
                flex-wrap: wrap;
            }

            .hero-title {
                font-size: 38px;
            }

            .hero-text,
            .hero-tagline,
            .hero-button {
                font-size: 18px;
            }

            .hero-button {
                min-width: 230px;
                min-height: 56px;
            }

            .profile-link svg {
                width: 44px;
                height: 44px;
            }

            .profile-link {
                padding: 8px 14px;
            }

            .profile-username {
                max-width: 110px;
                font-size: 15px;
            }

            .profile-address {
                max-width: 150px;
                font-size: 11px;
            }

            .profile-actions {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .logout-btn {
                padding: 10px 14px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="topbar">
            <a href="{{ route('landing') }}" class="brand" aria-label="Pustakara">
                <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
            </a>

            <nav class="nav-links" aria-label="Navigasi utama">
                <a href="{{ route('koleksi.buku') }}">Koleksi Buku</a>
                <span>|</span>
                <a href="{{ route('favorites.index') }}">Favorit</a>
                <span>|</span>
                <a href="{{ route('loans.history') }}">Riwayat Peminjaman</a>
            </nav>

            <div class="profile-actions">
                <a href="{{ route('profile.user') }}" class="profile-link" aria-label="Profil user">
                    <span class="profile-name">
                        <span class="profile-label">Profil</span>
                        <span class="profile-username">{{ auth()->check() ? auth()->user()->username : 'Guest' }}</span>
                        <span class="profile-address">{{ auth()->check() ? (auth()->user()->alamat ?: 'Alamat belum diisi') : 'Alamat belum diisi' }}</span>
                    </span>
                    @if (auth()->check() && auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Foto profil {{ auth()->user()->name }}" class="profile-photo">
                    @else
                        <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <circle cx="32" cy="32" r="24" stroke="currentColor" stroke-width="3.5" opacity="0.9"/>
                            <circle cx="32" cy="25" r="8" stroke="currentColor" stroke-width="3.5"/>
                            <path d="M20 46C20 39.373 25.373 34 32 34C38.627 34 44 39.373 44 46" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @endif
                </a>

                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <input type="hidden" name="redirect_to" value="login.user">
                    <button type="submit" class="logout-btn" aria-label="Keluar">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M14 7L19 12L14 17" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 12H9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                            <path d="M11 5H6C4.89543 5 4 5.89543 4 7V17C4 18.1046 4.89543 19 6 19H11" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </header>

        <main class="hero">
            <section class="hero-copy">
                <h1 class="hero-title">Selamat Datang di Perpustakaan Pustakara</h1>
                <p class="hero-text">
                    Temukan buku yang ingin kamu baca, simpan buku favorit, dan pantau aktivitas perpustakaanmu dalam satu tempat.
                </p>
                <p class="hero-tagline">Mulai jelajahi koleksi dan pilih bacaan terbaikmu hari ini.</p>
                <a href="{{ route('koleksi.buku') }}" class="hero-button">Lihat Koleksi</a>
            </section>

            <section class="hero-art" aria-hidden="true">
                <img src="{{ asset('asset/tumpukanbuku.png') }}" alt="Tumpukan buku Pustakara">
            </section>
        </main>

        <div class="meta">Total buku: {{ $books->count() }} | Stok tersedia: {{ $books->sum('stok') }}</div>
    </div>
</body>
</html>
