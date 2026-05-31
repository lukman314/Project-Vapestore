<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = auth()->user()->carts()->with('product.category')->get();
        $total = $carts->sum(fn($c) => $c->quantity * $c->product->price);

        return view('pelanggan.cart', compact('carts', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            $cart->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => '"' . $product->name . '" berhasil ditambahkan ke keranjang.',
                'cart_count' => auth()->user()->carts()->count(),
            ]);
        }

        return redirect()->back()->with('success', '"' . $product->name . '" berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('pelanggan.cart')->with('success', 'Keranjang diperbarui.');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('pelanggan.cart')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear()
    {
        auth()->user()->carts()->delete();

        return redirect()->route('pelanggan.cart')->with('success', 'Semua produk berhasil dihapus dari keranjang.');
    }
}
