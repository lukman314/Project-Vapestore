<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 1. Coba login dulu
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
        
            $user = Auth::user(); // SEKARANG $user baru ada isinya!

        // 2. Baru cek statusnya di sini
        if ($user->status == 'suspend') {
            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda telah dinonaktifkan oleh Admin.']);
        }

        $request->session()->regenerate();
        
        // --- Sisa kode sukses login ---
            $pesanSukses = (method_exists($user, 'isAdmin') && $user->isAdmin()) 
                        ? 'Berhasil login sebagai Admin.' 
                        : 'Berhasil login! Selamat datang kembali, ' . $user->name . '.';

            return $this->redirectByRole($user)->with('success', $pesanSukses);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Bonus: Kamu juga bisa kasih notif saat logout kalau mau!
        return redirect()->route('home')->with('success', 'Anda telah berhasil logout.');
    }

    private function redirectByRole($user)
    {
        return $user->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }
}