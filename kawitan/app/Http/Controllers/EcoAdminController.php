<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EcoAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $data = DB::table('setoran')
            ->join('jenis_sampah', 'jenis_sampah.id_jenis', '=', 'setoran.id_jenis')

            ->select(
                'jenis_sampah.nama_jenis',

                DB::raw('SUM(setoran.berat) as total_berat'),
                DB::raw('SUM(setoran.total_co2) as co2'),
                DB::raw('SUM(setoran.total_air) as air'),
                DB::raw('SUM(setoran.total_energi) as energi')
            )

            ->when($search, function ($query) use ($search) {
                $query->where('jenis_sampah.nama_jenis', 'like', "%{$search}%");
            })

            ->groupBy('jenis_sampah.nama_jenis')

            ->orderByDesc('total_berat')

            ->paginate(10)
            ->withQueryString();

        return view('eco_admin', compact('data'));
    }
}