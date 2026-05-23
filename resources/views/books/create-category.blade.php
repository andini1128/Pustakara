<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #b9cbd9;
            --panel: #ffffff;
            --blue: #006dff;
            --navy: #123e7a;
            --ink: #16202a;
            --muted: rgba(22, 32, 42, 0.62);
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-card {
            width: min(720px, 100%);
            border-radius: 28px;
            background: var(--panel);
            box-shadow: var(--shadow);
            padding: 30px;
        }

        h1 {
            color: var(--navy);
            font-size: clamp(28px, 3vw, 40px);
            font-weight: 800;
            margin-bottom: 8px;
        }

        p {
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: rgba(22, 32, 42, 0.72);
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
        }

        input {
            width: 100%;
            border: 1px solid #d6e5f4;
            border-radius: 16px;
            padding: 14px 16px;
            font: inherit;
            font-weight: 600;
            outline: none;
        }

        .error {
            margin-top: 8px;
            color: #b42318;
            font-size: 12px;
            font-weight: 700;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
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
            background: #eef6ff;
            color: var(--blue);
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

        @media (max-width: 640px) {
            .content {
                align-items: flex-start;
                padding: 20px 16px;
            }
            .form-card { padding: 24px; }
        }
    </style>
</head>
<body>
    <div class="layout">
        @include('partials.admin-sidebar', ['activeMenu' => 'categories'])

        <main class="content">
            <section class="form-card">
                <h1>Tambah Kategori</h1>
                <p>Masukkan nama kategori baru untuk koleksi buku.</p>

                <form action="{{ route('books.categories.store') }}" method="POST">
                    @csrf

                    <div>
                        <label for="nama">Kategori</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('books.categories') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
