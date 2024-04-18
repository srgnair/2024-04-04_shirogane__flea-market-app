<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(ItemImagesTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
        // $this->call(DeliveryAddressesTableSeeder::class);
        // $this->call(ItemsTableSeeder::class);
        // $this->call(ItemCategoriesTableSeeder::class);
        // $this->call(LikesTableSeeder::class);
        // $this->call(OrdersTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
    }
}
