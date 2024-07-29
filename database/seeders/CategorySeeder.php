<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            [
                'name' => 'ファッション・インナー',
                'sort_order' => 1,
            ],[
                'name' => 'ファッション小物',
                'sort_order' => 2,
            ],[
                'name' => '食品・スイーツ',
                'sort_order' => 3,
            ],[
                'name' => 'ドリンク・お酒',
                'sort_order' => 4,
            ],[
                'name' => '日用雑貨・キッチン',
                'sort_order' => 5,
            ],[
                'name' => 'コスメ・健康・医薬品',
                'sort_order' => 6,
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'name' => 'Ｔシャツ・カットソー',
                'primary_category_id' => 1,
                'sort_order' => 1,
            ],[
                'name' => 'パンツ',
                'primary_category_id' => 1,
                'sort_order' => 2,
            ],[
                'name' => 'バック',
                'primary_category_id' => 2,
                'sort_order' => 1,
            ],[
                'name' => '靴',
                'primary_category_id' => 2,
                'sort_order' => 2,
            ],[
                'name' => '精肉',
                'primary_category_id' => 3,
                'sort_order' => 1,
            ],[
                'name' => '洋菓子',
                'primary_category_id' => 3,
                'sort_order' => 2,
            ],[
                'name' => '炭酸水',
                'primary_category_id' => 4,
                'sort_order' => 1,
            ],[
                'name' => 'ビール',
                'primary_category_id' => 4,
                'sort_order' => 2,
            ],
        ]);
    }
}
