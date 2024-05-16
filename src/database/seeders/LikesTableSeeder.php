<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('likes')->insert([
            [
                'user_id' => '1',
                'item_id' => '41',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
