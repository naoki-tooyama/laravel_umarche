<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'test_a1',
                'email' => 'test_a1@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2024/07/23 11:11:11'
            ],
            [
                'name' => 'test_a2',
                'email' => 'test_a2@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2024/07/23 11:11:11'
            ],
        ]);
    }
}
