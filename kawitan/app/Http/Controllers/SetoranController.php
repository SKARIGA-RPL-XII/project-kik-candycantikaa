<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setoran;
use App\Models\User;
use App\Models\JenisSampah;
use Carbon\Carbon;

class SetoranController extends Controller
{

    public function index(Request $request)
    {
        $query = Setoran::with(['user', 'jenis'])
            ->orderBy('tanggal', 'desc');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', function ($u) use ($request) {
                    $u->where('username', 'like', '%' . $request->search . '%');
                })
                    ->orWhereHas('jenis', function ($j) use ($request) {
                        $j->where('nama_jenis', 'like', '%' . $request->search . '%');
                    });
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', (int) $request->bulan);
        }

        $setoran = $query->paginate(10)->withQueryString();

        $users = User::where('role', 'user')->get();
        $jenisSampah = JenisSampah::all();

        return view('setoran', compact(
            'setoran',
            'users',
            'jenisSampah'
        ));
    }

    public function store(Request $request)
    {
        $today = Carbon::today()->toDateString();

        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_jenis' => 'required|exists:jenis_sampah,id_jenis',
            'berat' => 'required|numeric|min:0.1',
            'tanggal' => 'required|date|in:' . $today,
        ]);

        $jenis = JenisSampah::where('id_jenis', $request->id_jenis)->firstOrFail();

        $berat = $request->berat;

        Setoran::create([
            'id_user' => $request->id_user,
            'id_jenis' => $request->id_jenis,
            'berat' => $berat,
            'total_poin' => $berat * $jenis->poin_per_kg,
            'total_co2' => $berat * $jenis->co2_per_kg,
            'total_air' => $berat * $jenis->air_per_kg,
            'total_energi' => $berat * $jenis->energi_per_kg,
            'tanggal' => $today,
        ]);

        return redirect()
            ->route('setoran.index')
            ->with('tambah_success', true);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'berat' => 'required|numeric|min:0.1',
        ]);

        $setoran = Setoran::where('id_setoran', $id)->firstOrFail();

        $jenis = JenisSampah::where('id_jenis', $setoran->id_jenis)->firstOrFail();

        $berat = $request->berat;

        $setoran->update([
            'berat' => $berat,
            'total_poin' => $berat * $jenis->poin_per_kg,
            'total_co2' => $berat * $jenis->co2_per_kg,
            'total_air' => $berat * $jenis->air_per_kg,
            'total_energi' => $berat * $jenis->energi_per_kg,
        ]);

        return redirect()
            ->route('setoran.index')
            ->with('edit_success', true);
    }

    public function destroy($id)
    {
        Setoran::where('id_setoran', $id)->delete();

        return redirect()
            ->route('setoran.index')
            ->with('hapus_success', true);
    }
}
