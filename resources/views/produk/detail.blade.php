<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk }} - E-Commerce SMK Negeri 5 Kab. Tangerang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f6f8; color: #333; }
        .top-bar { background: #e60012; color: #ffffff; font-size: 11px; padding: 6px 30px; font-weight: 500; }
        header { background: #ffffff; border-bottom: 2px solid #e2e8f0; padding: 12px 30px; display: flex; align-items: center; justify-content: space-between; }
        .logo-area h1 { font-size: 16px; color: #1e293b; font-weight: 800; text-transform: uppercase; }
        .logo-area span { font-size: 11px; color: #e60012; font-weight: 700; display: block; }
        
        .container { max-width: 900px; margin: 30px auto; background: white; padding: 30px; border-radius: 6px; border: 1px solid #cbd5e1; display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .product-badge { background: #fee2e2; color: #991b1b; font-size: 11px; padding: 4px 8px; border-radius: 3px; width: fit-content; font-weight: 600; margin-bottom: 12px; display: inline-block; }
        h2 { font-size: 20px; color: #1e293b; margin-bottom: 10px; }
        .price { font-size: 22px; font-weight: 700; color: #e60012; margin-bottom: 15px; }
        .desc { font-size: 13px; color: #64748b; line-height: 1.6; margin-bottom: 20px; }
        .stock { font-size: 13px; font-weight: 600; color: #16a34a; margin-bottom: 20px; }
        
        .btn-order { background: #25d366; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 14px; font-weight: 700; cursor: pointer; width: 100%; text-align: center; text-decoration: none; display: block; }
        .btn-order:hover { background: #20ba5a; }
        .back-link { display: inline-block; margin-top: 15px; font-size: 13px; color: #64748b; text-decoration: none; }
    </style>
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

            <a href="https://wa.me/?text=Halo,%20saya%20tertarik%20untuk%20memesan%20produk%20{{ urlencode($produk->nama_produk) }}%20seharga%20Rp%20{{ number_format($produk->harga, 0, ',', '.') }}%20dari%20Unit%20Produksi%20SMKN%205%20Kab.%20Tangerang." target="_blank" class="btn-order">
                Pesan via WhatsApp / Hubungi Unit Produksi
            </a>
            
            <br>
            <a href="/" class="back-link">&larr; Lanjutkan Belanja</a>
        </div>
    </div>

</body>
</html>