<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user         = auth()->user();
        $totalOrders  = $user->orders()->count();
        $pendingOrders = $user->orders()->where('status', 'pending')->count();
        $recentOrders = $user->orders()->with('items')->latest()->limit(5)->get();
        $cartCount    = $user->carts()->count();

        return view('pelanggan.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'recentOrders',
            'cartCount'
        ));
    }
}
