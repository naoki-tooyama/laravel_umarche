<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Shops')->insert([
            [
                'owner_id' => 1,
                'name' => 'ここに店名が入ります',
                'infomation' => 'ここにお店の情報が入ります。ここにお店の情報が入ります。',
                'filename' => '',
                'is_selling' => true
            ],[
                'owner_id' => 2,
                'name' => 'ここに店名が入ります2',
                'infomation' => 'ここにお店の情報が入ります。ここにお店の情報が入ります。',
                'filename' => '',
                'is_selling' => true
            ],[
                'owner_id' => 3,
                'name' => 'ここに店名が入ります3',
                'infomation' => 'ここにお店の情報が入ります。ここにお店の情報が入ります。',
                'filename' => '',
                'is_selling' => true
            ],[
                'owner_id' => 4,
                'name' => 'ここに店名が入ります4',
                'infomation' => 'ここにお店の情報が入ります。ここにお店の情報が入ります。',
                'filename' => '',
                'is_selling' => true
            ],
        ]);
    }
}
