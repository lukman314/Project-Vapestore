@extends('layouts.app')

@section('title', 'Rekomendasi SPK - SAW')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-4">
                <h2 class="fw-bold"><i class="bi bi-stars text-warning"></i> Sistem Penunjang Keputusan</h2>
                <p class="text-muted">Metode SAW (Simple Additive Weighting) membantu Anda menemukan produk terbaik berdasarkan kriteria terbobot.</p>
            </div>

            {{-- Criteria Info --}}
            <div class="card mb-4">
                <div class="card-header fw-semibold bg-light">
                    <i class="bi bi-sliders"></i> Bobot Kriteria SAW yang Berlaku
                </div>
                <div class="card-body">
                    <div class="row g-3 justify-content-center">
                        @foreach($criteria as $c)
                        <div class="col-6 col-sm-4 col-md-4 col-lg-3">
                            <div class="card saw-weight-card h-100 border-0 shadow-sm text-center">
                                <div class="card-body py-4">
                                    <div class="fw-bold display-6 text-vs">{{ round($c->weight * 100) }}%</div>
                                    <div class="small fw-semibold text-muted">{{ $c->name }}</div>
                                    <span class="badge {{ $c->type === 'benefit' ? 'bg-success' : 'bg-warning text-dark' }} mt-3">
                                        {{ $c->type === 'benefit' ? 'Benefit' : 'Cost' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Filter Form --}}
            <div class="card mb-4">
                <div class="card-header fw-semibold bg-light">
                    <i class="bi bi-funnel"></i> Filter Preferensi Anda
                </div>
                <div class="card-body">
                    <form action="{{ route('spk') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Kategori</label>
                                <select name="category_id" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Budget Maksimum (Rp)</label>
                                <input type="number" name="max_budget" class="form-control" placeholder="Contoh: 500000" value="{{ old('max_budget') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Jenis Liquid</label>
                                <select name="liquid_type" class="form-select">
                                    <option value="">Semua</option>
                                    <option value="freebase" {{ old('liquid_type')=='freebase' ? 'selected':'' }}>Freebase</option>
                                    <option value="salt" {{ old('liquid_type')=='salt' ? 'selected':'' }}>Salt Nic</option>
                                    <option value="kosong" {{ old('liquid_type')=='kosong' ? 'selected':'' }}>Kosong (Device)</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-vs px-5 fw-semibold">
                                <i class="bi bi-calculator"></i> Hitung Rekomendasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Results --}}
    @if(isset($results) && $results !== null)
    <div class="row mt-2">
        <div class="col-12">
            <h5 class="fw-bold mb-3"><i class="bi bi-trophy"></i> Hasil Rekomendasi SAW</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="60">Rank</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Rating</th>
                            <th>Terjual</th>
                            <th width="100">Skor SAW</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $item)
                        @php $p = $item['product']; @endphp
                        <tr class="{{ $item['rank'] <= 3 ? 'table-warning' : '' }}">
                            <td class="text-center">
                                @if($item['rank'] == 1)
                                    <i class="bi bi-trophy-fill text-warning fs-5"></i>
                                @elseif($item['rank'] == 2)
                                    <span class="badge bg-secondary">2</span>
                                @elseif($item['rank'] == 3)
                                    <span class="badge bg-secondary" style="background:#cd7f32!important">3</span>
                                @else
                                    <span class="text-muted">{{ $item['rank'] }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $p->name }}</div>
                                @if($p->liquid_type !== 'kosong')
                                    <small class="text-muted">{{ ucfirst($p->liquid_type) }}
                                        @if($p->nicotine > 0) · {{ $p->nicotine }}mg @endif
                                    </small>
                                @endif
                            </td>
                            <td><span class="badge bg-light text-dark">{{ $p->category->name }}</span></td>
                            <td class="fw-semibold" style="color:#ff6b35">{{ $p->formatted_price }}</td>
                            <td>
                                <i class="bi bi-star-fill text-warning"></i> {{ $p->rating }}
                            </td>
                            <td>{{ number_format($p->purchase_count) }}x</td>
                            <td>
                                <div class="fw-bold text-success">{{ $item['score'] }}</div>
                                <div class="progress mt-1" style="height:5px">
                                    <div class="progress-bar bg-success" style="width:{{ round($item['score'] * 100) }}%"></div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('product.detail', $p) }}" class="btn btn-vs btn-sm">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="alert alert-info mt-3">
                <i class="bi bi-info-circle"></i>
                <strong>Cara kerja SAW:</strong> Setiap produk dinormalisasi per kriteria lalu dikalikan bobot. Produk dengan <strong>skor SAW tertinggi</strong> adalah yang paling direkomendasikan.
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .btn-vs { background:#ff6b35;border-color:#ff6b35;color:#fff; }
    .btn-vs:hover { background:#e55a25;color:#fff; }

    .saw-weight-card {
        min-height: 170px;
    }

    .saw-weight-card .text-vs {
        color: #ff6b35 !important;
    }
</style>
@endpush
