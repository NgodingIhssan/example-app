<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil transaksi beserta item dan barangnya
        $transaksis = Transaksi::with('items.barang')->orderBy('created_at', 'desc')->get();
        return view('transaksi.index', compact('transaksis'));
    }
       public function create()
    {
        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;
            $barangUpdates = [];

            // Hitung total dan siapkan update stok
            foreach ($request->items as $item) {
                $barang = Barang::find($item['barang_id']);
                $subtotal = $barang->harga * $item['jumlah'];
                $total += $subtotal;

                // Kurangi stok
                if ($barang->stok < $item['jumlah']) {
                    throw new \Exception("Stok tidak cukup untuk {$barang->nama}");
                }
                $barang->stok -= $item['jumlah'];
                $barangUpdates[] = $barang;
            }

            // Simpan transaksi
            $transaksi = Transaksi::create([
                'tanggal' => now(),
                'total' => $total,
            ]);

            // Simpan detail transaksi
            foreach ($request->items as $item) {
                $barang = Barang::find($item['barang_id']);
                $subtotal = $barang->harga * $item['jumlah'];

                TransaksiItem::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ]);
            }

            // Update stok barang setelah transaksi dan item tersimpan
            foreach ($barangUpdates as $barang) {
                $barang->save();
            }

            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('items.barang')->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
        
    }
    
    public function laporan()
    {
        $transaksis = \App\Models\Transaksi::with('items.barang')->orderBy('tanggal', 'desc')->get();
        return view('transaksi.laporan', compact('transaksis'));
    }

}