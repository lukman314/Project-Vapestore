@extends('layouts.twins')

@section('title', $product->name)

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('catalog') }}">Katalog</a></li>
            <li class="breadcrumb-item"><a href="{{ route('catalog', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card p-4 text-center" style="min-height:300px">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded" style="max-height:280px;object-fit:contain" alt="{{ $product->name }}">
                @else
                    <i class="bi bi-image text-muted" style="font-size:8rem;margin:auto"></i>
                @endif
            </div>
        </div>
        <div class="col-md-7">
            <span class="badge rounded-pill bg-light text-dark mb-2">{{ $product->category->name }}</span>
            <h2 class="fw-bold mb-2">{{ $product->name }}</h2>

            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="text-warning">
                    @for($i=1;$i<=5;$i++)
                        <i class="bi bi-star{{ $i <= round($product->rating) ? '-fill' : '' }}"></i>
                    @endfor
                    <span class="text-dark fw-semibold ms-1">{{ $product->rating }}</span>
                </div>
                <span class="text-muted">|</span>
                <span class="text-muted"><i class="bi bi-bag-check"></i> {{ number_format($product->purchase_count) }}x terjual</span>
                <span class="text-muted">|</span>
                <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                    <i class="bi bi-{{ $product->stock > 0 ? 'check-circle' : 'x-circle' }}"></i>
                    {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Habis' }}
                </span>
            </div>

            <div class="fs-2 fw-bold mb-3 text-dark">{{ $product->formatted_price }}</div>

            <div class="row g-2 mb-3">
                @if($product->liquid_type !== 'kosong')
                <div class="col-auto">
                    <span class="badge bg-info text-dark">
                        <i class="bi bi-droplet-half"></i> {{ ucfirst($product->liquid_type) }}
                    </span>
                </div>
                @endif
                @if($product->nicotine > 0)
                <div class="col-auto">
                    <span class="badge bg-secondary">Nikotin {{ $product->nicotine }}mg</span>
                </div>
                @endif
            </div>

            @if($product->description)
                <p class="text-muted mb-3">{{ $product->description }}</p>
            @endif

            @if($product->stock > 0)
                @auth
                    @if(auth()->user()->isPelanggan())
                        <form action="{{ route('pelanggan.cart.add', $product) }}" method="POST" class="ajax-cart-form d-flex gap-3 align-items-center">
                            @csrf
                            <div class="input-group" style="width:140px">
                                <button type="button" class="btn btn-outline-secondary" onclick="this.nextElementSibling.stepDown()">-</button>
                                <input type="number" name="quantity" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}">
                                <button type="button" class="btn btn-outline-secondary" onclick="this.previousElementSibling.stepUp()">+</button>
                            </div>
                            <button type="submit" class="btn btn-vs btn-lg px-4">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <div class="alert alert-info">Login sebagai pelanggan untuk membeli produk ini.</div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-vs btn-lg px-4">
                        <i class="bi bi-cart-plus"></i> Login untuk Membeli
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
        <button class="tab-btn active" onclick="showTab('desc')">
            Deskripsi
        </button>

        <button class="tab-btn" onclick="showTab('spec')">
            Spesifikasi
        </button>
    </div>

    {{-- DESKRIPSI --}}
    <div id="desc" class="tab-content active">

        <h3>Deskripsi</h3>

        <p>
            Hexohm V3 Anodize adalah salah satu device mod premium yang dikenal
            dengan performa tinggi, desain kokoh, dan kualitas build yang sangat solid.
            Dibuat oleh Craving Vapor, mod ini menghadirkan kombinasi antara kekuatan,
            kesederhanaan, dan daya tahan dalam satu perangkat yang elegan.
        </p>

        <p>
            Mengusung material billet aluminum anodized, Hexohm V3 memiliki tampilan
            mewah dengan finishing halus sekaligus tahan lama. Perangkat ini menggunakan
            sistem potentiometer (knob putar) untuk mengatur output voltage secara manual,
            memberikan kontrol penuh terhadap pengalaman vaping.
        </p>

        <p>
            Didukung chipset proprietary dengan kemampuan hingga 180W dan 30A,
            Hexohm V3 mampu menghasilkan tenaga besar yang stabil untuk berbagai
            kebutuhan vaping.
        </p>

        <br>

        <strong>Isi Paket (In The Box)</strong>

        <ul>
            <li>1x Hexohm V3 Anodize Mod</li>
            <li>1x Kartu autentikasi / serial number</li>
            <li>1x Kartu garansi</li>
            <li>1x Sticker Craving Vapor</li>
        </ul>

    </div>

    {{-- SPESIFIKASI --}}
    <div id="spec" class="tab-content">

        <h3>Spesifikasi</h3>

        <div class="row">

            <div class="col-md-6">
                <h5>Spesifikasi Hexohm V3</h5>

                <ul>
                    <li>Tipe Device: Box Mod</li>
                    <li>Material: Anodized Aluminum</li>
                    <li>Chipset: HEX-T/30-C Board</li>
                    <li>Output Power: 180 Watt</li>
                    <li>Voltage Range: 3.3V – 6.0V</li>
                    <li>Max Current: 30A</li>
                </ul>

                <h5>Baterai</h5>

                <ul>
                    <li>Dual 18650</li>
                    <li>Battery Door Magnetized</li>
                    <li>Solid Brass Contact</li>
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Fitur Utama</h5>

                <ul>
                    <li>Potentiometer Voltage Control</li>
                    <li>Master On / Off Switch</li>
                    <li>Magnetized Battery Door</li>
                    <li>Spring Loaded 510 Connector</li>
                    <li>Oversized Firing Button</li>
                </ul>

                <h5>Fitur Keamanan</h5>

                <ul>
                    <li>Low Voltage Cut-Off</li>
                    <li>Reverse Polarity Protection</li>
                    <li>10 Second Cut-Off Timer</li>
                </ul>
            </div>
        </div>
    </div>
