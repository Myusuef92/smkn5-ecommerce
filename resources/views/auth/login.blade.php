<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMK Negeri 5 Kab. Tangerang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f6f8; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .login-card { background: #ffffff; width: 100%; max-width: 400px; padding: 30px; border-radius: 6px; border: 1px solid #cbd5e1; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .login-header { text-align: center; margin-bottom: 20px; }
        .login-header h2 { font-size: 18px; color: #1e293b; font-weight: 800; text-transform: uppercase; }
        .login-header p { font-size: 12px; color: #64748b; margin-top: 4px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 5px; }
        .form-control { width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 13px; outline: none; }
        .form-control:focus { border-color: #e60012; }
        .btn-login { width: 100%; background: #e60012; color: white; border: none; padding: 10px; border-radius: 4px; font-size: 13px; font-weight: 700; cursor: pointer; }
        .btn-login:hover { background: #c5000f; }
        .back-home { display: block; text-align: center; margin-top: 15px; font-size: 12px; color: #64748b; text-decoration: none; }
        .back-home:hover { color: #e60012; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h2>SMKN 5 KAB. TANGERANG</h2>
            <p>Silakan Masuk ke Akun Pengelola / Admin</p>
        </div>

        @if($errors->any())
            <div style="background: #fef2f2; color: #dc2626; font-size: 12px; padding: 8px; border-radius: 4px; margin-bottom: 15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Sekolah</label>
                <input type="email" name="email" class="form-control" required placeholder="nama@smkn5tangerang.sch.id">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-login">Masuk Sistem</button>
        </form>

        <a href="/" class="back-home">&larr; Kembali ke Beranda Utama</a>
    </div>

</body>
</html>