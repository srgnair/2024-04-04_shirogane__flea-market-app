<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ItemCategoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_categories')->insert([
            [
                'item_id' => '1',
                'category' => '洋服',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '1',
                'category' => 'メンズ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '2',
                'category' => 'ぬいぐるみ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '3',
                'category' => 'バッグ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
