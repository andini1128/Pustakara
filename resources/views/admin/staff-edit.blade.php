<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Petugas - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --bg:#b9cbd9; --panel:#fff; --soft:#eef6ff; --blue:#006dff; --navy:#123e7a; --ink:#16202a; --muted:rgba(22,32,42,.62); --shadow:0 22px 40px rgba(69,102,130,.14); }
        body { min-height:100vh; font-family:'Poppins',sans-serif; background:var(--bg); color:var(--ink); }
        .layout { min-height:100vh; display:grid; grid-template-columns:395px 1fr; }
        .sidebar { background:linear-gradient(180deg,#9fd0f7 0%,#94c9f4 100%); padding:30px 24px 26px; display:flex; flex-direction:column; box-shadow:inset -1px 0 0 rgba(255,255,255,.2); }
        .brand { display:flex; justify-content:center; padding-top:6px; margin-bottom:30px; }
        .brand img { width:128px; height:auto; display:block; }
        .sidebar-divider { height:2px; background:rgba(255,255,255,.65); margin:0 6px 34px; }
        .sidebar-nav { display:flex; flex-direction:column; gap:10px; }
        .nav-item { display:inline-flex; align-items:center; gap:18px; min-height:58px; margin:0 18px; padding:14px 18px; border-radius:18px; color:#fff; text-decoration:none; font-size:20px; font-weight:500; }
        .nav-item svg { width:30px; height:30px; stroke:currentColor; flex:0 0 auto; }
        .nav-item.active { background:#c8b597; color:#fff; box-shadow:0 14px 26px rgba(126,104,73,.18); }
        .nav-item:hover { background:rgba(255,255,255,.2); }
        .sidebar-footer { margin-top:auto; padding:28px 18px 4px; }
        .logout-btn { width:100%; min-height:58px; border:0; border-radius:16px; background:#7a6da4; color:#fff; font-family:'Poppins',sans-serif; font-size:21px; display:inline-flex; align-items:center; justify-content:center; gap:10px; cursor:pointer; box-shadow:0 16px 24px rgba(76,62,112,.18); }
        .logout-btn svg { width:26px; height:26px; stroke:currentColor; }
        .content { padding:32px; min-width:0; display:flex; align-items:center; justify-content:center; }
        .form-card { width:min(760px,100%); border-radius:28px; background:var(--panel); box-shadow:var(--shadow); padding:30px; }
        h1 { color:var(--navy); font-size:clamp(28px,3vw,40px); font-weight:800; margin-bottom:8px; }
        p { color:var(--muted); font-weight:600; margin-bottom:24px; line-height:1.7; }
        .form-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:16px; }
        .form-group.full { grid-column:1 / -1; }
        label { display:block; margin-bottom:8px; color:rgba(22,32,42,.72); font-size:13px; font-weight:800; text-transform:uppercase; }
        input,
        select { width:100%; border:1px solid #d6e5f4; border-radius:16px; padding:14px 16px; font:inherit; font-weight:600; outline:none; background:#fff; }
        input:focus,
        select:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(0,109,255,.14); }
        .hint { color:var(--muted); font-size:12px; font-weight:700; margin-top:7px; line-height:1.5; }
        .error { margin-top:8px; color:#b42318; font-size:12px; font-weight:700; }
        .actions { display:flex; align-items:center; gap:12px; margin-top:24px; flex-wrap:wrap; }
        .btn { border:0; min-height:46px; border-radius:999px; display:inline-flex; align-items:center; justify-content:center; padding:10px 20px; font-family:'Poppins',sans-serif; font-size:14px; font-weight:800; cursor:pointer; text-decoration:none; }
        .btn-primary { background:var(--blue); color:#fff; box-shadow:0 14px 24px rgba(0,109,255,.18); }
        .btn-secondary { background:var(--soft); color:var(--blue); }
        @media (max-width:1280px){ .layout{grid-template-columns:320px 1fr;} }
        @media (max-width:900px){ .layout{grid-template-columns:1fr;} .sidebar{gap:18px;} .sidebar-nav{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;} .sidebar-footer{margin-top:0;} .nav-item{margin:0; font-size:18px;} }
        @media (max-width:640px){ .content{align-items:flex-start; padding:20px 16px;} .form-card{padding:24px;} .form-grid{grid-template-columns:1fr;} .form-group.full{grid-column:auto;} .btn{width:100%;} .sidebar-nav{grid-template-columns:1fr;} }
    </style>
</head>
<body>
    @php
        $bogorDistricts = [
            'Babakan Madang', 'Bojonggede', 'Caringin', 'Cariu', 'Ciampea', 'Ciawi', 'Cibinong', 'Cibungbulang',
            'Cigombong', 'Cigudeg', 'Cijeruk', 'Cileungsi', 'Ciomas', 'Cisarua', 'Citeureup', 'Dramaga',
            'Gunung Putri', 'Gunung Sindur', 'Jasinga', 'Jonggol', 'Kemang', 'Klapanunggal', 'Leuwiliang',
            'Leuwisadeng', 'Megamendung', 'Nanggung', 'Pamijahan', 'Parung', 'Parung Panjang', 'Rancabungur',
            'Rumpin', 'Sukajaya', 'Sukamakmur', 'Sukaraja', 'Tajurhalang', 'Tamansari', 'Tanjungsari', 'Tenjo',
            'Tenjolaya',
        ];
    @endphp
    <div class="layout">
        @include('partials.admin-sidebar', ['activeMenu' => 'staff'])

        <main class="content">
            <section class="form-card">
                <h1>Ubah Petugas</h1>
                <p>Perbarui data akun petugas. Kosongkan kata sandi jika tidak ingin menggantinya.</p>

                <form action="{{ route('admin.staff.update', $user) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Nama Petugas</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label for="username">Nama Pengguna</label>
                            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                            @error('username')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Surel</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi Baru</label>
                            <input type="password" id="password" name="password">
                            <div class="hint">Minimal 6 karakter, boleh dikosongkan.</div>
                            @error('password')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group full">
                            <label for="alamat">Alamat</label>
                            <select id="alamat" name="alamat">
                                <option value="">Pilih wilayah Bogor</option>
                                @foreach ($bogorDistricts as $district)
                                    @php($value = 'Kabupaten Bogor - ' . $district)
                                    <option value="{{ $value }}" {{ old('alamat', $user->alamat) === $value ? 'selected' : '' }}>{{ $district }}</option>
                                @endforeach
                            </select>
                            @error('alamat')<div class="error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.staff') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
