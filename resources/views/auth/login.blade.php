<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Commerce SMK Negeri 5 Kab. Tangerang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8fafc; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: #ffffff; max-width: 400px; width: 100%; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
        .header { text-align: center; margin-bottom: 25px; }
        .header h1 { font-size: 20px; color: #1e293b; font-weight: 700; margin-bottom: 5px; }
        .header p { font-size: 13px; color: #64748b; }
        .alert-error { background-color: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 10px; font-size: 13px; border-radius: 6px; margin-bottom: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; outline: none; }
        .form-control:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
        .btn-submit { width: 100%; padding: 10px; background-color: #2563eb; color: #ffffff; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; margin-top: 5px; }
        .btn-submit:hover { background-color: #1d4ed8; }
        .footer { margin-top: 20px; text-align: center; font-size: 11px; color: #94a3b8; border-top: 1px solid #f1f5f9; padding-top: 15px; }
    </style>
</head>
<body>

    <div class="card">
        <div class="header">
            <h1>SMK Negeri 5 Kab. Tangerang</h1>
            <p>Panel E-Commerce Unit Produksi Sekolah</p>
        </div>

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Sekolah</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required placeholder="nama@smkn5tangerang.sch.id">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-submit">Masuk Sistem</button>
        </form>

        <div class="footer">
            Belum punya akun pengelola? <a href="{{ route('register') }}" style="color: #ea580c; font-weight: 600; text-decoration: none;">Daftar di sini</a><br>
            &copy; 2026 E-Commerce SMK Negeri 5 Kab. Tangerang
        </div>
    </div>

</body>
</html>