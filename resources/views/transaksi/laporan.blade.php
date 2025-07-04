@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">Laporan Transaksi</h2>
    <table class="min-w-full bg-white border border-gray-200 rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b">Tanggal</th>
                <th class="py-2 px-4 border-b">Kode Transaksi</th>
                <th class="py-2 px-4 border-b">Barang</th>
                <th class="py-2 px-4 border-b">Jumlah</th>
                <th class="py-2 px-4 border-b">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
                @foreach ($transaksi->items as $item)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $transaksi->tanggal }}</td>
                    <td class="py-2 px-4 border-b">{{ $transaksi->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->barang->nama ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->jumlah }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->subtotal }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
