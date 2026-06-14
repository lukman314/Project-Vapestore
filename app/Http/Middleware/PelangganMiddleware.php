<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PelangganMiddleware
{
    public function handle(Request $request, Closure $next): Response
{
    // Cek apakah user sudah login
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // Pastikan data user diambil ulang dari database untuk sinkronisasi
    $user = auth()->user();

    // Cek role
    if (!$user->isPelanggan()) {
        abort(403, 'Akses ditolak. Halaman ini hanya untuk pelanggan.');
    }

    return $next($request);
}
}