@extends('layouts.admin')

@section('content')
<div class="card p-4">
    <h3>Riwayat Transaksi: {{ $user->name }}</h3>
    <hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Kode Pesanan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                {{-- Menggunakan nama kolom yang sesuai dengan Model Order --}}
                <td>{{ $order->order_code }}</td> 
                <td>{{ $order->formatted_total }}</td> {{-- Memakai fungsi otomatis yang sudah ada di Model --}}
                <td>{!! $order->status_badge !!}</td> {{-- Memakai badge cantik dari Model --}}
                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada riwayat pesanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('admin.users.index') }}" 
   style="
       display: inline-flex; 
       align-items: center; 
       justify-content: center; 
       padding: 8px 20px; 
       background-color: #111;    /* Ganti warna background di sini */
       color: #fff;               /* Ganti warna font di sini */
       border: 1px solid #111;    /* Ganti warna border di sini */
       border-radius: 6px; 
       font-size: 15px; 
       font-weight: 600; 
       text-decoration: none;
   ">
   Kembali
</a>
</div>
@endsection