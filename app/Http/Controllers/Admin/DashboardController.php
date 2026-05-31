<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts    = Product::count();
        $totalPelanggan   = User::where('role', 'pelanggan')->count();
        $totalOrders      = Order::count();
        $pendingOrders    = Order::where('status', 'pending')->count();
        $approvedOrders   = Order::where('status', 'approved')->count();
        $rejectedOrders   = Order::where('status', 'rejected')->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();

        $topProducts = Product::orderByDesc('purchase_count')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalPelanggan',
            'totalOrders',
            'pendingOrders',
            'approvedOrders',
            'rejectedOrders',
            'recentOrders',
            'topProducts'
        ));
    }
}
