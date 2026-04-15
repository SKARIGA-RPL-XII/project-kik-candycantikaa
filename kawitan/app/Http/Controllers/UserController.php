<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('tlpn', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('kelola_user', compact('users'));
    }

    public function update(Request $request, $id_user)
    {
        $request->validate([
            'username' => 'required|string|max:50',
        ]);

        $data = [
            'username' => $request->username,
        ];

        if ($request->has('reset_password')) {
            $data['password'] = Hash::make('password123');
        }

        User::where('id_user', $id_user)->update($data);

        return redirect()->route('kelola_user')->with('edit_success', true);
    }

    public function destroy($id_user)
    {
        User::where('id_user', $id_user)->delete();

        return redirect()->route('kelola_user')->with('hapus_success', true);
    }
}