<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Authentication\UserSeeder;
use Database\Seeders\Setting\PositionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PositionSeeder::class,
            BranchSeeder::class,
            CustomerSeeder::class,
            StockSeedeer::class,
            UserSeeder::class,
        ]);
    }
}
