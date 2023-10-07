<?php

namespace Database\Seeders;

use App\Models\Setting\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create([
            'code_branch' => 'PKU',
            'name_branch' => 'HO Pekanbaru',
            'npwp_branch' => '964361182706000',
            'contact_branch' => '(0761) 5795004',
            'address_branch' => 'Komp. Taman Harapan Indah, Blk. C No.16, Jl. Riau Gg. Harapan 2, Air Hitam, Kec. Payung Sekaki, Kota Pekanbaru, Riau 28292',
            'pic_branch' => 'Tn. Taufan'
        ]);

        Branch::create([
            'code_branch' => 'MDN',
            'name_branch' => 'Branch & Warehouse Medan',
            'npwp_branch' => '964361182706000',
            'contact_branch' => '(061) 42776613',
            'address_branch' => 'Komp. Menteng Indah Blok A4 No.5, Jl. Menteng VII, Medan Denai, Sumatera Utara',
            'pic_branch' => 'Tn. M. Hafiz Lubis',
        ]);

        Branch::create([
            'code_branch' => 'PNK',
            'name_branch' => 'Branch & Warehouse Pontianak',
            'npwp_branch' => '964361182706000',
            'contact_branch' => 'Unavailable',
            'address_branch' => 'Pergudangan Equator',
            'pic_branch' => 'Tn. Saktiar Sitorus'
        ]);
    }
}
