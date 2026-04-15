<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoinAdminController extends Controller
{
    public function index(Request $request)
    {
        $searchText = $request->searchText;
        $searchDate = $request->searchDate;
        $searchMonth = $request->searchMonth;
        $searchKeterangan = $request->searchKeterangan;

        $laporan = DB::table('riwayat_poin')
            ->join('users', 'users.id_user', '=', 'riwayat_poin.id_user')

            ->leftJoin('penukaran_poin', 'penukaran_poin.id_riwayat', '=', 'riwayat_poin.id_riwayat')

            ->select(
                'riwayat_poin.id_riwayat',

                DB::raw("
                    COALESCE(riwayat_poin.created_at, penukaran_poin.tanggal) as tanggal
                "),

                'users.username as nama_user',

                DB::raw("
                    CASE 
                        WHEN riwayat_poin.keterangan LIKE '%Penukaran%' 
                            THEN 'Penukaran hadiah'
                        ELSE riwayat_poin.keterangan
                    END as keterangan
                "),

                DB::raw("
                    CASE 
                        WHEN riwayat_poin.poin = 'tambah' 
                            THEN riwayat_poin.jumlah_poin 
                        ELSE -riwayat_poin.jumlah_poin 
                    END as poin
                ")
            )

            ->whereRaw("LOWER(riwayat_poin.keterangan) NOT LIKE '%ditolak%'")

            ->where(function ($q) {
                $q->whereNull('penukaran_poin.status') 
                  ->orWhere('penukaran_poin.status', 'selesai'); 
            })

            ->when($searchText, function ($query) use ($searchText) {
                $query->where(function ($q) use ($searchText) {
                    $q->where('users.username', 'like', "%{$searchText}%")
                      ->orWhere('riwayat_poin.keterangan', 'like', "%{$searchText}%");
                });
            })

            ->when($searchKeterangan, function ($query) use ($searchKeterangan) {

                if ($searchKeterangan == 'penukaran hadiah') {
                    $query->where('riwayat_poin.keterangan', 'like', '%Penukaran%');
                }

                if ($searchKeterangan == 'setor sampah') {
                    $query->where('riwayat_poin.keterangan', 'like', '%Setor sampah%');
                }
            })

            ->when($searchDate, function ($query) use ($searchDate) {
                $query->whereDate(
                    DB::raw("COALESCE(riwayat_poin.created_at, penukaran_poin.tanggal)"),
                    $searchDate
                );
            })

            ->when($searchMonth, function ($query) use ($searchMonth) {
                $query->whereMonth(
                    DB::raw("COALESCE(riwayat_poin.created_at, penukaran_poin.tanggal)"),
                    $searchMonth
                );
            })

            ->orderByDesc(
                DB::raw("COALESCE(riwayat_poin.created_at, penukaran_poin.tanggal)")
            )

            ->paginate(10)
            ->withQueryString();

        return view('poin_admin', compact('laporan'));
    }
}