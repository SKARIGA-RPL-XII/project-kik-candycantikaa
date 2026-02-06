<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'tlpn' => 'required|string|max:15',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.min' => 'Kata sandi minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sama',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'tlpn' => $request->tlpn,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'created_at' => now(), 
            'created_at',
        ]);


        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login');
    }
}
