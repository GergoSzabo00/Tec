<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentOption;

class PaymentOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentOption::create(['name' => 'Credit card']);
        PaymentOption::create(['name' => 'Cash']);
        PaymentOption::create(['name' => 'Apple Pay']);
        PaymentOption::create(['name' => 'Google Pay']);
        PaymentOption::create(['name' => 'PayPal']);
    }
}