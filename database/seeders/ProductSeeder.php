<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $samsungPhone1 = Product::create([
            'product_name' => 'Samsung Galaxy S23 Ultra 5G 256GB 8GB RAM Dual',
            'description' => '',
            'manufacturer_id' => 1,
            'product_image' => 'galaxy-s23.jpg',
            'price' => 1041.76,
            'quantity_in_stock' => 1,
        ]);

        $samsungPhone1->categories()->attach(1);

        $samsungPhone2 = Product::create([
            'product_name' => 'Samsung Galaxy A33 5G 128GB 6GB RAM Dual',
            'description' => '',
            'manufacturer_id' => 1,
            'product_image' => 'galaxy-a33.jpg',
            'price' => 170.62,
            'quantity_in_stock' => 1,
        ]);

        $samsungPhone2->categories()->attach(1);

        $huaweiPhone =Product::create([
            'product_name' => 'Huawei P30 Lite 128GB 4GB RAM Dual',
            'description' => '',
            'manufacturer_id' => 2,
            'product_image' => 'huawei-p30-lite.jpg',
            'price' => 197.88,
            'quantity_in_stock' => 5
        ]);

        $huaweiPhone->categories()->attach(1);

        $epsonPrinter = Product::create([
            'product_name' => 'Epson EcoTank L1210 (C11CJ70401)',
            'description' => '',
            'manufacturer_id' => 3,
            'product_image' => 'ecotank-l1210.jpg',
            'price' => 253.13,
            'quantity_in_stock' => 4,
        ]);

        $epsonPrinter->categories()->attach(3);

        $canonCamera = Product::create([
            'product_name' => 'Canon EOS 2000D',
            'description' => '',
            'manufacturer_id' => 4,
            'product_image' => 'eos-2000d.jpg',
            'price' => 463.10,
            'quantity_in_stock' => 2,
        ]);

        $canonCamera->categories()->attach(2);

    }
}
