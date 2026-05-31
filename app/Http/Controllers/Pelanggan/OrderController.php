<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);
        return view('pelanggan.orders', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $user  = auth()->user();
        $carts = $user->carts()->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('pelanggan.cart')->with('error', 'Keranjang Anda kosong.');
        }

        $request->validate([
            'whatsapp_number' => 'required|string|max:20',
            'notes'           => 'nullable|string|max:500',
        ]);

        $total = $carts->sum(fn($c) => $c->quantity * $c->product->price);

        $order = Order::create([
            'user_id'          => $user->id,
            'order_code'       => 'VS-' . strtoupper(Str::random(8)),
            'total_price'      => $total,
            'status'           => 'pending',
            'whatsapp_number'  => $request->whatsapp_number,
            'notes'            => $request->notes,
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $cart->product_id,
                'product_name' => $cart->product->name,
                'price'        => $cart->product->price,
                'quantity'     => $cart->quantity,
                'subtotal'     => $cart->quantity * $cart->product->price,
            ]);
        }

        // Clear cart
        $user->carts()->delete();

        // Build WhatsApp message
        $waNumber  = preg_replace('/[^0-9]/', '', config('app.admin_wa', '6281234567890'));
        $itemLines = $order->items->map(fn($i) => "- {$i->product_name} x{$i->quantity} = Rp " . number_format($i->subtotal, 0, ',', '.'))->implode("\n");
        $message   = urlencode(
            "Halo Admin VapeStore! 👋\n\n"
            . "Saya ingin mengonfirmasi pesanan:\n"
            . "Kode Pesanan: *{$order->order_code}*\n\n"
            . "Detail Produk:\n{$itemLines}\n\n"
            . "*Total: Rp " . number_format($total, 0, ',', '.') . "*\n\n"
            . "Catatan: " . ($request->notes ?? '-')
        );

        $waUrl = "https://wa.me/{$waNumber}?text={$message}";

        return redirect($waUrl);
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $order->load('items.product');
        return view('pelanggan.order-detail', compact('order'));
    }
}
