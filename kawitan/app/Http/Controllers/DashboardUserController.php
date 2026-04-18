<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardUserController extends Controller
{
    public function index()
    {
        $idUser = Session::get('id_user');

        if (!$idUser) {
            return redirect('/login');
        }

        $saldo = DB::table('riwayat_poin')
            ->where('id_user', $idUser)
            ->selectRaw("
                COALESCE(SUM(
                    CASE 
                        WHEN poin = 'tambah' THEN jumlah_poin 
                        ELSE 0 
                    END
                ),0)
                -
                COALESCE(SUM(
                    CASE 
                        WHEN poin = 'kurang' 
                        AND keterangan NOT IN ('MENUNGGU', 'DITOLAK')
                        THEN jumlah_poin 
                        ELSE 0 
                    END
                ),0)
                AS saldo
            ")
            ->value('saldo');

        $poinMasuk = DB::table('riwayat_poin')
            ->where('id_user', $idUser)
            ->where('poin', 'tambah')
            ->sum('jumlah_poin');

        $poinKeluar = DB::table('riwayat_poin')
            ->where('id_user', $idUser)
            ->selectRaw("
                COALESCE(SUM(
                    CASE 
                        WHEN poin = 'kurang' 
                        AND keterangan NOT IN ('MENUNGGU', 'DITOLAK')
                        THEN jumlah_poin 
                        ELSE 0 
                    END
                ),0)
                AS total
            ")
            ->value('total');

        $eco = DB::table('setoran')
            ->where('id_user', $idUser)
            ->selectRaw("
                COALESCE(SUM(total_co2),0) as total_co2,
                COALESCE(SUM(total_air),0) as total_air,
                COALESCE(SUM(total_energi),0) as total_energi
            ")
            ->first();

        return view('dashboard_user', [
            'saldo' => $saldo,
            'poinMasuk' => $poinMasuk,
            'poinKeluar' => $poinKeluar,
            'eco' => $eco
        ]);
    }
}
