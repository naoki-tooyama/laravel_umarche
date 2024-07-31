<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'test_u1',
                'email' => 'test_u1@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2024/07/23 11:11:11'
            ],
            [
                'name' => 'test_u2',
                'email' => 'test_u2@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2024/07/23 11:11:11'
            ],
        ]);
    }
}
