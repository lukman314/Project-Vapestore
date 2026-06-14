@php /**
 * Partial: Product section used on home index
 * Expects: $title (string), $products (collection), $categoryLabel (string)
 */
@endphp

<div class="section-wrap align-with-search">
    <div class="section-header">
        <h2>{{ $title }}</h2>
        @if(!empty($categoryLabel))<p>{{ $categoryLabel }}</p>@endif
    </div>

    <div class="product-grid">
        @forelse ($products as $product)
            <div class="prod-card">
                <a href="{{ route('product.detail', $product) }}" class="card-link">
                    <img class="prod-img" src="{{ $product->image ? Storage::url($product->image) : asset('images/no-image.png') }}" alt="{{ $product->name }}">
                    <span class="prod-cat">{{ $product->category->name ?? $categoryLabel }}</span>
                    <div class="prod-name">{{ $product->name }}</div>
                    <div class="prod-price">Rp {{ number_format($product->price,0,',','.') }}</div>
                </a>
                <div class="mt-top"></div>
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
            <div class="text-center text-muted py-4">Tidak ada produk untuk kategori ini.</div>
        @endforelse
    </div>
</div>
