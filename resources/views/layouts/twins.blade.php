<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Twins Vapor - Vape Store Terpercaya</title>
    <meta name="description"
        content="Twins Vapor - Toko vape terpercaya. Jual liquid, pod, mod, atomizer, accessories dan lebih.">

    {{-- GOOGLE FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ICONS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* =============================================
           NAVBAR
        ============================================= */
        .navbar {
            width: 100%;
            background: #111;
            position: sticky;
            top: 0;
            z-index: 9999;
            /* Padding diperkecil agar hitamnya kembali tipis seperti awal */
            padding: 8px 0;
        }

        .navbar-inner {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 30px;

            display: grid;
            grid-template-columns: 1fr auto 1fr;
            grid-template-rows: auto auto;
            /* Jarak sangat rapat agar tidak melar ke bawah */
            row-gap: 10px;
            align-items: center;
        }

        .nav-logo {
            grid-column: 1;
            /* KUNCI SAKTI: Logo mengambil 2 baris penuh secara vertikal */
            grid-row: 1 / span 2;
            display: flex;
            align-items: center;
            margin-left: 40px;
        }

        .nav-logo img {
            width: 90px;
            /* Tetap pakai ukuran asli 60px */
            height: 90px;
            object-fit: contain;
        }

        .nav-right {
            grid-column: 3;
            /* KUNCI SAKTI: Ikon Kanan juga mengambil 2 baris agar sejajar */
            grid-row: 1 / span 2;
            display: flex;
            align-items: center;
            gap: 16px;
            justify-content: flex-end;
            /* Paksa mentok ke ujung kanan */
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
            width: 480px;
            /* Mengunci lebar dengan presisi */
        }

        .nav-menu-wrap {
            grid-column: 2;
            grid-row: 2;
            width: 100%;
            display: flex;
        }

        .nav-menu {
            display: flex;
            width: 100%;
            /* Otomatis meratakan teks 'Beranda' dan 'Kontak Kami' sejajar
               dengan ujung kiri-kanan Search bar */
            justify-content: space-between;
            align-items: center;
            /* Pastikan TIDAK ADA properti "gap" di sini agar rata presisi */
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
            color: #ff4d4d; /* Warna diubah menjadi merah */
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
    </style>
@stack('styles')
</head>
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
                            <li><a href="{{ route('catalog', ['category' => 'accessories']) }}">AIO (All In One)</a>
                            </li>
                            <li class="has-sub">
                                <a href="{{ route('catalog', ['category' => 'accessories']) }}">Accessories <i
                                        class="fa-solid fa-angle-right" style="font-size:10px"></i></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('catalog', ['category' => 'accessories']) }}">Battery
                                            Cell</a></li>
                                    <li><a href="{{ route('catalog', ['category' => 'accessories']) }}">Charger</a>
                                    </li>
                                    <li><a href="{{ route('catalog', ['category' => 'accessories']) }}">Cotton</a></li>
                                    <li><a href="{{ route('catalog', ['category' => 'accessories']) }}">Driptip</a>
                                    </li>
                                    <li><a href="{{ route('catalog', ['category' => 'accessories']) }}">Toolkit</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a href="{{ route('catalog', ['category' => 'atomizer']) }}">Atomizers <i
                                        class="fa-solid fa-angle-right" style="font-size:10px"></i></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('catalog', ['category' => 'atomizer']) }}">RDA</a></li>
                                    <li><a href="{{ route('catalog', ['category' => 'atomizer']) }}">RTA</a></li>
                                    <li><a href="{{ route('catalog', ['category' => 'atomizer']) }}">RDTA</a></li>
                                    <li><a href="{{ route('catalog', ['category' => 'atomizer']) }}">RBA</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ route('spk') }}">Rekomendasi</a></li>
                    <li><a href="#footer">Kontak Kami</a></li>
                </ul>
            </div>

            {{-- RIGHT ICONS --}}
            <div class="nav-right">
                @auth
                    @if (auth()->user()->isPelanggan())
                        <a href="{{ route('pelanggan.cart') }}" style="position:relative">
                            <i class="fa-solid fa-cart-shopping"></i>
                            @php $cartCount = auth()->user()->carts()->count(); @endphp
                            <span id="cart-badge" class="cart-badge" style="{{ $cartCount ? '' : 'display:none;' }}">{{ $cartCount }}</span>
                        </a>
                    @else
                        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                    @endif
                @else
                    <a href="{{ route('login') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                @endauth

                <a href="#"><i class="fa-solid fa-bell"></i></a>

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
                            {{ Str::limit(Auth::user()->name, 10) }}
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
                <a href="#footer">Kontak Kami</a>
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
                <iframe
                    src="https://www.google.com/maps?q=Jl.%20H.%20Hasan%20No.12%20Pasar%20Rebo%20Jakarta&output=embed"
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
    @stack('scripts')
</body>
</html>