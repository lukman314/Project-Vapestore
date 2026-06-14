@extends('layouts.pelanggan')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Saya')

@section('content')
<div class="content-header mb-4 d-flex justify-content-between align-items-center">
    <div>
        <p class="text-muted small mb-1">Halo, <strong>{{ auth()->user()->name }}</strong> 👋</p>
        <h5 class="fw-bold mb-0">Dashboard Saya</h5>
    </div>
    <button class="btn btn-sm btn-dark d-md-none shadow-sm" onclick="toggleSidebar()">
        <i class="bi bi-list fs-5"></i> Menu
    </button>
</div>

{{-- STATS CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3 d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">Total Pesanan</div>
                    <div class="fs-3 fw-bold">{{ $totalOrders }}</div>
                </div>
                <div class="stats-icon bg-primary-subtle text-primary"><i class="bi bi-bag fs-4"></i></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3 d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">Menunggu Konfirmasi</div>
                    <div class="fs-3 fw-bold text-warning">{{ $pendingOrders }}</div>
                </div>
                <div class="stats-icon bg-warning-subtle text-warning"><i class="bi bi-clock-history fs-4"></i></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3 d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small">Item di Keranjang</div>
                    <div class="fs-3 fw-bold" style="color:#000000">{{ $cartCount }}</div>
                </div>
                <div class="stats-icon bg-light text-dark"><i class="bi bi-cart3 fs-4"></i></div>
            </div>
        </div>
    </div>
</div>

{{-- RECENT ORDERS TABLE --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Pesanan Terbaru</span>
        <a href="{{ route('pelanggan.orders') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
    </div>
    <div class="table-responsive" style="overflow-x: auto;">
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
                    <td class="small">{{ $order->items->count() }} item</td>
                    <td class="fw-semibold small">{{ $order->formatted_total }}</td>
                    <td>{!! $order->status_badge !!}</td>
                    <td class="small text-muted" style="white-space: nowrap;">{{ $order->created_at->format('d M Y') }}</td>
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

{{-- Overlay untuk menutup sidebar --}}
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>
@endsection

@push('styles')
<style>
    .btn-vs { background:#000000;border-color:#000000;color:#fff; }
    .btn-vs:hover { background:#000000;color:#fff; }
    
    .stats-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    @media (max-width: 768px) {
        .fs-3 { font-size: 1.2rem !important; }
        
        /* 1. Sembunyikan Sidebar yang menutupi konten */
        aside, 
        .sidebar, 
        .nav-sidebar, 
        [class*="sidebar"] {
            display: none !important;
        }

        /* 2. Reset layout utama agar full width dan tidak tertutup */
        main, .main-content, .content-wrapper, .container-fluid, #main-content {
            margin-left: 0 !important;
            padding: 15px !important;
            width: 100% !important;
            max-width: 100% !important;
            left: 0 !important;
            position: relative !important;
        }

        /* Perbaikan Tabel agar lebih profesional */
        .table-responsive {
            border-radius: 8px;
            border: 1px solid #eee;
            margin-top: 10px;
        }

        .table th, .table td { 
            font-size: 11px; 
            padding: 12px 10px; 
            white-space: nowrap; 
        }
    }
</style>
@endpush
