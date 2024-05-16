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
                'item_id' => '41',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '41',
                'category' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '42',
                'category' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '42',
                'category' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '43',
                'category' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '44',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '45',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
