<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // 1. Menampilkan halaman form input email
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // 2. Memproses pengiriman email link reset password
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Kita gunakan bawaan Laravel untuk mengirim email reset
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('success', 'Kami telah mengirimkan link reset password ke email Anda!');
        }

        return back()->withErrors(['email' => 'Maaf, email tersebut tidak ditemukan di sistem kami.']);
    }
}