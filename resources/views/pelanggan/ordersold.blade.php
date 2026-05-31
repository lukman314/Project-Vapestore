@extends('layouts.pelanggan')

@section('title', 'Pesanan Saya')
@section('page-title', 'Pesanan Saya')

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Kode</th><th>Item</th><th>Total</th><th>Status</th><th>Tgl Pesan</th><th></th></tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><code class="small">{{ $order->order_code }}</code></td>
                    <td class="small">{{ $order->items->count() }} item</td>
                    <td class="fw-semibold">{{ $order->formatted_total }}</td>
                    <td>{!! $order->status_badge !!}</td>
                    <td class="small text-muted">{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td><a href="{{ route('pelanggan.order.detail', $order) }}" class="btn btn-sm btn-outline-secondary">Detail</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        Belum ada pesanan. <a href="{{ route('catalog') }}">Mulai belanja sekarang!</a>
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
