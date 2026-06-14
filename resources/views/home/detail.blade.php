@extends('layouts.twins')

@section('title', $product->name)

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('catalog') }}">Katalog</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('catalog', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <div class="col-md-5">
                <div class="card p-4 text-center" style="min-height:300px">
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded"
                            style="max-height:280px;object-fit:contain" alt="{{ $product->name }}">
                    @else
                        <i class="bi bi-image-fill text-muted" style="font-size:8rem;margin:auto"></i>
                    @endif
                </div>
            </div>
            <div class="col-md-7">
                <span class="badge rounded-pill bg-light text-dark mb-2">{{ $product->category->name }}</span>
                <h2 class="fw-bold mb-2">{{ $product->name }}</h2>

                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="text-warning">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= round($product->rating) ? '-fill' : '' }}"></i>
                        @endfor
                        <span class="text-dark fw-semibold ms-1">{{ $product->rating }}</span>
                    </div>
                    <span class="text-muted">|</span>
                    <span class="text-muted"><i class="bi bi-bag-check-fill"></i> {{ number_format($product->purchase_count) }}x
                        terjual</span>
                    <span class="text-muted">|</span>
                    <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                        <i class="bi bi-{{ $product->stock > 0 ? 'check-circle-fill' : 'x-circle-fill' }}"></i>
                        {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Habis' }}
                    </span>
                </div>

                <div class="fs-2 fw-bold mb-3 text-dark">{{ $product->formatted_price }}</div>

                <div class="row g-2 mb-3">
                    @if ($product->liquid_type !== 'kosong')
                        <div class="col-auto">
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-droplet-half"></i> {{ ucfirst($product->liquid_type) }}
                            </span>
                        </div>
                    @endif
                    @if ($product->nicotine > 0)
                        <div class="col-auto">
                            <span class="badge bg-secondary">Nikotin {{ $product->nicotine }}mg</span>
                        </div>
                    @endif
                </div>

                @if ($product->stock > 0)
                    @auth
                        @if (auth()->user()->isPelanggan())
                            <form action="{{ route('pelanggan.cart.add', $product) }}" method="POST"
                                class="ajax-cart-form d-flex gap-3 align-items-center">
                                @csrf
                                <div class="input-group" style="width:140px">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="this.nextElementSibling.stepDown()">-</button>
                                    <input type="number" name="quantity" class="form-control text-center" value="1"
                                        min="1" max="{{ $product->stock }}">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="this.previousElementSibling.stepUp()">+</button>
                                </div>
                                <button type="submit" class="btn btn-vs btn-lg px-4">
                                    <i class="bi bi-cart-plus-fill"></i> Tambah ke Keranjang
                                </button>
                            </form>
                        @else
                            <div class="alert alert-info">Login sebagai pelanggan untuk membeli produk ini.</div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-vs btn-lg px-4">
                            <i class="bi bi-cart-plus-fill"></i> Login untuk Membeli
                        </a>
                    @endauth
                @else
                    <button class="btn btn-secondary btn-lg px-4" disabled>Stok Habis</button>
                @endif
            </div>
        </div>

        {{-- DESKRIPSI & SPESIFIKASI --}}
        <div class="product-info-section mt-5">

            <div class="info-tabs">
                <button class="tab-btn active" onclick="showTab('desc')">Deskripsi</button>
                <button class="tab-btn" onclick="showTab('spec')">Spesifikasi</button>
            </div>

            {{-- DESKRIPSI --}}
            <div id="desc" class="tab-content active text-start">
                <h3 class="text-center fw-bold mb-4">Deskripsi</h3>

                @if ($product->description)
                    <div class="desc-wrapper text-muted" style="line-height: 1.8; font-size: 0.95rem;">
                        @php
                            $descLines = explode("\n", $product->description);
                            $inDescList = false;
                        @endphp

                        @foreach ($descLines as $line)
                            @php $line = trim($line); @endphp

                            {{-- Lewati baris yang benar-benar kosong agar tidak merusak struktur HTML --}}
                            @if (empty($line))
                                @continue
                            @endif

                            {{-- Jika teks diawali dengan '-', ubah menjadi list (bullet) --}}
                            @if (strpos($line, '-') === 0)
                                @if (!$inDescList)
                                    <ul class="spec-list mt-2">
                                        @php $inDescList = true; @endphp
                                @endif
                                <li>{{ trim(substr($line, 1)) }}</li>
                            @else
                                {{-- Jika teks biasa, tutup list (jika sedang terbuka) lalu jadikan paragraf --}}
                                @if ($inDescList)
                                    </ul>
                                    @php $inDescList = false; @endphp
                                @endif
                                <p class="mb-2 mt-2 text-dark">
                                    {{ $line }}
                                </p>
                            @endif
                        @endforeach

                        {{-- Pastikan tag <ul> tertutup jika kalimat terakhir adalah list --}}
                        @if ($inDescList)
                            </ul>
                        @endif
                    </div>
                @else
                    <p class="text-muted text-center">Deskripsi produk belum tersedia.</p>
                @endif
            </div>

            {{-- SPESIFIKASI --}}
            <div id="spec" class="tab-content text-start">
                {{-- Judul kembali ke tengah tanpa garis bawah --}}
                <h3 class="text-center fw-bold mb-4">Spesifikasi</h3>

                @if ($product->specifications)
                    <div class="spec-wrapper">
                        @php
                            $lines = explode("\n", $product->specifications);
                            $inList = false;
                        @endphp

                        @foreach ($lines as $line)
                            @php $line = trim($line); @endphp
                            @if (empty($line))
                                @continue
                            @endif

                            @if (strpos($line, '-') === 0)
                                @if (!$inList)
                                    <ul class="spec-list">
                                        @php $inList = true; @endphp
                                @endif
                                <li>{{ trim(substr($line, 1)) }}</li>
                            @else
                                @if ($inList)
                                    </ul>
                                    @php $inList = false; @endphp
                                @endif
                                <p class="mb-1 mt-2 text-dark" style="font-size: 0.95rem; font-weight: 600;">
                                    {{ $line }}
                                </p>
                            @endif
                        @endforeach

                        @if ($inList)
                            </ul>
                        @endif
                    </div>
                @else
                    <p class="text-muted text-center">Spesifikasi tidak tersedia</p>
                @endif
            </div>
        </div>

        {{-- Related Products --}}
        @if ($related->isNotEmpty())
            <div class="mt-5">
                <h5 class="fw-bold mb-3">Produk Serupa</h5>
                <div class="row g-3">
                    @foreach ($related as $p)
                        <div class="col-6 col-md-3">
                            <div class="card h-100">
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                    style="height:120px">
                                    @if ($p->image)
                                        <img src="{{ Storage::url($p->image) }}"
                                            class="img-fluid h-100 w-100 object-fit-contain" alt="{{ $p->name }}">
                                    @else
                                        <i class="bi bi-image-fill text-muted" style="font-size:2rem"></i>
                                    @endif
                                </div>
                                <div class="card-body p-2">
                                    <div class="small fw-semibold">{{ $p->name }}</div>
                                    <div class="small fw-bold" style="color:#ff6b35">{{ $p->formatted_price }}</div>
                                    <a href="{{ route('product.detail', $p) }}"
                                        class="btn btn-outline-secondary btn-sm w-100 mt-2">Lihat</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .btn-vs {
            background: #000000;
            border-color: #000000;
            color: #fff;
        }

        .btn-vs:hover {
            background: #000000;
            color: #fff;
        }

        /* TAB SECTION */
        .product-info-section {
            margin-top: 40px;
        }

        .info-tabs {
            display: flex;
        }

        /* Tab yang tidak dipilih */
        .tab-btn {
            width: 50%;
            border: 1px solid #111;
            /* Garis diubah menjadi hitam */
            border-bottom: none;
            background: #fff;
            /* Background diubah menjadi putih */
            color: #111;
            /* Warna teks hitam */
            font-size: 1.1rem;
            font-weight: 600;
            padding: 12px;
            transition: 0.2s ease;
        }

        /* Tab yang sedang dipilih */
        .tab-btn.active {
            background: #000000;
            color: #fff;
            border-color: #000000;
        }

        /* Box Konten Deskripsi & Spesifikasi */
        .tab-content {
            display: none;
            border: 1px solid #000000;
            padding: 30px;
            background: #fff;
            text-align: left !important;
            /* Memaksa semua isi box menjadi rata kiri */
        }

        .tab-content.active {
            display: block;
        }

        /* Modifikasi khusus untuk list spesifikasi */
        .spec-list {
            padding-left: 20px;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .spec-list li {
            margin-bottom: 8px;
            font-size: 0.95rem;
            color: #444;
            list-style-type: disc;
            /* Memberikan gaya titik hitam standar */
            line-height: 1.6;
        }

        /* Judul utama tab */
        .tab-content h3 {
            text-align: center;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 20px;
        }

        /* Ini kunci untuk mengecilkan judul spesifikasi (h5) agar sama dengan teks biasa */
        .tab-content h5 {
            font-size: 0.95rem;
            font-weight: 700;
            /* Tetap tebal agar membedakan dengan isi */
            margin-top: 10px;
            margin-bottom: 6px;
        }

        /* Teks paragraf dan isi spesifikasi */
        .tab-content p,
        .tab-content li {
            font-size: 0.95rem;
            color: #444;
        }

        .tab-content ul {
            padding-left: 20px;
        }

        .tab-content li {
            margin-bottom: 6px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function showTab(tabId) {

            document.querySelectorAll('.tab-content')
                .forEach(el => el.classList.remove('active'));

            document.querySelectorAll('.tab-btn')
                .forEach(el => el.classList.remove('active'));

            document.getElementById(tabId)
                .classList.add('active');

            event.target.classList.add('active');
        }
    </script>
