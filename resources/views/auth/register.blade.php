{{-- resources/views/auth/register.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Twins Vapor</title>

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

        /* ================= LEFT IMAGE ================= */
        .left {
            flex: 1;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .left .bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            object-position: center;
        }

        /* ================= RIGHT FORM ================= */
        .right {
            width: 40%;
            min-width: 450px;
            height: 100vh;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 30px 40px;
            /* Diperkecil sedikit agar fit */
            overflow: hidden;
            /* Mematikan scroll total di desktop agar fit */
        }

        .register-box {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            width: 85px;
            /* Diperkecil sedikit */
            margin-bottom: 10px;
            align-self: flex-start;
        }

        .title {
            font-size: 22px;
            /* Diperkecil sedikit */
            font-weight: 700;
            color: #111;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .subtitle {
            font-size: 13px;
            color: #777;
            margin-bottom: 15px;
            /* Diperkecil */
        }

        /* ================= GOOGLE BUTTON ================= */
        .google-btn {
            width: 100%;
            padding: 10px;
            /* Diperkecil */
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 12px;
            transition: 0.3s;
            text-decoration: none;
            color: #000;
        }

        .google-btn:hover {
            background: #f7f7f7;
        }

        .google-icon {
            width: 16px;
            height: 16px;
        }

        /* ================= DIVIDER ================= */
        .divider {
            text-align: center;
            position: relative;
            margin: 12px 0;
            /* Diperkecil */
            font-size: 11px;
            color: #777;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 28%;
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
            margin-bottom: 12px;
            /* Diperkecil jarak antar input */
        }

        .form-group label {
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
            font-weight: 500;
            color: #222;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            /* Diperkecil ketebalan form input */
            border: 1px solid #bbb;
            border-radius: 8px;
            outline: none;
            font-size: 13px;
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
            font-size: 11px;
            margin-top: 4px;
            display: block;
            font-weight: 500;
        }

        /* ================= BUTTON ================= */
        .register-btn {
            width: 100%;
            padding: 12px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
            margin-top: 8px;
        }

        .register-btn:hover {
            background: #222;
        }

        /* ================= LOGIN BOTTOM LINK ================= */
        .login-bottom {
            width: 100%;
            text-align: center;
            font-size: 13px;
            color: #666;
            margin-top: 20px;
            /* Diperkecil */
        }

        .login-bottom a {
            color: #000;
            text-decoration: none;
            font-weight: 600;
        }

        .login-bottom a:hover {
            text-decoration: underline;
        }

        /* ================= RESPONSIVE (MOBILE) ================= */
        @media(max-width: 992px) {
            body {
                overflow-y: auto;
            }

            .container {
                height: auto;
                min-height: 100vh;
            }

            .left {
                display: none;
            }

            .right {
                width: 100%;
                min-width: 100%;
                height: auto;
                padding: 40px 20px;
                overflow-y: auto;
                /* Izinkan scroll hanya jika dibuka di HP */
            }
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- LEFT IMAGE --}}
        <div class="left">
            <img src="{{ asset('images/login-bg.jpeg') }}" alt="Background" class="bg"
                onerror="this.src='https://placehold.co/1200x1080/111/fff?text=Twins+Vapor+Background'">
        </div>

        {{-- RIGHT FORM --}}
        <div class="right">

            <div class="register-box">

                {{-- LOGO --}}
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="logo"
                    onerror="this.src='https://placehold.co/100x40/000/fff?text=TWINS'">

                {{-- TITLE --}}
                <h1 class="title">Selamat Datang Di TwinsVapor</h1>
                <p class="subtitle">Silakan Buat Akun Baru Anda</p>

                {{-- GOOGLE BUTTON --}}
                <button type="button" class="google-btn">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg"
                        alt="Google" class="google-icon">
                    Continue with Google
                </button>

                {{-- DIVIDER --}}
                <div class="divider">or Sign up with Email</div>

                {{-- FORM REGISTER --}}
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- NAMA LENGKAP INPUT (Penting agar backend Laravel tidak menolak/refresh) --}}
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap Anda"
                            value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="error-message"><i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- EMAIL INPUT --}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="email@gmail.com"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <span class="error-message"><i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- NOMOR TELEPON INPUT --}}
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" placeholder="081234xxxxxx"
                            value="{{ old('phone') }}" required>
                        @error('phone')
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
                            <span class="toggle-password" onclick="togglePassword('password', 'eyeIcon')">
                                <i class="fa-solid fa-eye-slash" id="eyeIcon"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="error-message"><i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- CONFIRM PASSWORD INPUT --}}
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <div class="password-group">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="*************" required>
                            <span class="toggle-password"
                                onclick="togglePassword('password_confirmation', 'eyeIconConfirm')">
                                <i class="fa-solid fa-eye-slash" id="eyeIconConfirm"></i>
                            </span>
                        </div>
                    </div>

                    {{-- REGISTER BUTTON --}}
                    <button type="submit" class="register-btn">Buat Akun</button>
                </form>

            </div>

            {{-- LOGIN LINK --}}
            <div class="login-bottom">
                Sudah Memiliki Akun?
                <a href="{{ route('login') }}">Login Sekarang</a>
            </div>

        </div>

    </div>

    {{-- PASSWORD TOGGLE SCRIPT --}}
    <script>
        function togglePassword(inputId, iconId) {
            let passwordField = document.getElementById(inputId);
            let eyeIcon = document.getElementById(iconId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>

</body>

</html>
