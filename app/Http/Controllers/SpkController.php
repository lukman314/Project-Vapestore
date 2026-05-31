<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SpkCriteria;
use Illuminate\Http\Request;

class SpkController extends Controller
{
    /**
     * Tampilkan form dan hasil rekomendasi SPK (SAW).
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $results    = null;
        $criteria   = SpkCriteria::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'category_id' => 'nullable|exists:categories,id',
                'max_budget'  => 'nullable|numeric|min:0',
                'liquid_type' => 'nullable|in:freebase,salt,kosong',
            ]);

            $query = Product::with('category')->where('is_active', true);

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            if ($request->filled('max_budget')) {
                $query->where('price', '<=', $request->max_budget);
            }

            if ($request->filled('liquid_type')) {
                $query->where('liquid_type', $request->liquid_type);
            }

            $products = $query->get();

            if ($products->isEmpty()) {
                return view('home.spk', compact('categories', 'criteria'))
                    ->with('warning', 'Tidak ada produk yang sesuai filter. Coba ubah kriteria.');
            }

            $results = $this->calculateSAW($products, $criteria);
        }

        return view('home.spk', compact('categories', 'criteria', 'results'));
    }

    private function calculateSAW($products, $criteria)
    {
        // Build matrix
        $matrix = [];
        foreach ($products as $product) {
            $matrix[$product->id] = [
                'price'          => $product->price,
                'rating'         => $product->rating,
                'purchase_count' => $product->purchase_count,
                'nicotine'       => $product->nicotine > 0 ? $product->nicotine : 1, // avoid division by zero
            ];
        }

        // Find max/min for each attribute
        $stats = [];
        foreach ($criteria as $c) {
            $values = array_column($matrix, $c->attribute);
            $stats[$c->attribute] = [
                'max' => max($values),
                'min' => min($values),
            ];
        }

        // Normalize and compute SAW score
        $scores = [];
        foreach ($products as $product) {
            $score = 0;
            foreach ($criteria as $c) {
                $val = $matrix[$product->id][$c->attribute];
                if ($c->type === 'benefit') {
                    $normalized = $stats[$c->attribute]['max'] > 0
                        ? $val / $stats[$c->attribute]['max']
                        : 0;
                } else {
                    // cost: min / val
                    $normalized = $val > 0
                        ? $stats[$c->attribute]['min'] / $val
                        : 0;
                }
                $score += $c->weight * $normalized;
            }
            $scores[] = [
                'product' => $product,
                'score'   => round($score, 4),
            ];
        }

        // Sort descending by score
        usort($scores, fn($a, $b) => $b['score'] <=> $a['score']);

        // Add rank
        foreach ($scores as $i => &$item) {
            $item['rank'] = $i + 1;
        }

        return $scores;
    }
}