</div>
    {{-- Related Products --}}
    @if($related->isNotEmpty())
    <div class="mt-5">
        <h5 class="fw-bold mb-3">Produk Serupa</h5>
        <div class="row g-3">
            @foreach($related as $p)
            <div class="col-6 col-md-3">
                <div class="card h-100">
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height:120px">
                        @if($p->image)
                            <img src="{{ Storage::url($p->image) }}" class="img-fluid h-100 w-100 object-fit-contain" alt="{{ $p->name }}">
                        @else
                            <i class="bi bi-image text-muted" style="font-size:2rem"></i>
                        @endif
                    </div>
                    <div class="card-body p-2">
                        <div class="small fw-semibold">{{ $p->name }}</div>
                        <div class="small fw-bold" style="color:#ff6b35">{{ $p->formatted_price }}</div>
                        <a href="{{ route('product.detail', $p) }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">Lihat</a>
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

.btn-vs{
    background:#000;
    border-color:#000;
    color:#fff;
}

.btn-vs:hover{
    background:#222;
    color:#fff;
}

/* TAB SECTION */

.product-info-section{
    margin-top:50px;
}

.info-tabs{
    display:flex;
}

.tab-btn{
    width:50%;
    border:1px solid #000;
    background:#fff;
    font-size:2rem;
    font-weight:700;
    padding:14px;
}

.tab-btn.active{
    background:#000;
    color:#fff;
}

.tab-content{
    display:none;
    border:1px solid #000;
    border-top:none;
    padding:30px;
    background:#fff;
}

.tab-content.active{
    display:block;
}

.tab-content h3{
    text-align:center;
    font-weight:700;
    margin-bottom:25px;
}

.tab-content ul{
    padding-left:20px;
}

.tab-content li{
    margin-bottom:6px;
}
</style>
@endpush
@push('scripts')
<script>
function showTab(tabId){

    document.querySelectorAll('.tab-content')
        .forEach(el => el.classList.remove('active'));

    document.querySelectorAll('.tab-btn')
        .forEach(el => el.classList.remove('active'));

    document.getElementById(tabId)
        .classList.add('active');

    event.target.classList.add('active');
}
</script>