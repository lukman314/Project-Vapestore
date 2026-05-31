<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — VapeStore</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    
    <style>
        :root {
            --vs-primary: #ffffff;
            --vs-dark: #fffbfb;
        }

        body {
            background: #ffffff;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background-color: #000000;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar .brand {
            padding: 1.25rem 1.5rem 1rem;
            border-bottom: 1px solid #ffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .sidebar .brand span {
            color: white;
        }

        .sidebar .brand a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #fff;
        }

        .sidebar .brand img {
            height: 120px;
            width: auto;
            object-fit: contain;
        }

        .sidebar .brand-label {
            color: #ffffff;
            padding: .25rem .75rem;
            margin-top: .75rem;
            display: inline-block;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: .6rem 1.5rem;
            transition: .2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(177, 177, 177, 0.15);
            border-left: 3px solid var(--vs-primary);
        }

        .sidebar .nav-link i {
            width: 22px;
        }

        .main-content {
            margin-left: 240px;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: .75rem 1.5rem;
        }

        .card {
            border: none;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .08);
        }

        .btn-vs {
            border-color: black;
            color: #000000;
        }

        .btn-vs:hover {
            background: #000000;
            color: #ffffff;
        }
    </style>
    @stack('styles')
</head>

<body>
    <nav class="sidebar d-flex flex-column">
        <div class="brand">
            <img src="{{ asset('images/Logo.png') }}" alt="VapeStore Logo">
            <div class="small brand-label">Area Pelanggan</div>
        </div>
        <ul class="nav flex-column py-2">
            <li class="nav-item">
                <a href="{{ route('pelanggan.dashboard') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i> Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('spk') }}" class="nav-link {{ request()->routeIs('spk') ? 'active' : '' }}">
                    <i class="bi bi-stars"></i> Rekomendasi
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pelanggan.cart') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.cart') ? 'active' : '' }}">
                    <i class="bi bi-cart3"></i> Keranjang
                    @php $cartCount = auth()->check() ? auth()->user()->carts()->count() : 0 @endphp
                    @if ($cartCount > 0)
                        <span class="badge bg-danger ms-1">{{ $cartCount }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pelanggan.orders') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.orders*') ? 'active' : '' }}">
                    <i class="bi bi-bag-check"></i> Pesanan Saya
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pelanggan.profile.edit') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-person-gear"></i> Profile Saya
                </a>
            </li>
        </ul>
        <div class="mt-auto p-3 border-top" style="border-color:#fff!important">
            <div class="d-flex align-items-center gap-2 text-white-50 small mb-2">
                <i class="bi bi-person-circle fs-5"></i>
                <span>{{ auth()->user()->name ?? 'User' }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-secondary btn-sm w-100" type="submit">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </nav>

    <div class="main-content">
        <div class="topbar d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold text-muted">@yield('page-title', 'Dashboard')</h6>
        </div>
        <div class="p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
