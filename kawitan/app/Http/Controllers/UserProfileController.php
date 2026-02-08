<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id_user', Session::get('id_user'))->firstOrFail();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where('id_user', Session::get('id_user'))->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
            'phone' => 'required|string|max:15',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sama',
        ]);

        $user->username = $request->name;
        $user->email = $request->email;
        $user->tlpn = $request->phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
    }

    $user->save();

    Session::put('username', $user->username);

    return back()->with('success','Profile berhasil diperbarui');
}
}
