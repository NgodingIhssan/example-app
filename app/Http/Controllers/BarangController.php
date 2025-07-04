<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'stok' => 'required|integer',
        'harga' => 'required|numeric',
    ]);

    // Hitung jumlah barang yang sudah punya kode prefix 'BRG'
    $count = Barang::where('kode', 'LIKE', 'BRG%')->count();
    $kode = 'BRG' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

    // Pastikan unik (jaga-jaga)
    while (Barang::where('kode', $kode)->exists()) {
        $count++;
        $kode = 'BRG' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
    }

    Barang::create([
        'kode' => $kode,
        'nama' => $request->nama,
        'stok' => $request->stok,
        'harga' => $request->harga,
    ]);

    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan dengan kode: ' . $kode);
}



    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode' => 'required|unique:barangs,kode,' . $barang->id,
            'nama' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
