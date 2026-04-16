<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class CheckPasswordChange
{
    public function handle($request, Closure $next)
    {
        $user = User::find(session('id_user'));

        if ($user && session('password_changed_at') != $user->password_changed_at) {
            session()->flush();
            return redirect('/login')->with('error', 'Kata sandi telah direset, silakan login ulang dengan "password123"');
        }

        return $next($request);
    }
}