@extends('layouts.admin')

@section('title', 'Kelola Pelanggan')
@section('page-title', 'Kelola Pelanggan')

@section('content')
    <div class="card mb-3">
        <div class="card-body py-2">
            <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" style="max-width:250px"
                    placeholder="Cari nama / email..." value="{{ request('search') }}">
                <button class="btn btn-vs btn-sm">Cari</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '-' }}</td>
                            <td>{{ $user->orders_count }}</td>
                            <td>
                                <a href="{{ route('admin.pelanggan.detail', $user->id) }}"
                                    class="btn btn-sm btn-info">Detail</a>
                                <form action="{{ route('admin.pelanggan.toggle', $user->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    <button
                                        class="btn btn-sm {{ ($user->status ?? 'aktif') == 'aktif' ? 'btn-warning' : 'btn-success' }}">
                                        {{ ($user->status ?? 'aktif') == 'aktif' ? 'Suspend' : 'Aktif' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.pelanggan.reset', $user->id) }}" method="POST"
                                    style="display:inline" onsubmit="return confirm('Yakin?')">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Reset</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $users->links() }}</div>
    </div>
@endsection
