<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - SMKN 5 Kab. Tangerang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: #f1f5f9; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .form-card { background: white; width: 100%; max-width: 500px; padding: 30px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h2 { font-size: 16px; color: #1e293b; margin-bottom: 20px; font-weight: 800; text-transform: uppercase; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 5px; }
        .form-control { width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 13px; outline: none; }
        .form-control:focus { border-color: #2563eb; }
        textarea.form-control { resize: vertical; height: 90px; }
        .btn-submit { background: #2563eb; color: white; border: none; padding: 10px 15px; border-radius: 4px; font-size: 13px; font-weight: 700; cursor: pointer; width: 100%; }
        .btn-submit:hover { background: #1d4ed8; }
        .back-link { display: block; text-align: center; margin-top: 15px; font-size: 12px; color: #64748b; text-decoration: none; }
        .back-link:hover { color: #e60012; }
    </style>
</head>
<body>

    <div class="form-card">
        <h2>Edit Produk Unggulan</h2>

        <form action="/dashboard/produk/update/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if(Auth::user()->role === 'admin')
                <div class="form-group">
                    <label>Pilih Jurusan</label>
                    <select name="jurusan_id" class="form-control" required>
                        @foreach($jurusans as $j)
                            <option value="{{ $j->id }}" {{ $produk->jurusan_id == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
            </div>

            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control">{{ $produk->deskripsi }}</textarea>
            </div>

            <div class="form-group">
                <label>Foto Produk Saat Ini</label>
                @if($produk->gambar)
                    <div style="margin-bottom: 8px;"><img src="{{ asset('storage/' . $produk->gambar) }}" alt="Preview" style="height: 60px; border-radius: 4px; object-fit: cover;"></div>
                @else
                    <p style="font-size: 11px; color: #64748b; margin-bottom: 8px;">Belum ada foto.</p>
                @endif
                <label>Ganti Foto (Opsional)</label>
                <input type="file" name="gambar" accept="image/*" style="font-size: 12px;">
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>

        <a href="/dashboard" class="back-link">&larr; Kembali ke Dashboard</a>
    </div>

</body>
</html>