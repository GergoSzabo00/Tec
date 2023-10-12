<?php

namespace Database\Seeders;

use App\Models\CustomerInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@techzone.com',
            'password' => Hash::make('AdminAdmin1234'),
            'is_verified' => 1,
            'is_admin' => 1
        ]);

        CustomerInfo::create([
            'user_id' => $user->id,
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'phone' => '06123456789'
        ]);

    }
}
