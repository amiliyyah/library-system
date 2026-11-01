<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perpustakaan</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;      /* tengah vertikal */
            justify-content: center;  /* tengah horizontal */
        }

        .login-box {
            padding: 20px;
        }

        .login-box h1 {
            margin: 0 0 24px;
            text-align: center;
        }

        .login-box .field {
            margin-bottom: 16px;      /* jarak antar baris */
        }

        .login-box label {
            display: inline-block;
            width: 90px;              /* supaya kolom input sejajar */
        }

        .login-box input {
            width: 220px;
            padding: 4px;
        }

        .login-box button {
            margin-top: 8px;
            padding: 6px 16px;
        }

        .login-box .errors {
            margin-bottom: 16px;
        }

        .login-box .errors p {
            margin: 0 0 4px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Login Sistem Perpustakaan</h1>

        {{-- Pesan error login gagal --}}
        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Pesan berhasil logout --}}
        @if (session('status'))
            <div class="errors">
                <p>{{ session('status') }}</p>
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>