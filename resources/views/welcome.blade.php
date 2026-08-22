<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SMKN 5 Kab. Tangerang - E-Commerce</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Header Utama (Sudah Termasuk Logo) -->
    <header class="header-top">
        <div class="logo-area">
        <img src="{{ asset('images/LogoSMKN5.png') }}" alt="Logo SMKN 5" style="width: 45px; height: 45px; object-fit: contain;">
        <div class="logo-text">
            <h1>SMKN 5 KAB. TANGERANG</h1>
            <span>E-Commerce Teaching Factory</span>
        </div>
        </div>

        <form action="/" method="GET" class="search-bar">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari Merek / Nama / Tipe Produk...">
            <button type="submit">Cari</button>
        </form>

        <div class="header-actions">
            @auth
                <a href="/dashboard" class="btn-auth btn-register">Dashboard</a>
            @else
                <a href="/login" class="btn-auth btn-login">Login</a>
            @endauth
        </div>
    </header>

    <!-- Sub Navigasi Kategori Jurusan -->
    <nav class="sub-nav">
        <a href="/">Semua Produk</a>
        @foreach($jurusans ?? [] as $j)
            <a href="/?jurusan={{ $j->id }}">{{ $j->nama_jurusan }}</a>
        @endforeach
    </nav>

    <!-- Bagian Slider / Banner Promosi -->
    @if(isset($banners) && count($banners) > 0)
        <div style="width: 95%; max-width: 1600px; margin: 20px auto 0 auto;">
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 6px; overflow: hidden; padding: 10px; display: flex; gap: 15px; overflow-x: auto;">
                @foreach($banners as $b)
                    <div style="min-width: 300px; flex: 1; position: relative;">
                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="Banner" style="width: 100%; height: 180px; object-fit: cover; border-radius: 4px;">
                        @if($b->judul)
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.6); color: white; padding: 5px 10px; font-size: 12px; font-weight: 600; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">
                                {{ $b->judul }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Layout Utama (Sidebar & Produk) -->
    <div class="main-container">
        
        <!-- Sidebar Jurusan -->
        <aside class="sidebar">
            <div class="sidebar-title">Kategori Jurusan</div>
            <ul>
                <li><a href="/">Semua Produk</a></li>
                @foreach($jurusans ?? [] as $j)
                    <li><a href="/?jurusan={{ $j->id }}">{{ $j->nama_jurusan }}</a></li>
                @endforeach
            </ul>
        </aside>

        <!-- Grid Produk -->
        <main class="product-grid-area">
            <h2>Katalog Produk Unggulan</h2>
            <div class="product-grid">
                @forelse($produks as $p)
                    <div class="product-card">
                        <div>
                            @if($p->gambar)
                                <img src="{{ asset('storage/' . $p->gambar) }}" alt="Foto" style="width:100%; height:140px; object-fit:cover; border-radius:4px;">
                            @else
                                <div style="background:#e2e8f0; height:140px; display:flex; align-items:center; justify-content:center; font-size:11px; color:#64748b; border-radius:4px;">Tidak Ada Foto</div>
                            @endif
                            <span class="badge-jurusan">{{ $p->jurusan->nama_jurusan ?? 'Umum' }}</span>
                            <div class="product-name">{{ $p->nama_produk }}</div>
                            <div class="product-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                        </div>
                        <a href="/produk/{{ $p->id }}" class="btn-detail" style="display: block; text-align: center; background: #2563eb; color: white; padding: 8px; border-radius: 4px; text-decoration: none; margin-top: 10px;">Lihat & Pesan</a>
                    </div>
                @empty
                    <p style="grid-column: 1 / -1; text-align: center; color: #64748b; padding: 30px;">Belum ada produk tersedia.</p>
                @endforelse
            </div>
        </main>

    </div>

    <!-- Panggil Footer Sekolah -->
    @include('layouts.footer')

</body>
</html>