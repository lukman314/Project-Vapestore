@extends('layouts.twins')

@section('title', 'Katalog Produk')

@section('content')
    <div class="container py-4">
        <div class="row g-4">
            {{-- Filter Sidebar --}}
            <div class="col-lg-3">
                <div class="card p-3 sticky-top" style="top:80px">
                    <h6 class="fw-bold mb-3"><i class="bi bi-funnel"></i> Filter Produk</h6>
                    <form action="{{ route('catalog') }}" method="GET" id="filterForm">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Kategori</label>
                            <select name="category" class="form-select form-select-sm"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->slug }}"
                                        {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Jenis Liquid</label>
                            <select name="liquid_type" class="form-select form-select-sm"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="">Semua</option>
                                <option value="freebase" {{ request('liquid_type') == 'freebase' ? 'selected' : '' }}>
                                    Freebase
                                </option>
                                <option value="salt" {{ request('liquid_type') == 'salt' ? 'selected' : '' }}>Salt Nic
                                </option>
                                <option value="kosong" {{ request('liquid_type') == 'kosong' ? 'selected' : '' }}>Kosong
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Harga Maks (Rp)</label>
                            <input type="text" name="max_price" class="form-control form-control-sm currency-input"
                                value="{{ request('max_price') ? number_format(request('max_price'), 0, ',', '.') : '' }}"
                                placeholder="500.000" data-currency>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Urutkan</label>
                            <select name="sort" class="form-select form-select-sm"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="rating" {{ request('sort', 'rating') == 'rating' ? 'selected' : '' }}>Rating
                                    Tertinggi</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler
                                </option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga:
                                    Rendah
                                    ke Tinggi</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga:
                                    Tinggi ke Rendah</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-vs btn-sm w-100">Terapkan Filter</button>
                        <a href="{{ route('catalog') }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">Reset</a>
                    </form>
                </div>
            </div>

            {{-- Products Grid --}}
            <div class="col-lg-9">

                {{-- ===== REKOMENDASI SECTION ===== --}}
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2 class="fw-bold text-uppercase mb-0 fs-3">
                            <i class="bi bi-stars" style="color:#ff6b35"></i> Twins Rekomendasi
                        </h2>
                        <a href="{{ route('spk') }}" class="text-decoration-none text-uppercase fw-bold"
                            style="color:#ff6b35;font-size:.85rem; white-space: nowrap;">Rekomendasi Cerdas <i
                                class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="row g-4">
                        @foreach ($recommended as $i => $rec)
                            <div class="col-6 col-md-3">
                                <div class="card h-100 border-0 shadow-sm rounded-4"
                                    style="border-top:3px solid #ff6b35 !important;position:relative">
                                    {{-- Rank badge --}}
                                    <div style="position:absolute;top:8px;left:8px;z-index:1">
                                        <span
                                            class="badge rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                            style="width:26px;height:26px;background:#ff6b35;font-size:.75rem">#{{ $i + 1 }}</span>
                                    </div>
                                    <a href="{{ route('product.detail', $rec) }}" class="text-decoration-none">
                                        <div class="d-flex align-items-center justify-content-center bg-transparent"
                                            style="height:120px;overflow:hidden">
                                            @if ($rec->image)
                                                <img src="{{ Storage::url($rec->image) }}"
                                                    class="img-fluid h-100 w-100 object-fit-contain"
                                                    alt="{{ $rec->name }}">
                                            @else
                                                <i class="bi bi-image text-muted" style="font-size:2rem"></i>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="card-body p-2">
                                        <span class="badge rounded-pill mb-1"
                                            style="background:#f0f0f0;color:#666;font-size:.6rem">
                                            {{ $rec->category->name }}
                                        </span>
                                        <a href="{{ route('product.detail', $rec) }}"
                                            class="text-decoration-none text-dark">
                                            <p class="fw-semibold mb-1 lh-sm" style="font-size:.8rem">{{ $rec->name }}
                                            </p>
                                        </a>
                                        <div class="d-flex align-items-center gap-1 mb-1">
                                            <i class="bi bi-star-fill text-warning" style="font-size:.65rem"></i>
                                            <small class="text-muted" style="font-size:.65rem">{{ $rec->rating }} ·
                                                {{ number_format($rec->purchase_count) }}x terjual</small>
                                        </div>
                                        <div class="fw-bold" style="color:#ff6b35;font-size:.85rem">
                                            {{ $rec->formatted_price }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr class="mb-4">
                {{-- ===== END REKOMENDASI ===== --}}

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div>
                        <h5 class="fw-bold text-uppercase mb-0">Katalog Produk</h5>
                        <small class="text-muted">{{ $products->total() }} produk ditemukan</small>
                    </div>
                    <form action="{{ route('catalog') }}" method="GET" class="d-flex gap-2">
                        @foreach (request()->except(['search', 'page']) as $key => $val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endforeach
                        <input type="text" name="search" class="form-control form-control-sm"
                            placeholder="Cari produk..." value="{{ request('search') }}" style="min-width:200px">
                        <button class="btn btn-vs btn-sm"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                @if ($products->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-search text-muted" style="font-size:4rem"></i>
                        <p class="mt-3 text-muted">Tidak ada produk yang sesuai.</p>
                        <a href="{{ route('catalog') }}" class="btn btn-vs btn-sm">Reset Filter</a>
                    </div>
                @else
                    <div class="row g-3">
                        @foreach ($products as $product)
                            <div class="col-6 col-md-4">
                                <div class="card h-100 product-card">
                                    <a href="{{ route('product.detail', $product) }}" class="text-decoration-none">
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-transparent"
                                            style="height:150px;overflow:hidden">
                                            @if ($product->image)
                                                <img src="{{ Storage::url($product->image) }}"
                                                    class="img-fluid h-100 w-100 object-fit-contain"
                                                    alt="{{ $product->name }}">
                                            @else
                                                <i class="bi bi-image text-muted" style="font-size:2.5rem"></i>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="card-body d-flex flex-column p-3">
                                        <span class="badge rounded-pill mb-1"
                                            style="background:#f0f0f0;color:#666;font-size:.65rem">
                                            {{ $product->category->name }}
                                            @if ($product->liquid_type !== 'kosong')
                                                · {{ ucfirst($product->liquid_type) }}
                                                @if ($product->nicotine > 0)
                                                    · {{ $product->nicotine }}mg
                                                @endif
                                            @endif
                                        </span>
                                        <a href="{{ route('product.detail', $product) }}"
                                            class="text-decoration-none text-dark">
                                            <h6 class="fw-semibold mb-1" style="font-size:.9rem">{{ $product->name }}
                                            </h6>
                                        </a>
                                        <div class="small text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <span class="text-muted ms-1">{{ $product->rating }} ·
                                                {{ number_format($product->purchase_count) }}x terjual</span>
                                        </div>
                                        <div class="fw-bold mt-auto mb-2 text-dark">{{ $product->formatted_price }}</div>
                                        @auth
                                            @if (auth()->user()->isPelanggan())
                                                <form action="{{ route('pelanggan.cart.add', $product) }}" method="POST"
                                                    class="ajax-cart-form">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button class="btn btn-vs btn-sm w-100">
                                                        <i class="bi bi-cart-plus"></i> Tambah
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('product.detail', $product) }}"
                                                    class="btn btn-custom-detail btn-sm w-100 rounded-3">Detail</a>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-vs btn-sm w-100">
                                                <i class="bi bi-cart-plus"></i> Tambah
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .btn-vs {
            background: #000000;
            border-color: #000000;
            color: #fff !important;
            font-weight: 600;
        }

        .btn-vs:hover {
            background: #000000;
            border-color: #000000;
            color: #fff !important;
        }

        .product-card {
            transition: .2s;
            border: 1px solid #eee;
        }

        .product-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, .1);
            transform: translateY(-3px);
        }

        .pagination svg {
            width: 16px !important;
            height: 16px !important;
        }

        .pagination {
            gap: 4px;
        }

        /* Mengubah warna latar belakang tombol pagination aktif */
        .pagination .page-item.active .page-link {
            background-color: #000000 !important;
            border-color: #000000 !important;
            color: #ffffff !important;
        }

        /* Mengubah warna teks nomor halaman yang tidak aktif */
        .pagination .page-link {
            color: #000000 !important;
            border: 1px solid #d3d3d3;
        }

        /* Efek saat nomor halaman di-hover */
        .pagination .page-link:hover {
            background-color: #000000;
            color: #ffffff !important;
        }

        /* TOMBOL DETAIL - SEBELUM DI-HOVER */
        .btn-custom-detail {
            background-color: #ffffff;
            /* Warna latar belakang (transparent = tembus pandang) */
            color: #000000;
            /* Warna teks */
            border: 1px solid #000000;
            /* Warna dan ketebalan garis pinggir */
            font-weight: 600;
            transition: all 0.3s ease;
            /* Membuat efek perubahan warnanya halus */
        }

        /* TOMBOL DETAIL - SESUDAH DI-HOVER */
        .btn-custom-detail:hover {
            background-color: #000000;
            /* Warna latar belakang berubah oranye */
            color: #ffffff !important;
            /* Warna teks berubah putih */
            border-color: #000000;
            /* Garis pinggir tetap oranye */
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format currency input
            const currencyInputs = document.querySelectorAll('[data-currency]');

            currencyInputs.forEach(input => {
                // Format saat input
                input.addEventListener('input', function(e) {
                    let value = this.value.replace(/\D/g, '');

                    if (value) {
                        value = new Intl.NumberFormat('id-ID').format(value);
                    }

                    this.value = value;
                });

                // Convert kembali ke angka sebelum form submit
                const form = input.closest('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        const numberValue = input.value.replace(/\D/g, '');
                        input.value = numberValue;
                    });
                }
            });
        });
    </script>
@endpush
