<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Unit Produksi & Pengadaan - SMK Negeri 5 Kab. Tangerang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f6f8; color: #333; }
        
        /* Top Bar Monotaro Style */
        .top-bar { background: #e60012; color: #ffffff; font-size: 11px; padding: 6px 30px; display: flex; justify-content: space-between; align-items: center; font-weight: 500; }
        .top-bar-left, .top-bar-right { display: flex; gap: 20px; align-items: center; }
        .top-bar a { color: #ffffff; text-decoration: none; }
        .top-bar a:hover { text-decoration: underline; }

        /* Header Utama Merah-Putih */
        header { background: #ffffff; border-bottom: 2px solid #e2e8f0; padding: 12px 30px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
        .logo-area { display: flex; align-items: center; gap: 10px; }
        .logo-badge { background: #e60012; color: white; font-weight: 900; font-size: 16px; padding: 6px 10px; border-radius: 4px; }
        .logo-text h1 { font-size: 16px; color: #1e293b; font-weight: 800; text-transform: uppercase; }
        .logo-text span { font-size: 11px; color: #e60012; font-weight: 700; display: block; }
        
        /* Search Bar Besar */
        .search-bar { display: flex; flex: 1; max-width: 500px; margin: 0 30px; }
        .search-bar input { width: 100%; padding: 10px 15px; border: 2px solid #e60012; border-right: none; border-radius: 4px 0 0 4px; font-size: 13px; outline: none; }
        .search-bar button { background: #e60012; color: white; border: none; padding: 0 25px; font-weight: 700; border-radius: 0 4px 4px 0; cursor: pointer; font-size: 13px; }
        .search-bar button:hover { background: #c5000f; }

        /* Header Actions (Login / Register / Dashboard) */
        .header-actions { display: flex; gap: 10px; align-items: center; }
        .btn-auth { padding: 7px 14px; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; }
        .btn-login { background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; }
        .btn-register { background: #e60012; color: white; }
        .btn-register:hover { background: #c5000f; }

        /* Sub-Navbar / Menu Kategori Navigasi */
        .sub-nav { background: #ffffff; border-bottom: 1px solid #cbd5e1; padding: 0 30px; display: flex; gap: 25px; font-size: 12px; font-weight: 600; color: #475569; }
        .sub-nav a { color: #475569; text-decoration: none; padding: 10px 0; border-bottom: 2px solid transparent; }
        .sub-nav a:hover { color: #e60012; border-bottom-color: #e60012; }

        /* Main Wrapper (Hero Banner & Product Highlight) */
        .hero-container { max-width: 1250px; margin: 20px auto; padding: 0 20px; display: grid; grid-template-columns: 240px 1fr 340px; gap: 15px; }

        /* Kategori Sidebar Kiri ala Monotaro */
        .sidebar-menu { background: #ffffff; border: 1px solid #cbd5e1; border-radius: 4px; overflow: hidden; height: fit-content; }
        .sidebar-menu-title { background: #1e293b; color: white; padding: 10px 15px; font-size: 12px; font-weight: 700; text-transform: uppercase; }
        .sidebar-menu ul { list-style: none; }
        .sidebar-menu ul li a { display: block; padding: 9px 15px; color: #334155; text-decoration: none; font-size: 12px; border-bottom: 1px solid #f1f5f9; transition: 0.15s; }
        .sidebar-menu ul li a:hover { background: #fff5f5; color: #e60012; padding-left: 18px; font-weight: 600; }

        /* Banner Promosi Tengah */
        .promo-banner { background: #ffffff; border: 1px solid #cbd5e1; border-radius: 4px; padding: 20px; display: flex; flex-direction: column; justify-content: center; background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%); position: relative; overflow: hidden; }
        .promo-banner h2 { font-size: 18px; color: #1e293b; font-weight: 700; margin-bottom: 8px; }
        .promo-banner p { font-size: 12px; color: #64748b; margin-bottom: 15px; line-height: 1.4; }
        .promo-badge-discount { position: absolute; right: 20px; top: 20px; background: #e60012; color: white; font-weight: 800; font-size: 12px; padding: 10px; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(230,0,18,0.3); }

        /* Product Highlight Kanan */
        .highlight-box { background: #ffffff; border: 1px solid #cbd5e1; border-radius: 4px; padding: 15px; }
        .highlight-title { font-size: 13px; font-weight: 700; color: #1e293b; border-bottom: 2px solid #e60012; padding-bottom: 6px; margin-bottom: 10px; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; }
        .highlight-item { display: flex; gap: 10px; align-items: center; padding: 8px 0; border-bottom: 1px solid #f1f5f9; font-size: 12px; }
        .highlight-item strong { color: #e60012; }

        /* Katalog Produk Utama di Bawah */
        .catalog-container { max-width: 1250px; margin: 20px auto; padding: 0 20px; }
        .catalog-header { font-size: 15px; font-weight: 700; color: #1e293b; border-bottom: 2px solid #e60012; padding-bottom: 8px; margin-bottom: 15px; text-transform: uppercase; }
        
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 15px; }
        .product-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 4px; padding: 12px; display: flex; flex-direction: column; justify-content: space-between; transition: 0.2s; }
        .product-card:hover { border-color: #e60012; box-shadow: 0 4px 12px rgba(230,0,18,0.08); }
        .product-badge { background: #fee2e2; color: #991b1b; font-size: 10px; padding: 2px 6px; border-radius: 3px; width: fit-content; font-weight: 600; margin-bottom: 6px; }
        .product-name { font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 6px; height: 36px; overflow: hidden; }
        .product-price { font-size: 15px; font-weight: 700; color: #e60012; margin-bottom: 10px; }
        .btn-buy { background: #e60012; color: white; border: none; padding: 7px; border-radius: 3px; font-size: 12px; font-weight: 600; cursor: pointer; width: 100%; text-align: center; }
        .btn-buy:hover { background: #c5000f; }

        /* Footer */
        footer { background: #1e293b; color: #94a3b8; text-align: center; padding: 20px; margin-top: 40px; font-size: 12px; }
        footer span { color: #f87171; font-weight: 600; }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-bar-left">
            <span>Alat & Perkakas Unit Produksi Resmi SMKN 5 Kab. Tangerang</span>
            <a href="#">Bantuan Pelanggan</a>
        </div>
        <div class="top-bar-right">
            <a href="#">Online Quotation</a>
            <a href="#">Faktur Pajak Sekolah</a>
            <a href="#">Bahasa: ID</a>
        </div>
    </div>

    <!-- Header Utama -->
    <header>
        <div class="logo-area">
            <div class="logo-badge">5</div>
            <div class="logo-text">
                <h1>SMKN 5 KAB. TANGERANG</h1>
                <span>E-Commerce Teaching Factory (TEFA)</span>
            </div>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Cari Merek / Nama / Tipe Produk unggulan dari 10 Jurusan...">
            <button>Cari</button>
        </div>

        <div class="header-actions">
            @auth
                <a href="/dashboard" class="btn-auth btn-register">Dashboard Panel</a>
            @else
                <a href="/login" class="btn-auth btn-login">Login</a>
                <a href="/register" class="btn-auth btn-register">Daftar Akun</a>
            @endauth
        </div>
    </header>

    <!-- Sub Navbar Kategori -->
    <div class="sub-nav">
        <a href="#">Semua Produk</a>
        <a href="#">Katalog 10 Jurusan</a>
        <a href="#">Promo Unit Produksi</a>
        <a href="#">Komparasi Produk Siswa</a>
        <a href="#">Request Quotation B2B</a>
    </div>

    <!-- Hero Banner & Highlight Section -->
    <div class="hero-container">
        
        <!-- 1. Sidebar Kategori Jurusan -->
        <div class="sidebar-menu">
            <div class="sidebar-menu-title">Kategori 10 Jurusan</div>
            <ul>
                @php
                    use App\Models\Jurusan;
                    use App\Models\Produk;
                    $daftarJurusanSidebar = Jurusan::all();
                    $semuaProduk = Produk::with('jurusan')->get();
                @endphp

                @foreach($daftarJurusanSidebar as $js)
                    <li><a href="#">{{ $js->nama_jurusan }}</a></li>
                @endforeach
            </ul>
        </div>

        <!-- 2. Banner Promo Tengah -->
        <div class="promo-banner">
            <div class="promo-badge-discount">10%</div>
            <h2>Uji Lebih Tepat, Belanja Lebih Hemat</h2>
            <p>Dapatkan penawaran khusus produk unggulan, alat praktikum, dan jasa layanan langsung dari unit produksi sekolah berstandar industri.</p>
            <div>
                <a href="#katalog" style="background: #e60012; color: white; padding: 7px 15px; border-radius: 3px; font-size: 12px; font-weight: 600; text-decoration: none; display: inline-block;">BELANJA SEKARANG</a>
            </div>
        </div>

        <!-- 3. Product Highlight Kanan -->
        <div class="highlight-box">
            <div class="highlight-title">
                <span>Product Highlight</span>
                <span style="font-size: 11px; color: #64748b; font-weight: normal;">Ready Stock</span>
            </div>
            @foreach($semuaProduk->take(2) as $hp)
            <div class="highlight-item">
                <div>
                    <div style="font-weight: 600; font-size: 12px; color: #1e293b; line-height: 1.3;">{{ $hp->nama_produk }}</div>
                    <strong>Rp {{ number_format($hp->harga, 0, ',', '.') }}</strong>
                </div>
            </div>
            @endforeach
            <div style="margin-top: 12px; background: #f8fafc; padding: 8px; border-radius: 4px; font-size: 11px; color: #64748b; line-height: 1.4;">
                <strong>Kemudahan Belanja:</strong> Pembayaran fleksibel dan pengadaan transparan untuk unit sekolah & umum.
            </div>
        </div>

    </div>

    <!-- Katalog Produk Utama -->
    <div class="catalog-container" id="katalog">
        <div class="catalog-header">Katalog Produk Unggulan 10 Jurusan</div>

        <div class="product-grid">
            @forelse($semuaProduk as $p)
            <div class="product-card">
                <div>
                    <div class="product-badge">{{ $p->jurusan->nama_jurusan ?? 'Umum' }}</div>
                    <div class="product-name">{{ $p->nama_produk }}</div>
                </div>
                <div>
                    <div class="product-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                    <a href="{{ route('produk.detail', $p->id) }}" class="btn-buy" style="display: block; text-decoration: none; line-height: 25px;">Lihat & Pesan</a>
            </div>
            @empty
            <p style="grid-column: span 4; text-align: center; color: #94a3b8; padding: 40px;">Belum ada produk yang tersedia di sistem.</p>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2026 <span>SMK Negeri 5 Kab. Tangerang</span>. All Rights Reserved. E-Commerce Teaching Factory System.
    </footer>

</body>
</html>