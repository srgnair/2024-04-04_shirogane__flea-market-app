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
                'buyer_id' => '3',
                'item_id' => '1',
                'transaction_type' => '購入済み',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}