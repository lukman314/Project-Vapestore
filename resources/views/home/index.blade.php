@extends('layouts.twins')

@push('styles')
<style>
    /* Page styles (hero, promos, product grid) — keep only page-specific rules */
    .hero {
        position: relative;
        width: 100%;
        height: 650px; /* Tentukan tinggi yang tetap (misal: 500px) */
        overflow: hidden;
        background: #111;
        display: block;
    }
    .hero-slide {
        position: absolute; /* Ubah ke absolute agar bertumpuk */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .hero-slide.active {
        opacity: 1;
        position: relative; /* Hanya slide aktif yang muncul */
    }

    /* img fallback (not used when using background images) */
    .hero-slide img {
        width: 100%;
        height: auto;
        object-fit: contain;
        object-position: center;
        display: none;
    }

    /* Hero gradient overlay for depth */
    .hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 120px;
        background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
        pointer-events: none;
        z-index: 2;
    }

    /* Hero navigation dots */
    .hero-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 3;
    }
    .hero-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        border: 2px solid rgba(255,255,255,0.7);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .hero-dot.active {
        background: #fff;
        border-color: #fff;
        transform: scale(1.2);
    }
    .hero-dot:hover {
        background: rgba(255,255,255,0.8);
    }

    /* Hero arrows */
    .hero-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
        background: rgba(0,0,0,0.35);
        border: none;
        color: #fff;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
    }
    .hero:hover .hero-arrow {
        opacity: 1;
    }
    .hero-arrow:hover {
        background: rgba(0,0,0,0.6);
        transform: translateY(-50%) scale(1.1);
    }
    .hero-arrow.prev { left: 20px; }
    .hero-arrow.next { right: 20px; }

    .promo-section { width:100%; max-width:1500px; margin:20px auto; padding:0 30px; display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    .promo-section a { display:block; border-radius:10px; overflow:hidden; height:380px; }
    .promo-section img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .3s }
    .promo-section a:hover img{ transform:scale(1.02) }

    .section-wrap { width:100%; max-width:1440px; margin:0 auto; padding:10px 30px 40px }
    .section-header { border-left:4px solid #111; padding-left:12px; margin-bottom:4px }
    .section-header h2{ font-size:20px; font-weight:800; text-transform:uppercase; color:#111 }

    .product-grid{ display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:16px; margin-top:18px
    <div class="mt-top"></div> }
    .prod-card{ background:#fff; border:1px solid #e8e8e8; border-radius:10px; padding:14px; display:flex; flex-direction:column; transition:box-shadow .25s,transform .25s }
    .prod-card:hover{ box-shadow:0 6px 20px rgba(0,0,0,.1); transform:translateY(-4px) }
    .prod-card .prod-img{ width:100%; max-height:260px; height:auto; object-fit:contain; border-radius:6px; background:#fafafa; margin-bottom:12px; display:block; margin-left:auto; margin-right:auto; padding:8px }
    .prod-card .prod-name{ font-size:12px; font-weight:600; line-height:1.45; color:#111; -webkit-line-clamp:2; display:-webkit-box; -webkit-box-orient:vertical; overflow:hidden; margin-bottom:8px }
    /* Tampilan sebelum di-hover (Bawaanmu ditambah transition) */
    .prod-card .buy-btn { 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        width: 100%; 
        height: 36px; 
        background: #fff; 
        color: #111; 
        border: 1px solid #111; 
        border-radius: 6px; 
        font-size: 12px; 
        font-weight: 600;
        transition: all 0.3s ease; /* Ditambahkan agar transisi warna halus */
    }

    /* Tampilan sesudah di-hover */
    .prod-card .buy-btn:hover {
        background: #111; /* Background berubah menjadi hitam */
        color: #fff;      /* Teks berubah menjadi putih */
        border-color: #111; /* Garis pinggir tetap hitam */
        cursor: pointer;  /* Memastikan kursor berubah jadi gambar tangan */
    }

    .new-arrival-section{ width:100%; max-width:1440px; margin:0 auto 10px; padding:0 30px 20px }
    .new-arrival-title{ text-align:center; font-size:20px; font-weight:800; text-transform:uppercase; color:#111; margin-bottom:18px }

    /* responsive tweaks */
    @media (max-width:1024px){ .product-grid{ grid-template-columns: repeat(3,1fr) } }
    @media (max-width:768px){ 
        .hero {
            height: 280px; /* Tinggi Slider lebih proporsional di HP */
        }
        .promo-section { 
            grid-template-columns:1fr; 
            padding: 0 15px; 
        } 
        .promo-section a {
            height: 200px; /* Tinggi Banner Promo lebih pas di HP */
        }
        .product-grid{ grid-template-columns: repeat(2,1fr) } 
        .hero-arrow{ width:36px; height:36px; font-size:14px } 
        .section-wrap { padding: 10px 15px 30px; }
    }
    @media (max-width:480px){ .product-grid{ grid-template-columns: 1fr 1fr; gap:10px } .hero-dot{ width:8px; height:8px } }
</style>
@endpush

@section('content')
    {{-- HERO --}}
    <div class="hero" id="heroSlider">
        <div class="hero-slide active" style="background-image: url('{{ asset('images/Hero/hero.png') }}')" aria-label="Hero 1"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/Hero/hero2.png') }}')" aria-label="Hero 2"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/Hero/hero3.png') }}')" aria-label="Hero 3"></div>

        {{-- Dots --}}
        <div class="hero-dots">
            <span class="hero-dot active" data-slide="0"></span>
            <span class="hero-dot" data-slide="1"></span>
            <span class="hero-dot" data-slide="2"></span>
        </div>
    </div>

    {{-- PROMO --}}
    <div class="promo-section align-with-search">
        <a href="{{ route('catalog') }}"><img src="{{ asset('images/promo/promo1.png') }}" alt="Promo 1"></a>
        <a href="{{ route('catalog') }}"><img src="{{ asset('images/promo/promo2.png') }}" alt="Promo 2"></a>
    </div>

    {{-- TWINS REKOMENDASI --}}
    <div class="section-wrap align-with-search">
        <div class="section-header"><h2>Twins Rekomendasi</h2><p>Produk pilihan terbaik dari Twins Vapor untuk kamu.</p></div>
        <div class="product-grid">
            @forelse ($featuredProducts->take(4) as $product)
                <div class="prod-card">
                    <a href="{{ route('product.detail', $product) }}" class="card-link">
                        <img class="prod-img" src="{{ $product->image ? Storage::url($product->image) : asset('images/no-image.png') }}" alt="{{ $product->name }}">
                        <span class="prod-cat">{{ $product->category->name ?? 'Twins Vapor' }}</span>
                        <div class="prod-name">{{ $product->name }}</div>
                        <div class="prod-price">Rp {{ number_format($product->price,0,',','.') }}</div>
                    </a>
                    <div class="mt-auto"></div>
                    @auth
                        @if (auth()->user()->isPelanggan())
                            <form action="{{ route('pelanggan.cart.add', $product) }}" method="POST" class="ajax-cart-form">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="buy-btn mt-auto">Tambah Keranjang</button>
                            </form>
                        @else
                            <a href="{{ route('product.detail', $product) }}" class="buy-btn mt-auto">Lihat Detail</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="buy-btn mt-auto">Tambah Keranjang</a>
                    @endauth
                </div>
            @empty
                <div class="text-center text-muted py-4">Tidak ada produk rekomendasi untuk saat ini.</div>
            @endforelse
        </div>
    </div>

    {{-- additional product sections (liquid, mod, pod, etc.) --}}
    @includeWhen(isset($liquidProducts), 'home._products_section', ['title' => 'Liquid Vape', 'products' => $liquidProducts, 'categoryLabel' => 'Aneka Pilihan Rasa Liquid Vape Freebase Dan Saltnic.'])
    @includeWhen(isset($modProducts), 'home._products_section', ['title' => 'MOD', 'products' => $modProducts, 'categoryLabel' => 'Temukan Mod Pilihan Dengan Kualitas Dan Harga Terbaik'])

    {{-- NEW ARRIVALS --}}
    <div class="new-arrival-section align-with-search">
        <div class="new-arrival-title">New Arrivals</div>
        <a href="{{ route('catalog') }}">
            <img src="{{ asset('images/new-arrival.png') }}" alt="New Arrivals" class="img-fluid w-100" style="border-radius: 10px;">
        </a>
    </div>

    @includeWhen(isset($podProducts), 'home._products_section', ['title' => 'POD', 'products' => $podProducts, 'categoryLabel' => 'Temukan Pod Pilihan Dengan Kualitas Terbaik Dan Harga Bersahabat'])
    @includeWhen(isset($aioProducts), 'home._products_section', ['title' => 'AIO (All In One)', 'products' => $aioProducts, 'categoryLabel' => 'Temukan AIO Favoritmu, Solusi Vaping All-In-One Yang Praktis'])
    @includeWhen(isset($accessoriesProducts), 'home._products_section', ['title' => 'Accessories', 'products' => $accessoriesProducts, 'categoryLabel' => 'Pilihan Accessories Lengkap Mulai Dari Catridge, Coil, Battery Cell, Charger, Cotton, 
    Driptip, Dan Toolkit. '])
    @includeWhen(isset($atomizerProducts), 'home._products_section', ['title' => 'Atomizers', 'products' => $atomizerProducts, 'categoryLabel' => 'Pilihan Atomizer Terbaik Untuk Hasil Flavor Lebih Nendang Dan Stabil'])
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ---- Hero Slider ----
    const slides = document.querySelectorAll('#heroSlider .hero-slide');
    // If there's only one slide, do nothing (no autoplay, no controls)
    if (slides.length <= 1) {
        if (slides[0]) slides[0].classList.add('active');
    } else {
        const dots = document.querySelectorAll('#heroSlider .hero-dot');
        const prevBtn = document.querySelector('#heroSlider .hero-arrow.prev');
        const nextBtn = document.querySelector('#heroSlider .hero-arrow.next');
        let currentSlide = 0;
        let slideInterval;

        function goToSlide(index) {
            slides[currentSlide].classList.remove('active');
            if (dots[currentSlide]) dots[currentSlide].classList.remove('active');
            currentSlide = (index + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            if (dots[currentSlide]) dots[currentSlide].classList.add('active');
        }

        function nextSlide() { goToSlide(currentSlide + 1); }
        function prevSlide() { goToSlide(currentSlide - 1); }

        function startAutoPlay() {
            slideInterval = setInterval(nextSlide, 5000);
        }
        function resetAutoPlay() {
            clearInterval(slideInterval);
            startAutoPlay();
        }

        if (nextBtn) nextBtn.addEventListener('click', function() { nextSlide(); resetAutoPlay(); });
        if (prevBtn) prevBtn.addEventListener('click', function() { prevSlide(); resetAutoPlay(); });
        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                goToSlide(parseInt(this.dataset.slide));
                resetAutoPlay();
            });
        });

        startAutoPlay();
    }

    // ---- Cart AJAX ----
    const cartBadge = document.getElementById('cart-badge');
    const alertContainer = document.createElement('div');
    alertContainer.style.position = 'fixed'; alertContainer.style.top = '1rem'; alertContainer.style.right = '1rem'; alertContainer.style.zIndex = '1050'; document.body.appendChild(alertContainer);
    document.querySelectorAll('form.ajax-cart-form').forEach(function(form){
        form.addEventListener('submit', async function(event){
            event.preventDefault();
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton ? submitButton.innerHTML : null;
            if(submitButton){ submitButton.disabled = true; submitButton.innerHTML = 'Menambahkan...'; }
            const formData = new FormData(form);
            try{
                const response = await fetch(form.action, { method:'POST', headers:{ 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json','X-Requested-With':'XMLHttpRequest' }, credentials:'same-origin', body: formData });
                const data = await response.json().catch(()=>({}));
                const showMessage = function(message,type){ const alertBox = document.createElement('div'); alertBox.className = 'alert alert-'+type+' alert-dismissible fade show'; alertBox.role='alert'; alertBox.innerHTML = message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'; alertContainer.appendChild(alertBox); setTimeout(()=>{ alertBox.classList.remove('show'); },4000); };
                if(response.ok && data.success){ if(cartBadge && typeof data.cart_count !== 'undefined'){ cartBadge.textContent = data.cart_count; cartBadge.style.display = 'flex'; } showMessage(data.message || 'Produk berhasil ditambahkan ke keranjang.','success'); } else { showMessage(data.message || 'Gagal menambahkan produk ke keranjang.','danger'); }
            } catch(err){ console.error(err); const showMessage = function(message,type){ const alertBox = document.createElement('div'); alertBox.className = 'alert alert-'+type+' alert-dismissible fade show'; alertBox.role='alert'; alertBox.innerHTML = message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'; alertContainer.appendChild(alertBox); setTimeout(()=>{ alertBox.classList.remove('show'); },4000); }; showMessage('Gagal terhubung ke server.','danger'); }
            if(submitButton){ submitButton.disabled = false; if(originalText !== null) submitButton.innerHTML = originalText; }
        });
    });
});
</script>
@endpush
