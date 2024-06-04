<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
                'item_name' => 'ワンピース',
                'seller_id' => '1',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドA',
                'price' => '47000',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Tシャツ',
                'seller_id' => '2',
                'buyer_id' => '1',
                'category_id' => NULL,
                'brand_name' => 'ブランドB',
                'price' => '3000',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'ぬいぐるみ',
                'seller_id' => '1',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドC',
                'price' => '500',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'バッグ',
                'seller_id' => '2',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドA',
                'price' => '5000',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'アクセサリー',
                'seller_id' => '1',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドB',
                'price' => '1500',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => '時計',
                'seller_id' => '1',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドC',
                'price' => '1500',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'ワンピース',
                'seller_id' => '1',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドA',
                'price' => '47000',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Tシャツ',
                'seller_id' => '2',
                'buyer_id' => '1',
                'category_id' => NULL,
                'brand_name' => 'ブランドB',
                'price' => '3000',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'ぬいぐるみ',
                'seller_id' => '1',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドC',
                'price' => '500',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'バッグ',
                'seller_id' => '2',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドA',
                'price' => '5000',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'アクセサリー',
                'seller_id' => '1',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドB',
                'price' => '1500',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => '時計',
                'seller_id' => '1',
                'buyer_id' => NULL,
                'category_id' => NULL,
                'brand_name' => 'ブランドC',
                'price' => '1500',
                'description' => <<<DESC
            カラー：グレー
            新品
            商品の状態は良好です。傷もありません。
            購入後、即発送いたします。
            DESC,
                'condition' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // category_id が NULL の既存のアイテムを取得して更新する
        // $items = Item::whereNull('category_id')->get();

        // foreach ($items as $item) {
        //     $item->category_id = 8;
        //     $item->save();
        // }
    }
}
