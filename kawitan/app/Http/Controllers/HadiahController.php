<?php

namespace App\Http\Controllers;

use App\Models\Hadiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HadiahController extends Controller
{
    public function index()
    {
        $hadiah = Hadiah::all();
        return view('hadiah', compact('hadiah'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_hadiah' => 'required',
            'poin_dibutuhkan' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required',
            'gambar' => 'required|image'
        ]);

        $data['gambar'] = $request->file('gambar')->store('hadiah', 'public');

        Hadiah::create($data);

        return redirect()->route('hadiah.index')
            ->with('tambah_success', true);
    }

    public function update(Request $request, $id)
    {
        $hadiah = Hadiah::where('id_hadiah', $id)->firstOrFail();

        $data = $request->validate([
            'nama_hadiah' => 'required',
            'poin_dibutuhkan' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image'
        ]);

        if ($request->hasFile('gambar')) {
            if ($hadiah->gambar) {
                Storage::disk('public')->delete($hadiah->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('hadiah', 'public');
        }

        $hadiah->update($data);

        return redirect()->route('hadiah.index')
            ->with('edit_success', true);
    }

    public function destroy($id)
    {
        $hadiah = Hadiah::where('id_hadiah', $id)->firstOrFail();

        if ($hadiah->gambar) {
            Storage::disk('public')->delete($hadiah->gambar);
        }

        $hadiah->delete();

        return redirect()->route('hadiah.index')
            ->with('hapus_success', true);
    }
}
