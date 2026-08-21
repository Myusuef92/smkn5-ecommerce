<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="form-card">
        <h2>Tambah Produk Unggulan</h2>

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Jika Admin, tampilkan pilihan jurusan. Jika Pengelola Jurusan, otomatis dikunci sesuai jurusannya -->
            @if(Auth::user()->role === 'admin')
                <div class="form-group">
                    <label>Pilih Jurusan</label>
                    <select name="jurusan_id" class="form-control" required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach(\App\Models\Jurusan::all() as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div class="form-group">
                    <label>Jurusan Anda</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->jurusan->nama_jurusan ?? 'Jurusan' }}" disabled style="background: #f8fafc; font-weight: bold; color: #0f172a;">
                    <input type="hidden" name="jurusan_id" value="{{ Auth::user()->jurusan_id }}">
                </div>
            @endif

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" required placeholder="Contoh: Aplikasi Kasir / Suku Cadang">
            </div>

            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" required placeholder="Contoh: 250000">
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required placeholder="Contoh: 10">
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" placeholder="Tuliskan spesifikasi produk..."></textarea>
            </div>

            <div class="form-group">
                <label>Foto Produk (Opsional)</label>
                <input type="file" name="gambar" accept="image/*" style="font-size: 12px;">
            </div>

            <button type="submit" class="btn-submit">Simpan Produk</button>
        </form>

        <a href="/dashboard" class="back-link">&larr; Kembali ke Dashboard</a>
    </div>

</body>
</html>