<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
                'name' => 'test_o1',
                'email' => 'test_o1@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2024/07/23 11:11:11'
            ],
            [
                'name' => 'test_o2',
                'email' => 'test_o2@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2024/07/23 11:11:11'
            ],
            [
                'name' => 'test_o3',
                'email' => 'test_o3@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2024/07/23 11:11:11'
            ],

        ]);
    }
}
