<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="center-page">

    <div class="form-card">
        <div style="text-align: center; margin-bottom: 20px;">
            <h2>SMKN 5 Kab. Tangerang</h2>
            <p style="font-size: 12px; color: #64748b; margin-top: 4px;">Silakan Masuk ke Akun Pengelola / Admin</p>
        </div>

        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Sekolah</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn-submit">Masuk Sistem</button>
        </form>

        <a href="/" class="back-link">&larr; Kembali ke Beranda Utama</a>
    </div>

</body>
</html>