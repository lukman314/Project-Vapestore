<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::where('role', 'pelanggan');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->withCount('orders')->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }   

    // 1. Fitur Suspend
        public function toggleStatus($id) {
            $user = User::findOrFail($id);
            $user->status = ($user->status == 'aktif') ? 'suspend' : 'aktif';
            $user->save();
            return back()->with('success', 'Status pelanggan berhasil diubah.');
        }

        // 2. Fitur Reset Password Paksa
        public function resetPassword($id) {
         $user = User::findOrFail($id);
         $user->password = Hash::make('twinsvapor');
         $user->save();
         return back()->with('success', 'Password pelanggan di-reset ke: twinsvapor');
        }

        // 3. Riwayat Transaksi per Pelanggan
        public function detail($id) {
         $user = User::findOrFail($id);
         $orders = Order::where('user_id', $id)->get(); // Sesuaikan nama model Order
         return view('admin.users.detail', compact('user', 'orders'));
        } 
}
