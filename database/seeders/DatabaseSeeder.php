<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            OrderStatusSeeder::class,
            StoreInfoSeeder::class,
            PaymentOptionSeeder::class,
            CategorySeeder::class,
            ManufacturerSeeder::class,
            ProductSeeder::class,
            AdminSeeder::class
        ]);
    }
}
