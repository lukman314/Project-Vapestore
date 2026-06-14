{{-- resources/views/auth/passwords/email.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lupa Password | Twins Vapor</title>

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

        /* Notifikasi Sukses */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            border: 1px solid #c3e6cb;
            font-weight: 500;
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

        /* Pesan Error Validasi */
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
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

        /* ================= REGISTER (BOTTOM LINK) ================= */

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
                    Lupa Password?
                </h1>

                <p class="subtitle">
                    Masukkan alamat email Anda yang terdaftar. Kami akan mengirimkan tautan untuk mengatur ulang
                    password Anda.
                </p>

                {{-- PESAN SUKSES DARI CONTROLLER --}}
                @if (session('success'))
                    <div class="alert-success">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                {{-- FORM PENGIRIMAN EMAIL --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- EMAIL INPUT --}}
                    <div class="form-group">
                        <label>Email Terdaftar</label>
                        <input type="email" name="email" class="form-control" placeholder="email@gmail.com"
                            value="{{ old('email') }}" required>

                        @error('email')
                            <span class="error-message"><i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <button type="submit" class="login-btn">
                        Kirim Tautan Reset Password
                    </button>

                </form>

            </div>

            {{-- KEMBALI KE LOGIN LINK --}}
            <div class="register-bottom">
                Ingat password Anda?
                <a href="{{ route('login') }}">
                    Login sekarang
                </a>
            </div>

        </div>

        {{-- RIGHT IMAGE --}}
        <div class="right">
            <img src="{{ asset('images/login-bg.jpeg') }}" alt="Background" class="bg"
                onerror="this.src='https://placehold.co/1200x1080/111/fff?text=Twins+Vapor+Background'">
        </div>

    </div>

</body>

</html>