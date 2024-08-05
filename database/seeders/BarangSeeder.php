<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create(['kode' => 'BRG001', 'nama' => 'Barang 1', 'harga' => 10000]);
        Barang::create(['kode' => 'BRG002', 'nama' => 'Barang 2', 'harga' => 20000]);
    }
}
