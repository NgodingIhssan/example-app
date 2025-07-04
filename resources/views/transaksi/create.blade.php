@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow-md">
    <h2 class="text-2xl font-semibold text-blue-600 mb-4">Transaksi Penjualan</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form id="formTransaksi" method="POST" action="{{ route('transaksi.store') }}">
        @csrf

        <div class="overflow-x-auto">
            <table class="w-full table-auto border text-sm">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="p-2">Nama Barang</th>
                        <th class="p-2">Harga</th>
                        <th class="p-2">Stok</th>
                        <th class="p-2">Jumlah Beli</th>
                        <th class="p-2">Subtotal</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbodyItems" class="bg-gray-50">
                    <!-- Rows akan muncul di sini -->
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <button type="button" onclick="tambahBaris()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                + Tambah Barang
            </button>
        </div>

        <div class="mt-6 text-right">
            <h3 class="text-lg font-bold">Total: 
                <span class="text-blue-700">Rp <span id="total">0</span></span>
            </h3>
        </div>

        <div class="mt-4 text-right">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Simpan Transaksi
            </button>
        </div>
    </form>
</div>

<script>
    const barangs = @json($barangs);

    function tambahBaris() {
        const tbody = document.getElementById('tbodyItems');
        const rowIndex = tbody.rows.length;
        const tr = document.createElement('tr');

        const tdBarang = document.createElement('td');
        const selectBarang = document.createElement('select');
        selectBarang.name = `items[${rowIndex}][barang_id]`;
        selectBarang.required = true;
        selectBarang.className = "p-2 border rounded w-full";
        selectBarang.onchange = updateSubtotal;

        const optionDefault = document.createElement('option');
        optionDefault.value = '';
        optionDefault.text = '-- Pilih Barang --';
        selectBarang.appendChild(optionDefault);

        barangs.forEach(b => {
            const option = document.createElement('option');
            option.value = b.id;
            option.text = b.nama;
            option.dataset.harga = b.harga;
            option.dataset.stok = b.stok;
            selectBarang.appendChild(option);
        });

        tdBarang.appendChild(selectBarang);
        tdBarang.className = "p-2";
        tr.appendChild(tdBarang);

        const tdHarga = document.createElement('td');
        tdHarga.className = 'harga p-2 text-right';
        tr.appendChild(tdHarga);

        const tdStok = document.createElement('td');
        tdStok.className = 'stok p-2 text-center';
        tr.appendChild(tdStok);

        const tdJumlah = document.createElement('td');
        const inputJumlah = document.createElement('input');
        inputJumlah.type = 'number';
        inputJumlah.name = `items[${rowIndex}][jumlah]`;
        inputJumlah.min = 1;
        inputJumlah.value = 1;
        inputJumlah.required = true;
        inputJumlah.className = "p-2 border rounded w-full";
        inputJumlah.oninput = updateSubtotal;
        tdJumlah.appendChild(inputJumlah);
        tdJumlah.className = "p-2";
        tr.appendChild(tdJumlah);

        const tdSubtotal = document.createElement('td');
        tdSubtotal.className = 'subtotal p-2 text-right';
        tdSubtotal.innerText = '0';
        tr.appendChild(tdSubtotal);

        const tdAksi = document.createElement('td');
        const btnHapus = document.createElement('button');
        btnHapus.type = 'button';
        btnHapus.innerText = 'Hapus';
        btnHapus.className = "text-red-600 hover:underline";
        btnHapus.onclick = () => {
            tr.remove();
            hitungTotal();
        };
        tdAksi.appendChild(btnHapus);
        tdAksi.className = "p-2 text-center";
        tr.appendChild(tdAksi);

        tbody.appendChild(tr);
    }

    function updateSubtotal() {
        const tr = this.closest('tr');
        const select = tr.querySelector('select');
        const jumlahInput = tr.querySelector('input[type="number"]');
        const hargaTd = tr.querySelector('.harga');
        const stokTd = tr.querySelector('.stok');
        const subtotalTd = tr.querySelector('.subtotal');

        const selectedOption = select.options[select.selectedIndex];
        const harga = parseFloat(selectedOption.dataset.harga) || 0;
        const stok = parseInt(selectedOption.dataset.stok) || 0;
        const jumlah = parseInt(jumlahInput.value) || 0;

        hargaTd.innerText = harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        stokTd.innerText = stok;
        subtotalTd.innerText = (harga * jumlah).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

        hitungTotal();
    }

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(td => {
            let val = td.innerText.replace(/[^\d]/g, '');
            if(val) total += parseInt(val);
        });

        document.getElementById('total').innerText = total.toLocaleString('id-ID');
    }

    tambahBaris();
</script>
@endsection
