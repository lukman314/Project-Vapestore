<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Fungsi Helper Privat untuk menghitung SPK (Metode SAW)
     * Kriteria: Harga (Cost - 25%), Rating (Benefit - 40%), Pembelian (Benefit - 35%)
     */
    private function getSpkRecommendations($limit = 4)
    {
        // KITA BLOKIR KATEGORI ACCESSORIES DI SINI
        $products = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('slug', '!=', 'accessories');
                $query->where('slug', '!=', 'atomizer'); // <-- Mencegah aksesoris masuk hitungan
            })
            ->get();

        if ($products->isEmpty()) {
            return collect();
        }

        // 1. Tentukan Nilai Max/Min
        $minPrice    = $products->min('price');
        $maxRating   = $products->max('rating');
        $maxPurchase = $products->max('purchase_count');

        // Mencegah pembagian dengan nol
        $minPrice    = $minPrice > 0 ? $minPrice : 1;
        $maxRating   = $maxRating > 0 ? $maxRating : 1;
        $maxPurchase = $maxPurchase > 0 ? $maxPurchase : 1;

        // Bobot Kriteria
        $wPrice    = 0.25; 
        $wRating   = 0.40; 
        $wPurchase = 0.35; 

        // 2. Normalisasi & Hitung Skor Akhir
        $products->map(function ($product) use ($minPrice, $maxRating, $maxPurchase, $wPrice, $wRating, $wPurchase) {
            $normPrice = $minPrice / ($product->price > 0 ? $product->price : 1);
            $normRating   = $product->rating / $maxRating;
            $normPurchase = $product->purchase_count / $maxPurchase;

            $product->rec_score = ($normPrice * $wPrice) + ($normRating * $wRating) + ($normPurchase * $wPurchase);
            return $product;
        });

        // 3. Urutkan semua produk berdasarkan skor tertinggi
        $sortedProducts = $products->sortByDesc('rec_score');

        // 4. STRATEGI KEBERAGAMAN DINAMIS (Otomatis deteksi kategori dari database)
        $diverseRecommendations = collect();
        $groupedByCategory = $sortedProducts->groupBy('category_id');

        foreach ($groupedByCategory as $categoryId => $productsInCategory) {
            $diverseRecommendations->push($productsInCategory->first());
            
            if ($diverseRecommendations->count() >= $limit) {
                break;
            }
        }

        // 5. Penuhi sisa slot jika belum mencapai limit
        if ($diverseRecommendations->count() < $limit) {
            $remainingProducts = $sortedProducts->whereNotIn('id', $diverseRecommendations->pluck('id'))
                                                ->take($limit - $diverseRecommendations->count());
            
            $diverseRecommendations = $diverseRecommendations->merge($remainingProducts);
        }

        // Kembalikan data yang sudah digabung, diurutkan ulang berdasarkan skor tertinggi
        return $diverseRecommendations->sortByDesc('rec_score')->values();
    }

    public function index()
    {
        // Fitur "Twins Rekomendasi" sekarang memanggil data cerdas dari SPK
        $featuredProducts = $this->getSpkRecommendations(4);

        $liquidProducts = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', fn($q) => $q->where('slug', 'liquid'))
            ->orderByDesc('rating')
            ->limit(4)
            ->get();

        $modProducts = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', fn($q) => $q->where('slug', 'mod'))
            ->orderByDesc('rating')
            ->limit(4)
            ->get();

        $podProducts = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', fn($q) => $q->where('slug', 'pod'))
            ->orderByDesc('rating')
            ->limit(4)
            ->get();

        $aioProducts = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', fn($q) => $q->where('slug', 'aio'))
            ->orderByDesc('rating')
            ->limit(4)
            ->get();

        $accessoriesProducts = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', fn($q) => $q->where('slug', 'accessories'))
            ->orderByDesc('rating')
            ->limit(4)
            ->get();

        $atomizerProducts = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', fn($q) => $q->where('slug', 'atomizer'))
            ->orderByDesc('rating')
            ->limit(4)
            ->get();

        $categories = Category::withCount('products')->get();

        
        return view('home.index', compact(
            'featuredProducts',
            'liquidProducts',
            'modProducts',
            'podProducts',
            'aioProducts',
            'accessoriesProducts',
            'atomizerProducts',
            'categories'
        ));
    }

    public function catalog(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('liquid_type')) {
            $query->where('liquid_type', $request->liquid_type);
        }

        $sort = $request->get('sort', 'rating');

        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'popular') {
            $query->orderByDesc('purchase_count');
        } else {
            $query->orderByDesc('rating');
        }

        $products = $query->paginate(12)->appends($request->query());
        $categories = Category::all();

        // Fitur Rekomendasi di Sidebar/Header Katalog sekarang menggunakan SPK
        $recommended = $this->getSpkRecommendations(4);

        return view('home.catalog', compact('products', 'categories', 'recommended'));
    }

    public function detail(Product $product)
    {
        $product->load('category');
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('home.detail', compact('product', 'related'));
    }

    public function kontak()
    {
        return view('home.kontak');
    }
}