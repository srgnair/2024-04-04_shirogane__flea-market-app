<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('items')->insert([
            [
                'item_name' => '商品名',
                'brand_name' => 'ブランド名',
                'price' => '47000',
                'description' => 'カラー：グレー\n
                新品\n
                商品の状態は良好です。傷もありません。\n
                購入後、即発送いたします。',
                'condition' => '新品',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => '商品A',
                'brand_name' => 'ブランド名A',
                'price' => '47000',
                'description' => 'カラー：グレー\n
                新品\n
                商品の状態は良好です。傷もありません。\n
                購入後、即発送いたします。',
                'condition' => '新品',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => '商品B',
                'brand_name' => 'ブランド名B',
                'price' => '47000',
                'description' => 'カラー：グレー\n
                新品\n
                商品の状態は良好です。傷もありません。\n
                購入後、即発送いたします。',
                'condition' => '新品',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
