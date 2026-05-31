@extends('layouts.pelanggan')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="row g-4 justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('pelanggan.orders') }}" class="btn btn-sm btn-outline-secondary me-2">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <span class="fw-semibold"><code>{{ $order->order_code }}</code></span>
                </div>
                {!! $order->status_badge !!}
            </div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <div class="small text-muted">Tanggal Pesan</div>
                        <div>{{ $order->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="small text-muted">WhatsApp</div>
                        <div>{{ $order->whatsapp_number }}</div>
                    </div>
                    @if($order->notes)
                    <div class="col-12">
                        <div class="small text-muted">Catatan Anda</div>
                        <div class="border rounded p-2 bg-light small">{{ $order->notes }}</div>
                    </div>
                    @endif
                    @if($order->admin_notes)
                    <div class="col-12">
                        <div class="small text-muted">Catatan Admin</div>
                        <div class="border rounded p-2 bg-light small">{{ $order->admin_notes }}</div>
                    </div>
                    @endif
                </div>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Produk</th><th class="text-end">Harga</th><th class="text-center">Qty</th><th class="text-end">Subtotal</th></tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <th colspan="3" class="text-end">Total</th>
                            <th class="text-end fw-bold" style="color:#ff6b35">{{ $order->formatted_total }}</th>
                        </tr>
                    </tfoot>
                </table>

                @if($order->status === 'pending')
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-clock-history"></i>
                    Pesanan Anda sedang menunggu konfirmasi dari admin. Admin akan menghubungi Anda via WhatsApp.
                </div>
                @elseif($order->status === 'approved')
                <div class="alert alert-success mb-0">
                    <i class="bi bi-check-circle"></i>
                    Pesanan Anda telah <strong>disetujui</strong>. Admin akan segera menghubungi Anda.
                </div>
                @elseif($order->status === 'rejected')
                <div class="alert alert-danger mb-0">
                    <i class="bi bi-x-circle"></i>
                    Pesanan Anda <strong>ditolak</strong>. Silakan hubungi admin untuk informasi lebih lanjut.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
