<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
{
    return view('pelanggan.profile-edit');
}

public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'password' => 'nullable|min:8|confirmed',
    ]);

    $user = auth()->user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    
    // Jika ada password baru, update password
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return back()->with('success', 'Profile berhasil diperbarui!');
}
}
