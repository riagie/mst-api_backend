<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create(['kode' => 'CUST001', 'name' => 'Customer 1', 'telp' => '081234567890']);
        Customer::create(['kode' => 'CUST002', 'name' => 'Customer 2', 'telp' => '089876543210']);
    }
}
