@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Detail Transaksi #{{ $transaksi->id }}</h2>

    <table class="table-auto w-full border">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-2 py-1">Kode Barang</th>
                <th class="px-2 py-1">Nama</th>
                <th class="px-2 py-1">Jumlah</th>
                <th class="px-2 py-1">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->items as $item)
                <tr>
                    <td class="px-2 py-1">{{ $item->barang->kode ?? '-' }}</td>
                    <td class="px-2 py-1">{{ $item->barang->nama ?? '-' }}</td>
                    <td class="px-2 py-1">{{ $item->jumlah }}</td>
                    <td class="px-2 py-1">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 text-right font-semibold text-lg">
        Total: Rp {{ number_format($transaksi->total, 0, ',', '.') }}
    </div>
</div>
@endsection
