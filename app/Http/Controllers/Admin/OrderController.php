<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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

        $order->update([
            'status'      => 'approved',
            'admin_notes' => $request->admin_notes,
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Pesanan berhasil disetujui.');
    }

    public function reject(Request $request, Order $order)
    {
        $request->validate(['admin_notes' => 'nullable|string|max:500']);

        $order->update([
            'status'      => 'rejected',
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Pesanan berhasil ditolak.');
    }
}
