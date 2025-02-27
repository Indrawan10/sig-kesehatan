<?php

namespace App\Http\Controllers;

use App\Models\Kesehatan;
use Illuminate\Http\Request;

class KesehatanController extends Controller
{
    public function index()
    {
        $kesehatans = Kesehatan::all();
        return view('pages.app.list-data-kesehatan', compact('kesehatans'));
    }
    public function create()
    {
        return view('pages.app.tambah-data-kesehatan'); // Pastikan ini sesuai dengan nama view Anda
    }

    // Menyimpan data kesehatan
    public function store(Request $request)
    {
        $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'jenis_fasilitas' => 'required|in:rumah sakit,klinik,apotek,puskesmas',
            'jam_operasional' => 'required|string',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'marker_color' => 'required|in:red,blue,green,orange',
        ]);

        Kesehatan::create([
            'nama_tempat' => $request->nama_tempat,
            'jenis_fasilitas' => $request->jenis_fasilitas,
            'jam_operasional' => $request->jam_operasional,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'nomor_hp' => $request->nomor_hp,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'marker_color' => $request->marker_color,
        ]);

        return redirect()->route('tambah.data.kesehatan')->with([
            'success' => true,
            'message' => 'Data kesehatan berhasil disimpan'
        ]);
    }

    public function edit($id)
    {
        $kesehatan = Kesehatan::findOrFail($id);
        return view('pages.app.list-data-kesehatan', compact('kesehatan'));
    }

    public function update(Request $request, $id)
    {
        $kesehatan = Kesehatan::findOrFail($id);

        $validatedData = $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'jenis_fasilitas' => 'required|in:rumah sakit,klinik,apotek,puskesmas',
            'jam_operasional' => 'required|string',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'marker_color' => 'required|in:red,blue,green,orange',
        ]);

        $kesehatan->update($validatedData);

        return redirect()->route('list.data.kesehatan')->with('success', 'Data kesehatan berhasil diperbarui');
    }

    // Hapus data
    public function destroy($id)
    {
        $kesehatan = Kesehatan::findOrFail($id);
        $kesehatan->delete();

        return redirect()->route('list.data.kesehatan')->with('success', 'Data kesehatan berhasil dihapus');
    }
}
