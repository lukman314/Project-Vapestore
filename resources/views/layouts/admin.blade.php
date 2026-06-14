<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — VapeStore Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    <style>
        :root { --vs-primary: #ffffff; --vs-dark: #000000; }
        body { background: #f0f2f5; }
        .sidebar { width: 240px; min-height: 100vh; background-color: #000000; position: fixed; top: 0; left: 0; z-index: 100; }
        .sidebar .brand {
            padding: 1.25rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .sidebar .brand span { color: white; }
        .sidebar .brand a { display: inline-flex; align-items: center; justify-content: center; text-decoration: none; color: #fff; }
        .sidebar .brand img { height: 120px; width: auto; object-fit: contain; }
        .sidebar .brand-label { color: #ffffff; padding: .25rem .75rem; margin-top: .75rem; display: inline-block; }
        .sidebar .nav-link { color: rgba(255,255,255,.7); padding: .6rem 1.5rem; border-radius: 0; transition: .2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(177, 177, 177, 0.15); border-left: 3px solid var(--vs-primary); }
        .sidebar .nav-link i { width: 22px; }
        .sidebar .nav-section { font-size: .7rem; text-transform: uppercase; letter-spacing: .08em; color: rgba(255,255,255,.4); padding: .75rem 1.5rem .25rem; }
        .main-content { margin-left: 240px; }
        .topbar { background: #fff; border-bottom: 1px solid #dee2e6; padding: .75rem 1.5rem; }
        .card { border: none; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .btn-vs { background: #000000; border-color: #000000; color: #fff; }
        .btn-vs:hover { background: #222222; border-color: #222222; color: #fff; }
        .text-vs { color: #000000 !important; }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column">
        <div class="brand">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/Logo.png') }}" alt="VapeStore Logo">
            </a>
            <div class="small brand-label">Panel Admin</div>
        </div>
        <ul class="nav flex-column py-2">
            <li><span class="nav-section">Utama</span></li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li><span class="nav-section">Toko</span></li>
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Produk
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Kategori
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                    <i class="bi bi-bag-check"></i> Pesanan
                    @php $pending = \App\Models\Order::where('status','pending')->count() @endphp
                    @if($pending > 0)
                        <span class="badge bg-danger ms-1">{{ $pending }}</span>
                    @endif
                </a>
            </li>
            <li><span class="nav-section">Pengguna</span></li>
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Pelanggan
                </a>
            </li>
            <li><span class="nav-section">SPK</span></li>
            <li class="nav-item">
                <a href="{{ route('admin.spk.index') }}" class="nav-link {{ request()->routeIs('admin.spk*') ? 'active' : '' }}">
                    <i class="bi bi-sliders"></i> Kriteria SAW
                </a>
            </li>
        </ul>
        <div class="mt-auto p-3 border-top" style="border-color:rgba(255,255,255,.1)!important">
            <div class="d-flex align-items-center gap-2 text-white-50 small mb-2">
                <i class="bi bi-person-circle fs-5"></i>
                <span>{{ auth()->user()->name }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-secondary btn-sm w-100" type="submit">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </nav>

    <!-- Main -->
    <div class="main-content">
        <div class="topbar d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold text-muted">@yield('page-title', 'Dashboard')</h6>
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                <i class="bi bi-globe"></i> Lihat Toko
            </a>
        </div>

        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
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
