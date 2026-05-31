@extends('layouts.admin')

@section('title', 'Kelola Pesanan')
@section('page-title', 'Kelola Pesanan')

@section('content')
<div class="card mb-3">
    <div class="card-body py-2">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" class="form-control form-control-sm" style="max-width:200px" placeholder="Kode / nama pelanggan" value="{{ request('search') }}">
            <select name="status" class="form-select form-select-sm" style="max-width:160px">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status')=='pending' ? 'selected':'' }}>Menunggu</option>
                <option value="approved" {{ request('status')=='approved' ? 'selected':'' }}>Disetujui</option>
                <option value="rejected" {{ request('status')=='rejected' ? 'selected':'' }}>Ditolak</option>
            </select>
            <button class="btn btn-vs btn-sm">Filter</button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kode Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tgl Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><code>{{ $order->order_code }}</code></td>
                    <td>
                        <div class="fw-semibold">{{ $order->user->name }}</div>
                        <small class="text-muted">{{ $order->user->phone }}</small>
                    </td>
                    <td class="fw-semibold">{{ $order->formatted_total }}</td>
                    <td>{!! $order->status_badge !!}</td>
                    <td class="small text-muted">{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada pesanan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $orders->links() }}</div>
</div>
@endsection
