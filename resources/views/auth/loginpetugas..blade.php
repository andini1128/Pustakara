<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Masuk Petugas - Pustakara</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Poppins', sans-serif;
      background: #f0f2f5;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .login-card {
      display: flex;
      width: 100%;
      max-width: 860px;
      min-height: 520px;
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    }
    .left-panel {
      width: 42%;
      background: #c5dff0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 2.5rem 2rem;
      gap: 1rem;
    }
    .logo-img { width: 150px; height: 150px; }
    .brand-name {
      font-size: 28px; font-weight: 700;
      color: #1a3a5c; letter-spacing: 2px; text-transform: uppercase;
    }
    .brand-sub {
      font-size: 11px; color: #2d5f8a;
      letter-spacing: 4px; text-transform: uppercase;
    }
    .right-panel {
      flex: 1;
      display: flex; flex-direction: column;
      justify-content: center;
      padding: 3rem;
    }
    h1 { font-size: 32px; font-weight: 700; color: #111; text-align: center; margin-bottom: 6px; }
    .subtitle { font-size: 14px; color: #777; text-align: center; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.1rem; }
    .form-group label { display: block; font-size: 13px; font-weight: 500; color: #333; margin-bottom: 6px; }
    .input-wrap { position: relative; display: flex; align-items: center; }
    .input-wrap .icon { position: absolute; left: 12px; color: #aaa; display: flex; align-items: center; }
    .input-wrap input {
      width: 100%; height: 44px;
      padding: 0 12px 0 40px;
      border: none; border-radius: 8px;
      background: #e9ecef; color: #333;
      font-size: 14px; font-family: 'Poppins', sans-serif;
      outline: none; transition: background 0.2s, box-shadow 0.2s;
    }
    .input-wrap input:focus { background: #dce8f5; box-shadow: 0 0 0 2px rgba(39,121,189,0.25); }
    .alert-error {
      background: #fdecea; color: #c0392b;
      border: 1px solid #f5c6cb;
      padding: 10px 14px; border-radius: 8px;
      font-size: 13px; margin-bottom: 1rem;
    }
    .btn-login {
      width: 100%; height: 48px;
      background: #2779BD; color: #fff;
      border: none; border-radius: 999px;
      font-size: 16px; font-weight: 600;
      font-family: 'Poppins', sans-serif;
      cursor: pointer; margin-top: 1.25rem;
      transition: background 0.2s, transform 0.1s;
    }
    .btn-login:hover { background: #1a5f9a; }
    .btn-login:active { transform: scale(0.98); }
    .register-row { text-align: center; margin-top: 1.25rem; font-size: 13px; color: #777; }
    .register-row a { color: #2779BD; text-decoration: none; font-weight: 600; }
    .register-row a:hover { text-decoration: underline; }
    @media (max-width: 640px) {
      .login-card { flex-direction: column; }
      .left-panel { width: 100%; min-height: 200px; }
      .right-panel { padding: 2rem 1.5rem; }
    }
  </style>
</head>
<body>
<div class="login-card">

  {{-- LEFT PANEL --}}
  <div class="left-panel">
    <img src="asset/logopustakara.png" alt="Logo Pustakara" class="logo-img"/>
    <div class="brand-name">PUSTAKARA</div>
    <div class="brand-sub">P E R P U S T A K A A N &nbsp; D I G I T A L</div>
  </div>

  {{-- RIGHT PANEL --}}
  <div class="right-panel">
    <h1>Masuk</h1>
    <p class="subtitle">Silakan masuk untuk melanjutkan</p>

    {{-- Pesan error dari Laravel --}}
    @if ($errors->any())
      <div class="alert-error">
        {{ $errors->first() }}
      </div>
    @endif

    @if (session('error'))
      <div class="alert-error">
        {{ session('error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf

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
                 value="{{ old('username') }}" autocomplete="username"/>
        </div>
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <div class="input-wrap">
          <span class="icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
              <rect x="5" y="11" width="14" height="10" rx="2" stroke="#aaa" stroke-width="2"/>
              <path d="M8 11V7a4 4 0 018 0v4" stroke="#aaa" stroke-width="2" stroke-linecap="round"/>
              <circle cx="12" cy="16" r="1.5" fill="#aaa"/>
            </svg>
          </span>
          <input type="password" id="password" name="password" autocomplete="current-password"/>
        </div>
      </div>

      <button type="submit" class="btn-login">Masuk</button>
    </form>   
</div>
</body>
</html>
