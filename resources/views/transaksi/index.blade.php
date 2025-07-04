@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Riwayat Transaksi</h2>

    <a href="{{ route('transaksi.create') }}" class="text-blue-600 hover:underline mb-4 inline-block">+ Tambah Transaksi Baru</a>

    <table class="w-full table-auto bg-white shadow-md rounded-md overflow-hidden">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Total</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $transaksi)
                <tr class="border-b hover:bg-blue-50">
                    <td class="px-4 py-2">{{ $transaksi->tanggal }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 text-center">
                        <a href="{{ route('transaksi.show', $transaksi->id) }}"
                           class="text-blue-600 hover:underline">Lihat Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">Belum ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
