@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="row g-4">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-arrow-left"></i></a>
                    <span class="fw-semibold">Pesanan: <code>{{ $order->order_code }}</code></span>
                </div>
                {!! $order->status_badge !!}
            </div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <div class="small text-muted">Pelanggan</div>
                        <div class="fw-semibold">{{ $order->user->name }}</div>
                        <div class="small">{{ $order->user->email }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="small text-muted">No. WhatsApp</div>
                        <div class="fw-semibold">
                            <a href="https://wa.me/{{ $order->whatsapp_number }}" target="_blank" class="text-success">
                                <i class="bi bi-whatsapp"></i> {{ $order->whatsapp_number }}
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="small text-muted">Tanggal Pesan</div>
                        <div>{{ $order->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    @if($order->notes)
                    <div class="col-12">
                        <div class="small text-muted">Catatan Pelanggan</div>
                        <div class="border rounded p-2 bg-light">{{ $order->notes }}</div>
                    </div>
                    @endif
                    @if($order->admin_notes)
                    <div class="col-12">
                        <div class="small text-muted">Catatan Admin</div>
                        <div class="border rounded p-2 bg-light">{{ $order->admin_notes }}</div>
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
                            <td class="text-end fw-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <th colspan="3" class="text-end">Total</th>
                            <th class="text-end" style="color:#ff6b35">{{ $order->formatted_total }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        @if($order->status === 'pending')
        <div class="card mb-3 border-success">
            <div class="card-header fw-semibold text-success"><i class="bi bi-check-circle"></i> Setujui Pesanan</div>
            <div class="card-body">
                <form action="{{ route('admin.orders.approve', $order) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small">Catatan Admin (opsional)</label>
                        <textarea name="admin_notes" class="form-control form-control-sm" rows="3" placeholder="Pesan untuk pelanggan..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100" onclick="return confirm('Setujui pesanan ini?')">
                        <i class="bi bi-check2-circle"></i> Setujui
                    </button>
                </form>
            </div>
        </div>

        <div class="card border-danger">
            <div class="card-header fw-semibold text-danger"><i class="bi bi-x-circle"></i> Tolak Pesanan</div>
            <div class="card-body">
                <form action="{{ route('admin.orders.reject', $order) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small">Alasan Penolakan</label>
                        <textarea name="admin_notes" class="form-control form-control-sm" rows="3" placeholder="Alasan penolakan..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Tolak pesanan ini?')">
                        <i class="bi bi-x-lg"></i> Tolak
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body text-center py-4">
                {!! $order->status_badge !!}
                <p class="text-muted mt-2 mb-0 small">Pesanan telah diproses</p>
                @if($order->approved_at)
                    <p class="small text-muted">{{ $order->approved_at->format('d M Y H:i') }}</p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
