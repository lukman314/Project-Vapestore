@extends('layouts.admin')

@section('title', 'Kriteria SPK SAW')
@section('page-title', 'Pengaturan Kriteria SPK - SAW')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header fw-semibold"><i class="bi bi-sliders"></i> Bobot Kriteria SAW</div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    Total bobot semua kriteria <strong>harus sama dengan 1.00</strong>.
                    Metode SAW menggunakan normalisasi matriks kemudian dijumlahkan berdasarkan bobot.
                </div>

                <form action="{{ route('admin.spk.update') }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr><th>Kriteria</th><th>Atribut</th><th>Tipe</th><th>Bobot</th></tr>
                            </thead>
                            <tbody>
                                @foreach($criteria as $c)
                                <tr>
                                    <td class="fw-semibold">{{ $c->name }}</td>
                                    <td><code>{{ $c->attribute }}</code></td>
                                    <td>
                                        <select name="criteria[{{ $loop->index }}][type]" class="form-select form-select-sm" style="width:110px">
                                            <option value="benefit" {{ $c->type == 'benefit' ? 'selected':'' }}>Benefit</option>
                                            <option value="cost" {{ $c->type == 'cost' ? 'selected':'' }}>Cost</option>
                                        </select>
                                        <input type="hidden" name="criteria[{{ $loop->index }}][id]" value="{{ $c->id }}">
                                    </td>
                                    <td>
                                        <input type="number" name="criteria[{{ $loop->index }}][weight]" class="form-control form-control-sm"
                                               value="{{ $c->weight }}" min="0.01" max="1" step="0.01" style="width:100px" required>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-light">
                                    <th colspan="3" class="text-end">Total Bobot</th>
                                    <th>
                                        <span class="fw-bold" id="totalWeight">{{ $criteria->sum('weight') }}</span>
                                        <span class="text-muted small">(harus = 1.00)</span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-vs px-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header fw-semibold">Penjelasan Metode SAW</div>
            <div class="card-body small text-muted">
                <p><strong>Simple Additive Weighting (SAW)</strong> adalah metode pengambilan keputusan multi-kriteria yang bekerja dengan:</p>
                <ol>
                    <li><strong>Normalisasi:</strong> Setiap nilai kriteria dinormalisasi.
                        <ul>
                            <li>Benefit: r = nilai / max(nilai)</li>
                            <li>Cost: r = min(nilai) / nilai</li>
                        </ul>
                    </li>
                    <li><strong>Pembobotan:</strong> Skor = Σ (bobot × nilai ternormalisasi)</li>
                    <li><strong>Ranking:</strong> Produk dengan skor tertinggi = rekomendasi terbaik</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('input[name$="[weight]"]').forEach(input => {
    input.addEventListener('input', function() {
        const inputs = document.querySelectorAll('input[name$="[weight]"]');
        let total = 0;
        inputs.forEach(i => total += parseFloat(i.value || 0));
        const el = document.getElementById('totalWeight');
        el.textContent = total.toFixed(2);
        el.className = 'fw-bold ' + (Math.abs(total - 1) < 0.01 ? 'text-success' : 'text-danger');
    });
});
</script>
@endpush
