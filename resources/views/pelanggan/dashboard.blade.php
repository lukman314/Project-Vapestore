@extends('layouts.pelanggan')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Saya')

@section('content')
<div class="content-header mb-4">
    <p class="text-muted">Halo, <strong>{{ auth()->user()->name }}</strong> 👋 Selamat datang kembali di VapeStore.</p>
</div>

{{-- STATS CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Total Pesanan</div>
                    <div class="fs-2 fw-bold">{{ $totalOrders }}</div>
                </div>
                <i class="bi bi-bag fs-2 text-primary opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Menunggu Konfirmasi</div>
                    <div class="fs-2 fw-bold text-warning">{{ $pendingOrders }}</div>
                </div>
                <i class="bi bi-clock-history fs-2 text-warning opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Item di Keranjang</div>
                    <div class="fs-2 fw-bold" style="color:#000000">{{ $cartCount }}</div>
                </div>
                <i class="bi bi-cart3 fs-2 opacity-50" style="color:#000000"></i>
            </div>
        </div>
    </div>
</div>

{{-- RECENT ORDERS TABLE --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Pesanan Terbaru</span>
        <a href="{{ route('pelanggan.orders') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td><code class="small">{{ $order->order_code }}</code></td>
                    <td>{{ $order->items->count() }} item</td>
                    <td class="fw-semibold">{{ $order->formatted_total }}</td>
                    <td>{!! $order->status_badge !!}</td>
                    <td class="small text-muted">{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('pelanggan.order.detail', $order) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-vs { background:#000000;border-color:#000000;color:#fff; }
    .btn-vs:hover { background:#000000;color:#fff; }
</style>
@endpush
