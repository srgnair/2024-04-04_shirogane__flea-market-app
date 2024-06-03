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
                'email' => 'usera@user.com',
                'password' => bcrypt('useruser'),
                'user_name' => 'usera',
                'post_code' => '1234567',
                'address' => '神奈川県横浜市',
                'building_name' => '〇〇マンション1-2-3',
                'created_at' => now(),
                'updated_at' => now(),
                'img' => 'img/grayBack.png',
                'role' => NULL,
            ],
            [
                'email' => 'userb@user.com',
                'password' => bcrypt('useruser'),
                'user_name' => 'userb',
                'post_code' => '1234567',
                'address' => '神奈川県横浜市',
                'building_name' => '〇〇マンション1-2-3',
                'created_at' => now(),
                'updated_at' => now(),
                'img' => 'img/grayBack.png',
                'role' => NULL,
            ],
            [
                'email' => 'userc@user.com',
                'password' => bcrypt('useruser'),
                'user_name' => 'userc',
                'post_code' => '1234567',
                'address' => '神奈川県横浜市',
                'building_name' => '〇〇マンション1-2-3',
                'created_at' => now(),
                'updated_at' => now(),
                'img' => 'img/grayBack.png',
                'role' => NULL,
            ],
            [
                'email' => 'admin@user.com',
                'password' => bcrypt('useruser'),
                'user_name' => 'admin',
                'post_code' => '1234567',
                'address' => '神奈川県横浜市',
                'building_name' => '〇〇マンション1-2-3',
                'created_at' => now(),
                'updated_at' => now(),
                'img' => 'img/grayBack.png',
                'role' => 'admin',
            ],
        ]);
    }
}
