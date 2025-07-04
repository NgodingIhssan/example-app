@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold">Data Barang</h2>
        <a href="{{ route('laporan.index') }}" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">Laporan Transaksi</a>
    </div>
    <a href="{{ route('barang.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">+ Tambah Barang</a>
    <a href="{{ route('transaksi.index') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Lihat Transaksi</a>

    @if(session('success'))
        <p class="mb-4 text-green-600">{{ session('success') }}</p>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded shadow">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">Kode</th>
                    <th class="py-2 px-4 border-b">Barcode</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Stok</th>
                    <th class="py-2 px-4 border-b">Harga</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $barang->kode }}</td>
                    <td class="py-2 px-4 border-b">
                        @if($barang->barcode)
                            <img src="{{ route('barcode.generate', $barang->barcode) }}" alt="Barcode {{ $barang->barcode }}" class="h-12">
                            <div class="text-xs mt-1">{{ $barang->barcode }}</div>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">{{ $barang->nama }}</td>
                    <td class="py-2 px-4 border-b">{{ $barang->stok }}</td>
                    <td class="py-2 px-4 border-b">{{ $barang->harga }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('barang.edit', $barang->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline ml-2" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection