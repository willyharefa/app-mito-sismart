<?php

namespace Database\Seeders\Setting;

use App\Models\Setting\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create(['name' => 'Admin Sales']);
        Position::create(['name' => 'Sales Marketing']);
        Position::create(['name' => 'Auditor']);
        Position::create(['name' => 'Head Sales Marketing']);
        Position::create(['name' => 'Teknisi']);
    }
}
