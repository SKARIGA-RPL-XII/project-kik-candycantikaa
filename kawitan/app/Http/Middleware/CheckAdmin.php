<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('login') || Session::get('role') !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
