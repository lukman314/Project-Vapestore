@extends('layouts.pelanggan')

@section('title', 'Pesanan Saya')
@section('page-title', 'Pesanan Saya')

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
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
                @forelse($orders as $order)
                <tr>
                    <td><code>{{ $order->order_code }}</code></td>
                    <td>{{ $order->items->count() }} item</td>
                    <td class="fw-semibold">{{ $order->formatted_total }}</td>
                    <td>{!! $order->status_badge !!}</td>
                    <td class="small text-muted">{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="{{ route('pelanggan.order.detail', $order) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-bag-x fs-1 d-block mb-2"></i>
                        Belum ada pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="card-footer">{{ $orders->links() }}</div>
    @endif
</div>
@endsection