@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Tambah Barang</h2>
    

    <form method="POST" action="{{ route('barang.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Kode Barang:</label>
            <input type="text" name="kode" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Barcode:</label>
            <input type="text" name="barcode" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Nama Barang:</label>
            <input type="text" name="nama" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">Stok:</label>
            <input type="number" name="stok" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 mb-2 font-medium">Harga:</label>
            <input type="number" name="harga" step="0.01" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition-all">
            Tambah Barang
        </button>
    </form>
</div>
@endsection