<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => '商品１',
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image1' => 1,
            ],[
                'name' => '商品２',
                'shop_id' => 1,
                'secondary_category_id' => 1,
                'image1' => 2,
            ],[
                'name' => '商品３',
                'shop_id' => 1,
                'secondary_category_id' => 2,
                'image1' => 3,
            ],[
                'name' => '商品４',
                'shop_id' => 1,
                'secondary_category_id' => 2,
                'image1' => 4,
            ],[
                'name' => '商品５',
                'shop_id' => 1,
                'secondary_category_id' => 3,
                'image1' => 5,
            ],
        ]);
    }
}
