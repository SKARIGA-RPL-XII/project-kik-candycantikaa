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
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('riwayatPoin', function ($r) use ($search) {
                    $r->whereHas('user', function ($u) use ($search) {
                        $u->where('username', 'like', '%' . $search . '%');
                    });
                })
                    ->orWhereHas('hadiah', function ($h) use ($search) {
                        $h->where('nama_hadiah', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        } elseif ($request->filled('bulan')) {
            $tahun = $request->filled('tahun') ? (int) $request->tahun : now()->year;
            $query->whereMonth('tanggal', (int) $request->bulan)
                ->whereYear('tanggal', $tahun);
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
            $penukaran = PenukaranPoin::with('riwayatPoin')
                ->where('id_penukaran', $id)
                ->firstOrFail();

            if ($penukaran->status !== 'menunggu') {
                return back()->with('error', 'Data sudah diproses');
            }

            $penukaran->update([
                'status' => 'selesai',
                'keterangan' => null
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
            \Log::error('Gagal setujui: ' . $e->getMessage());
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function tolak(Request $request, $id)
    {

        $request->validate([
            'keterangan' => 'required|string|max:255'
        ]);

        DB::beginTransaction();
        try {
            $penukaran = PenukaranPoin::with('riwayatPoin')
                ->where('id_penukaran', $id)
                ->firstOrFail();

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