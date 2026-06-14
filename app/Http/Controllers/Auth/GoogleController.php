<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        /** @var \Laravel\Socialite\Two\GoogleProvider $driver */
        $driver = Socialite::driver('google');
        return $driver->stateless()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            
            /** @var \Laravel\Socialite\Two\GoogleProvider $driver */
            $driver = Socialite::driver('google');
            $googleUser = $driver->stateless()->user();
            
            // 1. Cari atau buat user berdasarkan email agar datanya sinkron
            $user = User::where('email', $googleUser->email)->first();
            
            // Siapkan wadah untuk pesan notifikasi
            $pesanSukses = '';

            if ($user) {
                // Jika user sudah ada (daftar manual), update google_id-nya
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }
                // Pesan untuk proses LOGIN
                $pesanSukses = 'Berhasil login! Selamat datang kembali, ' . $user->name . '.';
            } else {
                // Buat user baru dengan data lengkap
                $user = User::create([
                    'name'      => $googleUser->name,
                    'email'     => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password'  => Hash::make(str()->random(16)),
                    'role'      => 'pelanggan', // Sesuaikan dengan kolom role kamu
                ]);
                // Pesan untuk proses REGISTER
                $pesanSukses = 'Pendaftaran berhasil! Selamat datang di Twins Vapor, ' . $user->name . '.';
            }

            // --- BAGIAN YANG DIUPDATE ---
            Auth::login($user, true); 
            
            // 1. Aktifkan regenerate untuk keamanan (hindari session fixation)
            $request->session()->regenerate();
            
            // 2. Simpan session secara manual untuk memastikan data tertulis sebelum redirect di lingkungan cloud
            $request->session()->put('success', $pesanSukses);
            session()->flash('success', $pesanSukses);
            
            return $this->redirectByRole($user); 
            // ----------------------------

        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login: ' . $e->getMessage());
        }
    }

    // Kembalikan fungsinya seperti semula (hapus parameter pesan)
    private function redirectByRole($user)
    {
        return $user->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }
}