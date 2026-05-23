<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Profil - Pustakara</title>
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
            width: min(880px, calc(100% - 48px));
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

        .form-card {
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.78);
            box-shadow: 0 18px 36px rgba(52, 94, 148, 0.14);
            padding: 32px;
        }

        .form-title {
            margin-bottom: 24px;
            text-align: center;
        }

        .form-title h1 {
            font-size: clamp(30px, 4vw, 42px);
            color: var(--navy);
            font-weight: 800;
            margin-bottom: 8px;
        }

        .form-title p {
            color: rgba(29, 29, 31, 0.66);
            font-weight: 500;
        }

        .photo-row {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 24px;
            padding: 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.68);
        }

        .avatar-preview {
            width: 104px;
            height: 104px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            background: rgba(31, 108, 224, 0.1);
            color: var(--blue);
            overflow: hidden;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .avatar-preview svg {
            width: 62px;
            height: 62px;
        }

        .photo-help {
            color: rgba(29, 29, 31, 0.62);
            font-size: 13px;
            line-height: 1.6;
            font-weight: 600;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: rgba(29, 29, 31, 0.68);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        input,
        textarea {
            width: 100%;
            border: 0;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.9);
            color: var(--dark);
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 600;
            outline: none;
            padding: 14px 16px;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        input[type="file"] {
            padding: 12px;
        }

        .error {
            margin-top: 7px;
            color: #b42318;
            font-size: 12px;
            font-weight: 700;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .btn {
            border: 0;
            min-height: 48px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--blue);
            color: var(--white);
            box-shadow: 0 14px 24px rgba(31, 108, 224, 0.18);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.78);
            color: var(--blue);
        }

        @media (max-width: 680px) {
            .page {
                width: min(100% - 32px, 880px);
                padding-top: 22px;
            }

            .topbar,
            .photo-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-card {
                padding: 24px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @php($user = auth()->user())

    <main class="page">
        <header class="topbar">
            <a href="{{ route('dashboard.user') }}" class="brand" aria-label="Pustakara">
                <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
            </a>

            <a href="{{ route('profile.user') }}" class="back-link">Kembali ke Profil</a>
        </header>

        <section class="form-card">
            <div class="form-title">
                <h1>Ubah Profil</h1>
                <p>Perbarui informasi akun dan foto profil kamu.</p>
            </div>

            <form method="POST" action="{{ route('profile.user.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="photo-row">
                    <div class="avatar-preview" aria-hidden="true">
                        @if ($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="">
                        @else
                            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="32" cy="32" r="24" stroke="currentColor" stroke-width="3.5" opacity="0.9"/>
                                <circle cx="32" cy="25" r="8" stroke="currentColor" stroke-width="3.5"/>
                                <path d="M20 46C20 39.373 25.373 34 32 34C38.627 34 44 39.373 44 46" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        @endif
                    </div>

                    <div class="field full">
                        <label for="profile_photo">Foto Profil</label>
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/png,image/jpeg,image/webp">
                        <p class="photo-help">Gunakan gambar JPG, PNG, atau WEBP. Ukuran maksimal 2 MB.</p>
                        @error('profile_photo')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-grid">
                    <div class="field">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="username">Nama Pengguna</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                        @error('username')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field full">
                        <label for="email">Surel</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field full">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ route('profile.user') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Profil</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
