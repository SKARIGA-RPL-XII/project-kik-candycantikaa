<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserTukarPoinController extends Controller
{
    public function index()
    {
        $idUser = Session::get('id_user');

        if (!$idUser) {
            return redirect('/login');
        }

        $poinMasuk = DB::table('riwayat_poin')
            ->where('id_user', $idUser)
            ->where('poin', 'tambah')
            ->sum('jumlah_poin');

        $poinKeluar = DB::table('riwayat_poin')
            ->where('id_user', $idUser)
            ->where('poin', 'kurang')
            ->sum('jumlah_poin');

        $saldo = $poinMasuk - $poinKeluar;

        $riwayat = DB::table('riwayat_poin')
            ->where('id_user', $idUser)
            ->orderBy('id_riwayat', 'desc')
            ->get();

        $hadiah = DB::table('hadiah')
            ->orderBy('poin_dibutuhkan', 'asc')
            ->get();

        return view('tukar_poin_user', compact(
            'saldo',
            'poinMasuk',
            'poinKeluar',
            'riwayat',
            'hadiah'
        ));
    }
}
