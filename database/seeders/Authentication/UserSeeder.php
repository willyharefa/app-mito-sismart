<?php

namespace Database\Seeders\Authentication;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sintia Lestari',
            'nickname' => 'Sintia',
            'gender' => 'Female',
            'employee_id' => '0323.07.6.1.1.065',
            'position_id' => 2,
            'phone_number' => '0813 1345 2451',
            'email' => 'sintia@mitoindonesia.com',
            'username' => 'sintia',
            'password' => Hash::make('sintia2023'),
            'branch_id' => 1,
        ]);

        User::create([
            'name' => 'Yudha Satria',
            'nickname' => 'Yudha',
            'gender' => 'Male',
            'employee_id' => '0723.07.6.1.1.072',
            'position_id' => 2,
            'phone_number' => '0853 6387 7814',
            'email' => 'yudha@mitoindonesia.com',
            'username' => 'yudha',
            'password' => Hash::make('yudha2023'),
            'branch_id' => 1,
        ]);
        
        User::create([
            'name' => 'Gea Nabila Sari',
            'nickname' => 'Gea',
            'gender' => 'Female',
            'employee_id' => '0822.07.5.1.1.051',
            'position_id' => 1,
            'phone_number' => '0823 8481 6321',
            'email' => 'gea@mitoindonesia.com',
            'username' => 'gea',
            'password' => Hash::make('gea2023'),
            'branch_id' => 1,
        ]);
    }
}
