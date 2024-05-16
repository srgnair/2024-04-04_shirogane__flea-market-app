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
                'item_id' => '41',
                'image' => 'img/itemImage.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '42',
                'image' => 'img/t-shirt.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '43',
                'image' => 'img/stuffed-animal.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '44',
                'image' => 'img/bag.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => '45',
                'image' => 'img/stuffed-animal.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
