<?php

namespace Database\Seeders;

use App\Models\Management\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create(['name' => 'Kota Pekanbaru']);
        City::create(['name' => 'Bangkinang']);
        City::create(['name' => 'Dumai']);
        City::create(['name' => 'Selat Panjang']);
        City::create(['name' => 'Pasir Pangaraian']);
        City::create(['name' => 'Gunung']);
        City::create(['name' => 'Tembilahan']);
        City::create(['name' => 'Bagan siapiapi']);
        City::create(['name' => 'Kecamatan Pangkalan Kerinci']);
        City::create(['name' => 'Kecamatan Sinaboi']);
        City::create(['name' => 'Bagan Batu']);
        City::create(['name' => 'Bangkinang']);
        City::create(['name' => 'Rengat']);
        City::create(['name' => 'Siak']);
    }
}
