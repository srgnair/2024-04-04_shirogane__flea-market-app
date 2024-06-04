<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'transaction_id' => '1',
                'reviewer_id' => '2',
                'reviewee_id' => '1',
                'rating' => '5',
                'comment' => 'ありがとうございました。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => '1',
                'reviewer_id' => '2',
                'reviewee_id' => '3',
                'rating' => '4',
                'comment' => 'よかったです。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
