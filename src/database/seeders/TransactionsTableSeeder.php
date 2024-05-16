<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            [
                'seller_id' => '2',
                'buyer_id' => NULL,
                'item_id' => '41',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
            ],
            [
                'seller_id' => '3',
                'buyer_id' => NULL,
                'item_id' => '42',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
            ],
            [
                'seller_id' => '2',
                'buyer_id' => NULL,
                'item_id' => '43',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
            ],
            [
                'seller_id' => '3',
                'buyer_id' => NULL,
                'item_id' => '44',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
            ],
            [
                'seller_id' => '2',
                'buyer_id' => NULL,
                'item_id' => '45',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => 1500,
            ],

        ]);
    }
}
