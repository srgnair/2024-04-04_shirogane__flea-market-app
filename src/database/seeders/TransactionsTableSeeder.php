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
                'seller_id' => '1',
                'buyer_id' => NULL,
                'item_id' => '1',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
                'payment_method' => NULL,
            ],
            [
                'seller_id' => '2',
                'buyer_id' => '1',
                'item_id' => '2',
                'transaction_type' => 'waiting_shipping',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
                'payment_method' => 'card',
            ],
            [
                'seller_id' => '1',
                'buyer_id' => NULL,
                'item_id' => '3',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
                'payment_method' => NULL,
            ],
            [
                'seller_id' => '2',
                'buyer_id' => NULL,
                'item_id' => '4',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
                'payment_method' => NULL,
            ],
            [
                'seller_id' => '1',
                'buyer_id' => NULL,
                'item_id' => '5',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => 1500,
                'payment_method' => NULL,
            ],
            [
                'seller_id' => '1',
                'buyer_id' => NULL,
                'item_id' => '6',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => 1500,
                'payment_method' => NULL,
            ],
            [
                'seller_id' => '1',
                'buyer_id' => NULL,
                'item_id' => '7',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
                'payment_method' => NULL,
            ],
            [
                'seller_id' => '2',
                'buyer_id' => '1',
                'item_id' => '8',
                'transaction_type' => 'waiting_shipping',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
                'payment_method' => 'card',
            ],
            [
                'seller_id' => '1',
                'buyer_id' => NULL,
                'item_id' => '9',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
                'payment_method' => NULL,
            ],
            [
                'seller_id' => '2',
                'buyer_id' => NULL,
                'item_id' => '10',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => NULL,
                'payment_method' => NULL,
            ],
            [
                'seller_id' => '1',
                'buyer_id' => NULL,
                'item_id' => '11',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => 1500,
                'payment_method' => NULL,
            ],
            [
                'seller_id' => '1',
                'buyer_id' => NULL,
                'item_id' => '12',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
                'amount' => 1500,
                'payment_method' => NULL,
            ],
        ]);
    }
}
