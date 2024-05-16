<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // DB::table('items')->insert([
        //     [
        //         'item_name' => 'ワンピース',
        //         'seller_id' => '2',
        //         'buyer_id' => NULL,
        //         'category_id' => NULL,
        //         'brand_name' => 'ブランドA',
        //         'price' => '47000',
        //         'description' => <<<DESC
        //     カラー：グレー
        //     新品
        //     商品の状態は良好です。傷もありません。
        //     購入後、即発送いたします。
        //     DESC,
        //         'condition' => '1',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'item_name' => 'Tシャツ',
        //         'seller_id' => '3',
        //         'buyer_id' => NULL,
        //         'category_id' => NULL,
        //         'brand_name' => 'ブランドB',
        //         'price' => '3000',
        //         'description' => <<<DESC
        //     カラー：グレー
        //     新品
        //     商品の状態は良好です。傷もありません。
        //     購入後、即発送いたします。
        //     DESC,
        //         'condition' => '1',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'item_name' => 'ぬいぐるみ',
        //         'seller_id' => '2',
        //         'buyer_id' => NULL,
        //         'category_id' => NULL,
        //         'brand_name' => 'ブランド名',
        //         'price' => '500',
        //         'description' => <<<DESC
        //     カラー：グレー
        //     新品
        //     商品の状態は良好です。傷もありません。
        //     購入後、即発送いたします。
        //     DESC,
        //         'condition' => '2',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'item_name' => 'バッグ',
        //         'seller_id' => '3',
        //         'buyer_id' => NULL,
        //         'category_id' => NULL,
        //         'brand_name' => 'ブランド名',
        //         'price' => '5000',
        //         'description' => <<<DESC
        //     カラー：グレー
        //     新品
        //     商品の状態は良好です。傷もありません。
        //     購入後、即発送いたします。
        //     DESC,
        //         'condition' => '3',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'item_name' => '絵本',
        //         'seller_id' => '2',
        //         'buyer_id' => NULL,
        //         'category_id' => NULL,
        //         'brand_name' => 'ブランド名',
        //         'price' => '1500',
        //         'description' => <<<DESC
        //     カラー：グレー
        //     新品
        //     商品の状態は良好です。傷もありません。
        //     購入後、即発送いたします。
        //     DESC,
        //         'condition' => '2',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        // category_id が NULL の既存のアイテムを取得
        $items = Item::whereNull('category_id')->get();

        // 取得したアイテムの category_id を変更して保存
        foreach ($items as $item) {
            $item->category_id = 8; // 例えば、カテゴリIDが 1 のカテゴリに変更
            $item->save();
        }
    }
}
