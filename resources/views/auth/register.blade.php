<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar - Pustakara Perpustakaan Digital</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Poppins', sans-serif;
      background: #f0f2f5;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }
    .page-label { padding: 10px 16px; font-size: 13px; color: #888; }
    .page-wrapper {
      width: 100%; flex: 1;
      display: flex; align-items: center; justify-content: center;
      padding: 20px;
    }
    .login-card {
      display: flex; width: 100%; max-width: 860px;
      background: #fff; border-radius: 16px; overflow: hidden;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    }

    /* LEFT */
    .left-panel {
      width: 42%; background: #c5dff0;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      padding: 2.5rem 2rem; gap: 1rem;
    }
    .logo-img { width: 150px; height: 150px; }
    .brand-name { font-size: 28px; font-weight: 700; color: #1a3a5c; letter-spacing: 2px; text-transform: uppercase; }
    .brand-sub { font-size: 11px; color: #2d5f8a; letter-spacing: 4px; text-transform: uppercase; }

    /* RIGHT */
    .right-panel {
      flex: 1; display: flex; flex-direction: column;
      justify-content: center; padding: 2.5rem 3rem;
    }
    h1 { font-size: 30px; font-weight: 700; color: #111; text-align: center; margin-bottom: 4px; }
    .subtitle { font-size: 14px; color: #777; text-align: center; margin-bottom: 1.5rem; }

    .form-group { margin-bottom: 0.9rem; }
    .form-group label { display: block; font-size: 13px; font-weight: 500; color: #333; margin-bottom: 5px; }
    .input-wrap { position: relative; display: flex; align-items: center; }
    .input-wrap .icon { position: absolute; left: 12px; color: #aaa; display: flex; align-items: center; }
    .input-wrap input,
    .input-wrap select {
      width: 100%; height: 42px;
      padding: 0 12px 0 40px;
      border: none; border-radius: 8px;
      background: #e9ecef; color: #333;
      font-size: 14px; font-family: 'Poppins', sans-serif;
      outline: none; transition: background 0.2s, box-shadow 0.2s;
      appearance: none;
    }
    .input-wrap input:focus,
    .input-wrap select:focus { background: #dce8f5; box-shadow: 0 0 0 2px rgba(39,121,189,0.25); }
    .input-wrap input.is-invalid,
    .input-wrap select.is-invalid { background: #fdecea; box-shadow: 0 0 0 2px rgba(220,53,69,0.2); }
    .select-arrow {
      position: absolute;
      right: 12px;
      color: #888;
      display: flex;
      align-items: center;
      pointer-events: none;
    }

    .invalid-feedback { font-size: 11px; color: #c0392b; margin-top: 4px; display: block; }

    .alert-error {
      background: #fdecea; color: #c0392b;
      border: 1px solid #f5c6cb;
      padding: 10px 14px; border-radius: 8px;
      font-size: 13px; margin-bottom: 1rem;
    }
    .alert-success {
      background: #eafaf1; color: #1e8449;
      border: 1px solid #a9dfbf;
      padding: 10px 14px; border-radius: 8px;
      font-size: 13px; margin-bottom: 1rem;
    }

    .btn-register {
      width: 100%; height: 46px;
      background: #2779BD; color: #fff;
      border: none; border-radius: 999px;
      font-size: 16px; font-weight: 600;
      font-family: 'Poppins', sans-serif;
      cursor: pointer; margin-top: 1rem;
      transition: background 0.2s, transform 0.1s;
    }
    .btn-register:hover { background: #1a5f9a; }
    .btn-register:active { transform: scale(0.98); }

    .login-row { text-align: center; margin-top: 1rem; font-size: 13px; color: #777; }
    .login-row a { color: #2779BD; text-decoration: none; font-weight: 600; }
    .login-row a:hover { text-decoration: underline; }

    @media (max-width: 640px) {
      .login-card { flex-direction: column; }
      .left-panel { width: 100%; min-height: 200px; }
      .right-panel { padding: 2rem 1.5rem; }
    }
  </style>
</head>
<body>

  <div class="page-label">daftar</div>

  <div class="page-wrapper">
    <div class="login-card">

      {{-- LEFT: Branding --}}
      <div class="left-panel">
        <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara" class="logo-img"/>
        <div class="brand-name">PUSTAKARA</div>
        <div class="brand-sub">P E R P U S T A K A A N &nbsp; D I G I T A L</div>
      </div>

      {{-- RIGHT: Form Register --}}
      <div class="right-panel">
        <h1>Daftar</h1>
        <p class="subtitle">Silakan daftar untuk melanjutkan</p>

        @if ($errors->any())
          <div class="alert-error">
            {{ $errors->first() }}
          </div>
        @endif

        @if (session('success'))
          <div class="alert-success">
            {{ session('success') }}
          </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}" autocomplete="off">
          @csrf
          <input type="text" name="fake_username" autocomplete="username" tabindex="-1" aria-hidden="true" style="position:absolute; left:-9999px; width:1px; height:1px; opacity:0;">
          <input type="password" name="fake_password" autocomplete="current-password" tabindex="-1" aria-hidden="true" style="position:absolute; left:-9999px; width:1px; height:1px; opacity:0;">

          {{-- Nama Pengguna --}}
          <div class="form-group">
            <label for="username">Nama Pengguna</label>
            <div class="input-wrap">
              <span class="icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <circle cx="12" cy="8" r="4" stroke="#aaa" stroke-width="2"/>
                  <path d="M4 20c0-4 3.582-7 8-7s8 3 8 7" stroke="#aaa" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </span>
              <input type="text" id="username" name="username"
                     value="{{ old('username') }}"
                     class="{{ $errors->has('username') ? 'is-invalid' : '' }}"
                     autocomplete="username"/>
            </div>
            @error('username') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          {{-- Email --}}
          <div class="form-group">
            <label for="email">Surel</label>
            <div class="input-wrap">
              <span class="icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <rect x="3" y="5" width="18" height="14" rx="2" stroke="#aaa" stroke-width="2"/>
                  <path d="M3 7l9 6 9-6" stroke="#aaa" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </span>
              <input type="email" id="email" name="email"
                     value="{{ old('email') }}"
                     class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                     autocomplete="email"/>
            </div>
            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          {{-- Password --}}
          <div class="form-group">
            <label for="password_display">Kata Sandi</label>
            <div class="input-wrap">
              <span class="icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <rect x="5" y="11" width="14" height="10" rx="2" stroke="#aaa" stroke-width="2"/>
                  <path d="M8 11V7a4 4 0 018 0v4" stroke="#aaa" stroke-width="2" stroke-linecap="round"/>
                  <circle cx="12" cy="16" r="1.5" fill="#aaa"/>
                </svg>
              </span>
              <input type="password" id="password_display" name="user_password_display"
                     value="{{ old('password') }}"
                     class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                     autocomplete="off"
                     readonly
                     autocapitalize="off"
                     autocorrect="off"
                     spellcheck="false"
                     data-lpignore="true"
                     data-1p-ignore="true"/>
              <input type="hidden" id="password" name="password" value="{{ old('password') }}">
            </div>
            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          {{-- Alamat --}}
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <div class="input-wrap">
              <span class="icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" stroke="#aaa" stroke-width="2"/>
                  <circle cx="12" cy="9" r="2.5" stroke="#aaa" stroke-width="2"/>
                </svg>
              </span>
              <select id="alamat" name="alamat"
                      class="{{ $errors->has('alamat') ? 'is-invalid' : '' }}">
                <option value="">Pilih kecamatan Kabupaten Bogor</option>
                <optgroup label="Kabupaten Bogor">
                  <option value="Kabupaten Bogor - Babakan Madang" {{ old('alamat') === 'Kabupaten Bogor - Babakan Madang' ? 'selected' : '' }}>Babakan Madang</option>
                  <option value="Kabupaten Bogor - Bojonggede" {{ old('alamat') === 'Kabupaten Bogor - Bojonggede' ? 'selected' : '' }}>Bojonggede</option>
                  <option value="Kabupaten Bogor - Caringin" {{ old('alamat') === 'Kabupaten Bogor - Caringin' ? 'selected' : '' }}>Caringin</option>
                  <option value="Kabupaten Bogor - Cariu" {{ old('alamat') === 'Kabupaten Bogor - Cariu' ? 'selected' : '' }}>Cariu</option>
                  <option value="Kabupaten Bogor - Ciampea" {{ old('alamat') === 'Kabupaten Bogor - Ciampea' ? 'selected' : '' }}>Ciampea</option>
                  <option value="Kabupaten Bogor - Ciawi" {{ old('alamat') === 'Kabupaten Bogor - Ciawi' ? 'selected' : '' }}>Ciawi</option>
                  <option value="Kabupaten Bogor - Cibinong" {{ old('alamat') === 'Kabupaten Bogor - Cibinong' ? 'selected' : '' }}>Cibinong</option>
                  <option value="Kabupaten Bogor - Cibungbulang" {{ old('alamat') === 'Kabupaten Bogor - Cibungbulang' ? 'selected' : '' }}>Cibungbulang</option>
                  <option value="Kabupaten Bogor - Cigombong" {{ old('alamat') === 'Kabupaten Bogor - Cigombong' ? 'selected' : '' }}>Cigombong</option>
                  <option value="Kabupaten Bogor - Cigudeg" {{ old('alamat') === 'Kabupaten Bogor - Cigudeg' ? 'selected' : '' }}>Cigudeg</option>
                  <option value="Kabupaten Bogor - Cijeruk" {{ old('alamat') === 'Kabupaten Bogor - Cijeruk' ? 'selected' : '' }}>Cijeruk</option>
                  <option value="Kabupaten Bogor - Cileungsi" {{ old('alamat') === 'Kabupaten Bogor - Cileungsi' ? 'selected' : '' }}>Cileungsi</option>
                  <option value="Kabupaten Bogor - Ciomas" {{ old('alamat') === 'Kabupaten Bogor - Ciomas' ? 'selected' : '' }}>Ciomas</option>
                  <option value="Kabupaten Bogor - Cisarua" {{ old('alamat') === 'Kabupaten Bogor - Cisarua' ? 'selected' : '' }}>Cisarua</option>
                  <option value="Kabupaten Bogor - Citeureup" {{ old('alamat') === 'Kabupaten Bogor - Citeureup' ? 'selected' : '' }}>Citeureup</option>
                  <option value="Kabupaten Bogor - Dramaga" {{ old('alamat') === 'Kabupaten Bogor - Dramaga' ? 'selected' : '' }}>Dramaga</option>
                  <option value="Kabupaten Bogor - Gunung Putri" {{ old('alamat') === 'Kabupaten Bogor - Gunung Putri' ? 'selected' : '' }}>Gunung Putri</option>
                  <option value="Kabupaten Bogor - Gunung Sindur" {{ old('alamat') === 'Kabupaten Bogor - Gunung Sindur' ? 'selected' : '' }}>Gunung Sindur</option>
                  <option value="Kabupaten Bogor - Jasinga" {{ old('alamat') === 'Kabupaten Bogor - Jasinga' ? 'selected' : '' }}>Jasinga</option>
                  <option value="Kabupaten Bogor - Jonggol" {{ old('alamat') === 'Kabupaten Bogor - Jonggol' ? 'selected' : '' }}>Jonggol</option>
                  <option value="Kabupaten Bogor - Kemang" {{ old('alamat') === 'Kabupaten Bogor - Kemang' ? 'selected' : '' }}>Kemang</option>
                  <option value="Kabupaten Bogor - Klapanunggal" {{ old('alamat') === 'Kabupaten Bogor - Klapanunggal' ? 'selected' : '' }}>Klapanunggal</option>
                  <option value="Kabupaten Bogor - Leuwiliang" {{ old('alamat') === 'Kabupaten Bogor - Leuwiliang' ? 'selected' : '' }}>Leuwiliang</option>
                  <option value="Kabupaten Bogor - Leuwisadeng" {{ old('alamat') === 'Kabupaten Bogor - Leuwisadeng' ? 'selected' : '' }}>Leuwisadeng</option>
                  <option value="Kabupaten Bogor - Megamendung" {{ old('alamat') === 'Kabupaten Bogor - Megamendung' ? 'selected' : '' }}>Megamendung</option>
                  <option value="Kabupaten Bogor - Nanggung" {{ old('alamat') === 'Kabupaten Bogor - Nanggung' ? 'selected' : '' }}>Nanggung</option>
                  <option value="Kabupaten Bogor - Pamijahan" {{ old('alamat') === 'Kabupaten Bogor - Pamijahan' ? 'selected' : '' }}>Pamijahan</option>
                  <option value="Kabupaten Bogor - Parung" {{ old('alamat') === 'Kabupaten Bogor - Parung' ? 'selected' : '' }}>Parung</option>
                  <option value="Kabupaten Bogor - Parung Panjang" {{ old('alamat') === 'Kabupaten Bogor - Parung Panjang' ? 'selected' : '' }}>Parung Panjang</option>
                  <option value="Kabupaten Bogor - Rancabungur" {{ old('alamat') === 'Kabupaten Bogor - Rancabungur' ? 'selected' : '' }}>Rancabungur</option>
                  <option value="Kabupaten Bogor - Rumpin" {{ old('alamat') === 'Kabupaten Bogor - Rumpin' ? 'selected' : '' }}>Rumpin</option>
                  <option value="Kabupaten Bogor - Sukajaya" {{ old('alamat') === 'Kabupaten Bogor - Sukajaya' ? 'selected' : '' }}>Sukajaya</option>
                  <option value="Kabupaten Bogor - Sukamakmur" {{ old('alamat') === 'Kabupaten Bogor - Sukamakmur' ? 'selected' : '' }}>Sukamakmur</option>
                  <option value="Kabupaten Bogor - Sukaraja" {{ old('alamat') === 'Kabupaten Bogor - Sukaraja' ? 'selected' : '' }}>Sukaraja</option>
                  <option value="Kabupaten Bogor - Tajurhalang" {{ old('alamat') === 'Kabupaten Bogor - Tajurhalang' ? 'selected' : '' }}>Tajurhalang</option>
                  <option value="Kabupaten Bogor - Tamansari" {{ old('alamat') === 'Kabupaten Bogor - Tamansari' ? 'selected' : '' }}>Tamansari</option>
                  <option value="Kabupaten Bogor - Tanjungsari" {{ old('alamat') === 'Kabupaten Bogor - Tanjungsari' ? 'selected' : '' }}>Tanjungsari</option>
                  <option value="Kabupaten Bogor - Tenjo" {{ old('alamat') === 'Kabupaten Bogor - Tenjo' ? 'selected' : '' }}>Tenjo</option>
                  <option value="Kabupaten Bogor - Tenjolaya" {{ old('alamat') === 'Kabupaten Bogor - Tenjolaya' ? 'selected' : '' }}>Tenjolaya</option>
                </optgroup>
              </select>
              <span class="select-arrow">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                  <path d="M6 9l6 6 6-6" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
            </div>
            @error('alamat') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <button type="submit" class="btn-register">Daftar</button>
        </form>

        <p class="login-row">Sudah punya akun? <a href="{{ route('login.user') }}">Masuk</a></p>
      </div>

    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const passwordDisplay = document.getElementById('password_display');
      const passwordHidden = document.getElementById('password');

      if (!passwordDisplay || !passwordHidden) {
        return;
      }

      const unlockPasswordField = function () {
        passwordDisplay.removeAttribute('readonly');
      };

      passwordDisplay.addEventListener('focus', unlockPasswordField, { once: true });
      passwordDisplay.addEventListener('click', unlockPasswordField, { once: true });
      passwordDisplay.addEventListener('input', function () {
        passwordHidden.value = passwordDisplay.value;
      });

      const form = passwordDisplay.closest('form');
      if (form) {
        form.addEventListener('submit', function () {
          passwordHidden.value = passwordDisplay.value;
        });
      }
    });
  </script>
</body>
</html>
