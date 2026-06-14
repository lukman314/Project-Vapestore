<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        /** @var \Illuminate\Pagination\LengthAwarePaginator $products */
        $products   = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'specifications' => 'nullable|string',
            'price'          => 'required|integer|min:0',
            'purchase_count' => 'required|integer|min:0',
            'rating'         => 'required|numeric|min:0|max:5',
            'liquid_type'    => 'required|in:freebase,salt,kosong',
            'nicotine'       => 'required|integer|min:0',
            'stock'          => 'required|integer|min:0',
            'image'          => 'nullable|image|max:2048',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $category = Category::findOrFail($data['category_id']);
            $data['image'] = $request->file('image')->store($this->imageDirectory($category), 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    private function imageDirectory(Category $category): string
    {
        return 'images/produk/' . $category->slug;
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'specifications' => 'nullable|string',
            'price'          => 'required|integer|min:0',
            'purchase_count' => 'required|integer|min:0',
            'rating'         => 'required|numeric|min:0|max:5',
            'liquid_type'    => 'required|in:freebase,salt,kosong',
            'nicotine'       => 'required|integer|min:0',
            'stock'          => 'required|integer|min:0',
            'image'          => 'nullable|image|max:2048',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $category = Category::findOrFail($data['category_id']);
            $data['image'] = $request->file('image')->store($this->imageDirectory($category), 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}