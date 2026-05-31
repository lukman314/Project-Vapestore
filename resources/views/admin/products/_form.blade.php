<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
        <select name="category_id" class="form-select" required>
            <option value="">Pilih Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected':'' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" min="0" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Rating (0-5) <span class="text-danger">*</span></label>
        <input type="number" name="rating" class="form-control" value="{{ old('rating', $product->rating ?? '') }}" min="0" max="5" step="0.1" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Jumlah Terjual <span class="text-danger">*</span></label>
        <input type="number" name="purchase_count" class="form-control" value="{{ old('purchase_count', $product->purchase_count ?? 0) }}" min="0" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Jenis Liquid <span class="text-danger">*</span></label>
        <select name="liquid_type" class="form-select" required>
            <option value="kosong" {{ old('liquid_type', $product->liquid_type ?? 'kosong') == 'kosong' ? 'selected':'' }}>Kosong (Device)</option>
            <option value="freebase" {{ old('liquid_type', $product->liquid_type ?? '') == 'freebase' ? 'selected':'' }}>Freebase</option>
            <option value="salt" {{ old('liquid_type', $product->liquid_type ?? '') == 'salt' ? 'selected':'' }}>Salt Nic</option>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Kadar Nikotin (mg)</label>
        <input type="number" name="nicotine" class="form-control" value="{{ old('nicotine', $product->nicotine ?? 0) }}" min="0">
        <div class="form-text">Isi 0 jika tidak ada nikotin / device</div>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? 0) }}" min="0" required>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Deskripsi</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Gambar Produk</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @if(isset($product) && $product->image)
            <div class="mt-2">
                <img src="{{ Storage::url($product->image) }}" height="80" class="rounded border" alt="current">
                <div class="form-text">Biarkan kosong jika tidak ingin mengganti gambar.</div>
            </div>
        @endif
    </div>
    <div class="col-md-6 d-flex align-items-end pb-1">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_active">Produk Aktif (tampil di katalog)</label>
        </div>
    </div>
</div>
