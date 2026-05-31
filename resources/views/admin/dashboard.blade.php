@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Total Produk</div>
                    <div class="fs-2 fw-bold">{{ $totalProducts }}</div>
                </div>
                <i class="bi bi-box-seam fs-2 text-primary opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Pelanggan</div>
                    <div class="fs-2 fw-bold">{{ $totalPelanggan }}</div>
                </div>
                <i class="bi bi-people fs-2 text-success opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Total Pesanan</div>
                    <div class="fs-2 fw-bold">{{ $totalOrders }}</div>
                </div>
                <i class="bi bi-bag fs-2 text-warning opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3" style="border-left: 3px solid #ff6b35">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Menunggu Approval</div>
                    <div class="fs-2 fw-bold text-vs">{{ $pendingOrders }}</div>
                </div>
                <i class="bi bi-clock-history fs-2 opacity-50" style="color:#ff6b35"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header fw-semibold">Status Pesanan</div>
            <div class="card-body">
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span><span class="badge bg-warning text-dark">Menunggu</span></span>
                    <strong>{{ $pendingOrders }}</strong>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span><span class="badge bg-success">Disetujui</span></span>
                    <strong>{{ $approvedOrders }}</strong>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span><span class="badge bg-danger">Ditolak</span></span>
                    <strong>{{ $rejectedOrders }}</strong>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-vs btn-sm w-100 mt-3">Kelola Pesanan</a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header fw-semibold">Produk Terlaris</div>
            <ul class="list-group list-group-flush">
                @foreach($topProducts as $i => $p)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-secondary me-1">{{ $i+1 }}</span>
                        <span class="small">{{ \Illuminate\Support\Str::limit($p->name, 25) }}</span>
                    </div>
                    <span class="badge bg-light text-dark">{{ $p->purchase_count }}x</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Pesanan Terbaru</span>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-vs btn-sm">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td><code class="small">{{ $order->order_code }}</code></td>
                            <td>{{ $order->user->name }}</td>
                            <td class="fw-semibold">{{ $order->formatted_total }}</td>
                            <td>{!! $order->status_badge !!}</td>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">Detail</a></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pesanan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
