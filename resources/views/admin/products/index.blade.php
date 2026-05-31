@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div></div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-vs">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

<div class="card mb-3">
    <div class="card-body py-2">
        <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" class="form-control form-control-sm" style="max-width:200px" placeholder="Cari nama produk..." value="{{ request('search') }}">
            <select name="category_id" class="form-select form-select-sm" style="max-width:160px">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-vs btn-sm">Filter</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Rating</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $i => $product)
                <tr>
                    <td class="text-muted small">{{ $products->firstItem() + $i }}</td>
                    <td style="width:90px;">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" class="img-thumbnail" style="width:64px;height:64px;object-fit:cover;" alt="{{ $product->name }}">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $product->name }}</div>
                        @if($product->liquid_type !== 'kosong')
                            <small class="text-muted">{{ ucfirst($product->liquid_type) }}
                                @if($product->nicotine > 0) · {{ $product->nicotine }}mg @endif
                            </small>
                        @endif
                    </td>
                    <td><span class="badge bg-light text-dark">{{ $product->category->name }}</span></td>
                    <td class="fw-semibold">{{ $product->formatted_price }}</td>
                    <td><i class="bi bi-star-fill text-warning"></i> {{ $product->rating }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @if($product->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted py-5">Belum ada produk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $products->links() }}</div>
</div>
@endsection
