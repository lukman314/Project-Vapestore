@extends('layouts.pelanggan')

@section('title', 'Keranjang Belanja')
@section('page-title', 'Keranjang Belanja')

@section('content')
@if($carts->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-cart-x text-muted" style="font-size:5rem"></i>
        <h5 class="mt-3 text-muted">Keranjang Anda Kosong</h5>
        <a href="{{ route('catalog') }}" class="btn btn-vs mt-2">Mulai Belanja</a>
    </div>
@else
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center fw-semibold">
                <div><i class="bi bi-cart3"></i> Item di Keranjang</div>
                <form action="{{ route('pelanggan.cart.clear') }}" method="POST" onsubmit="return confirm('Hapus semua produk dari keranjang?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> Hapus Semua
                    </button>
                </form>
            </div>
            @foreach($carts as $cart)
            <div class="card-body border-bottom py-3">
                <div class="d-flex gap-3 align-items-center">
                    <div class="d-flex align-items-center justify-content-center bg-light rounded" style="width:70px;height:70px;flex-shrink:0">
                        @if($cart->product->image)
                            <img src="{{ Storage::url($cart->product->image) }}" class="img-fluid rounded" style="max-height:65px;object-fit:contain" alt="">
                        @else
                            <i class="bi bi-image text-muted fs-3"></i>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">{{ $cart->product->name }}</div>
                        <div class="small text-muted">{{ $cart->product->category->name }}</div>
                        <div class="fw-bold" style="color:#ff6b35">{{ $cart->product->formatted_price }}</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <form action="{{ route('pelanggan.cart.update', $cart) }}" method="POST" class="d-flex align-items-center gap-1">
                            @csrf @method('PATCH')
                            <div class="input-group input-group-sm" style="width:110px">
                                <button type="button" class="btn btn-outline-secondary" onclick="this.nextElementSibling.stepDown();this.form.submit()">-</button>
                                <input type="number" name="quantity" class="form-control text-center" value="{{ $cart->quantity }}" min="1" onchange="this.form.submit()">
                                <button type="button" class="btn btn-outline-secondary" onclick="this.previousElementSibling.stepUp();this.form.submit()">+</button>
                            </div>
                        </form>
                        <div class="fw-semibold text-end" style="min-width:90px">
                            Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                        </div>
                        <form action="{{ route('pelanggan.cart.remove', $cart) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header fw-semibold">Ringkasan Pesanan</div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal ({{ $carts->count() }} item)</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between fw-bold border-top pt-2 fs-5">
                    <span>Total</span>
                    <span style="color:#ff6b35">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <hr>
                <div class="alert alert-info small">
                    <i class="bi bi-whatsapp text-success"></i>
                    Setelah checkout, Anda akan diarahkan ke WhatsApp untuk konfirmasi pesanan dengan admin.
                </div>

                <form action="{{ route('pelanggan.checkout') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. WhatsApp Anda <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-whatsapp text-success"></i></span>
                            <input type="text" name="whatsapp_number" class="form-control"
                                   placeholder="628xxxxxxxxxx"
                                   value="{{ auth()->user()->phone }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan (opsional)</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Catatan untuk admin..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-vs w-100 fw-semibold">
                        <i class="bi bi-whatsapp"></i> Checkout via WhatsApp
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
    .btn-vs { background:#ffffff;border-color:#000000;color:#000000; }
    .btn-vs:hover { background:#000000;color:#fff; }
</style>
@endpush
