@extends('layouts.admin')

@section('title', 'Kelola Pelanggan')
@section('page-title', 'Kelola Pelanggan')

@section('content')
<div class="card mb-3">
    <div class="card-body py-2">
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" style="max-width:250px" placeholder="Cari nama / email..." value="{{ request('search') }}">
            <button class="btn btn-vs btn-sm">Cari</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Nama</th><th>Email</th><th>No. HP</th><th>Total Pesanan</th><th>Bergabung</th></tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? '-' }}</td>
                    <td><span class="badge bg-light text-dark">{{ $user->orders_count }} pesanan</span></td>
                    <td class="small text-muted">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-5">Belum ada pelanggan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $users->links() }}</div>
</div>
@endsection
