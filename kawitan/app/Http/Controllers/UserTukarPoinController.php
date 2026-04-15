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

        // 🔥 SALDO (FIX UTAMA)
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

        // 🔥 POIN MASUK
        $poinMasuk = DB::table('riwayat_poin')
            ->where('id_user', $idUser)
            ->where('poin', 'tambah')
            ->sum('jumlah_poin');

        // 🔥 POIN KELUAR (FIX)
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

        // 🔥 RIWAYAT TUKAR
        $riwayatTukarAll = DB::table('penukaran_poin')
            ->join('riwayat_poin', 'penukaran_poin.id_riwayat', '=', 'riwayat_poin.id_riwayat')
            ->join('hadiah', 'penukaran_poin.id_hadiah', '=', 'hadiah.id_hadiah')
            ->where('riwayat_poin.id_user', $idUser)
            ->select(
                'penukaran_poin.*',
                'hadiah.nama_hadiah'
            )
            ->orderByDesc('penukaran_poin.id_penukaran')
            ->get();

        // 🔥 DATA HADIAH
        $hadiah = DB::table('hadiah')
            ->orderBy('poin_dibutuhkan')
            ->get();

        return view('tukar_poin_user', compact(
            'saldo',
            'poinMasuk',
            'poinKeluar',
            'riwayatTukarAll',
            'hadiah'
        ));
    }

    public function tukar()
    {
        $idUser = Session::get('id_user');

        if (!$idUser) {
            return redirect('/login');
        }

        $hadiah = DB::table('hadiah')
            ->where('id_hadiah', request('hadiah_id'))
            ->first();

        if (!$hadiah) {
            return back()->with('error', 'Hadiah tidak ditemukan');
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
            ")
            ->value('saldo');

        if ($saldo < $hadiah->poin_dibutuhkan) {
            return back()->with('error', 'Poin tidak cukup');
        }

        DB::beginTransaction();
        try {
            $idRiwayat = DB::table('riwayat_poin')->insertGetId([
                'id_user' => $idUser,
                'poin' => 'kurang',
                'jumlah_poin' => $hadiah->poin_dibutuhkan,
                'keterangan' => 'MENUNGGU',
            ]);

            DB::table('penukaran_poin')->insert([
                'id_riwayat' => $idRiwayat,
                'id_hadiah' => $hadiah->id_hadiah,
                'poin_dipakai' => $hadiah->poin_dibutuhkan,
                'tanggal' => now(),
                'status' => 'menunggu'
            ]);

            DB::commit();

            return back()->with('success', 'Permintaan dikirim, menunggu persetujuan admin');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}