<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class UpdateKodeBarangSeeder extends Seeder
{
    public function run()
    {
        $barangs = Barang::whereNull('kode')->orWhere('kode', '')->get();
        foreach ($barangs as $barang) {
            $barang->kode = 'BRG' . str_pad($barang->id, 3, '0', STR_PAD_LEFT);
            $barang->save();
        }
    }
}
