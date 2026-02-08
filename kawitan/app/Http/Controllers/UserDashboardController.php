<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserDashboardController extends Controller
{
    public function index()
    {
        if (!Session::has('login') || Session::get('role') !== 'user') {
            abort(403, 'Akses ditolak');
        }

        return view('dashboard_user');
    }
}
