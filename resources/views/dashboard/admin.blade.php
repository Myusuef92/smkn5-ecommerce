<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMK Negeri 5 Kab. Tangerang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8fafc; padding: 40px; color: #334155; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: white; max-width: 600px; width: 100%; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        h1 { font-size: 22px; color: #1e293b; margin-bottom: 8px; }
        p { color: #64748b; font-size: 14px; margin-bottom: 20px; line-height: 1.5; }
        .menu-box { display: flex; gap: 15px; margin-top: 20px; align-items: center; }
        .btn { display: inline-block; padding: 10px 20px; background: #2563eb; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; text-align: center; }
        .btn:hover { background: #1d4ed8; }
        .btn-logout { background: #dc2626; border: none; cursor: pointer; }
        .btn-logout:hover { background: #b91c1c; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Selamat Datang, Admin Pusat!</h1>
        <p>Ini adalah area kontrol utama untuk memantau dan mengelola seluruh data jurusan serta produk unggulan unit produksi SMK Negeri 5 Kab. Tangerang.</p>
        
        <div class="menu-box">
            <a href="/dashboard/produk" class="btn">Kelola Semua Produk</a>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>