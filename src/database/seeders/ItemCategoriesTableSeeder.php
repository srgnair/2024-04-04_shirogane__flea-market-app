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
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '1',
                'category' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '2',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '2',
                'category' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '3',
                'category' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '4',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '5',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '6',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '7',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '7',
                'category' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '8',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '8',
                'category' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '9',
                'category' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '10',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '11',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '12',
                'category' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
