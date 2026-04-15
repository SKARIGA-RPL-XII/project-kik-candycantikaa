<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');

        $totalUser = DB::table('users')->count();

        $totalBerat = DB::table('setoran')
            ->whereYear('tanggal', $tahun)
            ->sum('berat');

        $co2    = $totalBerat * 1.5;
        $air    = $totalBerat * 30;
        $energi = $totalBerat * 2;

        $lineData = DB::table('setoran')
            ->selectRaw('MONTH(tanggal) as bulan, SUM(berat) as total')
            ->whereYear('tanggal', $tahun)
            ->groupByRaw('MONTH(tanggal)')
            ->pluck('total', 'bulan')
            ->toArray();

        $lineChart = [];
        for ($i = 1; $i <= 12; $i++) {
            $lineChart[] = $lineData[$i] ?? 0;
        }

        $donutData = DB::table('setoran')
            ->join('jenis_sampah', 'jenis_sampah.id_jenis', '=', 'setoran.id_jenis')
            ->select('jenis_sampah.nama_jenis', DB::raw('SUM(setoran.berat) as total'))
            ->whereYear('setoran.tanggal', $tahun)
            ->groupBy('jenis_sampah.nama_jenis')
            ->orderByDesc('total')
            ->limit(4)
            ->get();

        $donutLabels = $donutData->pluck('nama_jenis');
        $donutValues = $donutData->pluck('total');

        return view('dashboard_admin', compact(
            'totalUser',
            'co2',
            'air',
            'energi',
            'lineChart',
            'donutLabels',
            'donutValues',
            'tahun' 
        ));
    }
}