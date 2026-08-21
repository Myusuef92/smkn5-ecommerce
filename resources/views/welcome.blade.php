@php
    use App\Models\Jurusan;
    use App\Models\Produk;
    
    $allJurusans = Jurusan::all();
    
    $selectedJurusan = request('jurusan');
    $keyword = request('cari');

    $query = Produk::with('jurusan');

    if ($selectedJurusan) {
        $query->where('jurusan_id', $selectedJurusan);
    }

    if ($keyword) {
        $query->where('nama_produk', 'like', '%' . $keyword . '%');
    }

    $semuaProduk = $query->get();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Teaching Factory - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Header Atas -->
    <header class="header-top">
         <div class="logo-area">
    <img src="{{ asset('images/LogoSMKN5.png
    ') }}"  style="height: 45px; width: auto; object-fit: contain;">
    <div class="logo-text">
        <h1>SMKN 5 KAB. TANGERANG</h1>
        <span>E-Commerce Teaching Factory</span>
    </div>
</div>
        </div>

        <form action="/" method="GET" class="search-bar">
            <input type="text" name="cari" placeholder="Cari Merek / Nama / Tipe Produk..." value="{{ request('cari') }}">
            <button type="submit">Cari</button>
        </form>

        <div class="header-actions">
            @auth
                <a href="/dashboard" class="btn-auth btn-register">Dashboard Panel</a>
            @else
                <a href="{{ route('login') }}" class="btn-auth btn-login">Login</a>
                
            @endauth
        </div>
    </header>

    <!-- Sub Navbar Jenis Produk / Kategori Jurusan -->
    <nav class="sub-nav">
        <a href="/" style="{{ request('jurusan') == '' ? 'color: #e60012; border-bottom-color: #e60012;' : '' }}">Semua Produk</a>
        
        @foreach($allJurusans as $j)
            @php
                $jenisProduk = "Produk Unggulan";
                $nama = strtolower($j->nama_jurusan);
                
                if (str_contains($nama, 'perangkat lunak') || str_contains($nama, 'rpl')) {
                    $jenisProduk = "Jasa & Pelatihan IT";
                } elseif (str_contains($nama, 'sepeda motor') || str_contains($nama, 'tbsm')) {
                    $jenisProduk = "Suku Cadang Motor";
                } elseif (str_contains($nama, 'kendaraan ringan') || str_contains($nama, 'tkr')) {
                    $jenisProduk = "Suku Cadang Mobil";
                } elseif (str_contains($nama, 'komputer') || str_contains($nama, 'tkj')) {
                    $jenisProduk = "Hardware & Jaringan";
                } elseif (str_contains($nama, 'visual') || str_contains($nama, 'dkv')) {
                    $jenisProduk = "Desain & Percetakan";
                } elseif (str_contains($nama, 'akuntansi') || str_contains($nama, 'akl')) {
                    $jenisProduk = "Jasa Keuangan & Admin";
                } elseif (str_contains($nama, 'permesinan') || str_contains($nama, 'tpm')) {
                    $jenisProduk = "Bubut & Komponen Logam";
                } elseif (str_contains($nama, 'perhotelan')) {
                    $jenisProduk = "Layanan Hospitality";
                } elseif (str_contains($nama, 'perikanan') || str_contains($nama, 'aphpi')) {
                    $jenisProduk = "Olahan Pangan & Hasil Laut";
                } else {
                    $jenisProduk = $j->nama_jurusan;
                }

                $isActive = request('jurusan') == $j->id;
            @endphp

            <a href="/?jurusan={{ $j->id }}" style="{{ $isActive ? 'color: #e60012; border-bottom-color: #e60012; font-weight: bold;' : '' }}">
                {{ $jenisProduk }}
            </a>
        @endforeach
    </nav>

    <!-- Kontainer Utama -->
    <div class="main-container">
        
        <!-- Sidebar Kategori -->
        <aside class="sidebar">
            <div class="sidebar-title">Kategori 10 Jurusan</div>
            <ul>
                @foreach($allJurusans as $j)
                    <li><a href="/?jurusan={{ $j->id }}">{{ $j->nama_jurusan }}</a></li>
                @endforeach
            </ul>
        </aside>

        <!-- Katalog Produk -->
        <main class="product-grid-area">
            <h2>Katalog Produk Unggulan</h2>
            <div class="product-grid">
                @forelse($semuaProduk as $p)
                    <div class="product-card">
                        <div>
                            @if($p->gambar)
                                <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama_produk }}" style="width: 100%; height: 130px; object-fit: cover; border-radius: 3px; margin-bottom: 8px;">
                            @else
                                <div style="background: #f1f5f9; height: 130px; border-radius: 3px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 11px; margin-bottom: 8px;">Tidak Ada Foto</div>
                            @endif

                            <span class="badge-jurusan">{{ $p->jurusan->nama_jurusan ?? 'Umum' }}</span>
                            <div class="product-name">{{ $p->nama_produk }}</div>
                        </div>
                        <div>
                            <div class="product-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                            <a href="{{ route('produk.detail', $p->id) }}" class="btn-pesan">Lihat & Pesan</a>
                        </div>
                    </div>
                @empty
                    <p style="grid-column: 1 / -1; color: #64748b; font-size: 13px; padding: 20px; background: white; text-align: center; border: 1px solid #cbd5e1; border-radius: 4px;">Belum ada produk tersedia untuk kategori ini.</p>
                @endforelse
            </div>
        </main>

    </div>

    @include('layouts.footer')
    
</body>
</html>