<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="center-page">

    <div class="form-card" style="max-width: 400px; width: 100%;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h2 style="font-size: 20px; color: #1e293b; margin-bottom: 5px;">SMKN 5 KAB. TANGERANG</h2>
            <p style="font-size: 12px; color: #64748b;">Silakan Masuk ke Akun Pengelola / Admin</p>
        </div>

        @if($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 4px; font-size: 12px; margin-bottom: 15px; text-align: center;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Email</label>
                <input type="email" name="email" class="form-control" placeholder="admin@smkn5tangerang.sch.id" value="{{ old('email') }}" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Password</label>
                <div style="position: relative;">
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required style="width: 100%; padding: 10px; padding-right: 40px; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;">
                    <span onclick="togglePassword()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #64748b;">
                        👁️
                    </span>
                </div>
            </div>

            <button type="submit" class="btn-submit" style="width: 100%; padding: 10px; background: #dc2626; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Masuk Sistem</button>
        </form>

        <div style="text-align: center; margin-top: 15px;">
            <a href="/" class="back-link" style="font-size: 12px; color: #2563eb; text-decoration: none;">&larr; Kembali ke Beranda Utama</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

</body>
</html>