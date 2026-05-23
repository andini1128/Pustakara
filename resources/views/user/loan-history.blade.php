<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - Pustakara</title>
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
            width: min(1120px, calc(100% - 48px));
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

        .top-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav-pill {
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

        .history-panel {
            overflow: hidden;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 16px 32px rgba(52, 94, 148, 0.12);
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th,
        .history-table td {
            padding: 16px 18px;
            text-align: left;
            border-bottom: 1px solid rgba(18, 62, 122, 0.1);
        }

        .history-table th {
            background: rgba(31, 108, 224, 0.1);
            color: var(--navy);
            font-size: 13px;
            text-transform: uppercase;
        }

        .history-table td {
            color: rgba(29, 29, 31, 0.76);
            font-size: 14px;
            font-weight: 600;
        }

        .status {
            display: inline-flex;
            align-items: center;
            min-height: 30px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(31, 108, 224, 0.12);
            color: var(--blue);
            font-size: 12px;
            font-weight: 800;
        }

        .return-btn {
            border: 0;
            min-height: 34px;
            padding: 8px 13px;
            border-radius: 999px;
            background: var(--blue);
            color: var(--white);
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .action-muted {
            color: rgba(29, 29, 31, 0.58);
            font-size: 12px;
            font-weight: 800;
        }

        .review-form {
            display: grid;
            gap: 8px;
            min-width: 240px;
        }

        .review-row {
            display: grid;
            grid-template-columns: 82px 1fr;
            gap: 8px;
        }

        .review-form select,
        .review-form textarea {
            width: 100%;
            border: 1px solid rgba(18, 62, 122, 0.14);
            border-radius: 10px;
            background: #fff;
            color: var(--dark);
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 10px;
            outline: none;
        }

        .review-form textarea {
            min-height: 64px;
            resize: vertical;
        }

        .review-btn {
            border: 0;
            min-height: 34px;
            border-radius: 999px;
            background: var(--navy);
            color: var(--white);
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .empty-state {
            padding: 34px 24px;
            text-align: center;
            font-weight: 700;
            color: rgba(29, 29, 31, 0.7);
        }

        .empty-state a {
            color: var(--blue);
            text-decoration: none;
        }

        .flash-message {
            margin: 0 auto 20px;
            width: min(720px, 100%);
            padding: 14px 18px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.82);
            color: var(--navy);
            text-align: center;
            font-weight: 700;
        }

        .flash-message.error {
            background: #fff1f0;
            color: #b42318;
        }

        @media (max-width: 720px) {
            .page {
                width: min(100% - 32px, 1120px);
                padding-top: 22px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .history-panel {
                overflow-x: auto;
            }

            .history-table {
                min-width: 1120px;
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

            <div class="top-actions">
                <a href="{{ route('koleksi.buku') }}" class="nav-pill">Koleksi Buku</a>
                <a href="{{ route('dashboard.user') }}" class="nav-pill">Kembali ke Dasbor</a>
            </div>
        </header>

        <section class="page-title">
            <h1>Riwayat Peminjaman</h1>
            <p>Daftar buku yang pernah atau sedang kamu pinjam.</p>
        </section>

        @if (session('success'))
            <div class="flash-message">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="flash-message error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="flash-message error">{{ $errors->first() }}</div>
        @endif

        <section class="history-panel">
            @if ($loans->isNotEmpty())
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Judul Buku</th>
                            <th>Alamat</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>Ulasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr>
                                <td>{{ $loan->book->judul ?? '-' }}</td>
                                <td>{{ auth()->user()->alamat ?: 'Belum diisi' }}</td>
                                <td>{{ optional($loan->borrowed_at)->format('d M Y') ?? '-' }}</td>
                                <td>{{ optional($loan->due_at)->format('d M Y') ?? '-' }}</td>
                                <td><span class="status">{{ $loan->status ?? 'Diproses' }}</span></td>
                                <td>
                                    @if ($loan->status === 'Dipinjam')
                                        <form method="POST" action="{{ route('loans.return', $loan) }}" onsubmit="return confirm('Kembalikan buku ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="return-btn">Kembalikan</button>
                                        </form>
                                    @elseif ($loan->status === 'Dikembalikan')
                                        <span class="action-muted">Dikembalikan {{ optional($loan->returned_at)->format('d M Y') }}</span>
                                    @else
                                        <span class="action-muted">Belum tersedia</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($loan->status === 'Dikembalikan' && ! in_array($loan->id, $reviewedLoanIds ?? []))
                                        <form method="POST" action="{{ route('loans.review.store', $loan) }}" class="review-form">
                                            @csrf
                                            <div class="review-row">
                                                <select name="rating" required>
                                                    <option value="5">5/5</option>
                                                    <option value="4">4/5</option>
                                                    <option value="3">3/5</option>
                                                    <option value="2">2/5</option>
                                                    <option value="1">1/5</option>
                                                </select>
                                                <button type="submit" class="review-btn">Kirim</button>
                                            </div>
                                            <textarea name="comment" placeholder="Tulis ulasan buku..." required>{{ old('comment') }}</textarea>
                                        </form>
                                    @elseif (in_array($loan->id, $reviewedLoanIds ?? []))
                                        <span class="action-muted">Ulasan terkirim</span>
                                    @else
                                        <span class="action-muted">Setelah dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    Belum ada riwayat peminjaman. <a href="{{ route('koleksi.buku') }}">Lihat koleksi buku.</a>
                </div>
            @endif
        </section>
    </main>
</body>
</html>
