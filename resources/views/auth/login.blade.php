{{-- resources/views/auth/login.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Twins Vapor</title>

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
        }

        .login-box {
            width: 100%;
            max-width: 400px;
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

        /* ================= GOOGLE BUTTON ================= */

        .google-btn {
            width: 100%;
            padding: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;

            font-size: 14px;
            font-weight: 500;

            margin-bottom: 25px;
            transition: 0.3s;

            text-decoration: none;
            color: #000;
        }

        .google-btn:hover {
            background: #f7f7f7;
        }

        .google-icon {
            width: 18px;
            height: 18px;
        }

        /* ================= DIVIDER ================= */

        .divider {
            text-align: center;
            position: relative;
            margin: 25px 0;
            font-size: 11px;
            color: #777;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 35%;
            height: 1px;
            background: #ccc;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        /* ================= FORM ================= */

        .form-group {
            margin-bottom: 22px;
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

        .password-group {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 13px;
            color: #444;
        }

        /* Pesan Error Validasi */
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }

        /* ================= OPTIONS ================= */

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 11px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .forgot {
            color: #000;
            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
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

        /* ================= REGISTER ================= */

        .register-bottom {
            width: 100%;
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-top: 40px;
        }

        .register-bottom a {
            color: #000;
            text-decoration: none;
            font-weight: 600;
        }

        .register-bottom a:hover {
            text-decoration: underline;
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

        /* ================= RESPONSIVE ================= */

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

                {{-- LOGO --}}
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="logo"
                    onerror="this.src='https://placehold.co/100x40/000/fff?text=TWINS'">

                {{-- TITLE --}}
                <h1 class="title">
                    Selamat Datang Kembali Di TwinsVapor
                </h1>

                <p class="subtitle">
                    Selamat Berbelanja
                </p>

                {{-- GOOGLE BUTTON --}}
                <a href="#" class="google-btn">

                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg"
                        alt="Google" class="google-icon">

                    Continue with Google

                </a>

                {{-- DIVIDER --}}
                <div class="divider">
                    or Sign in with Email
                </div>

                {{-- FORM PENGIRIMAN DATA --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- EMAIL INPUT --}}
                    <div class="form-group">
                        <label>Email</label>
                        {{-- Ditambahkan value="{{ old('email') }}" agar email tidak hilang saat salah ketik password --}}
                        <input type="email" name="email" class="form-control" placeholder="email@gmail.com"
                            value="{{ old('email') }}" required>

                        {{-- Menerima Pesan Error Validasi Email dari Backend --}}
                        @error('email')
                            <span class="error-message"><i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- PASSWORD INPUT --}}
                    <div class="form-group">
                        <label>Password</label>
                        <div class="password-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="*************" required>

                            <span class="toggle-password" onclick="togglePassword()">
                                <i class="fa-solid fa-eye-slash" id="eyeIcon"></i>
                            </span>
                        </div>

                        {{-- Menerima Pesan Error Validasi Password dari Backend --}}
                        @error('password')
                            <span class="error-message"><i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- OPTIONS --}}
                    <div class="options">
                        <label class="remember">
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            Remember Me
                        </label>

                        <a href="#" class="forgot">
                            Lupa Password?
                        </a>
                    </div>

                    {{-- LOGIN BUTTON --}}
                    <button type="submit" class="login-btn">
                        Login
                    </button>

                </form>

            </div>

            {{-- REGISTER LINK --}}
            <div class="register-bottom">

                Tidak Memiliki Akun?

                <a href="{{ route('register') }}">
                    register sekarang
                </a>

            </div>

        </div>

        {{-- RIGHT IMAGE --}}
        <div class="right">

            <img src="{{ asset('images/login-bg.jpeg') }}" alt="Background" class="bg"
                onerror="this.src='https://placehold.co/1200x1080/111/fff?text=Twins+Vapor+Background'">

        </div>

    </div>

    {{-- PASSWORD TOGGLE SCRIPT --}}
    <script>
        function togglePassword() {

            let password = document.getElementById('password');
            let eyeIcon = document.getElementById('eyeIcon');

            if (password.type === 'password') {

                password.type = 'text';

                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');

            } else {

                password.type = 'password';

                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>

</body>

</html>