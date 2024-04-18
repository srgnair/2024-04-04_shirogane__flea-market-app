<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'user@user.com',
                'password' => bcrypt('useruser'),
                'user_name' => 'user',
                'post_code' => '1234567',
                'address' => '神奈川県横浜市',
                'building_name' => '〇〇マンション1-2-3',
                'created_at' => now(),
                'updated_at' => now(),
                'img' => 'img/grayBack.png',
            ],
            [
                'email' => 'seller_user@user.com',
                'password' => bcrypt('selleruser'),
                'user_name' => 'seller_user',
                'post_code' => '1234567',
                'address' => '神奈川県横浜市',
                'building_name' => '〇〇マンション1-2-3',
                'created_at' => now(),
                'updated_at' => now(),
                'img' => 'img/grayBack.png',
            ],
            [
                'email' => 'buyer_user@user.com',
                'password' => bcrypt('buyeruser'),
                'user_name' => 'buyer_user',
                'post_code' => '1234567',
                'address' => '神奈川県横浜市',
                'building_name' => '〇〇マンション1-2-3',
                'created_at' => now(),
                'updated_at' => now(),
                'img' => 'img/grayBack.png',
            ],
        ]);
    }
}
