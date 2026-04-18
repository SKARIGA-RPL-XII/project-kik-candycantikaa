<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setoran;
use App\Models\User;
use App\Models\JenisSampah;
use Carbon\Carbon;
use App\Models\RiwayatPoin;
use Illuminate\Support\Facades\DB;

class SetoranController extends Controller
{
    public function index(Request $request)
    {
        $query = Setoran::with(['user', 'jenis'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('id_setoran', 'desc');

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

        return view('setoran', compact('setoran', 'users', 'jenisSampah'));
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
        $totalPoin = $berat * $jenis->poin_per_kg;

        DB::beginTransaction();
        try {
            $setoran = Setoran::create([
                'id_user' => $request->id_user,
                'id_jenis' => $request->id_jenis,
                'berat' => $berat,
                'total_poin' => $totalPoin,
                'total_co2' => $berat * $jenis->co2_per_kg,
                'total_air' => $berat * $jenis->air_per_kg,
                'total_energi' => $berat * $jenis->energi_per_kg,
                'tanggal' => $today,
            ]);

            RiwayatPoin::create([
                'id_user' => $request->id_user,
                'id_setoran' => $setoran->id_setoran,
                'poin' => 'tambah',
                'jumlah_poin' => $totalPoin,
                'keterangan' => 'Setor sampah ' . $jenis->nama_jenis,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()
                ->route('setoran.index')
                ->with('tambah_success', true);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Gagal tambah setoran: ' . $e->getMessage());
            return redirect()
                ->route('setoran.index')
                ->with('error', 'Gagal menambah data setoran');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'berat' => 'required|numeric|min:0.1',
        ]);

        $setoran = Setoran::where('id_setoran', $id)->firstOrFail();
        $jenis = JenisSampah::where('id_jenis', $setoran->id_jenis)->firstOrFail();
        $berat = $request->berat;
        $totalPoinBaru = $berat * $jenis->poin_per_kg;

        DB::beginTransaction();
        try {
            $setoran->update([
                'berat' => $berat,
                'total_poin' => $totalPoinBaru,
                'total_co2' => $berat * $jenis->co2_per_kg,
                'total_air' => $berat * $jenis->air_per_kg,
                'total_energi' => $berat * $jenis->energi_per_kg,
            ]);

            RiwayatPoin::where('id_setoran', $id)
                ->update([
                    'jumlah_poin' => $totalPoinBaru,
                    'updated_at' => now(),
                ]);

            DB::commit();

            return redirect()
                ->route('setoran.index')
                ->with('edit_success', true);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Gagal update setoran #' . $id . ': ' . $e->getMessage());
            return redirect()
                ->route('setoran.index')
                ->with('error', 'Gagal mengubah data setoran');
        }
    }

    public function destroy($id)
    {
        $setoran = Setoran::where('id_setoran', $id)->firstOrFail();

        DB::beginTransaction();
        try {
            RiwayatPoin::where('id_setoran', $id)->delete();

            $setoran->delete();

            DB::commit();

            return redirect()
                ->route('setoran.index')
                ->with('hapus_success', true);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Gagal hapus setoran #' . $id . ': ' . $e->getMessage());
            return redirect()
                ->route('setoran.index')
                ->with('error', 'Gagal menghapus data setoran');
        }
    }
}