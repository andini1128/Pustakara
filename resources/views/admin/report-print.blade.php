<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Pustakara</title>
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        body { min-height:100vh; padding:28px; font-family:Arial,sans-serif; color:#141414; background:#eef4f8; }
        .page { max-width:1120px; margin:0 auto; background:#fff; padding:28px; border-radius:10px; box-shadow:0 18px 36px rgba(20,44,70,.12); }
        .toolbar { display:flex; justify-content:flex-end; gap:10px; margin-bottom:18px; }
        .btn { min-height:40px; border:0; border-radius:8px; padding:9px 14px; background:#006dff; color:#fff; font-family:Arial,sans-serif; font-size:13px; font-weight:700; text-decoration:none; cursor:pointer; }
        .btn-secondary { background:#526170; }
        .kop { display:flex; align-items:center; gap:14px; padding-bottom:16px; border-bottom:3px solid #123e7a; }
        .kop img { width:74px; height:auto; display:block; }
        .kop-title { color:#123e7a; font-size:24px; font-weight:800; line-height:1.2; }
        .kop-subtitle { margin-top:4px; color:#555; font-size:13px; font-weight:700; }
        .report-head { display:flex; justify-content:space-between; gap:20px; margin:20px 0 16px; }
        h1 { color:#111; font-size:24px; margin-bottom:6px; }
        .description { color:#555; font-size:13px; font-weight:700; }
        .meta { min-width:260px; border:1px solid #d8e0e8; border-radius:8px; overflow:hidden; }
        .meta-row { display:grid; grid-template-columns:110px 1fr; border-bottom:1px solid #d8e0e8; }
        .meta-row:last-child { border-bottom:0; }
        .meta-label, .meta-value { padding:8px 10px; font-size:12px; }
        .meta-label { background:#edf4fb; color:#123e7a; font-weight:800; }
        .meta-value { font-weight:700; }
        .table-wrap { width:100%; overflow-x:auto; }
        table { width:100%; border-collapse:collapse; border:1px solid #aeb8c6; }
        th, td { border:1px solid #aeb8c6; padding:9px 10px; text-align:left; vertical-align:top; font-size:12px; }
        th { background:#eaf2fb; color:#123e7a; font-weight:800; text-align:center; }
        td:first-child { text-align:center; width:48px; }
        .empty { padding:24px; text-align:center; color:#666; font-weight:700; border:1px solid #d8e0e8; }
        .signature { display:flex; justify-content:flex-end; margin-top:32px; page-break-inside:avoid; }
        .signature-box { width:250px; text-align:center; color:#111; font-size:12px; font-weight:700; line-height:1.5; }
        .signature-space { height:72px; }
        .signature-name { display:inline-block; min-width:210px; padding-top:4px; border-top:1px solid #111; font-size:12px; font-weight:700; }
        @media print {
            @page { size:A4 landscape; margin:12mm; }
            body { padding:0; background:#fff; }
            .page { max-width:none; padding:0; border-radius:0; box-shadow:none; }
            .toolbar { display:none; }
            th, td { font-size:10.5px; padding:7px 8px; }
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="toolbar">
            <a class="btn btn-secondary" href="{{ $backUrl ?? route('admin.reports') }}">Kembali</a>
            <button type="button" class="btn" onclick="window.print()">Cetak PDF</button>
        </div>

        <header class="kop">
            <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
            <div>
                <div class="kop-title">Pustakara</div>
                <div class="kop-subtitle">Laporan data perpustakaan</div>
            </div>
        </header>

        <section class="report-head">
            <div>
                <h1>{{ $title }}</h1>
                <p class="description">{{ $description }}</p>
            </div>
            <div class="meta">
                <div class="meta-row">
                    <div class="meta-label">Tanggal</div>
                    <div class="meta-value">{{ now()->format('d M Y') }}</div>
                </div>
                <div class="meta-row">
                    <div class="meta-label">Jumlah Data</div>
                    <div class="meta-value">{{ count($rows) }}</div>
                </div>
                <div class="meta-row">
                    <div class="meta-label">Dicetak Oleh</div>
                    <div class="meta-value">{{ auth()->user()->name ?? 'Admin' }}</div>
                </div>
            </div>
        </section>

        @if (count($rows))
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            @foreach ($columns as $column)
                                <th>{{ $column }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            <tr>
                                @foreach ($row as $cell)
                                    <td>{{ $cell }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty">Belum ada data untuk laporan ini.</div>
        @endif

        <div class="signature">
            <div class="signature-box">
                Bogor, {{ now()->format('d M Y') }}
                <div>Mengetahui,</div>
                <div class="signature-space"></div>
                <div class="signature-name">{{ auth()->user()->name ?? 'Admin' }}</div>
            </div>
        </div>
    </main>
</body>
</html>
