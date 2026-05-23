<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman - Pustakara</title>
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
            --muted: rgba(29, 29, 31, 0.68);
        }
        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, var(--sky) 0%, var(--sky-soft) 100%);
            color: var(--dark);
            padding: 30px 24px;
        }
        .page {
            width: min(920px, 100%);
            margin: 0 auto;
        }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 28px;
        }
        .brand img {
            width: 112px;
            height: auto;
            display: block;
        }
        .back-link,
        .btn {
            min-height: 46px;
            border: 0;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            font: inherit;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
        }
        .back-link {
            background: rgba(255, 255, 255, 0.78);
            color: var(--blue);
            box-shadow: 0 12px 24px rgba(52, 94, 148, 0.12);
        }
        .panel {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.84);
            padding: 24px;
            box-shadow: 0 18px 36px rgba(52, 94, 148, 0.14);
        }
        .cover-frame {
            border-radius: 18px;
            background: linear-gradient(180deg, #f7fbff 0%, #eaf4ff 100%);
            padding: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 360px;
        }
        .cover-frame img {
            width: min(200px, 82%);
            aspect-ratio: 2 / 3;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 18px 28px rgba(18, 62, 122, 0.16);
            background: #fff;
        }
        h1 {
            color: var(--navy);
            font-size: clamp(28px, 4vw, 40px);
            line-height: 1.2;
            font-weight: 800;
            margin-bottom: 8px;
        }
        .subtitle {
            color: var(--muted);
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 22px;
        }
        .book-meta {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 22px;
        }
        .meta-box {
            border-radius: 14px;
            background: rgba(31, 108, 224, 0.08);
            padding: 13px;
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
            font-size: 14px;
            font-weight: 800;
            word-break: break-word;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .field.full {
            grid-column: 1 / -1;
        }
        label {
            color: var(--navy);
            font-size: 13px;
            font-weight: 800;
        }
        input {
            width: 100%;
            min-height: 46px;
            border: 1px solid rgba(18, 62, 122, 0.16);
            border-radius: 14px;
            background: #fff;
            padding: 10px 13px;
            font: inherit;
            font-size: 14px;
        }
        input[readonly] {
            color: rgba(29, 29, 31, 0.72);
            background: rgba(255, 255, 255, 0.62);
        }
        .errors {
            grid-column: 1 / -1;
            border-radius: 14px;
            background: #fff1f0;
            color: #b42318;
            padding: 12px 14px;
            font-size: 13px;
            font-weight: 700;
        }
        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .btn-primary {
            background: var(--blue);
            color: var(--white);
            box-shadow: 0 12px 24px rgba(31, 108, 224, 0.2);
        }
        .btn-secondary {
            background: rgba(31, 108, 224, 0.1);
            color: var(--blue);
        }
        .modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 40;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(18, 62, 122, 0.42);
        }
        .modal-backdrop.is-open {
            display: flex;
        }
        .modal-card {
            width: min(520px, 100%);
            border-radius: 22px;
            background: var(--white);
            box-shadow: 0 24px 50px rgba(18, 62, 122, 0.22);
            padding: 24px;
        }
        .modal-title {
            color: var(--navy);
            font-size: 24px;
            line-height: 1.25;
            font-weight: 800;
            margin-bottom: 8px;
        }
        .modal-text {
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 18px;
        }
        .confirm-list {
            display: grid;
            gap: 10px;
            margin-bottom: 20px;
        }
        .confirm-item {
            border-radius: 14px;
            background: rgba(31, 108, 224, 0.08);
            padding: 12px 14px;
        }
        .confirm-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .confirm-value {
            color: var(--navy);
            font-size: 14px;
            font-weight: 800;
            word-break: break-word;
        }
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }
        @media (max-width: 760px) {
            body { padding: 22px 16px; }
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
            .panel {
                grid-template-columns: 1fr;
                padding: 18px;
            }
            .cover-frame { min-height: 300px; }
            .book-meta,
            .form-grid {
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
            <a href="{{ route('koleksi.buku') }}" class="back-link">Kembali ke Koleksi</a>
        </header>

        <section class="panel">
            <div class="cover-frame">
                <img src="{{ $book->cover ?: asset('asset/tumpukanbuku.png') }}" alt="{{ $book->judul }}">
            </div>

            <div>
                <h1>Form Peminjaman</h1>
                <p class="subtitle">Cek ulang data buku dan tentukan tanggal kembali sebelum meminjam.</p>

                <div class="book-meta">
                    <div class="meta-box">
                        <div class="meta-label">Judul</div>
                        <div class="meta-value">{{ $book->judul }}</div>
                    </div>
                    <div class="meta-box">
                        <div class="meta-label">Penulis</div>
                        <div class="meta-value">{{ $book->penulis }}</div>
                    </div>
                    <div class="meta-box">
                        <div class="meta-label">Kategori</div>
                        <div class="meta-value">{{ $book->kategori ?: 'Umum' }}</div>
                    </div>
                    <div class="meta-box">
                        <div class="meta-label">Stok</div>
                        <div class="meta-value">{{ $book->stok }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('loans.borrow', $book) }}" id="loanForm">
                    @csrf
                    <div class="form-grid">
                        @if ($errors->any())
                            <div class="errors">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <div class="field">
                            <label for="name">Nama Peminjam</label>
                            <input type="text" id="name" value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div class="field">
                            <label for="borrowed_at">Tanggal Pinjam</label>
                            <input type="date" id="borrowed_at" value="{{ $borrowedAt->toDateString() }}" readonly>
                        </div>
                        <div class="field full">
                            <label for="due_at">Tanggal Kembali</label>
                            <input
                                type="date"
                                id="due_at"
                                name="due_at"
                                value="{{ old('due_at', $defaultDueAt->toDateString()) }}"
                                min="{{ $borrowedAt->toDateString() }}"
                                max="{{ $borrowedAt->copy()->addDays(14)->toDateString() }}"
                                required
                            >
                        </div>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                        <a href="{{ route('koleksi.buku') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <div class="modal-backdrop" id="confirmModal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
        <div class="modal-card">
            <h2 class="modal-title" id="confirmTitle">Konfirmasi Peminjaman</h2>
            <p class="modal-text">Pastikan data peminjaman sudah sesuai sebelum diajukan.</p>
            <div class="confirm-list">
                <div class="confirm-item">
                    <div class="confirm-label">Nama Peminjam</div>
                    <div class="confirm-value" id="confirmName">{{ auth()->user()->name }}</div>
                </div>
                <div class="confirm-item">
                    <div class="confirm-label">Judul Buku</div>
                    <div class="confirm-value">{{ $book->judul }}</div>
                </div>
                <div class="confirm-item">
                    <div class="confirm-label">Tanggal Pinjam</div>
                    <div class="confirm-value" id="confirmBorrowed">{{ $borrowedAt->format('d M Y') }}</div>
                </div>
                <div class="confirm-item">
                    <div class="confirm-label">Tanggal Kembali</div>
                    <div class="confirm-value" id="confirmDue">-</div>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" id="cancelConfirm">Periksa Lagi</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Konfirmasi Peminjaman</button>
            </div>
        </div>
    </div>

    <script>
        const loanForm = document.getElementById('loanForm');
        const confirmModal = document.getElementById('confirmModal');
        const dueInput = document.getElementById('due_at');
        const confirmDue = document.getElementById('confirmDue');
        const cancelConfirm = document.getElementById('cancelConfirm');
        const confirmSubmit = document.getElementById('confirmSubmit');
        let confirmed = false;

        function formatDate(dateValue) {
            if (!dateValue) return '-';
            return new Intl.DateTimeFormat('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            }).format(new Date(`${dateValue}T00:00:00`));
        }

        loanForm.addEventListener('submit', function (event) {
            if (confirmed) return;
            event.preventDefault();
            confirmDue.textContent = formatDate(dueInput.value);
            confirmModal.classList.add('is-open');
        });

        cancelConfirm.addEventListener('click', function () {
            confirmModal.classList.remove('is-open');
        });

        confirmSubmit.addEventListener('click', function () {
            confirmed = true;
            confirmSubmit.disabled = true;
            confirmSubmit.textContent = 'Mengajukan...';
            loanForm.submit();
        });

        confirmModal.addEventListener('click', function (event) {
            if (event.target === confirmModal) {
                confirmModal.classList.remove('is-open');
            }
        });
    </script>
</body>
</html>
