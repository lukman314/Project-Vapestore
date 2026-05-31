<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'VapeStore') — VapeStore</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --vs-primary: #111111;
            --vs-dark: #111111;
        }
        body { background: #f8f9fa; }
        .navbar-brand span { color: var(--vs-primary); }
        .btn-vs { background: var(--vs-primary); border-color: var(--vs-primary); color: #fff; }
        .btn-vs:hover { background: #e55a25; border-color: #e55a25; color: #fff; }
        .text-vs { color: var(--vs-primary) !important; }
        .badge-vs { background: var(--vs-primary); }
        footer { background: var(--vs-dark); }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/Logo.png') }}"
                    style="height:65px"
                    alt="Twins Vapor">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('catalog*') ? 'active' : '' }}" href="{{ route('catalog') }}">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('spk') ? 'active' : '' }}" href="{{ route('spk') }}">
                            <i class="bi bi-stars"></i> Rekomendasi SPK
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">
                            Kontak Kami
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                <a class="nav-link">
                    <i class="bi bi-bell"></i>
                </a>
            </li>
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Masuk</a></li>
                        <li class="nav-item"><a class="btn btn-vs btn-sm ms-2 rounded-pill px-3" href="{{ route('register') }}">Daftar</a></li>
                    @else
                        @if(auth()->user()->isPelanggan())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.cart') }}">
                                <i class="bi bi-cart3"></i>
                                <span class="badge bg-danger badge-vs rounded-pill" id="cart-badge">
                                    {{ auth()->user()->carts()->count() }}
                                </span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(auth()->user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard Admin</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('pelanggan.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('pelanggan.orders') }}"><i class="bi bi-bag"></i> Pesanan Saya</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-0 rounded-0" role="alert">
            <div class="container">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-0 rounded-0" role="alert">
            <div class="container">{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show m-0 rounded-0" role="alert">
            <div class="container">{{ session('warning') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')

    <footer class="text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-1"><strong><i class="bi bi-cloud-fog2-fill"></i> VapeStore</strong></p>
            <small class="text-muted">© {{ date('Y') }} VapeStore. Semua hak dilindungi.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cartBadge = document.getElementById('cart-badge');
            const alertContainer = document.createElement('div');
            alertContainer.style.position = 'fixed';
            alertContainer.style.top = '1rem';
            alertContainer.style.right = '1rem';
            alertContainer.style.zIndex = '1050';
            document.body.appendChild(alertContainer);

            document.querySelectorAll('form.ajax-cart-form').forEach(function (form) {
                form.addEventListener('submit', async function (event) {
                    event.preventDefault();

                    const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
                    const originalText = submitButton ? submitButton.innerHTML : null;
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.innerHTML = 'Menambahkan...';
                    }

                    const formData = new FormData(form);
                            let response, data = {};
                            try {
                                response = await fetch(form.action, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                        'Accept': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    credentials: 'same-origin',
                                    body: formData,
                                });

                                // try parse JSON if any
                                data = await response.json().catch(() => ({}));
                                console.debug('Add-to-cart response', response.status, data);
                            } catch (err) {
                                console.error('AJAX add-to-cart failed', err);
                                showMessage('Gagal terhubung ke server.', 'danger');
                                if (submitButton) { submitButton.disabled = false; submitButton.innerHTML = originalText; }
                                return;
                            }

                    const showMessage = function (message, type) {
                        const alertBox = document.createElement('div');
                        alertBox.className = 'alert alert-' + type + ' alert-dismissible fade show';
                        alertBox.role = 'alert';
                        alertBox.innerHTML = message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        alertContainer.appendChild(alertBox);
                        setTimeout(function () {
                            alertBox.classList.remove('show');
                        }, 4000);
                    };

                    if (response.ok && data.success) {
                        if (cartBadge && typeof data.cart_count !== 'undefined') {
                            cartBadge.textContent = data.cart_count;
                        }
                        showMessage(data.message || 'Produk berhasil ditambahkan ke keranjang.', 'success');
                    } else {
                        showMessage(data.message || 'Gagal menambahkan produk ke keranjang.', 'danger');
                    }

                    if (submitButton) {
                        submitButton.disabled = false;
                        if (originalText !== null) {
                            submitButton.innerHTML = originalText;
                        }
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html> 