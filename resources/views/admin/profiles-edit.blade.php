<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Admin - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        :root { --bg:#b9cbd9; --panel:#fff; --soft:#eef6ff; --blue:#006dff; --navy:#123e7a; --ink:#16202a; --muted:rgba(22,32,42,.62); --danger:#c0392b; --shadow:0 22px 40px rgba(69,102,130,.14); }
        body { min-height:100vh; font-family:'Poppins',sans-serif; background:var(--bg); color:var(--ink); }
        .layout { min-height:100vh; display:grid; grid-template-columns:395px 1fr; }
        .sidebar { background:linear-gradient(180deg,#9fd0f7 0%,#94c9f4 100%); padding:30px 24px 26px; display:flex; flex-direction:column; box-shadow:inset -1px 0 0 rgba(255,255,255,.2); }
        .brand { display:flex; justify-content:center; padding-top:6px; margin-bottom:30px; }
        .brand img { width:128px; height:auto; display:block; }
        .sidebar-divider { height:2px; background:rgba(255,255,255,.65); margin:0 6px 34px; }
        .sidebar-nav { display:flex; flex-direction:column; gap:10px; }
        .nav-item { display:inline-flex; align-items:center; gap:18px; min-height:58px; margin:0 18px; padding:14px 18px; border-radius:18px; color:#fff; text-decoration:none; font-size:20px; font-weight:500; }
        .nav-item svg { width:30px; height:30px; stroke:currentColor; flex:0 0 auto; }
        .nav-item.active { background:#c8b597; box-shadow:0 14px 26px rgba(126,104,73,.18); }
        .nav-item:hover { background:rgba(255,255,255,.2); }
        .sidebar-footer { margin-top:auto; padding:28px 18px 4px; }
        .logout-btn { width:100%; min-height:58px; border:0; border-radius:16px; background:#7a6da4; color:#fff; font-family:'Poppins',sans-serif; font-size:21px; display:inline-flex; align-items:center; justify-content:center; gap:10px; cursor:pointer; box-shadow:0 16px 24px rgba(76,62,112,.18); }
        .logout-btn svg { width:26px; height:26px; stroke:currentColor; }
        .content { padding:32px; min-width:0; }
        .panel { border-radius:28px; background:var(--panel); box-shadow:var(--shadow); padding:30px; }
        .panel-header { display:flex; justify-content:space-between; align-items:center; gap:18px; margin-bottom:24px; }
        .panel-title h1 { color:var(--navy); font-size:clamp(28px,3vw,42px); font-weight:800; margin-bottom:6px; }
        .panel-title p { color:var(--muted); font-weight:600; line-height:1.6; }
        .back-link { display:inline-flex; align-items:center; justify-content:center; min-height:42px; border-radius:999px; padding:10px 16px; background:var(--soft); color:var(--blue); text-decoration:none; font-size:13px; font-weight:800; }
        .photo-row { display:flex; align-items:center; gap:18px; margin-bottom:22px; padding:18px; border-radius:18px; background:var(--soft); }
        .avatar { width:96px; height:96px; border-radius:24px; background:var(--blue); color:#fff; display:flex; align-items:center; justify-content:center; font-size:32px; font-weight:800; overflow:hidden; flex:0 0 auto; }
        .avatar img { width:100%; height:100%; object-fit:cover; display:block; }
        .form-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:16px; }
        .field.full { grid-column:1 / -1; }
        label { display:block; margin-bottom:8px; color:var(--navy); font-size:12px; font-weight:800; text-transform:uppercase; }
        input, select, textarea { width:100%; border:0; border-radius:14px; background:var(--soft); color:var(--ink); font:inherit; font-size:14px; font-weight:600; padding:13px 15px; outline:none; }
        textarea { min-height:104px; resize:vertical; }
        input[type="file"] { padding:11px; }
        .help { color:var(--muted); font-size:12px; font-weight:700; line-height:1.6; margin-top:8px; }
        .error { margin-top:7px; color:var(--danger); font-size:12px; font-weight:700; }
        .actions { display:flex; justify-content:flex-end; gap:10px; flex-wrap:wrap; margin-top:22px; }
        .btn { border:0; min-height:44px; border-radius:999px; padding:10px 20px; display:inline-flex; align-items:center; justify-content:center; font:inherit; font-size:14px; font-weight:800; text-decoration:none; cursor:pointer; }
        .btn-primary { background:var(--blue); color:#fff; }
        .btn-secondary { background:var(--soft); color:var(--blue); }
        @media (max-width:1280px){ .layout{grid-template-columns:320px 1fr;} }
        @media (max-width:900px){ .layout{grid-template-columns:1fr;} .sidebar{gap:18px;} .sidebar-nav{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px;} .sidebar-footer{margin-top:0;} .nav-item{margin:0; font-size:18px;} .panel-header,.photo-row{align-items:flex-start; flex-direction:column;} }
        @media (max-width:640px){ .content{padding:20px 16px;} .panel{padding:24px;} .form-grid,.sidebar-nav{grid-template-columns:1fr;} .btn,.back-link{width:100%;} }
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
        $selectedAddress = old('alamat', $user->alamat);
    @endphp
    <div class="layout">
        @include('partials.admin-sidebar', ['activeMenu' => 'profiles'])

        <main class="content">
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <h1>Edit Profil Admin</h1>
                        <p>Perbarui informasi akun admin dan foto profil.</p>
                    </div>
                    <a href="{{ route('admin.profiles') }}" class="back-link">Kembali</a>
                </div>

                <form method="POST" action="{{ route('admin.profiles.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="photo-row">
                        <div class="avatar">
                            @if ($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="">
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="field full">
                            <label for="profile_photo">Foto Profil</label>
                            <input type="file" id="profile_photo" name="profile_photo" accept="image/png,image/jpeg,image/webp">
                            <p class="help">Gunakan JPG, PNG, atau WEBP. Maksimal 2 MB.</p>
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
                        <div class="field">
                            <label for="email">Surel</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')<div class="error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field">
                            <label for="password">Kata Sandi Baru</label>
                            <input type="password" id="password" name="password">
                            @error('password')<div class="error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field full">
                            <label for="alamat">Alamat</label>
                            <select id="alamat" name="alamat">
                                <option value="">Pilih wilayah Bogor</option>
                                @foreach ($bogorDistricts as $district)
                                    @php($value = 'Kabupaten Bogor - ' . $district)
                                    <option value="{{ $value }}" {{ $selectedAddress === $value ? 'selected' : '' }}>{{ $district }}</option>
                                @endforeach
                            </select>
                            @error('alamat')<div class="error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="actions">
                        <a href="{{ route('admin.profiles') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Profil</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
