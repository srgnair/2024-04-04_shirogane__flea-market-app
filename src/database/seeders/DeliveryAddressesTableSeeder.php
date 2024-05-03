<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DeliveryAddressesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('delivery_addresses')->insert([
            // [
            //     'user_id' => 1,
            //     'post_code' => '0123456',
            //     'address' => '神奈川県横浜市',
            //     'building_name' => 'ユーザーマンション4-5-6',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'user_id' => 8,
                'post_code' => '0123456',
                'address' => '神奈川県横浜市',
                'building_name' => 'ユーザーマンション1-2-3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
