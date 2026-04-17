<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class CheckPasswordChange
{
    public function handle($request, Closure $next)
    {
        $user = User::find(session('id_user'));

        if (!$user) {
            session()->flush();
            return redirect('/login');
        }

        // ✅ Fix: parse string ke Carbon dulu
        $changedAt = $user->password_changed_at
            ? \Carbon\Carbon::parse($user->password_changed_at)->timestamp
            : null;

        $loginAt = session('login_at');

        if ($changedAt && $loginAt && $changedAt > $loginAt) {
            session()->flush();
            return redirect('/login')->with(
                'error',
                'Password Anda telah direset oleh admin. Silakan login ulang dengan "password123".'
            );
        }

        return $next($request);
    }
}