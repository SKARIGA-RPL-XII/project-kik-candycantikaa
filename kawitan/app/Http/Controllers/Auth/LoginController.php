<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar',
            ])->withInput();
        }


        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Kata sandi salah',
            ])->withInput();
        }


        Session::put('login', true);
        Session::put('id_user', $user->id_user);
        Session::put('username', $user->username);
        Session::put('role', $user->role);


        if ($user->role === 'admin') {
            return redirect('/dashboard_admin');
        }

        return redirect('/dashboard_user'); 
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
