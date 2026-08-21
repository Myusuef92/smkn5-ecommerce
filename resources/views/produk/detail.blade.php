<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk }} - E-Commerce SMK Negeri 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
</head>
<body>

    <div class="top-bar">
        <span>Detail Produk Unggulan - Unit Produksi SMK Negeri 5 Kab. Tangerang</span>
    </div>

    <header>
        <div class="logo-area">
            <h1>SMKN 5 KAB. TANGERANG</h1>
            <span>E-Commerce Teaching Factory</span>
        </div>
        <div>
            <a href="/" style="font-size: 13px; color: #e60012; font-weight: 600; text-decoration: none;">&larr; Kembali ke Beranda</a>
        </div>
    </header>

    <div class="container">
        <div>
            <div style="background: #f1f5f9; height: 300px; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-weight: 600; text-align: center; padding: 20px;">
                [ Gambar Produk Unggulan Jurusan ]
            </div>
        </div>

        <div>
            <span class="product-badge">{{ $produk->jurusan->nama_jurusan ?? 'Umum' }}</span>
            <h2>{{ $produk->nama_produk }}</h2>
            <div class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
            <div class="stock">Stok Tersedia: {{ $produk->stok }} pcs</div>
            
            <div style="font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 5px;">Deskripsi / Spesifikasi:</div>
            <div class="desc">{{ $produk->deskripsi ?? 'Tidak ada deskripsi produk.' }}</div>

            <a href="https://wa.me/6285819859297?text=Halo,%20saya%20tertarik%20untuk%20memesan%20produk%20{{ urlencode($produk->nama_produk) }}%20seharga%20Rp%20{{ number_format($produk->harga, 0, ',', '.') }}%20dari%20Unit%20Produksi%20SMKN%205%20Kab.%20Tangerang." target="_blank" class="btn-order">
                Pesan via WhatsApp / Hubungi Unit Produksi
            </a>
            
            <br>
            <a href="/" class="back-link">&larr; Lanjutkan Belanja</a>
        </div>
    </div>

</body>
</html>