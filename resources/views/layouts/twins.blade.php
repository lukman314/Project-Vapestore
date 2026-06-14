<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Twins Vapor - Vape Store Terpercaya</title>
    <meta name="description"
        content="Twins Vapor - Toko vape terpercaya. Jual liquid, pod, mod, atomizer, dan accessories.">

    {{-- GOOGLE FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ICONS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">

    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            color: #111;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        img {
            display: block;
            max-width: 100%;
        }

        /* =============================================
           NAVBAR
        ============================================= */
        .navbar {
            width: 100%;
            background: #111;
            position: sticky;
            top: 0;
            z-index: 9999;
            padding: 8px 0 8px;
        }

        .navbar-inner {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 30px;

            display: grid;
            grid-template-columns: auto 1fr auto;
            grid-template-rows: auto auto;
            row-gap: 0;
            align-items: center;
        }

        .nav-logo {
            grid-column: 1;
            grid-row: 1 / span 2;
            width: 120px;
            margin-left: 20px;
            display: flex;
            align-items: center;
        }

        .nav-logo img {
            width: 100%;
            height: auto;
            object-fit: contain;
            max-height: 70px;
        }

        .nav-right {
            grid-column: 3;
            grid-row: 1;
            display: flex;
            align-items: center;
            gap: 16px;
            justify-content: flex-end;
        }

        .search-form {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 50px;
            overflow: hidden;
            height: 38px;
        }

        .search-form input {
            flex: 1;
            border: none;
            outline: none;
            padding: 0 16px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            background: transparent;
        }

        .search-form button {
            border: none;
            background: transparent;
            padding: 0 14px;
            font-size: 14px;
            color: #555;
        }

        /* NAV MENU */
        .nav-search {
            grid-column: 2;
            grid-row: 1;
            width: 100%;
            max-width: 560px;
            justify-self: center;
        }

        .nav-menu-wrap {
            grid-column: 2;
            grid-row: 2;
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 6px 0;
            margin-top: 6px;
        }

        .nav-menu {
            display: flex;
            width: 100%;
            max-width: 560px;
            justify-content: space-between;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-menu li {
            position: relative;
        }

        .nav-menu>li>a {
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            transition: color 0.2s;
        }

        .nav-menu>li>a:hover {
            color: #ccc;
        }

        /* DROPDOWN */
        .has-dropdown>.dropdown-menu {
            position: absolute;
            top: calc(100% + 12px);
            left: 0;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            padding: 6px 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all 0.22s ease;
            z-index: 9999;
        }

        .navbar .dropdown-menu {
            display: block !important;
        }

        .has-dropdown:hover>.dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu li {
            position: relative;
        }

        .dropdown-menu li a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 16px;
            font-size: 12px;
            color: #222;
            transition: background 0.15s;
        }

        .dropdown-menu li a:hover {
            background: #f5f5f5;
        }

        /* SUBMENU */
        .has-sub>.submenu {
            position: absolute;
            top: 0;
            left: 100%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 160px;
            padding: 6px 0;
            display: none;
            z-index: 9999;
        }

        .has-sub:hover>.submenu {
            display: block;
        }

        .submenu li a {
            display: block;
            padding: 9px 16px;
            font-size: 12px;
            color: #222;
        }

        .submenu li a:hover {
            background: #f5f5f5;
        }

        /* NAV RIGHT */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .nav-right a,
        .nav-right button {
            background: none;
            border: none;
            color: #fff;
            font-size: 17px;
            padding: 0;
            position: relative;
            transition: color 0.2s;
        }

        .nav-right a:hover {
            color: #ccc;
        }

        .cart-badge {
            position: absolute;
            top: -7px;
            right: -7px;
            background: #ff4d4d;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .nav-sep {
            width: 1px;
            height: 20px;
            background: rgba(255, 255, 255, 0.3);
        }

        /* USER DROPDOWN */
        .user-wrap {
            position: relative;
        }

        .user-toggle {
            background: none;
            border: none;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 400;
            cursor: pointer;
            padding: 0;
        }

        .user-toggle i {
            font-size: 18px;
        }

        .user-dd {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all 0.22s ease;
            z-index: 9999;
        }

        .user-wrap:hover .user-dd {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-dd a,
        .user-dd button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 16px;
            font-size: 13px;
            color: #222 !important;
            background: none;
            border: none;
            text-align: left;
            transition: background 0.15s;
        }

        .user-dd a:hover,
        .user-dd button:hover {
            background: #f5f5f5;
        }

        .user-dd button.logout {
            color: #e53935 !important;
        }

        /* =============================================
           FOOTER
        ============================================= */
        .footer {
            background: #111;
            padding: 40px 30px 30px;
            margin-top: 30px;
        }

        .footer-inner {
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .footer-logo {
            flex: 0 0 auto;
        }

        .footer-logo img {
            width: 160px;
            object-fit: contain;
        }

        .footer-col h4 {
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-col a {
            display: block;
            color: #aaa;
            font-size: 13px;
            margin-bottom: 8px;
            transition: color 0.2s;
        }

        .alamat-wrap i {
            margin-top: 4px;
            color: #ff4d4d;
            /* Warna diubah menjadi merah */
            font-size: 16px;
        }

        .footer-col a:hover {
            color: #fff;
        }

        .footer-social-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .footer-social-row i {
            font-size: 18px;
            color: #fff;
        }

        .footer-social-row .fa-instagram,
        .footer-social-row .bi-instagram {
            color: #E4405F;
        }

        .footer-social-row .fa-whatsapp {
            color: #25D366;
        }

        .footer-social-row span {
            color: #aaa;
            font-size: 13px;
        }

        .footer-social-row img.market-icon {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        .footer-addr p {
            color: #aaa;
            font-size: 12px;
            line-height: 1.8;
            margin-bottom: 14px;
        }

        .footer-addr iframe {
            width: 100%;
            height: 140px;
            border-radius: 8px;
            border: none;
        }

        .footer-addr a.maps-link {
            display: inline-block;
            margin-top: 10px;
            color: #aaa;
            font-size: 12px;
            text-decoration: underline;
        }

        .footer-addr a.maps-link:hover {
            color: #fff;
        }

        .footer-bottom {
            width: 100%;
            max-width: 1440px;
            margin: 24px auto 0;
            padding-top: 18px;
            border-top: 1px solid #333;
            text-align: center;
            color: #555;
            font-size: 12px;
        }

        /* =============================================
           GLOBAL BANNER & SLIDER HELPERS (MOBILE READY)
        ============================================= */
        .hero-slider img, .promo-banner img, .banner-img {
            width: 100%;
            height: auto;
            border-radius: 12px;
            object-fit: cover;
        }
        
        /* Mencegah gambar meluap di mobile */
        .img-fluid-mobile {
            max-width: 100%;
            height: auto;
        }

        /* Responsive breakpoints */
        @media (max-width: 1200px) {
            .navbar-inner {
                padding: 0 20px;
            }

            .nav-logo {
                width: 120px;
                margin-left: 15px;
            }

            .nav-logo img {
                width: 100%;
                height: auto;
            }

            .nav-search {
                max-width: 480px;
            }

            .nav-menu {
                gap: 30px;
            }
        }

        @media (max-width: 992px) {
            .navbar-inner {
                padding: 0 16px;
            }

            .nav-logo {
                width: 100px;
                margin-left: 10px;
            }

            .nav-logo img {
                width: 100%;
                height: auto;
            }

            .search-form {
                height: 36px;
            }

            .nav-search {
                max-width: 380px;
            }

            .nav-menu {
                gap: 20px;
            }

            .nav-menu>li>a {
                font-size: 12px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 10px 0 0;
            }
            .navbar-inner {
                grid-template-columns: auto 1fr auto;
                grid-template-rows: auto auto auto;
                padding: 0 16px;
                column-gap: 10px;
            }

            .nav-logo {
                grid-column: 1;
                grid-row: 1;
                width: 90px;
                margin-left: 0;
            }

            .nav-right {
                grid-column: 3;
                grid-row: 1;
                gap: 12px;
            }

            .nav-search {
                grid-column: 1 / -1;
                grid-row: 2;
                padding: 12px 0 6px;
            }

            .search-form {
                height: 40px;
                background: #fdfdfd;
                border: 1px solid #ddd;
            }

            .nav-menu-wrap {
                grid-column: 1 / -1;
                grid-row: 3;
                margin: 0 -16px; /* Menarik container ke tepi layar hp */
                padding: 0;
                position: relative;
                overflow: hidden;
            }

            .nav-menu {
                display: flex;
                flex-direction: row; 
                flex-wrap: nowrap;
                justify-content: flex-start; 
                align-items: center; 
                gap: 10px;
                padding: 8px 16px 18px; /* Padding kiri-kanan agar sejajar konten lain */
                background: transparent;
                width: max-content; 
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
                /* Efek fade halus di sisi kanan agar menu tidak terlihat terpotong kasar */
                -webkit-mask-image: linear-gradient(to right, black 85%, transparent 100%);
                mask-image: linear-gradient(to right, black 85%, transparent 100%);
            }

            .nav-menu::-webkit-scrollbar {
                display: none;
            }

            .nav-menu > li {
                flex-shrink: 0; 
            }

            .nav-menu>li>a {
                padding: 7px 16px;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(255, 255, 255, 0.12);
                border-radius: 50px; /* Gaya Pill yang lebih rapi */
                color: #fff;
                white-space: nowrap;
            }

            /* Sembunyikan indikator dropdown dan menu dropdown di mobile agar navigasi lancar */
            .nav-menu>li>a i.fa-angle-down, 
            .nav-menu .dropdown-menu {
                display: none !important;
            }

            /* Sembunyikan teks "Akun" atau nama user di mobile agar tidak sesak */
            .user-toggle span, .user-toggle .user-name-text {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <nav class="navbar">
        <div class="navbar-inner">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('images/Logo.png') }}" alt="Twins Vapor">
            </a>

            {{-- SEARCH --}}
            <div class="nav-search">
                <form action="{{ route('catalog') }}" method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Cari produk vape..."
                        value="{{ request('search') }}">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            {{-- MENU --}}
            <div class="nav-menu-wrap">
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}">Beranda</a></li>

                    <li class="has-dropdown">
                        <a href="{{ route('catalog') }}">Kategori Produk <i class="fa-solid fa-angle-down"
                                style="font-size:11px"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('catalog', ['category' => 'mod']) }}">Mod</a></li>
                            <li><a href="{{ route('catalog', ['category' => 'pod']) }}">Pod</a></li>
                            <li class="has-sub">
                                <a href="{{ route('catalog', ['category' => 'liquid']) }}">Liquid <i
                                        class="fa-solid fa-angle-right" style="font-size:10px"></i></a>
                                <ul class="submenu">
                                    <li><a
                                            href="{{ route('catalog', ['category' => 'liquid', 'liquid_type' => 'freebase']) }}">Freebase</a>
                                    </li>
                                    <li><a
                                            href="{{ route('catalog', ['category' => 'liquid', 'liquid_type' => 'salt']) }}">Saltnic</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{ route('catalog', ['category' => 'aio']) }}">AIO (All In One)</a>
                            </li>
                            <li class="has-sub">
                                <a href="{{ route('catalog', ['category' => 'accessories']) }}">Accessories <i
                                        style="font-size:10px"></i></a>
                            </li>
                            <li class="has-sub">
                                <a href="{{ route('catalog', ['category' => 'atomizer']) }}">Atomizers <i
                                        style="font-size:10px"></i></a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ route('spk') }}">Rekomendasi</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
                </ul>
            </div>

            {{-- RIGHT ICONS --}}
            <div class="nav-right">
                @auth
                    @if (auth()->user()->isPelanggan())
                        <a href="{{ route('pelanggan.cart') }}" style="position:relative">
                            <i class="fa-solid fa-cart-shopping"></i>
                            @php $cartCount = auth()->user()->carts()->count(); @endphp
                            <span id="cart-badge" class="cart-badge"
                                style="{{ $cartCount ? '' : 'display:none;' }}">{{ $cartCount }}</span>
                        </a>
                    @else
                        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                    @endif
                @else
                    <a href="{{ route('login') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                @endauth

                @auth
                    {{-- JIKA USER SUDAH LOGIN: Tampilkan dropdown notifikasi --}}
                    <div class="user-wrap" id="notificationDropdown">
                        <button class="user-toggle position-relative">
                            <i class="bi bi-bell-fill fs-5"></i>
                            {{-- Tampilkan badge merah hanya jika ada notifikasi yang belum dibaca --}}
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span class="cart-badge" style="width: 15px; height: 15px; top: -5px; right: -5px;"
                                    id="notificationCount">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <div class="user-dd" style="width: 300px;">
                            {{-- Header Dropdown --}}
                            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                                    Notifikasi</h6>
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <a href="#" class="text-muted" id="markAllRead"
                                        style="font-size: 10px; text-decoration: underline;">Tandai semua dibaca</a>
                                @endif
                            </div>

                            {{-- Isi Notifikasi (Looping) --}}
                            <div style="max-height: 300px; overflow-y: auto;">
                                @forelse(auth()->user()->notifications->take(10) as $notification)
                                    @php
                                        $isRead = $notification->read_at !== null;
                                        $statusColor = $isRead
                                            ? 'text-muted'
                                            : ($notification->data['status'] === 'approved'
                                                ? 'text-success'
                                                : 'text-danger');
                                        $statusIcon = $isRead
                                            ? 'bi-check-lg'
                                            : ($notification->data['status'] === 'approved'
                                                ? 'bi-check-circle-fill'
                                                : 'bi-x-circle-fill');
                                    @endphp
                                    <a href="{{ route('notifications.read', $notification->id) }}"
                                        class="notification-item border-bottom {{ $isRead ? '' : 'bg-light' }}"
                                        style="display: block; padding: 12px 16px;">
                                        <div class="d-flex align-items-start gap-2">
                                            <i class="bi {{ $statusIcon }} {{ $statusColor }}"
                                                style="font-size: 1.1rem; margin-top: 2px;"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-semibold text-dark mb-1"
                                                    style="font-size: 12px; line-height: 1.3;">
                                                    Pesanan #{{ $notification->data['order_id'] }}
                                                    {{ ucfirst($notification->data['status']) }}
                                                </div>
                                                <div class="text-muted mb-1" style="font-size: 11px; line-height: 1.4;">
                                                    {{ Str::limit($notification->data['message'], 60, '...') }}
                                                </div>
                                                <div class="text-muted text-uppercase"
                                                    style="font-size: 9px; font-weight: 600;">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="p-4 text-center text-muted">
                                        <i class="bi bi-bell-slash-fill fs-3 mb-2 d-block"></i>
                                        <p class="small mb-0">Tidak ada notifikasi.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @else
                    {{-- JIKA USER BELUM LOGIN: Tampilkan ikon lonceng biasa yang diarahkan ke halaman login --}}
                    <a href="{{ route('login') }}"><i class="bi bi-bell-fill fs-5"></i></a>
                @endauth

                <div class="nav-sep"></div>

                @guest
                    <div class="user-wrap">
                        <button class="user-toggle">
                            <i class="fa-solid fa-circle-user"></i>
                            Akun
                            <i class="fa-solid fa-angle-down" style="font-size:11px"></i>
                        </button>
                        <div class="user-dd">
                            <a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                            <a href="{{ route('register') }}"><i class="fa-solid fa-user-plus"></i> Register</a>
                        </div>
                    </div>
                @endguest

                @auth
                    <div class="user-wrap">
                        <button class="user-toggle">
                            <i class="fa-solid fa-circle-user"></i>
                            <span class="user-name-text">{{ Str::limit(Auth::user()->name, 10) }}</span>
                            <i class="fa-solid fa-angle-down" style="font-size:11px"></i>
                        </button>
                        <div class="user-dd">
                            <a href="{{ route('pelanggan.dashboard') }}"><i class="fa-solid fa-user"></i> Dashboard</a>
                            <a href="{{ route('pelanggan.orders') }}"><i class="fa-solid fa-bag-shopping"></i> Pesanan
                                Saya</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout"><i class="fa-solid fa-right-from-bracket"></i>
                                    Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- ALERT MELAYANG (FLOATING) BEBAS --}}
            @if (session()->has('success'))
                <div id="floating-alert"
                    style="position: fixed; top: 50px; right: 25px; z-index: 99999; background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; border: 1px solid #c3e6cb; font-family: 'Poppins', sans-serif; font-size: 13px; box-shadow: 0px 5px 15px rgba(0,0,0,0.2); display: flex; align-items: center; gap: 10px; transition: opacity 0.5s ease; max-width: 350px;">
                    <i class="fa-solid fa-circle-check" style="font-size: 16px;"></i>
                    <span>{{ session('success') }}</span>
                </div>

                <script>
                    setTimeout(function() {
                        let alertBox = document.getElementById('floating-alert');
                        if (alertBox) {
                            alertBox.style.opacity = '0';
                            setTimeout(() => alertBox.remove(), 500); // Hilang perlahan setelah 4 detik
                        }
                    }, 4000);
                </script>
            @endif

        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer" id="footer">
        <div class="footer-inner">

        {{-- LOGO --}}
        <div class="footer-logo">
            <img src="{{ asset('images/Logo.png') }}" alt="Twins Vapor">
        </div>

        {{-- MENU --}}
        <div class="footer-col">
            <h4>Menu</h4>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('catalog') }}">Kategori Produk</a>
            <a href="{{ route('spk') }}">Rekomendasi</a>
            <a href="{{ route('kontak') }}">Kontak Kami</a>
        </div>

        {{-- SOCIAL --}}
        <div class="footer-col">
            <h4>Sosial Media</h4>
            <div class="footer-social-row">
                <i class="bi bi-instagram"></i>
                <span>twins.vaporshop</span>
            </div>
            <h4 style="margin-top:12px">Marketplace</h4>
            <div class="footer-social-row">
                <img src="{{ asset('images/tokopedia.png') }}" class="market-icon" alt="Tokopedia">
                <span>twins.vaporshop</span>
            </div>
            <h4 style="margin-top:12px">WhatsApp</h4>
            <div class="footer-social-row">
                <i class="fab fa-whatsapp" style="color:#25D366"></i>
                <span>0857-1431-4125</span>
            </div>
        </div>

        {{-- ADDRESS --}}
        <div class="footer-col footer-addr">
            <h4>Alamat</h4>
            <p class="alamat-wrap">
                <i class="fa-solid fa-location-dot"></i>
                Jl. H. Hasan No.12, RT.13/RW.8,Baru, Kec. Ps. Rebo,Kota Jakarta Timur,
                DKI Jakarta 13780
            </p>
            <h4 style="margin-bottom:10px">Maps</h4>
            <iframe src="https://www.google.com/maps?q=Jl.%20H.%20Hasan%20No.12%20Pasar%20Rebo%20Jakarta&output=embed"
                allowfullscreen loading="lazy">
            </iframe>
            <a href="https://maps.google.com/?q=Jl.H.Hasan+No.12+Pasar+Rebo+Jakarta" target="_blank"
                class="maps-link">
                Lihat Lokasi di Google Maps
            </a>
        </div>

    </div>

    <div class="footer-bottom">
        &copy; {{ date('Y') }} Twins Vapor. All rights reserved.
    </div>
</footer>

@auth
    <script>
        document.getElementById('markAllRead')?.addEventListener('click', function(e) {
            e.preventDefault();
            fetch('{{ route('notifications.markAllRead') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => {
                if (response.ok) window.location.reload();
                else alert('Gagal memproses permintaan.');
            }).catch(error => console.error('Error:', error));
        });
    </script>
    <script>
        // Fungsi global untuk update badge keranjang secara real-time
        window.updateCartBadge = function(count) {
            const badge = document.getElementById('cart-badge');
            if (!badge) return;

            const numCount = parseInt(count);
            if (numCount > 0) {
                badge.style.display = 'flex';
                badge.innerText = numCount;
            } else {
                badge.style.display = 'none';
                badge.innerText = '0';
            }
        };
    </script>
@endauth
@stack('scripts')
</body>

</html>
