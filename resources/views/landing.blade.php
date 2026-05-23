<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pustakara - Perpustakaan Digital</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --blue: #2779BD;
      --blue-dark: #1a5f9a;
      --blue-light: #c5dff0;
      --blue-bg: #dceef8;
      --navy: #1a3a5c;
      --white: #ffffff;
      --gray-text: #555;
      --radius: 14px;
      --page-x: clamp(1.5rem, 4vw, 4.5rem);
    }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Poppins', sans-serif;
      background: #f0f2f5;
      color: #333;
    }
    nav {
      background: #fff;
      padding: 0 var(--page-x);
      min-height: 68px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 999;
      box-shadow: 0 1px 8px rgba(0,0,0,0.08);
      gap: 16px;
    }
    .nav-logo {
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
    }
    .nav-logo img { width: 40px; height: 40px; object-fit: contain; }
    .nav-logo span {
      font-size: 16px;
      font-weight: 700;
      color: var(--navy);
      letter-spacing: 1px;
    }
    .nav-links {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      list-style: none;
    }
    .nav-right {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-left: auto;
    }
    .nav-links a {
      text-decoration: none;
      font-size: 13px;
      color: #555;
      font-weight: 500;
    }
    .nav-buttons {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }
    .btn-outline,
    .btn-solid,
    .btn-hero {
      text-decoration: none;
      font-family: 'Poppins', sans-serif;
      transition: all 0.2s;
      border-radius: 999px;
      font-weight: 600;
    }
    .btn-outline {
      padding: 8px 20px;
      border: 1.5px solid var(--blue);
      background: transparent;
      color: var(--blue);
      font-size: 13px;
    }
    .btn-outline:hover { background: var(--blue); color: #fff; }
    .btn-solid {
      padding: 8px 20px;
      border: 1.5px solid var(--blue);
      background: var(--blue);
      color: #fff;
      font-size: 13px;
    }
    .btn-solid:hover { background: var(--blue-dark); }
    .hero {
      background: var(--blue-light);
      padding: 5rem var(--page-x) 6.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: clamp(2rem, 7vw, 7rem);
      min-height: 620px;
    }
    .hero-text { max-width: 480px; }
    .hero-text h1 {
      font-size: 32px;
      font-weight: 800;
      color: var(--navy);
      line-height: 1.25;
      margin-bottom: 1rem;
    }
    .hero-text p {
      font-size: 14px;
      color: #3a5a7a;
      line-height: 1.8;
      margin-bottom: 1.5rem;
      max-width: 360px;
    }
    .hero-text .tagline {
      font-size: 13px;
      color: #2d5f8a;
      font-weight: 500;
      margin-bottom: 1.5rem;
    }
    .btn-hero {
      display: inline-block;
      padding: 10px 32px;
      background: var(--white);
      color: var(--blue);
      border: 2px solid var(--blue);
      font-size: 14px;
    }
    .btn-hero:hover { background: var(--blue); color: #fff; }
    .hero-illustration img {
      width: min(360px, 80vw);
      height: auto;
      display: block;
      filter: drop-shadow(0 12px 28px rgba(0,0,0,0.12));
    }
    .section-koleksi {
      background: var(--blue-bg);
      padding: 3.75rem var(--page-x) 4.75rem;
      scroll-margin-top: 86px;
    }
    .section-title {
      text-align: center;
      font-size: clamp(24px, 3vw, 34px);
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 0.7rem;
      letter-spacing: 1px;
    }
    .section-subtitle {
      text-align: center;
      color: #537396;
      margin: 0 auto 2.25rem;
      max-width: 760px;
      line-height: 1.7;
      font-size: 14px;
    }
    .book-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 1.25rem;
      max-width: 1280px;
      margin: 0 auto;
    }
    .book-card {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid rgba(39, 121, 189, 0.14);
      box-shadow: 0 12px 32px rgba(15, 35, 68, 0.08);
      display: flex;
      flex-direction: column;
      min-height: 100%;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .book-card:hover { transform: translateY(-5px); box-shadow: 0 18px 45px rgba(34, 82, 124, 0.18); }
    .book-cover {
      position: relative;
      width: 100%;
      aspect-ratio: 2/3;
      background: #d8e4ef;
      overflow: hidden;
    }
    .book-cover::after {
      content: "";
      position: absolute;
      inset: auto 0 0;
      height: 42%;
      background: linear-gradient(180deg, rgba(17,36,61,0), rgba(17,36,61,0.58));
    }
    .book-cover img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.3s;
    }
    .book-card:hover .book-cover img { transform: scale(1.04); }
    .book-badge {
      position: absolute;
      left: 12px;
      bottom: 12px;
      z-index: 1;
      display: inline-flex;
      align-items: center;
      min-height: 28px;
      padding: 6px 10px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.92);
      color: var(--blue-dark);
      font-size: 11px;
      font-weight: 800;
    }
    .book-content {
      padding: 15px;
      display: flex;
      flex: 1;
      flex-direction: column;
    }
    .book-title {
      font-size: 15px;
      font-weight: 800;
      color: var(--navy);
      line-height: 1.4;
      margin-bottom: 7px;
    }
    .book-meta {
      font-size: 12px;
      color: #6380a0;
      margin-bottom: 8px;
      line-height: 1.5;
    }
    .book-desc {
      font-size: 12px;
      color: #526174;
      line-height: 1.7;
      min-height: 82px;
    }
    .book-stock {
      margin-top: auto;
      padding-top: 14px;
      font-size: 12px;
      font-weight: 800;
      color: #168a4a;
    }
    .section-about {
      background: var(--white);
      padding: 3.5rem var(--page-x);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 3rem;
    }
    .about-text { max-width: 500px; }
    .about-text h2 {
      font-size: 26px;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 1rem;
    }
    .about-text p {
      font-size: 13.5px;
      color: var(--gray-text);
      line-height: 1.85;
    }
    .about-illustration img {
      width: min(260px, 100%);
      height: auto;
      display: block;
    }
    footer {
      background: var(--blue-light);
      padding: 2rem var(--page-x);
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 2rem;
      flex-wrap: wrap;
    }
    .footer-info p {
      font-size: 12.5px;
      color: #3a5a7a;
      line-height: 2;
    }
    .footer-copy {
      font-size: 11px;
      color: #5a7a9a;
      text-align: right;
    }
    @media (max-width: 1100px) {
      .book-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 900px) {
      .book-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
      nav { padding: 1rem; flex-wrap: wrap; }
      .nav-right { width: 100%; justify-content: flex-end; }
      .nav-links { display: none; }
      .hero {
        flex-direction: column;
        min-height: 680px;
        padding: 3.5rem 1.5rem 4.75rem;
        text-align: center;
      }
      .hero-text p { margin: 0 auto 1.5rem; }
      .section-koleksi { padding: 3rem 1.5rem 3.5rem; }
      .section-about { flex-direction: column; padding: 2.5rem 1.5rem; }
      footer { padding: 2rem 1.5rem; flex-direction: column; }
      .footer-copy { text-align: left; }
    }
    @media (max-width: 560px) {
      .book-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  @php
    $assetBooks = collect([
      [
        'judul' => 'Laskar Pelangi',
        'penulis' => 'Andrea Hirata',
        'kategori' => 'Novel Inspiratif',
        'deskripsi' => 'Kisah perjuangan anak-anak Belitung dalam meraih pendidikan dan mimpi mereka.',
        'stok' => 12,
        'cover' => asset('asset/bukulaskar.jpg'),
      ],
      [
        'judul' => 'Fantasi Nusantara',
        'penulis' => 'Koleksi Pilihan',
        'kategori' => 'Fantasi',
        'deskripsi' => 'Petualangan penuh imajinasi yang membawa pembaca ke dunia magis dan menegangkan.',
        'stok' => 8,
        'cover' => asset('asset/bukufantasi.jpg'),
      ],
      [
        'judul' => 'Jejak Sejarah',
        'penulis' => 'Koleksi Edukasi',
        'kategori' => 'Sejarah',
        'deskripsi' => 'Rangkuman peristiwa penting yang membantu pembaca memahami perjalanan masa lalu.',
        'stok' => 10,
        'cover' => asset('asset/bukusejarah.png'),
      ],
      [
        'judul' => "why don't we?",
        'penulis' => 'Tidak diketahui',
        'kategori' => 'Romantis',
        'deskripsi' => 'Kisah romantis tentang keberanian membuka hati dan memilih kesempatan kedua.',
        'stok' => 5,
        'cover' => asset('asset/bukuromantis.jpg'),
      ],
    ]);

    $landingBooks = $assetBooks;
  @endphp

  <nav>
    <a class="nav-logo" href="{{ route('landing') }}">
      <img src="{{ asset('asset/logopustakara.png') }}" alt="Logo Pustakara">
      <span>PUSTAKARA</span>
    </a>

    <div class="nav-right">
      <ul class="nav-links">
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#kontak">Kontak</a></li>
      </ul>

      <div class="nav-buttons">
        <a href="{{ route('login.user') }}" class="btn-outline">Masuk</a>
        <a href="{{ route('register') }}" class="btn-solid">Daftar</a>
      </div>
    </div>
  </nav>

  <section class="hero" id="beranda">
    <div class="hero-text">
      <h1>SELAMAT DATANG<br>DI PERPUSTAKAAN<br>KAMI</h1>
      <p>Pustakara membantu siswa dan pustakawan mengelola pinjaman buku secara mudah dan menarik.</p>
      <p class="tagline">Koleksi buku di landing page sekarang ditampilkan dari aset cover yang sudah disiapkan.</p>
      <a href="#koleksi" class="btn-hero">Lihat Koleksi</a>
    </div>

    <div class="hero-illustration">
      <img src="{{ asset('asset/tumpukanbuku.png') }}" alt="Tumpukan buku">
    </div>
  </section>

  <section class="section-koleksi" id="koleksi">
    <h2 class="section-title">KOLEKSI BUKU</h2>
    <p class="section-subtitle">
      Temukan bacaan inspiratif, fantasi, sejarah, dan romantis yang siap menemani waktu belajar dan bersantai.
    </p>

    <div class="book-grid">
      @foreach ($landingBooks as $book)
        <div class="book-card">
          <div class="book-cover">
            @if (!empty(data_get($book, 'cover')))
              <img src="{{ data_get($book, 'cover') }}" alt="{{ data_get($book, 'judul') }}">
            @else
              <img src="{{ asset('asset/tumpukanbuku.png') }}" alt="{{ data_get($book, 'judul') }}">
            @endif
            <span class="book-badge">{{ data_get($book, 'kategori') }}</span>
          </div>
          <div class="book-content">
            <p class="book-title">{{ data_get($book, 'judul') }}</p>
            <p class="book-meta">{{ data_get($book, 'penulis') }}</p>
            <p class="book-desc">{{ data_get($book, 'deskripsi') ?: 'Deskripsi buku belum ditambahkan.' }}</p>
            <p class="book-stock">Stok tersedia: {{ data_get($book, 'stok') }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <section class="section-about" id="about">
    <div class="about-text">
      <h2>About Us</h2>
      <p>
        Perpustakaan digital atau <em>digital library</em> adalah koleksi buku, dokumen,
        dan media lain yang disimpan dalam bentuk elektronik sehingga bisa diakses
        dengan lebih cepat, rapi, dan mudah dikelola.
      </p>
    </div>

    <div class="about-illustration">
      <img src="{{ asset('asset/bukudigital.png') }}" alt="Ilustrasi perpustakaan digital">
    </div>
  </section>

  <footer id="kontak">
    <div class="footer-info">
      <p><strong>Surel:</strong> perpustakaan29@gmail.com</p>
      <p><strong>Telepon:</strong> +62 815 1733 6801</p>
      <p><strong>Alamat:</strong> Jl. Raya Tajur, Bogor Timur</p>
      <p>Kota Bogor, Jawa Barat 16141</p>
    </div>

    <p class="footer-copy">2026 Pustakara Perpustakaan Digital</p>
  </footer>
</body>
</html>
