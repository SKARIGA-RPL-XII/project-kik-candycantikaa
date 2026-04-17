<?php

namespace App\Http\Controllers;

use App\Models\PenukaranPoin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminPenukaranPoinController extends Controller
{
    public function index(Request $request)
    {
        $query = PenukaranPoin::with(['riwayatPoin.user', 'hadiah'])
            ->orderBy('tanggal', 'desc');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('riwayatPoin.user', function ($u) use ($request) {
                    $u->where('username', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('hadiah', function ($h) use ($request) {
                    $h->where('nama_hadiah', 'like', '%' . $request->search . '%');
                });
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', (int) $request->bulan);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->paginate(10)->withQueryString();

        return view('persetujuan', compact('data'));
    }

    public function setujui($id)
    {
        DB::beginTransaction();
        try {
            $penukaran = PenukaranPoin::with('riwayatPoin')->findOrFail($id);

            if ($penukaran->status !== 'menunggu') {
                return back()->with('error', 'Data sudah diproses');
            }

            DB::table('users')
                ->where('id', $penukaran->riwayatPoin->id_user)
                ->decrement('saldo', $penukaran->poin_dipakai);

            $penukaran->update([
                'status' => 'selesai',
                'keterangan' => 'Berhasil menukar poin'
            ]);

            DB::table('riwayat_poin')
                ->where('id_riwayat', $penukaran->id_riwayat)
                ->update([
                    'keterangan' => 'Penukaran disetujui'
                ]);

            DB::table('hadiah')
                ->where('id_hadiah', $penukaran->id_hadiah)
                ->decrement('stok', 1);

            DB::commit();

            return back()->with('success', 'Penukaran disetujui');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyetujui');
        }
    }

    public function tolak(Request $request, $id)
    {

        $request->validate([
            'keterangan' => 'required|string|max:255'
        ]);

        DB::beginTransaction();
        try {
            $penukaran = PenukaranPoin::with('riwayatPoin')->findOrFail($id);

            if ($penukaran->status !== 'menunggu') {
                return back()->with('error', 'Data sudah diproses');
            }

            $penukaran->update([
                'status' => 'ditolak',
                'keterangan' => $request->keterangan
            ]);

            DB::table('riwayat_poin')
                ->where('id_riwayat', $penukaran->id_riwayat)
                ->update([
                    'keterangan' => 'Ditolak: ' . $request->keterangan
                ]);

            DB::commit();

            return back()->with('success', 'Penukaran ditolak');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menolak');
        }
    }
}