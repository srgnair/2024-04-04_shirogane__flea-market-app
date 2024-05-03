<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ItemImagesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_images')->insert([
            [
                'item_id' => '1',
                'image' => 'img/itemImage.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '2',
                'image' => 'img/t-shirt.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '3',
                'image' => 'img/stuffed-animal.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '4',
                'image' => 'img/bag.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
