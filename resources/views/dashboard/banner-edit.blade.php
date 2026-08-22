<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Banner - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="center-page">

    <div class="form-card" style="max-width: 450px; width: 100%;">
        <h2>Edit Banner</h2>
        <p style="font-size: 12px; color: #64748b; margin-bottom: 20px;">Perbarui judul atau ganti gambar banner promosi.</p>

        @if($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 4px; font-size: 12px; margin-bottom: 15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/dashboard/banner/update/{{ $banner->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Judul Banner (Opsional)</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $banner->judul) }}" placeholder="Contoh: Pameran Produk Teaching Factory 2026" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Gambar Banner Saat Ini</label>
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $banner->gambar) }}" alt="Banner" style="width: 100%; max-height: 120px; object-fit: cover; border-radius: 4px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Ganti Gambar Baru (Opsional)</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" style="font-size: 12px;">
                <small style="font-size: 11px; color: #64748b;">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>

            <button type="submit" class="btn-submit" style="width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Perbarui Banner</button>
        </form>

        <div style="text-align: center; margin-top: 15px;">
            <a href="/dashboard/banner" class="back-link" style="font-size: 12px; color: #2563eb; text-decoration: none;">&larr; Kembali ke Kelola Banner</a>
        </div>
    </div>

</body>
</html>