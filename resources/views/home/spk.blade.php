@extends('layouts.twins')

@section('title', 'Rekomendasi SPK - SAW')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            
            {{-- Header --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold display-6 text-dark mb-2">
                    <i class="bi bi-stars text-warning animate-pulse"></i> Twins Rekomendasi
                </h2>
                <p class="text-muted fs-6 max-w-600 mx-auto">
                    Temukan produk vape Best Seller Anda menggunakan metode <strong>SAW (Simple Additive Weighting)</strong> yang akurat berdasarkan kriteria pilihan.
                </p>
            </div>

            {{-- Elegant Divider Line --}}
            <hr class="my-4" style="border: 0; height: 1px; background: linear-gradient(to right, rgba(0,0,0,0), rgba(0,0,0,0.15), rgba(0,0,0,0)); opacity: 0.5;">


            {{-- Criteria Info --}}
            <div class="card mb-4 border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header fw-bold bg-white text-dark border-bottom border-light py-3">
                    <i class="bi bi-sliders text-vs me-2"></i> Bobot Kriteria SAW yang Berlaku
                </div>
                <div class="card-body p-4 bg-light-subtle">
                    <div class="row g-4 justify-content-center">
                        @foreach($criteria as $c)
                        <div class="col-12 col-md-4">
                            <div class="card saw-weight-card h-100 border-0 shadow-sm text-center position-relative overflow-hidden border-top border-4" 
                                 style="border-top-color: {{ $c->type === 'benefit' ? '#10b981' : '#ff6b35' }} !important;">
                                <div class="card-body py-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="fw-bold display-5 text-vs text-nowrap mb-1" style="font-size: 2.25rem;">
                                            {{ round($c->weight * 100) }}%
                                        </div>
                                        <div class="small fw-semibold text-dark text-uppercase tracking-wider mb-2">
                                            {{ $c->name }}
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge rounded-pill {{ $c->type === 'benefit' ? 'bg-success-subtle text-success border border-success' : 'bg-warning-subtle text-warning border border-warning' }} px-3 py-2 fw-semibold">
                                            {{ $c->type === 'benefit' ? 'Benefit' : 'Cost' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Filter Form --}}
            <div class="card mb-5 border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header fw-bold bg-white text-dark border-bottom border-light py-3">
                    <i class="bi bi-funnel text-vs me-2"></i> Filter Preferensi Anda
                </div>
                <div class="card-body p-4 bg-light-subtle">
                    <form action="{{ route('spk') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary small mb-2">
                                    <i class="bi bi-grid-fill text-vs me-1"></i> Kategori
                                </label>
                                <div class="input-group shadow-sm-hover rounded">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-tag-fill"></i></span>
                                    <select name="category_id" class="form-select border-start-0 ps-0 bg-white">
                                        <option value="">Semua Kategori</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary small mb-2">
                                    <i class="bi bi-cash-stack text-vs me-1"></i> Budget Maksimum (Rp)
                                </label>
                                <div class="input-group shadow-sm-hover rounded">
                                    <span class="input-group-text bg-white border-end-0 fw-semibold text-muted" style="font-size: 0.85rem;">Rp</span>
                                    <input type="text" name="max_budget" class="form-control border-start-0 ps-0 bg-white currency-input" placeholder="Contoh: 50.000" value="{{ old('max_budget') ? number_format(old('max_budget'), 0, ',', '.') : '' }}" data-currency>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary small mb-2">
                                    <i class="bi bi-droplet-fill text-vs me-1"></i> Jenis Liquid
                                </label>
                                <div class="input-group shadow-sm-hover rounded">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-funnel-fill"></i></span>
                                    <select name="liquid_type" class="form-select border-start-0 ps-0 bg-white">
                                        <option value="">Semua</option>
                                        <option value="freebase" {{ old('liquid_type')=='freebase' ? 'selected':'' }}>Freebase</option>
                                        <option value="salt" {{ old('liquid_type')=='salt' ? 'selected':'' }}>Salt Nic</option>
                                        <option value="kosong" {{ old('liquid_type')=='kosong' ? 'selected':'' }}>Kosong (Device)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-vs px-5 py-2.5 fw-semibold shadow-sm rounded-pill btn-hit-rekomendasi transition-transform">
                                <i class="bi bi-calculator-fill me-2"></i> Hitung Rekomendasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Results --}}
            @if(isset($results) && $results !== null)
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header fw-bold bg-white text-dark border-bottom border-light py-3 d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-trophy text-warning me-2"></i> Hasil Rekomendasi SAW</span>
                    <span class="badge bg-dark rounded-pill">{{ count($results) }} Produk</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-uppercase font-size-xs text-muted">
                                <tr>
                                    <th width="80" class="text-center py-3">Rank</th>
                                    <th class="py-3">Produk</th>
                                    <th class="py-3">Kategori</th>
                                    <th class="py-3">Harga</th>
                                    <th class="py-3">Rating</th>
                                    <th class="py-3">Terjual</th>
                                    <th width="150" class="py-3">Skor SAW</th>
                                    <th width="100" class="text-center py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $item)
                                @php $p = $item['product']; @endphp
                                <tr class="{{ $item['rank'] == 1 ? 'table-warning-subtle' : '' }}" style="{{ $item['rank'] == 1 ? 'background-color: rgba(255, 193, 7, 0.08) !important;' : '' }}">
                                    <td class="text-center py-3 fw-bold">
                                        @if($item['rank'] == 1)
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="bi bi-trophy-fill text-warning fs-4 animate-bounce"></i>
                                            </div>
                                        @elseif($item['rank'] == 2)
                                            <span class="badge bg-secondary rounded-circle px-2.5 py-1.5" style="width:28px; height:28px; display:inline-flex; align-items:center; justify-content:center;">2</span>
                                        @elseif($item['rank'] == 3)
                                            <span class="badge rounded-circle px-2.5 py-1.5" style="background:#cd7f32!important; width:28px; height:28px; display:inline-flex; align-items:center; justify-content:center; color:#fff;">3</span>
                                        @else
                                            <span class="text-muted">{{ $item['rank'] }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <div class="fw-semibold text-dark">{{ $p->name }}</div>
                                        @if($p->liquid_type !== 'kosong')
                                            <small class="text-muted">{{ ucfirst($p->liquid_type) }}
                                                @if($p->nicotine > 0) · {{ $p->nicotine }}mg @endif
                                            </small>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <span class="badge bg-light text-dark border border-gray-200">{{ $p->category->name }}</span>
                                    </td>
                                    <td class="fw-bold py-3 text-vs">{{ $p->formatted_price }}</td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-star-fill text-warning me-1"></i> 
                                            <span>{{ number_format($p->rating, 1) }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-muted">{{ number_format($p->purchase_count) }}x</td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="fw-bold text-success">{{ $item['score'] }}</span>
                                        </div>
                                        <div class="progress" style="height:6px; border-radius: 10px;">
                                            <div class="progress-bar bg-success rounded-pill" style="width:{{ round($item['score'] * 100) }}%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center py-3">
                                        <a href="{{ route('product.detail', $p) }}" class="btn btn-vs btn-sm px-3 rounded-pill">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="alert alert-info border-0 shadow-sm rounded-4 p-4 d-flex align-items-start mb-4">
                <i class="bi bi-info-circle-fill text-info fs-4 me-3 mt-0.5"></i>
                <div>
                    <h6 class="fw-bold text-dark-emphasis mb-1">Bagaimana rekomendasi ini dihitung?</h6>
                    <p class="text-muted small mb-0">
                        Metode SAW menormalisasi data setiap produk berdasarkan kriteria terpilih (Harga sebagai Cost, Rating & Terjual sebagai Benefit) lalu mengalikannya dengan bobot kriteria. Produk dengan skor SAW tertinggi (mendekati 1.00) merupakan rekomendasi terbaik untuk Anda.
                    </p>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-vs { 
        background: #ff6b35; 
        border-color: #ff6b35; 
        color: #fff; 
    }
    .btn-vs:hover { 
        background: #e55a25; 
        border-color: #e55a25;
        color: #fff; 
    }

    .btn-hit-rekomendasi {
        transition: all 0.3s ease;
    }
    .btn-hit-rekomendasi:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3) !important;
    }
    
    .saw-weight-card {
        min-height: 150px;
        transition: all 0.3s ease;
        background: #fff;
    }
    
    .saw-weight-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
    }

    .saw-weight-card .text-vs {
        color: #ff6b35 !important;
    }

    .shadow-sm-hover {
        transition: all 0.2s ease;
        border: 1px solid #dee2e6;
    }
    .shadow-sm-hover:focus-within {
        border-color: #ff6b35 !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.15) !important;
    }
    
    .form-select:focus, .form-control:focus {
        border-color: transparent !important;
        box-shadow: none !important;
    }
    
    /* Animation effects */
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    .animate-pulse {
        animation: pulse 2s infinite ease-in-out;
        display: inline-block;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Format currency input
    const currencyInputs = document.querySelectorAll('[data-currency]');
    
    currencyInputs.forEach(input => {
        // Format saat input
        input.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            
            if (value) {
                value = new Intl.NumberFormat('id-ID').format(value);
            }
            
            this.value = value;
        });
        
        // Convert kembali ke angka sebelum form submit
        const form = input.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const numberValue = input.value.replace(/\D/g, '');
                input.value = numberValue;
            });
        }
    });
});
</script>
@endpush
