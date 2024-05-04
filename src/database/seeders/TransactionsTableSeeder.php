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
                'seller_id' => '8',
                'buyer_id' => '9',
                'item_id' => '1',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => '8',
                'buyer_id' => '9',
                'item_id' => '2',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => '8',
                'buyer_id' => '9',
                'item_id' => '3',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => '8',
                'buyer_id' => '9',
                'item_id' => '4',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => '8',
                'buyer_id' => '9',
                'item_id' => '5',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => '8',
                'buyer_id' => '9',
                'item_id' => '6',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => '8',
                'buyer_id' => '9',
                'item_id' => '7',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => '8',
                'buyer_id' => '9',
                'item_id' => '8',
                'transaction_type' => 'listed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}