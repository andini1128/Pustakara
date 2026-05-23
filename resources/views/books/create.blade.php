<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Pustakara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #d8ecff 0%, #eef7ff 100%);
            color: #1b3557;
            padding: 24px;
        }
        .wrap {
            width: min(760px, 100%);
            margin: 0 auto;
            background: #fff;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 20px 45px rgba(39, 88, 148, 0.12);
        }
        h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }
        p {
            color: #6a7c92;
            margin-bottom: 24px;
        }
        .errors {
            background: #fff1f1;
            color: #b53a4d;
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 18px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .field.full { grid-column: 1 / -1; }
        label {
            font-size: 14px;
            font-weight: 600;
        }
        input, select, textarea {
            width: 100%;
            border: 1px solid #d6e5f4;
            border-radius: 14px;
            padding: 12px 14px;
            font: inherit;
            background: #fff;
        }
        .field-hint {
            color: #6a7c92;
            font-size: 12px;
            margin-bottom: 0;
        }
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        .actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
        }
        .btn, .btn-secondary {
            border: none;
            border-radius: 999px;
            padding: 12px 20px;
            font: inherit;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }
        .btn {
            background: #1f6fd6;
            color: #fff;
        }
        .btn-secondary {
            background: #fff;
            color: #1b3557;
            border: 1px solid #d6e5f4;
        }
        @media (max-width: 640px) {
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <h1>Tambah Buku</h1>
        <p>Isi data buku baru untuk dimasukkan ke database perpustakaan.</p>

        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid">
                <div class="field">
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required>
                </div>
                <div class="field">
                    <label for="penulis">Penulis</label>
                    <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}" required>
                </div>
                <div class="field">
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori" required>
                        <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->nama }}" {{ old('kategori') === $category->nama ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
                </div>
                <div class="field">
                    <label for="tahun_terbit">Tahun Terbit</label>
                    <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}">
                </div>
                <div class="field">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" value="{{ old('stok', 0) }}" min="0" required>
                </div>
                <div class="field full">
                    <label for="cover">Cover Buku</label>
                    <input type="file" id="cover" name="cover" accept="image/png,image/jpeg,image/webp">
                    <p class="field-hint">Pilih gambar dari file manager. Format JPG, PNG, atau WEBP, maksimal 2 MB.</p>
                </div>
                <div class="field full">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="btn">Simpan Buku</button>
                <a href="{{ route('books.index') }}" class="btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
