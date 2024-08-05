<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diskon;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Diskon::create(['barang_id' => 1, 'diskon_pct' => 10, 'diskon_nilai' => 0]);
        Diskon::create(['barang_id' => 2, 'diskon_pct' => 5, 'diskon_nilai' => 0]);
    }
}
