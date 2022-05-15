<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StoreInfo;

class StoreInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreInfo::truncate();
        StoreInfo::create([
            'address' => 'Fictional Street',
            'phone' => '06123456789',
            'shipping_cost' => 10.87
        ]);
    }
}
