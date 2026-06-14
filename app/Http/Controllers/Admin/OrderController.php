<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('order_code', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->search . '%'));
        }

        $orders = $query->latest()->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function approve(Request $request, Order $order)
    {
        $request->validate(['admin_notes' => 'nullable|string|max:500']);

        if ($order->status === 'approved') {
            return redirect()->route('admin.orders.show', $order)
                ->with('success', 'Pesanan sudah disetujui sebelumnya.');
        }

        try {
            DB::transaction(function () use ($order, $request) {
                $order->load('items.product');

                foreach ($order->items as $item) {
                    $product = $item->product;
                    if (! $product) {
                        throw new \RuntimeException('Produk untuk item pesanan tidak ditemukan.');
                    }

                    if ($product->stock < $item->quantity) {
                        throw new \RuntimeException('Stok produk "' . $product->name . '" tidak mencukupi untuk menyetujui pesanan.');
                    }

                    // 1. Mengurangi stok produk
                    $product->decrement('stock', $item->quantity);
                    
                    // 2. Menambahkan jumlah terjual pada produk (Update purchase_count)
                    $product->increment('purchase_count', $item->quantity);
                }

                $order->update([
                    'status'      => 'approved',
                    'admin_notes' => $request->admin_notes,
                    'approved_at' => now(),
                ]);

                $order->user->notify(new OrderStatusNotification($order));
            });
        } catch (\Throwable $e) {
            return redirect()->route('admin.orders.show', $order)
                ->with('error', $e->getMessage());
        }

        // Pesan sukses diubah sedikit agar memberi tahu admin bahwa produk terjual juga bertambah
        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Pesanan berhasil disetujui');
    }

    public function updateStatus(Request $request, Order $order)
    {
        // 1. Update status pesanan
        $order->update([
            'status' => $request->status,
            'admin_notes' => $request->note
        ]);

        // 2. Kirim notifikasi ke User (pemilik order)
        $user = $order->user;
        $user->notify(new OrderStatusNotification($order));

        return back()->with('success', 'Status diupdate dan notifikasi dikirim.');
    }

    public function reject(Request $request, Order $order)
    {
        $request->validate(['admin_notes' => 'nullable|string|max:500']);

        $order->update([
            'status'      => 'rejected',
            'admin_notes' => $request->admin_notes,
        ]);

        $order->user->notify(new OrderStatusNotification($order));

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Pesanan berhasil ditolak.');
    }
}