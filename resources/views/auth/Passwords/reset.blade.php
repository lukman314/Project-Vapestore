{{-- resources/views/auth/passwords/reset.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password | Twins Vapor</title>

    {{-- GOOGLE FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100%;
            height: 100vh;
            overflow: hidden;
            background: #fff;
        }

        .container {
            width: 100%;
            height: 100vh;
            display: flex;
        }

        /* ================= LEFT FORM ================= */
        .left {
            width: 40%;
            min-width: 450px;
            height: 100vh;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 40px;
            overflow-y: auto;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            margin: auto;
        }

        .logo {
            width: 100px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 26px;
            font-weight: 700;
            color: #111;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .subtitle {
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }

        /* ================= FORM ================= */
        .form-group {
            margin-bottom: 22px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #222;
        }

        .form-control {
            width: 100%;
            padding: 14px;
            border: 1px solid #bbb;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #000;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }

        /* Toggle Password Icon */
        .toggle-password {
            position: absolute;
            top: 40px;
            right: 15px;
            cursor: pointer;
            color: #666;
        }

        /* ================= BUTTON ================= */
        .login-btn {
            width: 100%;
            padding: 15px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: 0.3s;
            margin-top: 10px;
        }

        .login-btn:hover {
            background: #222;
        }

        /* ================= RIGHT IMAGE ================= */
        .right {
            flex: 1;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .right .bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            object-position: center;
        }

        @media(max-width: 992px) {
            body {
                overflow-y: auto;
            }

            .container {
                height: auto;
                min-height: 100vh;
            }

            .right {
                display: none;
            }

            .left {
                width: 100%;
                min-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        {{-- LEFT FORM --}}
        <div class="left">
            <div class="login-box">

                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="logo"
                    onerror="this.src='https://placehold.co/100x40/000/fff?text=TWINS'">

                <h1 class="title">Buat Password Baru</h1>
                <p class="subtitle">Silakan masukkan password baru Anda di bawah ini.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    {{-- Token Wajib dari Laravel --}}
                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- EMAIL INPUT (Biasanya readonly atau hidden, tapi dimunculkan agar jelas) --}}
                    <div class="form-group">
                        <label>Email Terdaftar</label>
                        <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}"
                            readonly required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- PASSWORD BARU INPUT --}}
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Minimal 8 karakter" required>
                        <span class="toggle-password" onclick="togglePassword('password', 'eye1')">
                            <i class="fa-solid fa-eye-slash" id="eye1"></i>
                        </span>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- KONFIRMASI PASSWORD INPUT --}}
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirm" class="form-control"
                            placeholder="Ulangi password baru" required>
                        <span class="toggle-password" onclick="togglePassword('password_confirm', 'eye2')">
                            <i class="fa-solid fa-eye-slash" id="eye2"></i>
                        </span>
                    </div>

                    <button type="submit" class="login-btn">Simpan Password Baru</button>
                </form>

            </div>
        </div>

        {{-- RIGHT IMAGE --}}
        <div class="right">
            <img src="{{ asset('images/login-bg.jpeg') }}" alt="Background" class="bg"
                onerror="this.src='https://placehold.co/1200x1080/111/fff?text=Twins+Vapor+Background'">
        </div>

    </div>

    {{-- SCRIPT TOGGLE PASSWORD --}}
    <script>
        function togglePassword(inputId, iconId) {
            let input = document.getElementById(inputId);
            let icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>

</html>
