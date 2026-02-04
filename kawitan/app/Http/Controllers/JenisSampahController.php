<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use Illuminate\Http\Request;
class JenisSampahController extends Controller
{
    public function index()
    {
        $data = JenisSampah::all();
        return view('jenis_sampah', compact("data"));
    }
    public function store(Request $request)
    {
        JenisSampah::create($request->only([
            'nama_jenis',
            'poin_per_kg',
            'co2_per_kg',
            'air_per_kg',
            'energi_per_kg'
        ]));

        return redirect()->route('jenis-sampah.index')
            ->with('tambah_success', true);
    }

    public function update(Request $request, $id)
    {
        JenisSampah::where('id_jenis', $id)->update($request->only([
            'nama_jenis',
            'poin_per_kg',
            'co2_per_kg',
            'air_per_kg',
            'energi_per_kg'
        ]));

        return redirect()->route('jenis-sampah.index')
            ->with('edit_success', true);
    }

    public function destroy($id)
    {
        JenisSampah::where('id_jenis', $id)->delete();

        return redirect()->route('jenis-sampah.index')
            ->with('hapus_success', true);
    }

}