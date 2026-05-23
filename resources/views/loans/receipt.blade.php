<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Peminjaman - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        :root { --sky:#a7d2f5; --soft:#eef6ff; --white:#fff; --blue:#1f6ce0; --navy:#123e7a; --ink:#1d1d1f; --muted:rgba(29,29,31,.62); --line:rgba(18,62,122,.16); }
        body { min-height:100vh; font-family:'Poppins',sans-serif; background:linear-gradient(180deg,var(--sky),#dceef8); color:var(--ink); padding:30px 20px; }
        .page { width:min(860px,100%); margin:0 auto; }
        .topbar { display:flex; justify-content:space-between; align-items:center; gap:14px; margin-bottom:24px; }
        .brand img { width:110px; display:block; }
        .actions { display:flex; gap:10px; flex-wrap:wrap; }
        .btn { border:0; min-height:44px; border-radius:999px; padding:10px 18px; display:inline-flex; align-items:center; justify-content:center; background:var(--white); color:var(--blue); font:inherit; font-size:13px; font-weight:800; text-decoration:none; cursor:pointer; box-shadow:0 12px 24px rgba(52,94,148,.12); }
        .btn-primary { background:var(--blue); color:var(--white); }
        .receipt { border-radius:24px; background:rgba(255,255,255,.9); box-shadow:0 18px 36px rgba(52,94,148,.14); overflow:hidden; }
        .receipt-head { padding:26px 30px; background:linear-gradient(135deg,#dceeff,#eef6ff); border-bottom:1px solid var(--line); }
        .print-kop, .receipt-meta, .signature-row { display:none; }
        h1 { color:var(--navy); font-size:clamp(28px,4vw,40px); line-height:1.2; font-weight:800; margin-bottom:8px; }
        .subtitle { color:var(--muted); font-weight:700; line-height:1.6; }
        .receipt-body { padding:26px 30px; }
        .stamp { display:inline-flex; min-height:34px; align-items:center; border-radius:999px; padding:7px 14px; background:#fff7df; color:#a26400; font-size:12px; font-weight:800; margin-bottom:20px; }
        .grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; }
        .item { border:1px solid var(--line); border-radius:16px; padding:14px 16px; background:var(--soft); }
        .label { color:var(--muted); font-size:11px; font-weight:800; text-transform:uppercase; margin-bottom:5px; }
        .value { color:var(--navy); font-size:15px; font-weight:800; line-height:1.45; word-break:break-word; }
        .note { margin-top:22px; color:var(--muted); font-size:13px; font-weight:700; line-height:1.7; }
        .modal-backdrop { position:fixed; inset:0; z-index:40; display:none; align-items:center; justify-content:center; padding:20px; background:rgba(18,62,122,.42); }
        .modal-backdrop.is-open { display:flex; }
        .modal-card { width:min(460px,100%); border-radius:22px; background:#fff; padding:24px; box-shadow:0 24px 50px rgba(18,62,122,.22); text-align:center; }
        .success-mark { width:58px; height:58px; border-radius:50%; background:#e8f7ee; color:#178248; display:inline-flex; align-items:center; justify-content:center; font-size:30px; font-weight:800; margin-bottom:14px; }
        .modal-title { color:var(--navy); font-size:24px; font-weight:800; margin-bottom:8px; }
        .modal-text { color:var(--muted); font-size:14px; font-weight:700; line-height:1.6; margin-bottom:18px; }
        @media (max-width:680px){ .topbar{align-items:flex-start; flex-direction:column;} .grid{grid-template-columns:1fr;} .receipt-head,.receipt-body{padding:22px;} }
        @media print {
            @page { size:A4; margin:14mm; }
            * { -webkit-print-color-adjust:exact; print-color-adjust:exact; }
            body { background:#fff; padding:0; font-family:Arial,sans-serif; color:#111; }
            .topbar { display:none; }
            .page { width:100%; }
            .receipt { box-shadow:none; border-radius:0; border:1px solid #cfd8e6; overflow:visible; }
            .receipt-head { background:#fff; padding:18px 22px 14px; border-bottom:2px solid #123e7a; }
            .print-kop { display:flex; align-items:center; gap:14px; margin-bottom:14px; }
            .print-kop img { width:68px; height:auto; display:block; }
            .print-kop strong { display:block; color:#123e7a; font-size:20px; line-height:1.2; }
            .print-kop span { display:block; color:#555; font-size:11px; font-weight:700; margin-top:3px; }
            h1 { color:#111; font-size:24px; margin-bottom:4px; }
            .subtitle { color:#555; font-size:12px; line-height:1.5; }
            .receipt-body { padding:18px 22px 22px; }
            .receipt-meta { display:grid; grid-template-columns:repeat(3,1fr); gap:8px; margin-bottom:14px; }
            .meta-card { border:1px solid #d7dde8; border-radius:8px; padding:8px 10px; }
            .meta-label { display:block; color:#666; font-size:9px; font-weight:700; text-transform:uppercase; margin-bottom:3px; }
            .meta-value { color:#111; font-size:12px; font-weight:800; }
            .stamp { border-radius:6px; border:1px solid #d7a338; background:#fff8df; color:#8a5600; margin-bottom:14px; min-height:0; padding:6px 10px; }
            .grid { gap:0; border:1px solid #cfd8e6; border-bottom:0; border-right:0; }
            .item { border:0; border-right:1px solid #cfd8e6; border-bottom:1px solid #cfd8e6; border-radius:0; background:#fff; padding:10px 12px; }
            .label { color:#666; font-size:9px; }
            .value { color:#111; font-size:12px; }
            .note { margin-top:14px; color:#555; font-size:11px; }
            .signature-row { display:flex; justify-content:space-between; gap:22px; margin-top:30px; page-break-inside:avoid; }
            .signature-box { width:220px; text-align:center; color:#111; font-size:12px; font-weight:700; }
            .signature-space { height:58px; }
        }
    </style>
</head>
<body>
    <main class="page">
        <header class="topbar">
            <a href="{{ route('dashboard.user') }}" class="brand" aria-label="Pustakara">
                <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
            </a>
            <div class="actions">
                <a href="{{ route('loans.history') }}" class="btn">Riwayat</a>
                <button type="button" class="btn btn-primary" onclick="window.print()">Cetak PDF</button>
            </div>
        </header>

        <section class="receipt">
            <div class="receipt-head">
                <div class="print-kop">
                    <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
                    <div>
                        <strong>Pustakara</strong>
                        <span>Bukti transaksi peminjaman buku</span>
                    </div>
                </div>
                <h1>Bukti Peminjaman</h1>
                <p class="subtitle">Bukti ini dibuat setelah pengajuan peminjaman dikirim ke admin atau petugas.</p>
            </div>
            <div class="receipt-body">
                <div class="receipt-meta">
                    <div class="meta-card">
                        <span class="meta-label">Nomor Bukti</span>
                        <span class="meta-value">PMJ-{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="meta-card">
                        <span class="meta-label">Tanggal Cetak</span>
                        <span class="meta-value">{{ now()->format('d M Y') }}</span>
                    </div>
                    <div class="meta-card">
                        <span class="meta-label">Status</span>
                        <span class="meta-value">{{ $loan->status }}</span>
                    </div>
                </div>
                <span class="stamp">{{ $loan->status }}</span>
                <div class="grid">
                    <div class="item"><div class="label">Nomor Bukti</div><div class="value">PMJ-{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }}</div></div>
                    <div class="item"><div class="label">Tanggal Pengajuan</div><div class="value">{{ optional($loan->created_at)->format('d M Y H:i') }}</div></div>
                    <div class="item"><div class="label">Nama Peminjam</div><div class="value">{{ $loan->user->name ?? '-' }}</div></div>
                    <div class="item"><div class="label">Alamat</div><div class="value">{{ $loan->user->alamat ?: 'Belum diisi' }}</div></div>
                    <div class="item"><div class="label">Judul Buku</div><div class="value">{{ $loan->book->judul ?? '-' }}</div></div>
                    <div class="item"><div class="label">Penulis</div><div class="value">{{ $loan->book->penulis ?? '-' }}</div></div>
                    <div class="item"><div class="label">Tanggal Pinjam</div><div class="value">{{ optional($loan->borrowed_at)->format('d M Y') }}</div></div>
                    <div class="item"><div class="label">Tanggal Kembali</div><div class="value">{{ optional($loan->due_at)->format('d M Y') }}</div></div>
                </div>
                <p class="note">Status buku akan menjadi Dipinjam setelah admin atau petugas menyetujui pengajuan ini.</p>
                <div class="signature-row">
                    <div class="signature-box">
                        Peminjam
                        <div class="signature-space"></div>
                        {{ $loan->user->name ?? '-' }}
                    </div>
                    <div class="signature-box">
                        Petugas
                        <div class="signature-space"></div>
                        {{ auth()->user()->name ?? 'Pustakara' }}
                    </div>
                </div>
            </div>
        </section>
    </main>
    @if (session('success'))
        <div class="modal-backdrop is-open" id="successModal" role="dialog" aria-modal="true" aria-labelledby="successTitle">
            <div class="modal-card">
                <div class="success-mark">✓</div>
                <h2 class="modal-title" id="successTitle">Peminjaman Berhasil Diajukan</h2>
                <p class="modal-text">{{ session('success') }}</p>
                <button type="button" class="btn btn-primary" id="closeSuccess">Lihat Bukti</button>
            </div>
        </div>

        <script>
            const successModal = document.getElementById('successModal');
            const closeSuccess = document.getElementById('closeSuccess');

            closeSuccess.addEventListener('click', function () {
                successModal.classList.remove('is-open');
            });

            successModal.addEventListener('click', function (event) {
                if (event.target === successModal) {
                    successModal.classList.remove('is-open');
                }
            });
        </script>
    @endif
</body>
</html>
