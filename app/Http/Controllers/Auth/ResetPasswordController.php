<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * 1. Menampilkan halaman form untuk membuat password baru
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * 2. Memproses update password ke database
     */
    public function reset(Request $request)
    {
        // Validasi inputan (password wajib diisi, minimal 8 karakter, dan harus sama dengan konfirmasi)
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed', 
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal harus 8 karakter.'
        ]);

        // Proses pencocokan token dan update password menggunakan sistem bawaan Laravel
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // Jika berhasil diubah, arahkan kembali ke halaman login dengan pesan sukses
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login dengan password baru Anda.');
        }

        // Jika token kadaluarsa atau email salah
        return back()->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa. Silakan request link baru.']);
    }
}