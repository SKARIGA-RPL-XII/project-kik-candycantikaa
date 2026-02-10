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

        $riwayatTukarLatest = DB::table('penukaran_poin')
            ->join('riwayat_poin', 'penukaran_poin.id_riwayat', '=', 'riwayat_poin.id_riwayat')
            ->join('hadiah', 'penukaran_poin.id_hadiah', '=', 'hadiah.id_hadiah')
            ->where('riwayat_poin.id_user', $idUser)
            ->orderBy('penukaran_poin.id_penukaran', 'desc')
            ->limit(1)
            ->get();

        $riwayatTukarAll = DB::table('penukaran_poin')
            ->join('riwayat_poin', 'penukaran_poin.id_riwayat', '=', 'riwayat_poin.id_riwayat')
            ->join('hadiah', 'penukaran_poin.id_hadiah', '=', 'hadiah.id_hadiah')
            ->where('riwayat_poin.id_user', $idUser)
            ->orderBy('penukaran_poin.id_penukaran', 'desc')
            ->get();

        $hadiah = DB::table('hadiah')
            ->orderBy('poin_dibutuhkan', 'asc')
            ->get();

        return view('tukar_poin_user', compact(
            'saldo',
            'poinMasuk',
            'poinKeluar',
            'riwayatTukarLatest',
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
            return redirect()->back()->with('error', 'Hadiah tidak ditemukan.');
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

        if ($saldo < $hadiah->poin_dibutuhkan) {
            return redirect()->back()->with('error', 'Poin kamu tidak cukup.');
        }

        DB::beginTransaction();
        try {
            $idRiwayat = DB::table('riwayat_poin')->insertGetId([
                'id_user' => $idUser,
                'poin' => 'kurang',
                'jumlah_poin' => $hadiah->poin_dibutuhkan,
                'keterangan' => 'Penukaran hadiah',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('penukaran_poin')->insert([
                'id_riwayat' => $idRiwayat,
                'id_hadiah' => $hadiah->id_hadiah,
                'poin_dipakai' => $hadiah->poin_dibutuhkan,
                'tanggal' => now(),
                'status' => 'menunggu',
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Hadiah berhasil ditukar.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
    }

}
