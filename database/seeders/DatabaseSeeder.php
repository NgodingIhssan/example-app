<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder lain bisa ditaruh sini juga...

        // Update kolom kode barang yang kosong/null
        $barangs = Barang::whereNull('kode')->orWhere('kode', '')->get();

        foreach ($barangs as $barang) {
            $barang->kode = 'BRG' . str_pad($barang->id, 3, '0', STR_PAD_LEFT);
            $barang->save();
        }
    }
}
