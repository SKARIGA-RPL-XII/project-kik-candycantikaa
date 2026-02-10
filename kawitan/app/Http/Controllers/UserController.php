<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('kelola_user', compact('users'));
    }

    public function update(Request $request, $id_user)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $id_user . ',id_user',
            'tlpn' => 'nullable|string|max:15',
        ], [
            'email.unique' => 'Email sudah digunakan oleh user lain',
        ]);

        User::where('id_user', $id_user)->update([
            'username' => $request->username,
            'email' => $request->email,
            'tlpn' => $request->tlpn,
        ]);

        return back()->with('edit_success', true);
    }

    public function destroy($id_user)
    {
        User::where('id_user', $id_user)->delete();
        return back()->with('hapus_success', true);
    }
}
