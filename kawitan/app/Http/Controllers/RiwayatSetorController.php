<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Setoran;

class RiwayatSetorController extends Controller
{
    public function index()
    {
        $idUser = Session::get('id_user');

        $riwayat_setoran = Setoran::with('jenis')
            ->where('id_user', $idUser)
            ->orderBy('tanggal', 'desc')
            ->orderBy('id_setoran', 'desc')
            ->get();

        return view('riwayat_setor', compact('riwayat_setoran'));
    }
}
