<?php

namespace Database\Seeders;

use App\Models\Partner\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PT STC Indonesia
        Customer::create([
            'name_customer' => 'PT STC Indonesia',
            'type_bussiness' => 'Water Treatment',
            'npwp' => '031167703915000',
            'contact' => '(+62) 812 7662 717',
            'pic_customer' => 'Tn. Eko Apriano',
            'pic_status' => 'Manager',
            'email' => 'eko.apriano@stcresources.com',
            'branch_id' => '1',
            'pic_sales' => 'Tn Taufan',
            'city' => 'Dumai',
            'address' => 'Jl. Raya Puputan No. 18, Renon, Denpasar Selatan, Bali 80226',
            'about_customer' => 'Perusahaan yang bergerak di bidang pengolahan limbah cair kelapa sawit',
        ]);
        //PT DUMAI TIRTA PERSADA
        Customer::create([
            'name_customer' => 'PT Dumai Tirta Persada',
            'type_bussiness' => 'Water Treatment',
            'npwp' => '910805803063000',
            'contact' => '(+62) 8122 0170 800',
            'pic_customer' => 'Tn. Zakarurizal',
            'pic_status' => 'Manager',
            'email' => 'Unavailable',
            'branch_id' => '1',
            'pic_sales' => 'Unknown',
            'city' => 'Dumai',
            'address' => 'Jl. Raya Pasar Minggu KM. 18, Pejaten Timur, Pasar Minggu, Dumai',
            'about_customer' => 'This is only temporary dummy data for the demo application',
        ]);
        // PDAM Kabupaten Kampar
        Customer::create([
            'name_customer' => 'PDAM Kabupaten Kampar',
            'type_bussiness' => 'PDAM',
            'npwp' => '01.508.107.8-221.000',
            'contact' => '(+62) 8521 3985 548',
            'pic_customer' => 'Tn. Burhanis',
            'pic_status' => 'Manager',
            'email' => 'burhanis@gmail.com',
            'branch_id' => '1',
            'pic_sales' => 'Unknown',
            'city' => 'Kampar',
            'address' => 'Jl. Jendral Sudirman No. 107, Kota Bangkinang',
            'about_customer' => 'This is only temporary dummy data for the demo application',
        ]);
        // PT Grand Citra Prima
        Customer::create([
            'name_customer' => 'PT Grand Citra Prima',
            'type_bussiness' => 'Hotel',
            'npwp' => '03.047.568.5-211.000',
            'contact' => '(+62) 823 9215 9299',
            'pic_customer' => 'Tn. Delon',
            'pic_status' => 'Manager',
            'email' => 'Unavailable',
            'branch_id' => '1',
            'pic_sales' => 'Unknown',
            'city' => 'Pekanbaru',
            'address' => 'Jl. Gambir No. 5 RT.0/RW.0, Sukaramai, Pekanbaru Kota, Pekanbaru 28113',
            'about_customer' => 'This is only temporary dummy data for the demo application',
        ]);
        // PT Agro Abadi Cemerlang
        Customer::create([
            'name_customer' => 'PT Agro Abadi Cemerlang',
            'type_bussiness' => 'PKS',
            'npwp' => '02.662.492.4-705.005',
            'contact' => 'Unavailable',
            'pic_customer' => '-',
            'pic_status' => '-',
            'email' => 'Unavailable',
            'branch_id' => '1',
            'pic_sales' => 'Unknown',
            'city' => 'Sanggau',
            'address' => 'Desa Enggadai, Enggadai Meliau, Kabupaten Sanggau 78571',
            'about_customer' => 'This is only temporary dummy data for the demo application',
        ]);

    }
}
