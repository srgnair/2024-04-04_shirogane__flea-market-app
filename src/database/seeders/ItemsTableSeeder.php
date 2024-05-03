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
            //             [
            //                 'item_name' => '商品名',
            //                 'brand_name' => 'ブランド名',
            //                 'price' => '47000',
            //                 'description' => <<<DESC
            // カラー：グレー
            // 新品
            // 商品の状態は良好です。傷もありません。
            // 購入後、即発送いたします。
            // DESC,
            //                 'condition' => '新品',
            //                 'created_at' => now(),
            //                 'updated_at' => now(),
            //             ],
            [
                'item_name' => 'Tシャツ',
                'brand_name' => 'ブランド名',
                'price' => '3000',
                'description' => <<<DESC
カラー：グレー
新品
商品の状態は良好です。傷もありません。
購入後、即発送いたします。
DESC,
                'condition' => '新品',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'ぬいぐるみ',
                'brand_name' => 'ブランド名',
                'price' => '500',
                'description' => <<<DESC
カラー：グレー
新品
商品の状態は良好です。傷もありません。
購入後、即発送いたします。
DESC,
                'condition' => '新品',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'バッグ',
                'brand_name' => 'ブランド名',
                'price' => '5000',
                'description' => <<<DESC
カラー：グレー
新品
商品の状態は良好です。傷もありません。
購入後、即発送いたします。
DESC,
                'condition' => '新品',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
