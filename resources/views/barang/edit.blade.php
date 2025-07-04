@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-blue-50 py-10 px-4">
    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-3xl font-bold text-blue-700 text-center mb-6">Edit Barang</h2>

        {{-- Barcode preview --}}
        <div class="flex justify-center mb-6">
            <img src="{{ route('barcode.generate', $barang->kode) }}" alt="Barcode {{ $barang->kode }}" class="w-48">
        </div>

        <form method="POST" action="{{ route('barang.update', $barang->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Barang</label>
                <input type="text" name="kode" value="{{ $barang->kode }}" readonly
                    class="w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-md text-gray-700 cursor-not-allowed">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Barcode</label>
                <input type="text" name="barcode" value="{{ $barang->barcode }}"
                    class="w-full px-4 py-2 border border-blue-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Barang</label>
                <input type="text" name="nama" value="{{ $barang->nama }}" required
                    class="w-full px-4 py-2 border border-blue-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
                <input type="number" name="stok" value="{{ $barang->stok }}" required
                    class="w-full px-4 py-2 border border-blue-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Harga</label>
                <input type="number" name="harga" step="0.01" value="{{ $barang->harga }}" required
                    class="w-full px-4 py-2 border border-blue-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition duration-200">
                    Update Barang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
