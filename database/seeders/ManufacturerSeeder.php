<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manufacturer;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manufacturer::create(['name' => 'Samsung']);
        Manufacturer::create(['name' => 'Huawei']);
        Manufacturer::create(['name' => 'Epson']);
        Manufacturer::create(['name' => 'Canon']);
    }
}
