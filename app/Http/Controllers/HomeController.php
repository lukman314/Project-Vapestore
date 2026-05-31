<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->orderByDesc('rating')
            ->limit(8)
            ->get();

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

        // Rekomendasi: skor gabungan rating (40%) + popularitas (60%), maks 4 produk
        $maxPurchase = Product::where('is_active', true)->max('purchase_count') ?: 1;
        $recommended = Product::with('category')
            ->where('is_active', true)
            ->selectRaw('*, (rating * 0.4 + (purchase_count / ?) * 5 * 0.6) as rec_score', [$maxPurchase])
            ->orderByDesc('rec_score')
            ->limit(4)
            ->get();

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
