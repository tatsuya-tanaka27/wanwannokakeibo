<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Kakeibo_item_mstTableSeeder::class);
        //$this->call(Kakeibo_usersTableSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
